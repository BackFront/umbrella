<?php

/*
  Plugin Name: Umbrella
  Plugin URI: https://github.com/backfront/umbrella
  Description: Plugin Modular
  Version: 1.0.0
  Author: Douglas Alves
  Author URI: http://alvesdouglas.com.br/
  License: GPLv2
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Arquivo de configuração do plugin
 */
require_once('bootstrap.php');

function load_modules() {
    global $app;
    $app->load_module('teste');
}

add_action('plugins_loaded', 'load_modules');

$app->controller('Controllers\Admin\Dashboard')->initDashboard(new \Odin_Add_Menu());
