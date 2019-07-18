<?php
/**
 * Lyra Collect V2-Payment Module version 2.4.1 for Magento 2.x. Support contact : support-ecommerce@lyra-collect.com.
 *
 * @category  Payment
 * @package   Lyra
 * @author    Lyra Network (http://www.lyra-network.com/)
 * @copyright 2014-2019 Lyra Network and contributors
 * @license   
 */

namespace Lyranetwork\Lyra\Model\Api\Ws;

class WsApiClassLoader
{
    private function __construct()
    {
        // Do not instantiate this class.
    }

    /**
     * Registers self::loadClass method as an autoloader.
     *
     * @param bool $prepend Whether to prepend the autoloader or not
     */
    public static function register($prepend = false)
    {
        spl_autoload_register(__NAMESPACE__ . '\WsApiClassLoader::loadClass', true, $prepend);
    }

    /**
     * Unregisters self::loadClass method as an autoloader.
     */
    public static function unregister()
    {
        spl_autoload_unregister(__NAMESPACE__ . '\WsApiClassLoader::loadClass');
    }

    public static function loadClass($class)
    {
        if (__NAMESPACE__ && strpos($class, __NAMESPACE__) === false) {
            return;
        }

        $pos = strrpos($class, '\\');
        if ($pos === false) {
            $pos = -1;
        }

        $file = __DIR__ . DIRECTORY_SEPARATOR . substr($class, $pos + 1) . '.php';
        if (is_file($file) && ($file !== __FILE__)) {
            include_once $file;
        }
    }
}
