# Quesada Fitness WordPress theme

Mobile-first black and red theme for Quesada Fitness GYM (Ciudad Quesada, Rojales). It is built to replace the current Divi theme on quesadafitness.com and reuses the site's existing pages, posts, menu, photos and contact form.

## Install

1. Build the zip (from the `wordpress-theme` folder): `./build-zip.sh` → `quesada-fitness.zip`.
2. In WordPress: **Appearance → Themes → Add New → Upload Theme**, choose the zip, then **Activate**.
3. Check **Appearance → Menus**: the theme uses the same menu location id as Divi (`primary-menu`), so the existing menu is normally kept. If not, assign it to **Main menu**.
4. Optional: **Appearance → Customize → Quesada Fitness** to review contact details, hours, prices and timetable.

Test on a copy of the site first (LocalWP, staging) before activating it in production.

## How pages are built

WordPress picks the template from the page slug, so the existing pages get the new design automatically:

| Page (slug) | Template | Content source |
| --- | --- | --- |
| Inicio (front page) | `front-page.php` | Theme sections + Customizer + latest posts |
| `clases` | `page-clases.php` | Class descriptions, timetable, videos |
| `equipo` | `page-equipo.php` | Founders story and team (photos from the media library) |
| `galeria` | `page-galeria.php` | Gym photos (lightbox), videos, latest posts |
| `contacto` | `page-contacto.php` | Contact details, hours, map on click, the page's Contact Form 7 form |
| Legal pages and any other page | `page.php` | The page's own content |
| Posts, archives, search, 404 | `single.php`, `index.php`, `404.php` | WordPress content |

The Inicio, Clases, Equipo and Galería pages were built with WPBakery/Divi. Their builder content is not used; the templates above replace it, so nothing breaks when Divi is deactivated.

## Editing content

- **Customizer → Quesada Fitness**: phone, WhatsApp, email, address, map, booking link, Facebook, Instagram, opening hours, the three price lists and the weekly timetable (one line per row, `Name | Price` or `09:30 | Class`; end a class name with `*` for outside instructors).
- **Logo**: the header and footer show the gym's own logo, recoloured for the black background (`assets/images/logo-light.png`: white name, red tagline). To use a different one, upload it in **Appearance → Customize → Site Identity**; a light version works best on the black header.
- **Posts**: news posts appear on the home page, the gallery and the posts page.
- Fixed texts (facilities, class descriptions, team bios, photo lists) are in `inc/data.php`. Each list can be changed with a filter (`qf_team`, `qf_facilities`, `qf_class_types`, `qf_gallery_photos`, `qf_gallery_videos`).

## Photos and videos

The theme does not bundle the gym's photos. It uses the files already in the site's media library, by their path inside `wp-content/uploads/` (the same paths as on quesadafitness.com), so on the live site nothing has to be copied.

If a file is missing from the uploads folder of the site where the theme runs (for example a fresh local copy), it is loaded from `https://quesadafitness.com/wp-content/uploads/` instead. To use local files, copy them into `wp-content/uploads/` keeping the year/month folders and names below. To change the fallback address, or disable it by returning `''`, use the `qf_media_fallback_url` filter.

To swap a photo, replace the file at the same path, or change the path in `inc/data.php` (facilities, team, gallery) or in the template that uses it.

<details>
<summary>Files used by the theme (32 photos, 10 videos)</summary>

```
2021/11/Gergana-min-1024x683.png
2021/11/Jodii.png
2021/11/Luiz-min-1024x683.png
2021/11/Santi-min-1024x683.png
2021/11/Saraa.png
2021/11/usforwebsite.jpg
2023/09/Gym-entrance-2.jpg
2023/09/IMG-20220902-WA000612.jpg
2023/09/IMG-20220916-WA00083.jpg
2023/09/IMG-20220916-WA00122.jpg
2023/09/QFG1.jpg
2023/09/QFG10.jpg
2023/09/QFG13.jpg
2023/09/QFG15.jpg
2023/09/QFG16.jpg
2023/09/QFG17.jpg
2023/09/QFG2.jpg
2023/09/QFG7.jpg
2023/09/QFG81.jpg
2023/09/QFG9.jpg
2023/09/Stairs-rotated.jpg
2024/11/IMG-20241031-WA0004.jpg
2024/11/IMG-20241031-WA0005.jpg
2024/11/IMG-20241031-WA0006.jpg
2024/11/IMG-20241031-WA0007.jpg
2024/11/newshowers.jpg
2024/12/upgradedgym1.jpg
2024/12/upgradedgym2.jpg
2024/12/upgradedgym6.jpg
2024/12/upgradedgym7.jpg
2026/02/Stela-QFG-removebg-preview.webp
2026/07/AllClassesTimetable-4.png
2021/11/classes.mp4
2021/11/mergemerge.mp4
2025/01/VID-20250113-WA0002.mp4
2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.25_220ed559.mp4
2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.25_34f1b851.mp4
2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.25_a66853bb.mp4
2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.25_b3f936c5.mp4
2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.25_d8898797.mp4
2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.26_308e85fb.mp4
2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.03.49_f4d0301f.mp4
```

</details>

## Plugins

- **Contact Form 7**: the Contact page shows the first `[contact-form-7 ...]` shortcode found in its content, or the shortcode set in the Customizer. Without either, a simple form opens the visitor's email app.
- **WPBakery** (`js_composer`): keep it active while the legal pages still contain its shortcodes. If it is deactivated, the theme removes the leftover `[vc_...]` tags and keeps the text.
- Cookie, WhatsApp and translation plugins keep working; the theme does not add its own WhatsApp button.

## Privacy and performance

- Fonts (Bebas Neue, Inter) are self-hosted under the SIL Open Font License; no requests to Google Fonts.
- Google Maps loads only after the visitor clicks **Show map**.
- WordPress's emoji script is disabled; browsers show emoji natively.

## Language

Theme texts are in English and translation-ready (text domain `quesada-fitness`, `languages/` folder).
