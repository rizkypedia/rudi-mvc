<?php
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

define('ROOT_PATH', dirname(__DIR__));
define('PROJECT_ROOT_PATH', dirname(ROOT_PATH));
define('APP', PROJECT_ROOT_PATH . DS . "src" . DS);
define('VENDOR', PROJECT_ROOT_PATH . DS . "vendor");
define('TMP', ROOT_PATH . DS . "tmp");
define('PLUGINS', ROOT_PATH . DS . "Plugins");
define('ACTION_SUFFIX', 'Action');
define('DEFAULT_CONTROLLER_ACTION', 'index');
define('CONTROLLER_SUFFIX', 'Controller');
define('DEFAULT_NAMESPACE','RudiMVC');
define('VIEW', PROJECT_ROOT_PATH . DS . "app/src/Views");
define('VIEW_TEMPLATE_LAYOUT', VIEW . DS . "Layout");
define('VIEW_TEMPLATE', VIEW . DS . "Templates" . DS);
define('WWW', PROJECT_ROOT_PATH . DS . "webroot" . DS);
define('ENTITIES_LOCATION', APP . "Entities");
define('DB_CONFIG_PATH', ROOT_PATH . DS . 'config/database.yml' );
define('RUDI_API_PREFIX','api');