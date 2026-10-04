/* IronPulse Gym: interactions */
(() => {
  'use strict';

  const $ = (selector, ctx = document) => ctx.querySelector(selector);
  const $$ = (selector, ctx = document) => Array.from(ctx.querySelectorAll(selector));
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

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

  /* ---------- Class schedule ---------- */
  const schedule = {
    mon: [
      { time: '06:00', name: 'Strength Training', coach: 'Marcus Reed', duration: 60, room: 'Main floor', level: 'All levels' },
      { time: '07:30', name: 'Yoga & Mobility', coach: 'Sofia Lindqvist', duration: 45, room: 'Studio 1', level: 'Beginner' },
      { time: '12:15', name: 'HIIT Inferno', coach: 'Elena Torres', duration: 45, room: 'Studio 2', level: 'Intermediate' },
      { time: '18:00', name: 'Boxing', coach: 'Jay Okafor', duration: 60, room: 'Fight zone', level: 'All levels' },
      { time: '19:30', name: 'CrossFit WOD', coach: 'Marcus Reed', duration: 50, room: 'Rig area', level: 'Advanced' },
    ],
    tue: [
      { time: '06:30', name: 'HIIT Inferno', coach: 'Elena Torres', duration: 45, room: 'Studio 2', level: 'Intermediate' },
      { time: '09:00', name: 'Yoga & Mobility', coach: 'Sofia Lindqvist', duration: 45, room: 'Studio 1', level: 'Beginner' },
      { time: '17:30', name: 'Kickboxing', coach: 'Jay Okafor', duration: 60, room: 'Fight zone', level: 'Intermediate' },
      { time: '19:00', name: 'Strength Training', coach: 'Marcus Reed', duration: 60, room: 'Main floor', level: 'All levels' },
    ],
    wed: [
      { time: '06:00', name: 'CrossFit WOD', coach: 'Marcus Reed', duration: 50, room: 'Rig area', level: 'Advanced' },
      { time: '07:30', name: 'Yoga & Mobility', coach: 'Sofia Lindqvist', duration: 45, room: 'Studio 1', level: 'Beginner' },
      { time: '12:15', name: 'HIIT Inferno', coach: 'Elena Torres', duration: 45, room: 'Studio 2', level: 'Intermediate' },
      { time: '18:00', name: 'Boxing', coach: 'Jay Okafor', duration: 60, room: 'Fight zone', level: 'All levels' },
      { time: '19:30', name: 'Strength Training', coach: 'Marcus Reed', duration: 60, room: 'Main floor', level: 'All levels' },
    ],
    thu: [
      { time: '06:30', name: 'HIIT Inferno', coach: 'Elena Torres', duration: 45, room: 'Studio 2', level: 'Intermediate' },
      { time: '12:00', name: 'Strength Training', coach: 'Marcus Reed', duration: 60, room: 'Main floor', level: 'All levels' },
      { time: '17:30', name: 'Kickboxing', coach: 'Jay Okafor', duration: 60, room: 'Fight zone', level: 'Intermediate' },
      { time: '19:00', name: 'Yoga & Mobility', coach: 'Sofia Lindqvist', duration: 45, room: 'Studio 1', level: 'Beginner' },
    ],
    fri: [
      { time: '06:00', name: 'Strength Training', coach: 'Marcus Reed', duration: 60, room: 'Main floor', level: 'All levels' },
      { time: '12:15', name: 'HIIT Inferno', coach: 'Elena Torres', duration: 45, room: 'Studio 2', level: 'Intermediate' },
      { time: '18:00', name: 'CrossFit WOD', coach: 'Marcus Reed', duration: 50, room: 'Rig area', level: 'Advanced' },
      { time: '19:30', name: 'Boxing', coach: 'Jay Okafor', duration: 60, room: 'Fight zone', level: 'All levels' },
    ],
    sat: [
      { time: '09:00', name: 'Saturday Sweat', coach: 'Elena Torres', duration: 60, room: 'Studio 2', level: 'All levels' },
      { time: '10:30', name: 'Boxing Bootcamp', coach: 'Jay Okafor', duration: 75, room: 'Fight zone', level: 'Advanced' },
      { time: '12:00', name: 'Yoga & Mobility', coach: 'Sofia Lindqvist', duration: 60, room: 'Studio 1', level: 'Beginner' },
    ],
    sun: [
      { time: '10:00', name: 'Recovery Flow', coach: 'Sofia Lindqvist', duration: 60, room: 'Studio 1', level: 'Beginner' },
      { time: '11:30', name: 'Open Gym Coaching', coach: 'Marcus Reed', duration: 90, room: 'Main floor', level: 'All levels' },
    ],
  };

  const dayNames = { mon: 'Monday', tue: 'Tuesday', wed: 'Wednesday', thu: 'Thursday', fri: 'Friday', sat: 'Saturday', sun: 'Sunday' };
  const tabs = $$('.tab');
  const panel = $('#schedule-panel');
  const classList = $('#class-list');

  const renderDay = (day) => {
    classList.innerHTML = schedule[day]
      .map((item, index) => {
        const levelClass = item.level === 'Advanced' ? ' class-item__level--advanced' : '';
        return `
          <li class="class-item" style="animation-delay: ${index * 60}ms">
            <span class="class-item__time">${item.time}</span>
            <div class="class-item__info">
              <h3 class="class-item__name">${item.name}</h3>
              <p class="class-item__meta">${item.coach} · ${item.duration} min · ${item.room}</p>
            </div>
            <span class="class-item__level${levelClass}">${item.level}</span>
            <a href="#contact" class="btn btn--ghost btn--sm class-item__btn"
               data-book="${item.name}" data-day="${dayNames[day]}" data-time="${item.time}"
               aria-label="Book ${item.name} on ${dayNames[day]} at ${item.time}">Book spot</a>
          </li>`;
      })
      .join('');
  };

  const selectTab = (tab, focus = false) => {
    tabs.forEach((t) => {
      const selected = t === tab;
      t.setAttribute('aria-selected', String(selected));
      t.tabIndex = selected ? 0 : -1;
    });
    panel.setAttribute('aria-labelledby', tab.id);
    renderDay(tab.dataset.day);
    if (focus) tab.focus();
    tab.scrollIntoView({ block: 'nearest', inline: 'nearest' });
  };

  tabs.forEach((tab, index) => {
    tab.addEventListener('click', () => selectTab(tab));
    tab.addEventListener('keydown', (event) => {
      let next = null;
      if (event.key === 'ArrowRight') next = tabs[(index + 1) % tabs.length];
      if (event.key === 'ArrowLeft') next = tabs[(index - 1 + tabs.length) % tabs.length];
      if (event.key === 'Home') next = tabs[0];
      if (event.key === 'End') next = tabs[tabs.length - 1];
      if (next) {
        event.preventDefault();
        selectTab(next, true);
      }
    });
  });

  // Open today's schedule by default (getDay: 0 = Sunday)
  const todayKey = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'][new Date().getDay()];
  const todayTab = tabs.find((t) => t.dataset.day === todayKey) || tabs[0];
  tabs.forEach((t) => {
    t.setAttribute('aria-selected', String(t === todayTab));
    t.tabIndex = t === todayTab ? 0 : -1;
  });
  panel.setAttribute('aria-labelledby', todayTab.id);
  renderDay(todayTab.dataset.day);

  /* ---------- Pricing toggle ---------- */
  const billingSwitch = $('#billing-switch');
  const billingLabels = $$('.billing__label');

  const setBilling = (yearly) => {
    billingSwitch.setAttribute('aria-checked', String(yearly));
    billingLabels.forEach((label) => {
      label.classList.toggle('is-active', (label.dataset.billing === 'yearly') === yearly);
    });
    $$('.plan__amount').forEach((el) => {
      el.textContent = yearly ? el.dataset.yearly : el.dataset.monthly;
    });
    $$('.plan__period').forEach((el) => {
      el.textContent = yearly ? '/mo, billed yearly' : '/month';
    });
  };

  billingSwitch.addEventListener('click', () => {
    setBilling(billingSwitch.getAttribute('aria-checked') !== 'true');
  });

  billingLabels.forEach((label) => {
    label.addEventListener('click', () => setBilling(label.dataset.billing === 'yearly'));
  });

  /* ---------- Prefill contact form from plan & class buttons ---------- */
  const contactForm = $('#contact-form');
  const planSelect = $('#plan');
  const messageField = $('#message');

  document.addEventListener('click', (event) => {
    const planButton = event.target.closest('[data-plan]');
    if (planButton) {
      planSelect.value = planButton.dataset.plan;
      validateField(planSelect);
    }

    const bookButton = event.target.closest('[data-book]');
    if (bookButton) {
      const { book, day, time } = bookButton.dataset;
      if (!planSelect.value) planSelect.value = 'trial';
      messageField.value = `I'd like to book ${book} on ${day} at ${time}.`;
      validateField(planSelect);
    }
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
    { max: 18.5, label: 'Underweight', tip: 'Our strength programs and nutrition coaching can help you build healthy mass.' },
    { max: 25, label: 'Healthy weight', tip: 'Great starting point! Let\'s build strength and keep you performing at your best.' },
    { max: 30, label: 'Overweight', tip: 'HIIT and strength training are a powerful combo to help you reach your goal.' },
    { max: Infinity, label: 'Obese', tip: 'Our coaches will build a safe, step-by-step plan tailored to you.' },
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
    bmiCategory.innerHTML = `<strong>${range.label}.</strong> ${range.tip}`;
    bmiMarker.style.left = `${position}%`;
    bmiResult.classList.add('has-value');
  });

  /* ---------- Contact form validation ---------- */
  const validators = {
    name: (v) => v.trim().length >= 2 || 'Please enter your full name.',
    email: (v) => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim()) || 'Please enter a valid email address.',
    phone: (v) => !v.trim() || /^\+?[\d\s().-]{7,20}$/.test(v.trim()) || 'Please enter a valid phone number.',
    plan: (v) => Boolean(v) || 'Please choose an option.',
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
  const submitButton = $('[type="submit"]', contactForm);
  const submitLabel = submitButton.innerHTML;

  contactForm.addEventListener('submit', (event) => {
    event.preventDefault();
    formStatus.hidden = true;

    const results = contactFields.map(validateField);
    const firstInvalid = contactFields[results.indexOf(false)];
    if (firstInvalid) {
      firstInvalid.focus();
      return;
    }

    const firstName = $('#name').value.trim().split(/\s+/)[0];
    submitButton.disabled = true;
    submitButton.textContent = 'Sending…';

    // No backend yet: simulate the request. Replace with a real fetch() to your API or form service.
    setTimeout(() => {
      contactForm.reset();
      submitButton.disabled = false;
      submitButton.innerHTML = submitLabel;
      formStatus.textContent = `Thanks, ${firstName}! A coach will contact you within 24 hours to set up your free week.`;
      formStatus.hidden = false;
    }, 900);
  });

  /* ---------- Footer year ---------- */
  $('#year').textContent = new Date().getFullYear();
})();
