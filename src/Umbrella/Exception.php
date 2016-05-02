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

namespace Umbrella;

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
        $this->type = $type;
        set_error_handler(array($this, 'buildExceptionMessage'));
        echo "ola";
    }
    

    public function buildExceptionMessage($excNo, $excMsg, $excFile, $excLine, $excContext) {
        switch ($excNo) :
            case E_USER_ERROR :
                "Deu ruim";
                break;
            case E_USER_WARNING :
                "Sedoido";
                break;
            case E_USER_NOTICE :
                "Salve";
                break;
            case E_USER_DEPRECATED :
                "Nem existo";
                break;
            default :
                "Normal";
                break;
        endswitch;
    }

}
