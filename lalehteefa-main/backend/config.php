<?php
/**
 * Finesse — Application Configuration
 * Railway-compatible config
 */

function env_str(string $key, string $default = ''): string
{
    $v = getenv($key);

    if ($v === false) {
        return $default;
    }

    $v = trim((string)$v);

    return $v !== '' ? $v : $default;
}

/**
 * First non-empty env var from a list.
 */
function env_str_first(array $keys, string $default = ''): string
{
    foreach ($keys as $key) {
        $v = env_str($key);

        if ($v !== '') {
            return $v;
        }
    }

    return $default;
}

/* ──────────────────────────────────────────────────────────────
   DATABASE
────────────────────────────────────────────────────────────── */

define('DB_HOST', env_str_first(['MYSQLHOST', 'DB_HOST'], 'localhost'));
define('DB_PORT', env_str_first(['MYSQLPORT', 'DB_PORT'], '3306'));
define('DB_NAME', env_str_first(['MYSQLDATABASE', 'MYSQL_DATABASE', 'DB_NAME'], 'finesse_db'));
define('DB_USER', env_str_first(['MYSQLUSER', 'DB_USER'], 'root'));
define('DB_PASS', env_str_first(['MYSQLPASSWORD', 'DB_PASS'], ''));

/* Optional SSL */
define('DB_SSL_CA', env_str('DB_SSL_CA'));
define('DB_SSL_CERT', env_str('DB_SSL_CERT'));
define('DB_SSL_KEY', env_str('DB_SSL_KEY'));

/* ──────────────────────────────────────────────────────────────
   SITE
────────────────────────────────────────────────────────────── */

define('SITE_URL', env_str('SITE_URL', 'http://localhost/finesse'));

define('UPLOAD_DIR', __DIR__ . '/../frontend/assets/uploads/');
define('UPLOAD_URL', SITE_URL . '/frontend/assets/uploads/');

if (!file_exists(UPLOAD_DIR)) {
    @mkdir(UPLOAD_DIR, 0755, true);
}

/* ──────────────────────────────────────────────────────────────
   WEATHER API
────────────────────────────────────────────────────────────── */

define('WEATHER_API_KEY', env_str('WEATHER_API_KEY', ''));

/* ──────────────────────────────────────────────────────────────
   PDO DATABASE CONNECTION
────────────────────────────────────────────────────────────── */

try {

    $dsn = sprintf(
        "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4",
        DB_HOST,
        DB_PORT,
        DB_NAME
    );

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    /* Optional SSL support */
    if (DB_SSL_CA !== '') {
        $options[PDO::MYSQL_ATTR_SSL_CA] = DB_SSL_CA;
    }

    if (DB_SSL_CERT !== '') {
        $options[PDO::MYSQL_ATTR_SSL_CERT] = DB_SSL_CERT;
    }

    if (DB_SSL_KEY !== '') {
        $options[PDO::MYSQL_ATTR_SSL_KEY] = DB_SSL_KEY;
    }

    $pdo = new PDO(
        $dsn,
        DB_USER,
        DB_PASS,
        $options
    );

} catch (PDOException $e) {

    /* TEMP DEBUG */
    die("Database Connection Failed: " . $e->getMessage());

    /*
    PRODUCTION:
    die("Database Connection Failed");
    */
}
