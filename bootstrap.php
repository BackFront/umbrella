<?php

//Autoload Composer
$atl = require_once 'vendor/autoload.php';
//$atl->add('App\\Controllers\\', 'src/App/Controllers');
//define('UMB_VERSION', '1.0.0');
define('UMB_PLUGIN', __FILE__);
define('UMB_PLUGIN_BASENAME', plugin_basename(UMB_PLUGIN));
define('UMB_PLUGIN_NAME', trim(dirname(UMB_PLUGIN_BASENAME), '/'));
define('UMB_PLUGIN_DIR', untrailingslashit(dirname(UMB_PLUGIN)));
define('UMB_PLUGIN_URI', plugins_url());
define('UMB_PLUGIN_MODULES_DIR', UMB_PLUGIN_DIR . '/modules');

//Enquewes
if (!function_exists('umb_enqueues_register')):

    function umb_register_admin_enqueues() {
        //Styles
        wp_enqueue_style("grid_system", UMB_PLUGIN_URI . '/' . UMB_PLUGIN_NAME . '/assets/css/grid_system.css');
        wp_enqueue_style("semantic_ui", UMB_PLUGIN_URI . '/' . UMB_PLUGIN_NAME . '/assets/libs/semantic_ui/semantic.min.css');
        wp_enqueue_style("mainstyle", UMB_PLUGIN_URI . '/' . UMB_PLUGIN_NAME . '/assets/css/main.css');

        //Scripts
        wp_enqueue_script("grid_system", UMB_PLUGIN_URI . '/' . UMB_PLUGIN_NAME . '/assets/libs/semantic_ui/semantic.min.js');
    }

    add_action('admin_enqueue_scripts', 'umb_register_admin_enqueues');

else :
    print("#0205161201 : Função 'umb_enqueues_register' já existe");
endif;

//
//

use Umbrella\Umbrella;
use Umbrella\Exception;

$loader = new Twig_Loader_Filesystem(__DIR__ . '/src/App/Views');
$twig = new Twig_Environment($loader);
$app = new Umbrella(UMB_PLUGIN_MODULES_DIR, $twig);
$umb_messages = new Exception();

//echo $twig->render('dashboard.phtml', array('text' => 'Hello world!'));