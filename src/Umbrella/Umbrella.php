<?php

/**
 * @author Douglas Alves <alves.douglaz@gmail.com>
 */

namespace Umbrella {

    class Umbrella {

        private $module_dir;
        private $template_system;

        public function __construct($module_dir, $template_system = null) {
            $this->module_dir = $module_dir;
            $this->template_system = $template_system;
        }

        public function load_module($mod) {
            $dir = $this->module_dir;

            if (empty($dir) || !is_dir($dir)) {
                echo "Erro ao incluir o Modulo: #{$mod} - no diretorio: {$dir}";
                return false;
            }

            $file = path_join($dir, $mod . '.php');

            if (file_exists($file)) {
                include_once $file;
            } else {
                echo "Erro ao incluir o Modulo: #{$mod} - no diretorio: {$dir}";
                return false;
            }
        }

        public function controller($Controller) {
            return new $Controller($this->template_system);
        }

    }

}
