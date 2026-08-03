switch (getenv('WP_ENV')) {
    case 'dev':
        define('WP_DEBUG', true);
        define('WP_DEBUG_LOG', true);
        define('WP_DEBUG_DISPLAY', true);
        define('DISALLOW_FILE_MODS', false);
        break;

    case 'prod':
    default:
        define('WP_DEBUG', false);
        define('WP_DEBUG_LOG', false);
        define('WP_DEBUG_DISPLAY', false);
        define('DISALLOW_FILE_MODS', true);
        break;
}