(function () {
  // Mobile menu.
  var toggle = document.querySelector('.menu-toggle');
  var nav = document.getElementById('site-nav');
  if (toggle && nav) {
    var setOpen = function (open) {
      nav.classList.toggle('is-open', open);
      toggle.setAttribute('aria-expanded', String(open));
      // SVG elements have no .hidden property, so toggle the attribute.
      toggle.querySelector('.icon-open').toggleAttribute('hidden', open);
      toggle.querySelector('.icon-close').toggleAttribute('hidden', !open);
    };
    toggle.addEventListener('click', function () {
      setOpen(toggle.getAttribute('aria-expanded') !== 'true');
    });
    nav.addEventListener('click', function (e) {
      if (e.target.closest('a')) setOpen(false);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') setOpen(false);
    });
  }

  // "Request this" on a service card preselects that service in the form.
  var select = document.getElementById('request-service');
  document.querySelectorAll('[data-service]').forEach(function (link) {
    link.addEventListener('click', function () {
      if (select) select.value = link.getAttribute('data-service');
    });
  });
})();
