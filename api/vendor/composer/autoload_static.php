<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5de51a6ee6dde7d4a962686f87360ce8
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'src\\' => 4,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'src\\Authenticate' => __DIR__ . '/../..' . '/src/Authenticate.php',
        'src\\Base' => __DIR__ . '/../..' . '/src/Base.php',
        'src\\ClientErrorException' => __DIR__ . '/../..' . '/src/ClientErrorException.php',
        'src\\Database' => __DIR__ . '/../..' . '/src/Database.php',
        'src\\FirebaseJWT\\JWT' => __DIR__ . '/../..' . '/src/FirebaseJWT/jwt.php',
        'src\\FirebaseJWT\\Key' => __DIR__ . '/../..' . '/src/FirebaseJWT/key.php',
        'src\\FirebaseJWT\\beforevalidexception' => __DIR__ . '/../..' . '/src/FirebaseJWT/beforevalidexception.php',
        'src\\FirebaseJWT\\expiredexception' => __DIR__ . '/../..' . '/src/FirebaseJWT/expiredexception.php',
        'src\\FirebaseJWT\\signatureinvalidexception' => __DIR__ . '/../..' . '/src/FirebaseJWT/signatureinvalidexception.php',
        'src\\Paper' => __DIR__ . '/../..' . '/src/Paper.php',
        'src\\Request' => __DIR__ . '/../..' . '/src/Request.php',
        'src\\Response' => __DIR__ . '/../..' . '/src/Response.php',
        'src\\Update' => __DIR__ . '/../..' . '/src/Update.php',
        'src\\author' => __DIR__ . '/../..' . '/src/author.php',
        'src\\clientError' => __DIR__ . '/../..' . '/src/clientError.php',
        'src\\endpoint' => __DIR__ . '/../..' . '/src/endpoint.php',
        'src\\responseJson' => __DIR__ . '/../..' . '/src/responseJson.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5de51a6ee6dde7d4a962686f87360ce8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5de51a6ee6dde7d4a962686f87360ce8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5de51a6ee6dde7d4a962686f87360ce8::$classMap;

        }, null, ClassLoader::class);
    }
}
