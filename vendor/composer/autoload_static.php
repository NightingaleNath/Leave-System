<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6730ab9fa4f608424e695b92ba293e5b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6730ab9fa4f608424e695b92ba293e5b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6730ab9fa4f608424e695b92ba293e5b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6730ab9fa4f608424e695b92ba293e5b::$classMap;

        }, null, ClassLoader::class);
    }
}