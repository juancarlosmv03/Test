# Quesada Fitness Gym website

A responsive, mobile-first website for Quesada Fitness Gym (Ciudad Quesada, Rojales, Alicante), built with plain HTML, CSS and JavaScript. No build step, no dependencies.

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
js/main.js         Menu, live open/closed status, BMI calculator, contact form
assets/favicon.svg
```

## Sections

Hero with live opening status · Facilities · Group classes · On-site services · Prices · BMI calculator · Online booking · Contact & opening hours · Footer

## Where the content comes from

The official site (quesadafitness.com) could not be reached from the build environment, so the content was taken from public web search results about the business (search snippets of quesadafitness.com, its Facebook page, Tripadvisor and local directories). Only details found there were used; nothing was made up.

| Content | Value used | Notes |
| --- | --- | --- |
| Address | Avenida del Aeropuerto, 50-D, 03170 Ciudad Quesada, Rojales | One older listing says number 66 |
| Phone | +34 865 77 45 77 | Consistent across sources |
| Email | quesadafitnessgymboxing@gmail.com | Attributed to the official site; the Facebook page lists fitnessquesada@gmail.com |
| Opening hours | Mon–Fri 07:00–21:30, Sat–Sun 09:00–13:00 | From directory listings |
| Prices | Weekly €15, 2-week €20, induction €10, personal training €25/hour | Monthly price conflicts between sources (€30 vs €40), so the page says "ask at reception" |
| Classes | Spinning, Pilates, Simply Dumbbells, Body Conditioning, Legs Bums & Tums, Zumba, Zumba Gold, Hip Hop, Tai Chi, AquaFit | No class times were available; the page links to Facebook for the timetable |
| Services | Men's barber, hair & beauty, osteopathy, chiromassage | A travel aggregator also lists nail technician, sports massage, hypnotherapy and healing (not included) |
| Links | Online booking (Setmore), Facebook, X | No Instagram handle was found |

**Before publishing, confirm the prices, hours and email with the gym**, and add their logo and photos if available (the page currently uses a generic logo mark and no photos).

## Customizing

- **Colors, radii, fonts**: edit the CSS variables at the top of `css/styles.css`.
- **Opening hours**: update both the HTML (hero card, contact section, footer) and the `openingHours` object in `js/main.js`, which drives the "Open now / Closed" badge (Spain time).
- **Prices**: edit the `.prices` section in `index.html`.

## Contact form

The form validates input and then opens the visitor's email app with a pre-filled message to the gym's email address (`GYM_EMAIL` in `js/main.js`). To receive submissions directly instead, replace that step with a `fetch()` call to a backend or form service.
