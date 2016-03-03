<?php
function Load(array $Class, $Namespace = null) {
    $path = 'app/controllers';
    $_ = DIRECTORY_SEPARATOR;
    foreach ($Class as $Class):
        $Class = str_replace('\\', DIRECTORY_SEPARATOR, $Class);
        $dirName = __DIR__ . $_ . $path;

        if (file_exists("{$dirName}{$_}{$Namespace}{$_}{$Class}.class.php")):
            require_once("{$dirName}{$_}{$Namespace}{$_}{$Class}.class.php");
        elseif (file_exists("{$dirName}{$_}{$Namespace}{$_}{$Class}.php")):
            require_once("{$dirName}{$_}{$Namespace}{$_}{$Class}.php");
        else:
            die("</hr>Erro ao incluir:: {$dirName}{$_}{$Namespace}{$_}{$Class}.php<hr />");
        endif;
    endforeach;
}
