<?php
/**
 * Plugin Name: Umbrella
 * Plugin URI: https://github.com/backfront/umbrella
 * Description: Plugin Modular
 * Version: 1.0
 * Author: Douglas Alves
 * Author URI: http://alvesdouglas.com.br/
 * License: Apache 2.0
 * 
 * @package Umbrella 
 * @subpackage wp_plugin
 * @version 1.0
 * 
 * @author Douglas Alves <alves.douglaz@gmail.com>
 * @link http://https://github.com/BackFront/umbrella/ Project Repository
 * @license http://www.apache.org/licenses/LICENSE-2.0/ Apache License 2.0
 * @since 1.0
 */
register_activation_hook(__FILE__, 'install'); /* It's run when the installation is running */
register_deactivation_hook(__FILE__, 'uninstall'); /* It's run when the uninstall is running */

require_once('bootstrap.php'); //Config File
function load_modules()
{
    global $app;
    $app->load_module('teste');
}


add_action('plugins_loaded', 'load_modules'); /* calls modules */
function init_plugin()
{
    global $app;
    $app->load_admin_menu();
}


add_action('plugins_loaded', 'init_plugin'); /* calls modules */