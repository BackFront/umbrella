<?php
//Autoload Composer
$atl = require_once 'vendor/autoload.php';

//$atl->add('App\\Controllers\\', 'src/App/Controllers');


//define('UMB_VERSION', '1.0.0');
define('UMB_PLUGIN', __FILE__);
define('UMB_PLUGIN_BASENAME', plugin_basename(UMB_PLUGIN));
define('UMB_PLUGIN_NAME', trim(dirname(UMB_PLUGIN_BASENAME), '/'));
define('UMB_PLUGIN_DIR', untrailingslashit(dirname(UMB_PLUGIN)));
define('UMB_PLUGIN_MODULES_DIR', UMB_PLUGIN_DIR . '/modules');

use Umbrella\Umbrella;
use Umbrella\Exception;

$loader = new Twig_Loader_Filesystem(__DIR__ . '/src/App/Views');
$twig = new Twig_Environment($loader);
$app = new Umbrella(UMB_PLUGIN_MODULES_DIR, $twig);
$umb_messages = new Exception();

//echo $twig->render('dashboard.phtml', array('text' => 'Hello world!'));