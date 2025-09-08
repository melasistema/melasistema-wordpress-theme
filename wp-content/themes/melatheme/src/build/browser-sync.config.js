// src/build/browser-sync.config.js

/**
 * Browser-Sync Configuration for Local WordPress Development.
 *
 * This configuration sets up Browser-Sync to proxy a local Apache/Nginx server
 * (like MAMP PRO) and enable live reloading for theme file changes.
 *
 * It is tailored for a WordPress theme located directly within the WordPress
 * installation (e.g., `wp-content/themes/your-theme-name/`).
 */
module.exports = {
    /**
     * Proxy an existing server.
     * Browser-Sync will create its own URL (e.g., https://localhost:3000)
     * and route all requests through your specified local WordPress site URL.
     */
    "proxy": "https://melasistema-wordpress-theme.loc:8890/", // update this to your local WordPress site URL

    /**
     * Files to watch for changes to trigger a browser reload.
     * Paths are relative to the root of your current theme directory
     * (e.g., `wp-content/themes/my-custom-theme/`),
     * as 'npm run bs' is executed from there.
     */
    "files": [
        // Watch compiled CSS files (e.g., from `css/child-theme.min.css`)
        "./css/*.min.css",
        // Watch compiled JavaScript files (e.g., from `js/child-theme.min.js`)
        "./js/*.min.js",
        // Watch all PHP files within the theme folder
        "./**/*.php",
        // Watch other static assets (images, fonts, etc.)
        "./**/*.{png,jpg,gif,svg,woff,woff2,ttf,eot}"
    ],

    /**
     * Browser-Sync UI and Connection Settings.
     */
    "port": 3000, // The port Browser-Sync will run on (e.g., https://localhost:3000)
    "ui": {
        "port": 3001 // The port for Browser-Sync's UI dashboard
    },
    "open": "external", // Opens the Browser-Sync URL in your default browser. 'external' uses your network IP.
    "notify": false, // Disable Browser-Sync notifications in the browser. Set to 'true' to enable.

    /**
     * HTTPS Configuration.
     * Set to 'true' if your proxied local WordPress site uses HTTPS (e.g., MAMP PRO SSL).
     * Browser-Sync will attempt to generate a self-signed certificate.
     */
    "https": true,

    /**
     * Ghost Mode (Synchronized Browsing).
     * Synchronizes clicks, scrolls, and form inputs across all connected browsers.
     */
    "ghostMode": {
        "clicks": true,
        "forms": true,
        "scroll": true
    }
};