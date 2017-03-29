<?php
function autoload($classname)
{
    if (file_exists($file = 'modeleControllers/' . $classname . '.php')) {
        require $file;
    } elseif (file_exists($file = 'modele/' . $classname . '.php')) {
        require $file;
    }
}
spl_autoload_register('autoload');

$rooter= New Rooter();
$rooter->rooterRequete();
?>