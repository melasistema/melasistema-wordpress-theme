# MelaTheme

This repository contains the development source for the **MelaTheme** WordPress. It is built upon the [Understrap](https://understrap.com/) framework, which combines the power of the `_s` (Underscores) starter theme with Bootstrap 5.

This theme is designed to be lean and focused strictly on the **presentation layer (the "frontend")**. All business logic, data management (like Custom Post Types), and complex functionalities are handled by separate, dedicated plugins to ensure a clean separation of concerns.

## Project Philosophy

-   **Theme for Presentation Only:** The theme's responsibility is limited to templates, styling (Sass), frontend JavaScript, and assets.
-   **Plugins for Logic:** All functionality, such as creating Custom Post Types, custom taxonomies, API integrations, or form handling, must be implemented within plugins. The primary companion plugin for this theme is `melatheme-core`.

---

## Theme Features

### Megamenu

To enable the megamenu for a specific navigation item, follow these steps:

1.  In the WordPress dashboard, navigate to **Appearance > Menus**.
2.  At the top-right of the screen, click **Screen Options** and ensure the **CSS Classes** option is checked.
3.  Expand the top-level menu item you wish to convert into a megamenu.
4.  In the **CSS Classes** field, add the class `megamenu`.
5.  Structure your menu items three levels deep:
    *   **Level 1:** The main navigation link (with the `megamenu` class).
    *   **Level 2:** Non-clickable column titles for the megamenu grid.
    *   **Level 3:** The clickable links that will appear under each column title.
6.  Save the menu. The theme will automatically convert it into a wide, grid-based megamenu where the column content is always visible.

---

## Requirements

Before you begin, ensure you have the following set up:

1.  **A Local WordPress Environment:** A fully functional local installation of WordPress (e.g., using Local, MAMP, Docker, etc.).
2.  **Node.js & NPM:** Required for managing frontend dependencies and running build scripts. You can download them [here](https://nodejs.org/).
3.  **Parent Theme (Understrap):** This child theme will not work without its parent.
4.  **Core Logic Plugin:** The `melatheme-core` plugin, which contains the CPTs and other logic required for the theme to function correctly for this project.

---

## Local Development Setup

Follow these steps to set up your local development environment:

**1. Clone the Repositories:**

Clone this theme and the companion plugin into your local WordPress installation's `wp-content` directory.

```bash
# Clone the theme
git clone <this-repo-url> wp-content/themes/melatheme

# Clone the core logic plugin
git clone <plugin-repo-url> wp-content/plugins/melatheme-core
```

**2. Install the Parent Theme:**

Download the latest version of the [Understrap parent theme](https://github.com/understrap/understrap) and install it in your `wp-content/themes/` directory. The folder should be named `understrap`.

**3. Install Theme Dependencies:**

Navigate to this theme's directory and install the required Node.js packages.

```bash
cd wp-content/themes/melatheme
npm install
```

**4. Activate in WordPress:**

Log in to your WordPress admin panel and activate the following:
- The `melatheme-core` plugin.
- The `MelaTheme` theme. (You do not need to activate the parent Understrap theme).

**5. Configure BrowserSync:**

The theme uses BrowserSync to automatically reload your browser when you make changes to files. For this to work, you must configure it to point to your local site's URL.

-   Open the file: `src/build/browser-sync.config.js`
-   Find the `proxy` setting.
-   Change the default value to the URL of your local WordPress installation.

For example:
```javascript
// For a MAMP Pro or LocalWP setup:
"proxy": "http://melatheme.local/"

// For a generic localhost setup with a port:
"proxy": "http://localhost:8888/"
```

Your local environment is now set up.

---

## Development Workflow & Build Process

All development work on styles (Sass) and JavaScript should be done within the `/src` directory.

-   **Sass files:** `src/sass/`
-   **JavaScript files:** `src/js/`
-   **PHP template files:** Edit the `.php` files in the root directory (`footer.php`, `header.php`, etc.) and within `/template-parts/` as needed - wordpress theme conventions apply.

**Build Commands:**

The project uses `npm` scripts to compile assets.

-   **For active development:** Run the `watch-bs` command. This will watch for changes in your `src` files and automatically re-compile them plus uses browser sync.
    ```bash
    npm run watch-bs
    ```

-   **For a one-time build:** To compile all assets for production, run the `dist-build` command.
    ```bash
    npm run dist-build
    ```
**N.B. More command available in the `package.json`**

**Build Output:**

The compiled, production-ready theme is built into the `/melatheme/` directory.

> **IMPORTANT:** The `/melatheme/` directory is included in `.gitignore` and **is not** version controlled. It is a build artifact. Never make direct edits to files in this folder, as they will be overwritten.

## Deployment

### Cache Busting

Before running the final `npm run dist-build` for deployment, it is crucial to update the `Version` number in the `style.css` file at the root of the theme.

```css
/*
 Theme Name: MelaTheme
 Version: 1.2.3 <== INCREMENT THIS NUMBER
 ...
*/
```

WordPress uses this version number to control asset caching (e.g., `style.css?ver=1.2.3`). Incrementing it ensures that users' browsers will download the new stylesheet and see the latest changes.

### Deployment Steps

To deploy the theme to a live server, you only need to transfer the contents of the compiled `/melatheme/` directory.

1.  **Update Version:** Increment the version number in `style.css`.
2.  **Build:** Run the build command locally: `npm run dist-build`.
3.  **Transfer:** Using SFTP or another deployment method, replace the contents of the existing theme folder on the production server (`/wp-content/themes/melatheme/`) with the contents of your local `/melatheme/` directory.