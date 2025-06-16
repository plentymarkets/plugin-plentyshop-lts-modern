# Release Notes for plentyShop LTS Modern

## v.1.0.16 (2025-xx-xx)

### Fixed

- Fixed an issue where the primary color was not used for the navigation menu items.

## v.1.0.15 (2025-04-15) <a href="https://github.com/plentymarkets/plugin-plentyshop-lts-modern/compare/1.0.14...1.0.15" target="_blank" rel="noopener"><b>Overview of all changes</b></a>

### Changed

- Added widget instead of datafields for manufacturer and eu responsible tabs to the default presets.
- Changes to stylesheets have been done to match new plentyShop LTS Version 5.0.72

## v.1.0.14 (2024-11-14) <a href="https://github.com/plentymarkets/plugin-plentyshop-lts-modern/compare/1.0.13...1.0.14" target="_blank" rel="noopener"><b>Overview of all changes</b></a>

### Changed

- The ShopBuilder preset for the single item view now includes a new tab for displaying information about the EU-Responsible Person in order to be GPSR-compliant.
- The placeholder for “Contact form”, “Legal name” and “EU responsible contact form” was added to the ShopBuilder preset of the item view.

## v.1.0.13 (2024-09-27) <a href="https://github.com/plentymarkets/plugin-plentyshop-lts-modern/compare/1.0.12...1.0.13" target="_blank" rel="noopener"><b>Overview of all changes</b></a>

### Changed

- Changes to stylesheets have been done to match new plentyShop LTS Version 5.0.68
- A change in version 1.0.12 could lead to horizontal scrolling behaviour. This change has been reversed.
- The default single item view now includes a new tab for displaying information about the EU-Responsible Person in order to be GPSR-compliant.
- The ShopBuilder preset for the single item view now includes a new tab for displaying information about the manufacturer.
- The default template for the single item view now includes a new tab for displaying information about the manufacturer.

## v.1.0.12 (2024-08-19) <a href="https://github.com/plentymarkets/plugin-plentyshop-lts-modern/compare/1.0.11...1.0.12" target="_blank" rel="noopener"><b>Overview of all changes</b></a>

### Changed

- Changes to stylesheets have been done to match new plentyShop LTS Version 5.0.64

## v.1.0.11 (2024-04-11) <a href="https://github.com/plentymarkets/plugin-plentyshop-lts-modern/compare/1.0.10...1.0.11" target="_blank" rel="noopener"><b>Overview of all changes</b></a>

### Fixed

- If the entire header is sticky, scrolling now changes the background colour of all header elements.

## v.1.0.10 (2024-04-03) <a href="https://github.com/plentymarkets/plugin-plentyshop-lts-modern/compare/1.0.9...1.0.10" target="_blank" rel="noopener"><b>Overview of all changes</b></a>

### Changed

- For the Image Box widget, if **Maintain Aspect Ratio** is selected for the **Aspect Ratio** setting, a minimum height for the image is no longer specified on mobile devices.
- The styling for the header has been adjusted to match a [change in plentyShop LTS](https://github.com/plentymarkets/plugin-ceres/pull/3467).

### Fixed

- The tiles for displaying payment providers in Checkout were displayed too large on older iOS devices. This has been fixed.
- Order properties with the type select were not correclty displayed. This has been fixed.

## v.1.0.9 (2023-06-20) <a href="https://github.com/plentymarkets/plugin-plentyshop-lts-modern/compare/1.0.8...1.0.9" target="_blank" rel="noopener"><b>Overview of all changes</b></a>

### Changed

- Optimized the view of article grid and article list on mobile devices.

### Fixed

- In case of multiple addresses, the address selection contained unnecessary spacing. This has been fixed.

### Removed

- Unused CSS has been removed.

## v.1.0.8 (2023-03-01) <a href="https://github.com/plentymarkets/plugin-plentyshop-lts-modern/compare/1.0.7...1.0.8" target="_blank" rel="noopener"><b>Overview of all changes</b></a>

### Fixed

- Under some conditions, the sticky container widget on the article view could wobble. This was fixed.

## v.1.0.7 (2023-02-14) <a href="https://github.com/plentymarkets/plugin-plentyshop-lts-modern/compare/1.0.6...1.0.7" target="_blank" rel="noopener"><b>Overview of all changes</b></a>

### Fixed

- If filters were placed inside the toolbar widget, the texts of the filters were not visible under some circumstances. This has been fixed.
- When using the image box widget with the "Image without text" setting, text was displayed by mistake. This has been fixed.

## v.1.0.6 (2023-02-07)

### Fixed

- Under some conditions, the sticky container widget on the article view could wobble. This was fixed.
- The spacing of the filter selection on the category view has been unified.
- The first image of the image slider on the home page template was incorrectly mirrored. This now only happens with the demo image.
- Improved the display of the category-view on small devices.

### Changed

- On mobile devices, the "Add to Cart" button has been made more prominent.
- The plugin's color settings are now no longer marked as deprecated, and the corresponding instructions have been updated.

### Removed

- Removed unused CSS of the item grid
- Removed unused SCSS files (_legacy.scss, _home.scss)

## v.1.0.5

### Fixed

- The "button order" option did not work correctly for the cookiebar widget. This has been fixed.

## v.1.0.3

### Fixed

- It's no longer possible to submit a plentyShop contact form without accepting the privacy policy.
- On mobile, display errors no longer inhibit the usability of the permanently displayed search.
- On mobile, you can now close the language detection from the **Language detection** widget again.
- On mobile, the images in the **Article grid** widget are displayed correctly again with the setting: **Number of articles per row (mobile): 2**.
- On mobile, items in the shopping cart are now always visible.
- In the **Item list** widget, other elements no longer overlap the action of adding items to the basket. This means that you can now add items to the basket again, no matter the position of the item in the list.
- The "Full screen width" option did not work correctly with the background image widget in the header. This has been fixed.

## v.1.0.2

### Fixed

- Updated the description for configuring container links.

## v1.0.1

- Adaptation of the user guide
- Adjusting the preview image

## v1.0.0

- Release of first stable version.
