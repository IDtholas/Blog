<?php
function autoload($classname)
{
    if (file_exists($file = '../modeleControllers/' . $classname . '.php')) {
        require $file;
    } elseif (file_exists($file = '../modele/' . $classname . '.php')) {
        require $file;
    }
}
spl_autoload_register('autoload');


$ctrlAdmin = new ControlleurAdmin();
$ctrlAdmin->admin();
?>

