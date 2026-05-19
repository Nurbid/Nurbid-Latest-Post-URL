# Nurbid Latest Post URL (NLP)

WordPress plugin that automatically sets a link’s URL to your most recent published blog post — no manual edits required.

Ideal for landing pages, call-to-actions, and onboarding flows where your latest post is always the best next step.

## Requirements

- WordPress 6.5+
- PHP 8.0+

## What it does

When the page loads:

1. JavaScript fetches the URL of the most recent post via WordPress `admin-ajax.php`
2. It finds the first element with the class `.nurbid-latest-post-url`
3. It replaces the element’s `href` with the permalink of the latest published post

## How it works

1. A server-side PHP function retrieves the latest published post
2. A WordPress AJAX endpoint exposes that URL to the front end
3. Footer JavaScript updates the `href` of matching `<a>` elements

## Install

### From GitHub Releases

1. Download `nurbid-latest-post-url-x.y.z.zip` from the repository **Releases** page
2. Go to **Plugins → Add New → Upload Plugin**
3. Upload the zip, then click **Install Now** and **Activate**

## Setup

### 1. Add a link or button

In your page builder, template, or HTML:

```html
<a class="nurbid-latest-post-url" href="#">Read Latest Post</a>
```

- Use any valid anchor (`<a>`)
- May be inside or outside a `<button>` wrapper
- Add the class `nurbid-latest-post-url`
- Use a placeholder `href="#"` — it will be replaced automatically

### 2. Done

The URL updates on each page load. No settings screen.

## Shortcode (optional)

Embed the latest post URL in content:

```text
[nurbid_latest_post_url]
```

Works in:

- Posts and pages
- Page builders that support shortcodes
- PHP templates: `echo do_shortcode('[nurbid_latest_post_url]');`

## Changelog

- 1.26.0519 - Edit release notes for this version.
- 1.26.0519 - Version number update.
- 1.0.0 - Initial release

## License

GPL-2.0-or-later. See [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html).

## Author

[Nurbid — Bespoke IT Services](https://nurbid.com)
