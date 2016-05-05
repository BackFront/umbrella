<?php
if(!defined('ABSPATH'))
    die; //Verifica se esta acessando algum arquivo diretamente

    /* It's run when the installation is running */
function install()
{
    add_option('umb_auth', null);
    add_option('umb_instalation_date', date('Y-m-d H:i'));
}


/* It's run when the uninstall is running */
function uninstall()
{
    delete_option('umb_auth');
    delete_option('umb_instalation_date');
}


//Autoload Composer
$atl = require_once 'vendor/autoload.php';
$atl = require_once 'functions.php';
//$atl->add('App\\Controllers\\', 'src/App/Controllers');

define('UMB_PLUGIN', __FILE__);
define('UMB_PLUGIN_VERSION', '1.3');
define('UMB_PLUGIN_BASENAME', plugin_basename(UMB_PLUGIN));
define('UMB_PLUGIN_NAME', trim(dirname(UMB_PLUGIN_BASENAME), '/'));
define('UMB_PLUGIN_DIR', untrailingslashit(dirname(UMB_PLUGIN)));
define('UMB_PLUGIN_URI', plugins_url());
define('UMB_PLUGIN_MODULES_DIR', UMB_PLUGIN_DIR . '/modules');

//Enquewes
if(!function_exists('umb_enqueues_register')):
    function umb_register_admin_enqueues()
    {
        //Styles
        wp_enqueue_style("grid_system", UMB_PLUGIN_URI . '/' . UMB_PLUGIN_NAME . '/assets/css/grid_system.css');
        wp_enqueue_style("semantic_ui", UMB_PLUGIN_URI . '/' . UMB_PLUGIN_NAME . '/assets/libs/semantic_ui/semantic.min.css');
        wp_enqueue_style("mainstyle", UMB_PLUGIN_URI . '/' . UMB_PLUGIN_NAME . '/assets/css/main.css');

        //Scripts
        wp_enqueue_script("grid_system", UMB_PLUGIN_URI . '/' . UMB_PLUGIN_NAME . '/assets/libs/semantic_ui/semantic.min.js');
        wp_enqueue_script("plug_exception", UMB_PLUGIN_URI . '/' . UMB_PLUGIN_NAME . '/assets/js/exception.js');
        wp_enqueue_script("controller_dashboard", UMB_PLUGIN_URI . '/' . UMB_PLUGIN_NAME . '/assets/js/admin/dashboard.js');
        wp_enqueue_script("main", UMB_PLUGIN_URI . '/' . UMB_PLUGIN_NAME . '/assets/js/main.js');
    }


    add_action('admin_enqueue_scripts', 'umb_register_admin_enqueues');
else :
    Exception::person("#0205161201 : Função 'umb_enqueues_register' já existe", E_USER_ERROR);
endif;
use Umbrella\Exception;
use Umbrella\Umbrella;

$loader = new Twig_Loader_Filesystem(__DIR__ . '/src/App/Views');
$twig = new Twig_Environment($loader);
$umb_messages = new Exception();
$app = new Umbrella(UMB_PLUGIN_MODULES_DIR, $twig);

echo $twig->render('local_error.twig', array('exception' => ''));
