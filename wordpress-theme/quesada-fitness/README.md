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
- **Site Identity**: upload a logo (a light version works best on the black header). Without one, a text logo is shown.
- **Posts**: news posts appear on the home page, the gallery and the posts page.
- Fixed texts (facilities, class descriptions, team bios, photo lists) are in `inc/data.php`. Each list can be changed with a filter (`qf_team`, `qf_facilities`, `qf_class_types`, `qf_gallery_photos`, `qf_gallery_videos`).

Photos and videos are referenced from the existing media library (`wp-content/uploads/...`), so they must exist on the site where the theme is installed.

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
