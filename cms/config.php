<?php
date_default_timezone_set("Asia/Baku");
date_default_timezone_get();

define('API_TITLE', 'CMS V2');

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', '/cms/');
define('SITE_URL', 'http://shalsetgroup.local/');
define('LIBS', 'libs/');
define('BASE_DIR', '/domains/shalsetgroup.local/');
define('UPLOAD_DIR', BASE_DIR.'upload/');
define('UPLOAD_DIR_LINK', '/upload/');
define('VENDOR_DIR', BASE_DIR . 'vendor/');

//DB
define('PHP_DATE_FORMAT', 'Y-m-d H:i');
define('DB_DATE_FORMAT', '%Y-%m-%d %h:%i');
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'fizuli_shalsetgroup');
define('DB_USER', 'root');
define('DB_PASS', '123');

//IMAGE size
define('projects_width', '1024');
define('projects_height', '768');
define('projects_thumb_width', '440');
define('projects_thumb_height', '360');
define('news_width', '770');
define('news_height', '450');
define('news_thumb_width', '370');
define('news_thumb_height', '240');
define('slider_width', '1920');
define('slider_height', '820');
define('partners_width', '54');
define('partners_height', '54');
define('staff_width', '510');
define('staff_height', '775');
define('certificates_width', '820');
define('certificates_height', '1160');
define('certificates_thumb_width', '410');
define('certificates_thumb_height', '580');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', '[Dxftc5zbbSh!0k]poZIP#|`yv?CM}P&~F"F]k7&S786%_OUASKJBohkjdfkdu:q&E_q1]Ljdn0:!');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'K_=[iHz{]BUt]?4J=[iHz{]Bwl,kt~L3>908hijBzM5EuIx`_NK&*78ghb!');

// ReCaptcha v2
define('RECAPTCHA_SECRET', '6LcuZj8UAAAAABZ-ZqnNAaAFXZ4q8EQbKCUp3_UR');
define('RECAPTCHA_SITEKEY', '6LcuZj8UAAAAAEF-s_IVU0dNTqxteFUW_5x5NMXQ');