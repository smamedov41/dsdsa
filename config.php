<?php
date_default_timezone_set("Asia/Baku");
date_default_timezone_get();

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', '/');
define('SITE_URL', 'http://shalsetgroup.local/');
define('LIBS', 'libs/');
define('BASE_DIR', '/domains/shalsetgroup.local/');
define('UPLOAD_DIR', BASE_DIR . 'upload/');
define('UPLOAD_DIR_LINK', '/upload/');
define('VENDOR_DIR', BASE_DIR . 'vendor/');

// DB
define('PHP_DATE_FORMAT', 'Y-m-d H:i');
define('DB_DATE_FORMAT', '%d.%m.%Y');
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'fizuli_shalsetgroup');
define('DB_USER', 'root');
define('DB_PASS', '123');

// LIMITS
define('LIMIT_PROJECTS', '12');
define('LIMIT_NEWS', '12');

define('MAIL_HOST', 'smtp.mail.ru');
define('MAIL_USERNAME', 'n.kalantarova@shalsetgroup.az');
define('MAIL_PASSWORD', 'e05nL*uoxWTT');
define('MAIL_FROM_NAME', 'SHALSET GROUP');


// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', '[Dxftc5zbbSh!0k]poZIP#|`yv?CM}P&~F"F]k7&S786%_OUASKJBohkjdfkdu:q&E_q1]Ljdn0:!');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'K_=[iHz{]BUt]?4J=[iHz{]Bwl,kt~L3>908hijBzM5EuIx`_NK&*78ghb!');

// ReCaptcha v2
define('RECAPTCHA_SECRET', '6LcuZj8UAAAAABZ-ZqnNAaAFXZ4q8EQbKCUp3_UR');
define('RECAPTCHA_SITEKEY', '6LcuZj8UAAAAAEF-s_IVU0dNTqxteFUW_5x5NMXQ');
