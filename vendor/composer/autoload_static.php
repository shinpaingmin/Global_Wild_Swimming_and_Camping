<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2ef80f280b6e8f0474e065aa280e84e9
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2ef80f280b6e8f0474e065aa280e84e9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2ef80f280b6e8f0474e065aa280e84e9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2ef80f280b6e8f0474e065aa280e84e9::$classMap;

        }, null, ClassLoader::class);
    }
}
