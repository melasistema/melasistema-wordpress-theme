# MelaTheme Core Plugin

This is the core companion plugin for the `melatheme`. It is designed to contain all the essential business logic, custom functionalities, and data management features that power the theme.

By separating the logic (the plugin) from the presentation (the theme), we ensure a more modular, maintainable, and scalable WordPress environment.

## Highlights

- **Companion to `melatheme`**: This plugin is a dependency for our custom theme and works in tandem with it to deliver a seamless user experience.
- **Custom Logic**: Manages custom post types, taxonomies, and business-specific functionalities.
- **Metaboxes & Custom Fields**: Utilizes CMB2 to create and manage custom fields for pages, posts, and custom post types.
- **Scripts & Styles**: Enqueues necessary CSS and JavaScript for both the frontend and the WordPress admin area.
- **Helper Functions & Constants**: Provides a centralized place for helper functions and constants used throughout the theme and plugin.

## Requirement

This plugin is intended to be used exclusively with the `melatheme` understrap child theme. It is a required dependency for the theme to function correctly.

## Versioning

It is crucial to keep the plugin version number updated with every significant modification. This practice is essential for:

-   **Deployment Sanity**: Easily compare the version deployed in production with the development version.
-   **Future-Proofing**: Although this plugin currently does not manage CSS or JS assets, maintaining a versioning scheme ensures we are prepared for when they are introduced. The version number is used for cache-busting these assets.

Please ensure the version number in `melatheme-core.php` is incremented accordingly when you make changes.
