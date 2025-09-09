<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!defined('MELATHEME_CORE_BASE_URL')) {
    define('MELATHEME_CORE_BASE_URL', plugin_dir_url(__FILE__));
}
if(!defined('MELATHEME_CORE_BASE_DIR')) {
    define('MELATHEME_CORE_BASE_DIR', dirname(__FILE__));
}

// Define plugin version.
if ( ! defined( 'MELATHEME_CORE_VERSION' ) ) {
	define( 'MELATHEME_CORE_VERSION', '0.0.1' );
}
