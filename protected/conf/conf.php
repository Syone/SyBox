<?php
// Project name
define('PROJECT', 'SyBox');

// Project url
define('PROJECT_URL', (isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'https') . '://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'syframework.alwaysdata.net'));

// Project version
define('PROJECT_VERSION', '1.0.0');

// Client path to project root directory starting at document root.
define('WEB_ROOT', '');

// Templates path
define('TPL_DIR', __DIR__ . '/../templates');

// Translation files path
define('LANG_DIR', __DIR__ . '/../lang');

// Server path to the uploaded files directory
define('UPLOAD_DIR', __DIR__ . '/../../upload');

// Client path to the uploaded files directory
define('UPLOAD_ROOT', WEB_ROOT . '/upload');

// Server path to the uploaded avatars directory
define('AVATAR_DIR', UPLOAD_DIR . '/avatar');

// Client path to the uploaded avatars directory
define('AVATAR_ROOT', UPLOAD_ROOT . '/avatar');

// Client path to the default avatars directory.
define('DEFAULT_AVATAR_DIR', __DIR__ . '/../../assets/img/avatar');

// Client path to the default avatars directory.
define('DEFAULT_AVATAR_ROOT', WEB_ROOT . '/assets/img/avatar');

//------------------------------------------------------------------------------
// Controller trigger
//------------------------------------------------------------------------------
// The controller trigger refers to the class to call from Project\Component\Application
//------------------------------------------------------------------------------
// Example:
// define('CONTROLLER_TRIGGER', 'p');
// http://my.domain.com/index.php?p=home
//------------------------------------------------------------------------------
define('CONTROLLER_TRIGGER', 'p');

//------------------------------------------------------------------------------
// Action trigger
//------------------------------------------------------------------------------
// The action trigger refers to the method to call from the controller
//------------------------------------------------------------------------------
// Example:
// define('ACTION_TRIGGER', 'a');
// http://my.domain.com/index.php?p=home&a=index
//------------------------------------------------------------------------------
define('ACTION_TRIGGER', 'a');
define('ACTION_PARAM', ACTION_TRIGGER . '_param');

// Cache directory
define('CACHE_DIR', '/tmp/' . basename(realpath(__DIR__ . '/../../')));

// Database informations
define('DATABASE_CONFIG', parse_ini_file(__DIR__ . '/database.ini'));

// SMTP informations
define('SMTP_CONFIG', parse_ini_file(__DIR__ . '/smtp.ini'));

// Project team mail
define('TEAM_MAIL', 'contact@syone.me');

// Url rewriting
define('URL_REWRITING', 1);

// Default lang & lang authorized
define('LANG', 'en');
define('LANGS', ['fr' => 'Fran&ccedil;ais', 'en' => 'English']);

// Salt for hash id
define('SALT', PROJECT);

define('PHP', 'php -d max_execution_time=5 -c /home/syframework/ %s');
define('TMP_DIR', '/tmp');

// CDN urls
define('ACE_EDITOR'           , 'https://cdn.jsdelivr.net/npm/ace-builds');
define('CODE_MIRROR'          , 'https://cdn.jsdelivr.net/npm/codemirror@5');
define('CKEDITOR_JS'          , 'https://cdn.ckeditor.com/4.17.1/full-all/ckeditor.js');
define('CKEDITOR_ROOT'        , WEB_ROOT . '/assets/ckeditor');
define('MOMENT_JS'            , 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js');
//define('JQUERY_JS'            , ['url' => 'https://code.jquery.com/jquery-3.5.1.min.js', 'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=']);
define('JQUERY_UI_JS'         , ['url' => 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', 'integrity' => 'sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=']);
define('JQUERY_UI_TOUCH_JS'   , 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js');
//define('SCROLL_JS'            , 'https://cdnjs.cloudflare.com/ajax/libs/iamdustan-smoothscroll/0.4.0/smoothscroll.min.js');
define('STICKYFILL_JS'        , 'https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.0.2/stickyfill.min.js');
define('INSTAFEED_JS'         , 'https://cdnjs.cloudflare.com/ajax/libs/instafeed.js/1.4.1/instafeed.min.js');
//define('AUTOSIZE_JS'          , 'https://cdnjs.cloudflare.com/ajax/libs/autosize.js/4.0.2/autosize.min.js');
define('INTLTELINPUT_JS'      , 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js');
define('INTLTELINPUT_UTILS_JS', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.min.js');
define('INTLTELINPUT_CSS'     , 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.min.css');
define('MAILCHECK_JS'         , 'https://cdnjs.cloudflare.com/ajax/libs/mailcheck/1.1.2/mailcheck.min.js');
define('CLIPBOARD_JS'         , 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js');
define('PRINT_JS'             , 'https://cdnjs.cloudflare.com/ajax/libs/printThis/1.12.1/printThis.min.js');
define('SLIP_JS'              , 'https://cdnjs.cloudflare.com/ajax/libs/slipjs/2.1.1/slip.min.js');
define('CROPPER_JS'           , 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.min.js');
define('CROPPER_CSS'          , 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.min.css');

// You can use these slot names (prefixed by underscore) in your templates, they are set in Sy\Bootstrap\Application\Page\Body
define('MAGIC_VARS', [
	'_PROJECT'         => PROJECT,
	'_PROJECT_URL'     => PROJECT_URL,
	'_PROJECT_VERSION' => PROJECT_VERSION,
	'_WEB_ROOT'        => WEB_ROOT,
	'_YEAR'            => date('Y'),
]);
