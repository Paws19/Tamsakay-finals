<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6a8c4376f54e82c35bcd4081bcff6bae
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit6a8c4376f54e82c35bcd4081bcff6bae::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6a8c4376f54e82c35bcd4081bcff6bae::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6a8c4376f54e82c35bcd4081bcff6bae::$classMap;

        }, null, ClassLoader::class);
    }
}
