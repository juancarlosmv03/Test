# IronPulse Gym

A responsive, mobile-first landing page for a gym, built with plain HTML, CSS and JavaScript (no build step, no dependencies).

## Preview

Open `index.html` in a browser, or serve the folder locally:

```bash
python3 -m http.server 8000
# then visit http://localhost:8000
```

## Structure

```
index.html         Page markup (all sections + inline SVG icon sprite)
css/styles.css     Mobile-first styles; design tokens live in :root
js/main.js         Menu, schedule tabs, pricing toggle, BMI calculator, form validation
assets/favicon.svg
```

## Sections

Hero · Programs · Why Us · Class schedule (tabbed by day) · Trainers · Pricing (monthly / yearly toggle) · Testimonials · BMI calculator · Free-week CTA · Contact form · Footer

## Customizing

- **Colors, radii, fonts**: edit the CSS variables at the top of `css/styles.css` (`--c-red`, `--radius-lg`, etc.).
- **Class schedule**: edit the `schedule` object in `js/main.js`.
- **Prices**: edit the `data-monthly` / `data-yearly` attributes on `.plan__amount` in `index.html`.
- **Placeholder content**: the gym name, address, phone, email, coaches and testimonials are sample data. Replace them with real details before publishing.

## Contact form

The form validates input on the client and shows a success message, but **it does not send data anywhere yet**. Connect it to a backend or a form service by replacing the simulated `setTimeout` in the submit handler in `js/main.js` with a real `fetch()` call.

## Breakpoints

Base styles target phones. Layout enhancements kick in at `480px`, `640px`, `960px` (desktop nav) and `1200px`.
