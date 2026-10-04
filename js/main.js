/* Quesada Fitness Gym: interactions */
(() => {
  'use strict';

  const $ = (selector, ctx = document) => ctx.querySelector(selector);
  const $$ = (selector, ctx = document) => Array.from(ctx.querySelectorAll(selector));
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  const GYM_EMAIL = 'quesadafitnessgymboxing@gmail.com';

  /* ---------- Mobile navigation ---------- */
  const header = $('.header');
  const menuToggle = $('.menu-toggle');
  const nav = $('#site-nav');

  const setNav = (open) => {
    menuToggle.setAttribute('aria-expanded', String(open));
    menuToggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    nav.classList.toggle('is-open', open);
  };

  menuToggle.addEventListener('click', () => {
    setNav(menuToggle.getAttribute('aria-expanded') !== 'true');
  });

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

  /* ---------- Header state & back-to-top ---------- */
  const toTop = $('.to-top');

  const onScroll = () => {
    const y = window.scrollY;
    header.classList.toggle('is-scrolled', y > 8);
    toTop.classList.toggle('is-visible', y > 700);
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* ---------- Active link on scroll ---------- */
  const navLinks = $$('.nav__link');
  const sections = navLinks
    .map((link) => document.getElementById(link.getAttribute('href').slice(1)))
    .filter(Boolean);

  if ('IntersectionObserver' in window) {
    const spy = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          navLinks.forEach((link) => {
            const active = link.getAttribute('href') === `#${entry.target.id}`;
            link.classList.toggle('is-active', active);
            if (active) link.setAttribute('aria-current', 'location');
            else link.removeAttribute('aria-current');
          });
        });
      },
      { rootMargin: '-45% 0px -50% 0px' }
    );
    sections.forEach((section) => spy.observe(section));
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
      { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );
    reveals.forEach((el) => revealer.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add('is-visible'));
  }

  /* ---------- Open / closed status (gym time: Europe/Madrid) ---------- */
  // Minutes from midnight, per weekday (0 = Sunday)
  const openingHours = {
    0: [9 * 60, 13 * 60],
    1: [7 * 60, 21 * 60 + 30],
    2: [7 * 60, 21 * 60 + 30],
    3: [7 * 60, 21 * 60 + 30],
    4: [7 * 60, 21 * 60 + 30],
    5: [7 * 60, 21 * 60 + 30],
    6: [9 * 60, 13 * 60],
  };
  const dayLabels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
  const formatTime = (minutes) =>
    `${String(Math.floor(minutes / 60)).padStart(2, '0')}:${String(minutes % 60).padStart(2, '0')}`;

  const gymNow = () => {
    const parts = new Intl.DateTimeFormat('en-GB', {
      timeZone: 'Europe/Madrid',
      weekday: 'short',
      hour: '2-digit',
      minute: '2-digit',
      hourCycle: 'h23',
    }).formatToParts(new Date());
    const get = (type) => parts.find((p) => p.type === type).value;
    return { day: dayLabels.indexOf(get('weekday')), minutes: Number(get('hour')) * 60 + Number(get('minute')) };
  };

  const updateOpenStatus = () => {
    const status = $('#open-status');
    const statusText = $('#open-status-text');
    if (!status || !statusText) return;

    let now;
    try {
      now = gymNow();
    } catch {
      return; // Leave the static "Opening hours" label
    }
    if (now.day < 0) return;

    const [opens, closes] = openingHours[now.day];
    const isOpen = now.minutes >= opens && now.minutes < closes;
    let text;

    if (isOpen) {
      text = `Open now · until ${formatTime(closes)}`;
    } else if (now.minutes < opens) {
      text = `Closed · opens ${formatTime(opens)}`;
    } else {
      const nextDay = (now.day + 1) % 7;
      text = `Closed · opens ${dayLabels[nextDay]} ${formatTime(openingHours[nextDay][0])}`;
    }

    status.classList.toggle('is-open', isOpen);
    statusText.textContent = text;
    $$('.hours-card__list li').forEach((row) => {
      row.classList.toggle('is-today', row.dataset.days.split(',').map(Number).includes(now.day));
    });
  };

  updateOpenStatus();
  setInterval(updateOpenStatus, 60 * 1000);

  /* ---------- Prefill contact form from price buttons ---------- */
  const contactForm = $('#contact-form');
  const interestSelect = $('#interest');

  document.addEventListener('click', (event) => {
    const button = event.target.closest('[data-interest]');
    if (!button) return;
    interestSelect.value = button.dataset.interest;
    validateField(interestSelect);
  });

  /* ---------- BMI calculator ---------- */
  const bmiForm = $('#bmi-form');
  const bmiHeight = $('#bmi-height');
  const bmiWeight = $('#bmi-weight');
  const bmiValue = $('#bmi-value');
  const bmiCategory = $('#bmi-category');
  const bmiMarker = $('#bmi-marker');
  const bmiResult = $('.bmi__result');

  const bmiRanges = [
    { max: 18.5, label: 'Underweight' },
    { max: 25, label: 'Healthy weight' },
    { max: 30, label: 'Overweight' },
    { max: Infinity, label: 'Obese' },
  ];

  bmiForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const height = parseFloat(bmiHeight.value);
    const weight = parseFloat(bmiWeight.value);
    const heightOk = height >= 100 && height <= 250;
    const weightOk = weight >= 30 && weight <= 300;

    bmiHeight.closest('.field').classList.toggle('has-error', !heightOk);
    bmiWeight.closest('.field').classList.toggle('has-error', !weightOk);
    bmiHeight.setAttribute('aria-invalid', String(!heightOk));
    bmiWeight.setAttribute('aria-invalid', String(!weightOk));

    if (!heightOk || !weightOk) {
      bmiResult.classList.remove('has-value');
      bmiValue.textContent = '--.-';
      bmiCategory.textContent = 'Please enter a height between 100 and 250 cm and a weight between 30 and 300 kg.';
      return;
    }

    const bmi = weight / (height / 100) ** 2;
    const range = bmiRanges.find((r) => bmi < r.max);
    const position = Math.min(Math.max((bmi - 15) / (40 - 15), 0), 1) * 100;

    bmiValue.textContent = bmi.toFixed(1);
    bmiCategory.innerHTML = `<strong>${range.label}.</strong> Book a gym induction or a personal training session to plan your next steps.`;
    bmiMarker.style.left = `${position}%`;
    bmiResult.classList.add('has-value');
  });

  /* ---------- Contact form: validate, then open an email to the gym ---------- */
  const validators = {
    name: (v) => v.trim().length >= 2 || 'Please enter your full name.',
    email: (v) => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim()) || 'Please enter a valid email address.',
    phone: (v) => !v.trim() || /^\+?[\d\s().-]{7,20}$/.test(v.trim()) || 'Please enter a valid phone number.',
    interest: (v) => Boolean(v) || 'Please choose an option.',
  };

  function validateField(input) {
    const rule = validators[input.name];
    if (!rule) return true;
    const result = rule(input.value);
    const valid = result === true;
    const field = input.closest('.field');
    const error = field.querySelector('.field__error');

    field.classList.toggle('has-error', !valid);
    input.setAttribute('aria-invalid', String(!valid));
    if (error) {
      error.textContent = valid ? '' : result;
      if (valid) input.removeAttribute('aria-describedby');
      else input.setAttribute('aria-describedby', error.id);
    }
    return valid;
  }

  const contactFields = $$('input, select', contactForm).filter((el) => validators[el.name]);

  contactFields.forEach((input) => {
    input.addEventListener('blur', () => {
      if (input.value) validateField(input);
    });
    input.addEventListener('input', () => {
      if (input.closest('.field').classList.contains('has-error')) validateField(input);
    });
  });

  const formStatus = $('#form-status');

  contactForm.addEventListener('submit', (event) => {
    event.preventDefault();
    formStatus.hidden = true;

    const results = contactFields.map(validateField);
    const firstInvalid = contactFields[results.indexOf(false)];
    if (firstInvalid) {
      firstInvalid.focus();
      return;
    }

    const name = $('#name').value.trim();
    const email = $('#email').value.trim();
    const phone = $('#phone').value.trim();
    const interest = interestSelect.options[interestSelect.selectedIndex].text;
    const message = $('#message').value.trim();

    const subject = `Website enquiry: ${interest}`;
    const lines = [`Name: ${name}`, `Email: ${email}`];
    if (phone) lines.push(`Phone: ${phone}`);
    lines.push(`Interested in: ${interest}`);
    if (message) lines.push('', message);
    const body = lines.join('\n');

    window.location.href = `mailto:${GYM_EMAIL}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;

    formStatus.textContent = `Your email app should now open with the message ready to send. If it doesn't, write to us at ${GYM_EMAIL}.`;
    formStatus.hidden = false;
  });

  /* ---------- Footer year ---------- */
  $('#year').textContent = new Date().getFullYear();
})();
