<?php

/**
 * @package Umbrella 
 * @subpackage Umbrella Modular Plugin
 * @version 1.0.0
 * 
 * @author Douglas Alves <alves.douglaz@gmail.com>
 * @link http://https://github.com/BackFront/umbrella_modular_plugin/ Project Repository
 * @license http://www.apache.org/licenses/LICENSE-2.0/ Apache License 2.0
 * @since 1.0
 */

namespace Umbrella {

    class Exception {

        /**
         * 
         * @param type $return: Verity if exists a return
         * @param type $errorArray: array assoc containig the informations of this exception message
         * @return type bool
         * 
         * @usage $error array( 
         * 'exception_id' => {number_of_exception: type <i>int</i>},
         * 'exception_type' => {type_of_exception: [ E_USER_NOTICE | E_USER_DEPRECATED |success| E_USER_ERROR | E_USER_WARNING ] type <i>string</i>},
         * 'exception_title' => {title_for_exception: type <i>string</i>},
         * 'exception_message' => {message_for_exception: type <i>string</i>},
         * 'exception_path' => {path_for_exception: type <i>string</i>},
         * 'exception_line' => {line_for_exception: type <i>string</i>},
         * )
         */
        private $type;

        public function __construct($type = null) {
            define('UMB_USER_SUCCESS', 200);
            $this->type = $type;
            set_error_handler(array(&$this, 'buildExceptionMessage'));
        }

        public function buildExceptionMessage($excNo, $excMsg, $excFile, $excLine, $excContext) {
            switch ($excNo) :
                case E_USER_ERROR :
                    $cssclass = "negative";
                    break;
                case E_USER_WARNING :
                    $cssclass = "warning";
                    break;
                case E_USER_NOTICE :
                    $cssclass = "info";
                    break;
                case E_USER_DEPRECATED :
                    $cssclass = "small";
                    break;
                case UMB_USER_SUCCESS :
                    $cssclass = "success";
                    break;
                default :
                    $cssclass = "info";
                    break;
            endswitch;

            $html = '<div class="ui ' . $cssclass . ' message umb umb-exception">';
            $html .= '<i class="close icon"></i>';
            $html .= '<div class="header">' . $excMsg . '</div>';
            $html .= '<p>' . $excFile . ':' . $excLine . '</p>';
            $html .= '</div>';
            echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>';

            echo '<script>exc("#umb_local_error"';
            echo $html;
            echo ')</script>';
        }

        public static function person($excNo, $excMsg, $excFile = null, $excLine = null) {
            switch ($excNo) :
                case E_USER_ERROR :
                    $cssclass = "negative";
                    break;
                case E_USER_WARNING :
                    $cssclass = "warning";
                    break;
                case E_USER_NOTICE :
                    $cssclass = "info";
                    break;
                case E_USER_DEPRECATED :
                    $cssclass = "small";
                    break;
                case UMB_USER_SUCCESS :
                    $cssclass = "success";
                    break;
            endswitch;

            $html = '<div class="ui ' . $cssclass . ' message umb umb-exception">';
            $html .= '<i class="close icon"></i>';
            $html .= '<div class="header">' . $excMsg . '</div>';
            $html .= '<p>' . $excFile . $excLine . '</p>';
            $html .= '</div>';
            echo $html;
        }

    }

}
