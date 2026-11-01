/* Quesada Fitness theme: interactions */
(() => {
  'use strict';

  const $ = (selector, ctx = document) => ctx.querySelector(selector);
  const $$ = (selector, ctx = document) => Array.from(ctx.querySelectorAll(selector));
  const settings = window.qfSettings || {};
  const i18n = settings.i18n || {};
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Minimal printf for translated strings: supports %s and %1$s.
  const format = (template, ...values) => {
    let index = 0;
    return String(template || '').replace(/%(?:(\d+)\$)?s/g, (match, position) =>
      String(values[position ? Number(position) - 1 : index++] ?? '')
    );
  };

  /* ---------- Mobile navigation ---------- */
  const header = $('.header');
  const menuToggle = $('.menu-toggle');
  const nav = $('#site-nav');

  if (header && menuToggle && nav) {
    const setNav = (open) => {
      menuToggle.setAttribute('aria-expanded', String(open));
      menuToggle.setAttribute('aria-label', open ? menuToggle.dataset.labelClose : menuToggle.dataset.labelOpen);
      nav.classList.toggle('is-open', open);
    };

    menuToggle.addEventListener('click', () => setNav(menuToggle.getAttribute('aria-expanded') !== 'true'));
    nav.addEventListener('click', (event) => {
      if (event.target.closest('a')) setNav(false);
    });
    document.addEventListener('click', (event) => {
      if (nav.classList.contains('is-open') && !header.contains(event.target)) setNav(false);
    });
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && nav.classList.contains('is-open')) {
        setNav(false);
        menuToggle.focus();
      }
    });
    window.matchMedia('(min-width: 960px)').addEventListener('change', (event) => {
      if (event.matches) setNav(false);
    });

    const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 8);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---------- Reveal on scroll ---------- */
  const reveals = $$('.reveal');
  if ('IntersectionObserver' in window && !prefersReducedMotion) {
    const revealer = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        });
      },
      { threshold: 0.08, rootMargin: '0px 0px -40px 0px' }
    );
    reveals.forEach((el) => revealer.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add('is-visible'));
  }

  /* ---------- Gym time (Europe/Madrid) ---------- */
  const gymNow = () => {
    try {
      const parts = new Intl.DateTimeFormat('en-GB', {
        timeZone: 'Europe/Madrid',
        weekday: 'short',
        hour: '2-digit',
        minute: '2-digit',
        hourCycle: 'h23',
      }).formatToParts(new Date());
      const get = (type) => parts.find((p) => p.type === type).value;
      const day = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].indexOf(get('weekday'));
      return day < 0 ? null : { day, minutes: Number(get('hour')) * 60 + Number(get('minute')) };
    } catch {
      return null;
    }
  };

  /* ---------- Open / closed badge ---------- */
  const formatTime = (minutes) =>
    `${String(Math.floor(minutes / 60)).padStart(2, '0')}:${String(minutes % 60).padStart(2, '0')}`;

  const updateOpenStatus = () => {
    const badges = $$('[data-open-status]');
    const hours = settings.hours || {};
    const now = gymNow();
    if (!badges.length || !now || !hours[now.day]) return;

    const [opens, closes] = hours[now.day];
    const isOpen = now.minutes >= opens && now.minutes < closes;
    let text;
    if (isOpen) {
      text = format(i18n.openUntil, formatTime(closes));
    } else if (now.minutes < opens) {
      text = format(i18n.opensAt, formatTime(opens));
    } else {
      let next = (now.day + 1) % 7;
      while (!hours[next] && next !== now.day) next = (next + 1) % 7;
      text = hours[next] ? format(i18n.opensDay, (i18n.days || [])[next] || '', formatTime(hours[next][0])) : '';
    }

    badges.forEach((badge) => {
      badge.classList.toggle('is-open', isOpen);
      const label = $('[data-open-status-text]', badge);
      if (label && text) label.textContent = text;
    });
    $$('.hours-card__list li[data-days]').forEach((row) => {
      row.classList.toggle('is-today', row.dataset.days.split(',').map(Number).includes(now.day));
    });
  };
  updateOpenStatus();
  setInterval(updateOpenStatus, 60 * 1000);

  /* ---------- Timetable tabs ---------- */
  $$('[data-timetable]').forEach((timetable) => {
    const tabs = $$('[role="tab"]', timetable);
    const panels = $$('[role="tabpanel"]', timetable);

    const select = (tab, focus = false) => {
      tabs.forEach((t) => {
        const selected = t === tab;
        t.setAttribute('aria-selected', String(selected));
        t.tabIndex = selected ? 0 : -1;
      });
      panels.forEach((panel) => {
        panel.hidden = panel.id !== tab.getAttribute('aria-controls');
      });
      if (focus) tab.focus();
    };

    tabs.forEach((tab, index) => {
      tab.addEventListener('click', () => select(tab));
      tab.addEventListener('keydown', (event) => {
        const keys = { ArrowRight: index + 1, ArrowLeft: index - 1, Home: 0, End: tabs.length - 1 };
        if (!(event.key in keys)) return;
        event.preventDefault();
        select(tabs[(keys[event.key] + tabs.length) % tabs.length], true);
      });
    });

    // Open on today's classes (gym time).
    const now = gymNow();
    const today = now && tabs.find((t) => Number(t.dataset.day) === now.day);
    if (today) select(today);
  });

  /* ---------- Photo lightbox ---------- */
  const dialog = $('[data-lightbox-dialog]');
  if (dialog && typeof dialog.showModal === 'function') {
    const img = $('.lightbox__img', dialog);
    const caption = $('.lightbox__caption', dialog);
    let group = [];
    let current = 0;

    const show = (index) => {
      current = (index + group.length) % group.length;
      const link = group[current];
      const thumb = $('img', link);
      img.src = link.href;
      img.alt = thumb ? thumb.alt : '';
      caption.textContent = thumb ? thumb.alt : '';
    };

    document.addEventListener('click', (event) => {
      const link = event.target.closest('[data-lightbox]');
      if (!link) return;
      event.preventDefault();
      const container = link.closest('[data-lightbox-group]');
      group = container ? $$('[data-lightbox]', container) : [link];
      show(group.indexOf(link));
      dialog.showModal();
    });

    $('[data-lightbox-close]', dialog).addEventListener('click', () => dialog.close());
    $('[data-lightbox-prev]', dialog).addEventListener('click', () => show(current - 1));
    $('[data-lightbox-next]', dialog).addEventListener('click', () => show(current + 1));
    dialog.addEventListener('click', (event) => {
      if (event.target === dialog) dialog.close();
    });
    dialog.addEventListener('keydown', (event) => {
      if (event.key === 'ArrowLeft') show(current - 1);
      if (event.key === 'ArrowRight') show(current + 1);
    });
    dialog.addEventListener('close', () => {
      img.removeAttribute('src');
    });
  }

  /* ---------- Map: load Google Maps only on request ---------- */
  $$('[data-map]').forEach((map) => {
    const button = $('[data-map-load]', map);
    if (!button) return;
    button.addEventListener('click', () => {
      const iframe = document.createElement('iframe');
      iframe.src = map.dataset.map;
      iframe.title = button.textContent.trim();
      iframe.loading = 'lazy';
      iframe.referrerPolicy = 'no-referrer-when-downgrade';
      map.replaceChildren(iframe);
    });
  });

  /* ---------- Fallback contact form: open the visitor's email app ---------- */
  $$('[data-mail-form]').forEach((form) => {
    const status = $('.form__status', form);
    const fields = $$('[required]', form);

    const validate = (input) => {
      const value = input.value.trim();
      let message = '';
      if (!value) message = i18n.required || '';
      else if (input.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(value)) message = i18n.invalidMail || '';
      const field = input.closest('.field');
      const error = field && $('.field__error', field);
      if (field) field.classList.toggle('has-error', Boolean(message));
      input.setAttribute('aria-invalid', String(Boolean(message)));
      if (error) {
        error.textContent = message;
        if (message) input.setAttribute('aria-describedby', error.id);
        else input.removeAttribute('aria-describedby');
      }
      return !message;
    };

    fields.forEach((input) => {
      input.addEventListener('input', () => {
        if (input.closest('.has-error')) validate(input);
      });
    });

    form.addEventListener('submit', (event) => {
      event.preventDefault();
      status.hidden = true;
      const invalid = fields.filter((input) => !validate(input));
      if (invalid.length) {
        invalid[0].focus();
        return;
      }
      const data = new FormData(form);
      const body = `${data.get('message')}\n\n${data.get('name')}\n${data.get('email')}`;
      const subject = `Website enquiry: ${data.get('name')}`;
      window.location.href = `mailto:${settings.email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
      status.textContent = format(i18n.formSent, settings.email);
      status.hidden = false;
    });
  });
})();
