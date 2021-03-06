<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4ac77f98f29a31cb53e25f4f1cf7aba0
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modele\\' => 7,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modele\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modele',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modeleControllers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4ac77f98f29a31cb53e25f4f1cf7aba0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4ac77f98f29a31cb53e25f4f1cf7aba0::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
