<?php
/**
 * @author Douglas Alves <alves.douglaz@gmail.com>
 */
namespace Umbrella {
    use Umbrella\Module\ModuleGetCurl;

    class Umbrella
    {

        private $module_dir;
        private $template_system;
        private $umb_auth;

        public function __construct($module_dir, $template_system = null)
        {
            $this->module_dir = $module_dir;
            $this->template_system = $template_system;
        }


        public function load_module($mod)
        {
            $dir = $this->module_dir;

            if(empty($dir) || !is_dir($dir)) {
                trigger_error("Erro ao incluir o Modulo: #{$mod}", E_USER_WARNING);
                return false;
            }

            $file = path_join($dir, $mod . '.php');

            if(file_exists($file)) {
                include_once $file;
            } else {
                trigger_error("Erro ao incluir o Modulo: #{$mod}", E_USER_WARNING);
                return false;
            }
        }


        public function controller($Controller)
        {
            return new $Controller($this->template_system);
        }


        public function remoteAppVerification($umb_auth)
        {
            $usr = $umb_auth['user'];
            $psw = $umb_auth['pass'];
        }


        private function localAppAuthentication()
        {
            
        }


        private function remoteAppAuthentication()
        {
            $this->umb_auth['app_id'] = "ac897e4ff84cf874dfa64fa6ecfb";
            $this->umb_auth['app_secret'] = "74dfa64fa6ecfbac897e4ff84cf874dfa64fa6ecfb";
            $this->umb_auth['token'] = "74dfa64fa6ecfbac897e4ff84cf874dfa64fa6ecfb";
            $this->umb_auth['id'] = 0000;
            $this->umb_auth['user_name'] = "nome";
            $this->umb_auth['user_email'] = "email@domain.com";
            $this->umb_auth['modules'] = array(
                [
                    'id' => 001,
                    'name' => "teste",
                    'get_link' => "https://module.umbrella.tk/?get=3cb18a6f51d5acf0ed",
                    'cover' => "https://module.umbrella.tk/?cover=3cb18a6f51d5acf0ed",
                ],
                [
                    'id' => 002,
                    'name' => "teste2",
                    'get_link' => "https://module.umbrella.tk/?get=3cb18a6f51d5acf0ed",
                    'cover' => "https://module.umbrella.tk/?cover=3cb18a6f51d5acf0ed",
                ],
            );
        }


    }
}
