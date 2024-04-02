<?php
namespace MyApp\Configuration;

use Dotenv\Dotenv;

/**
 * Environment class for initialization of the environment settings
 */
class Environment 
{
    public static function init()
    {
        $envPath = __DIR__ . '/../../';
        $dotenv = Dotenv::createImmutable($envPath);
        $dotenv->load();

        $environmentFileName = '.env';
        $environmentSuffix = '.' . $_ENV['APP_ENV'];
        $environmentFile = realpath($envPath . $environmentFileName . $environmentSuffix);
        if (file_exists($environmentFile)) {
            foreach ($_ENV as $key => $value) {
                unset($_ENV[$key]);
                unset($_SERVER[$key]);
            }
            $dotenv = Dotenv::createImmutable($envPath, $environmentFileName . $environmentSuffix);
            $dotenv->load();
        }
    }
}