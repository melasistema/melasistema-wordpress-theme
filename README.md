
# MelaTheme Monorepo

This repository contains the **MelaTheme WordPress ecosystem**, which is composed of:

- **[MelaTheme](https://github.com/melasistema/melasistema-wordpress-theme/tree/master/wp-content/themes/melatheme)**:  
  A child theme of [Understrap](https://understrap.com/), responsible only for the **presentation layer** (templates, styles, JS, assets).
- **[MelaTheme Core Plugin](https://github.com/melasistema/melasistema-wordpress-theme/tree/master/wp-content/plugins/melatheme-core)**:  
  A required companion plugin that contains all **business logic, custom post types, taxonomies, and functional code** needed by the theme.

By keeping **logic in the plugin** and **presentation in the theme**, we achieve a clean separation of concerns, making the project modular, maintainable, and scalable.

---

## 📐 Project Philosophy

- **Theme = Presentation** → Only templates, Sass/CSS, JS, and assets live in the theme.
- **Plugin = Logic** → All CPTs, taxonomies, metaboxes, API integrations, and business rules belong to `melatheme-core`.
- **Separation of Concerns** → No logic in the theme, no styles in the plugin.

---

## ⚙️ Requirements

Before starting, ensure you have:

1. A local **WordPress environment** (LocalWP, MAMP, Docker, etc.).
2. **Node.js & npm** installed → [Download here](https://nodejs.org/).
3. The **Understrap parent theme** → [Download](https://github.com/understrap/understrap) into `wp-content/themes/understrap`.
4. Both this **child theme** and the **core plugin** in place.

---

## 🚀 Setup Instructions

Clone this repo inside your WordPress `wp-content/` folder:

```bash
cd wp-content

git clone <https://github.com/melasistema/melasistema-wordpress-theme/tree/master/wp-content> .
```

This will provide both:

`themes/melatheme/`

`plugins/melatheme-core/`

**Install Theme Dependencies**

```bash
cd themes/melatheme
npm install
```

1. Activate in WordPress
2. Log in to your WordPress Admin.
3. Activate the MelaTheme Core plugin.
4. Activate the MelaTheme theme (child of Understrap).

✅ You do not need to activate the parent Understrap theme.

## 🛠️ Development Workflow

**File Structure**

Theme Sass → `themes/melatheme/src/sass/`

Theme JS → `themes/melatheme/src/js/`

Theme PHP templates → `themes/melatheme/*.php, themes/melatheme/template-parts/`

Plugin Logic → `plugins/melatheme-core/`

**Theme Build Commands**

From inside `themes/melatheme:`

**Watch mode with BrowserSync**

```bash
npm run watch-bs
```

**Production build**

```bash
npm run dist-build
```

👉 See package.json for additional commands.

**
**
Production assets are compiled into `/dist/`.

This folder is ignored by git and should never be edited manually.

## 📦 Deployment

Update version in `themes/melatheme/style.css` before final build:

```bash
/*
 Theme Name: MelaTheme
 Version: 1.2.3
*/
```

**Run production build:**

```bash
npm run dist-build
```

Deploy the contents of the compiled `melatheme` folder to `/wp-content/themes/melatheme/` on the server.

***Ensure the melatheme-core plugin is also up-to-date and deployed.***

**🔢 Versioning**

Theme version → set in style.css (important for cache-busting assets).

Plugin version → set in melatheme-core.php.

Always increment versions before deployment.

## 📚 Related Documentation

MelaTheme [README]((https://github.com/melasistema/melasistema-wordpress-theme/tree/master/wp-content/themes/melatheme))

MelaTheme Core Plugin README

[Understrap Documentation](https://docs.understrap.com)

**📄 License**

This project is licensed under the GNU [License](LICENSE).