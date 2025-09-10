# Changelog

## 1.3.15
### Changes
- Removed expand/collapse on components (now native in ACF).
- Added **Menu** field type.
- Deprecated the following field types: `hidden`, `id`, `instagram`, `latest posts`.

## 1.3.14
### Bugfixes
- Fixed an issue where an empty inline editor left a `<br>` tag.

## 1.3.13
### Bugfixes
- Fixed a warning in **ACF rule tax type**.

## 1.3.12
### Changes
- Improved component UI.
- Removed **Table TinyMCE plugin** (moved to WP Steroids plugin).

## 1.3.11
### Changes
- Use cURL with user agent to download Instagram images.

## 1.3.10
### Features
- Added `aria-label` input on link selector.

## 1.3.9
### Changes
- License changed to **MIT**.

## 1.3.8
### Bugfixes
- Fixed link error.

## 1.3.7
### Bugfixes
- Fixed input issue with tag selector.

## 1.3.6
### Bugfixes
- Fixed line break issue with inline editor and link style.

## 1.3.5
### Bugfixes
- Fixed warning with inline editor.

## 1.3.4
### Bugfixes
- Fixed dynamic select issue.

## 1.3.3
### Bugfixes
- Cleaned HTML output from inline editor.

## 1.3.2
### Bugfixes
- Replaced usage of `UPLOAD` constant.

## 1.3.1
### Bugfixes
- Fixed component slug compatibility for ACF >= 6.

## 1.3.0
### Features
- Added new fields.

## 1.2.2
### Bugfixes
- Fixed issue with ID field generating `uniqid`.

## 1.1.11
### Features
- Added **Post parent** location rule.

## 1.1.10
### Features
- Added Instagram post URL field.

## 1.1.9
### Features
- Added **ID field** (generates a unique ID).

## 1.1.8
### Features
- Added fields cleaning function (`?clean-acf=1` in backend URL).

## 1.1.7
### Bugfixes
- Fixed invalid `dynamic_select` component value.

## 1.1.6
### Features
- Added `dynamic_select` component (lists values from another field in post or options).

## 1.1.5
### Features
- **Latest posts** component now supports multiple `post_type`.

## 1.1.4
### Bugfixes
- Allowed empty tags.

## 1.1.3
### Features
- Added `tag` setting to text/textarea fields (choose HTML tag).
- Added `public` setting to control entity variable visibility.
- Added `sizes` support in image and gallery fields.
- Removed map fallback (now included in ACF).
### Bugfixes
- Fixed post selection when using term template.

## 1.1.2
### Features
- Added `term template` display rule selector (requires `get_taxonomy_templates` function).

## 1.1.1
### Bugfixes
- Fixed issue when multisite rules equal `all`.
