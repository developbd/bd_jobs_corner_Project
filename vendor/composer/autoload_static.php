<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitced887ce5558eead0095eafa8abcaf06
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitced887ce5558eead0095eafa8abcaf06::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitced887ce5558eead0095eafa8abcaf06::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
