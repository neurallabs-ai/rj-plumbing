#!/usr/bin/env node
/*
  Rebuilds the theme's pages/ and assets/ from the static site export in ../source.

  Usage (from the theme folder, with Node on PATH):
    node tools/build-from-export.mjs

  To update the design: replace source/ with the new export, run this, test locally, commit.

  What it does to each page:
    - keeps the page body (header, main, footer and the menu script) exactly as designed;
    - turns links like "services-drain-cleaning.html" into WordPress URLs ("{{BASE}}/services/drain-cleaning/");
    - points images at the theme's assets/ folder;
    - makes the estimate forms post to WordPress instead of showing the "demo preview" note.
  {{BASE}}, {{ASSETS}}, {{FORM_ACTION}} and {{FORM_FIELDS}} are filled in by functions.php when the page is served.
*/
import { cp, mkdir, readdir, readFile, rm, writeFile } from "node:fs/promises";
import { dirname, join, resolve } from "node:path";
import { fileURLToPath } from "node:url";

const themeDir = resolve(dirname(fileURLToPath(import.meta.url)), "..");
const sourceDir = join(themeDir, "source");
const pagesDir = join(themeDir, "pages");
const assetsDir = join(themeDir, "assets");

// Export file name (without .html) -> route under the site home ("" is the homepage).
function routeFor(name) {
  if (name === "index") return "";
  for (const prefix of ["services", "service-areas", "blog"]) {
    if (name === prefix) return prefix;
    if (name.startsWith(prefix + "-")) return `${prefix}/${name.slice(prefix.length + 1)}`;
  }
  return name;
}

function url(route, hash = "") {
  return `{{BASE}}/${route ? route + "/" : ""}${hash}`;
}

const FORM_SCRIPT = /document\.querySelectorAll\('form\.form-card'\)[\s\S]*?insertAdjacentElement\('afterend',p\);\}\);\}\);/;
const FORM_SCRIPT_LIVE = "document.querySelectorAll('form.form-card').forEach(function(f){f.addEventListener('submit',function(e){if(!f.reportValidity())e.preventDefault();});});";

function convert(html) {
  const title = (html.match(/<title>([\s\S]*?)<\/title>/) || [])[1] || "";
  const start = html.indexOf('<a class="skip-link"');
  const end = html.lastIndexOf("</body>");
  if (start < 0 || end < 0) throw new Error("page body markers not found");
  let body = html.slice(start, end);

  if (!FORM_SCRIPT.test(body)) throw new Error("form script not found");
  body = body
    .replace(FORM_SCRIPT, FORM_SCRIPT_LIVE)
    .replace(/'contact\.html#estimate'/g, `'${url("contact", "#estimate")}'`)
    .replace(/href="([a-z0-9-]+)\.html(#[a-z0-9-]*)?"/g, (_, name, hash) => `href="${url(routeFor(name), hash || "")}"`)
    .replace(/(src|href)="images\//g, '$1="{{ASSETS}}/images/')
    .replace(/<form class="form-card"([^>]*)>/g, '<form class="form-card" method="post" action="{{FORM_ACTION}}"$1>{{FORM_FIELDS}}');

  return { title, body };
}

await rm(pagesDir, { recursive: true, force: true });
await mkdir(pagesDir, { recursive: true });

const files = (await readdir(sourceDir)).filter((f) => f.endsWith(".html"));
const titles = {};
for (const file of files) {
  const name = file.slice(0, -5);
  const route = routeFor(name);
  const { title, body } = convert(await readFile(join(sourceDir, file), "utf8"));
  const out = join(pagesDir, (route || "index") + ".html");
  await mkdir(dirname(out), { recursive: true });
  await writeFile(out, body);
  titles[route] = title;
  console.log(`  /${route}  <-  ${file}`);
}

// The homepage export carries the artifact's preview title, so give it a real one.
titles[""] = "R. Jacobs Plumbing | Licensed Winnipeg Plumber, Open 24/7";

// 404 page: the thank-you page layout with its own message.
const thanks = (await readFile(join(pagesDir, "thank-you.html"), "utf8"));
const notFound = thanks.replace(
  /<main id="main">[\s\S]*<\/main>/,
  '<main id="main"><section class="page-hero page-hero--light thanks" aria-labelledby="page-title"><div class="container thanks__inner">'
    + '<h1 id="page-title" class="h1">Page not found</h1>'
    + '<p class="thanks__while">The page you’re looking for doesn’t exist or has moved.</p>'
    + `<a class="btn btn--primary btn--lg" href="${url("")}">Back to home</a>`
    + "</div></section></main>",
);
await writeFile(join(pagesDir, "404.html"), notFound);
titles["404"] = "Page Not Found | R. Jacobs Plumbing";

await writeFile(join(pagesDir, "titles.json"), JSON.stringify(titles, null, 1));

await rm(assetsDir, { recursive: true, force: true });
await mkdir(assetsDir, { recursive: true });
await cp(join(sourceDir, "site.css"), join(assetsDir, "site.css"));
await cp(join(sourceDir, "images"), join(assetsDir, "images"), { recursive: true });
console.log(`Built ${files.length} pages + 404 into pages/, assets into assets/`);
