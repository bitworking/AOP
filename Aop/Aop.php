<?php

/**
 * Aspect oriented programming with PHP
 *
 * PHP version 5.4
 */
namespace Aop;

/**
 * Aspect oriented programming with PHP
 *
 * @category    Aop
 * @package     Aop
 * @author      Jan Fischer, bitWorking <info@bitworking.de>
 * @copyright   2014 Jan Fischer
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class Aop
{

    const PROTOCOLL = 'aop';
    
    private static $_config = array();

    public static function init(array $config)
    {
        self::$_config = $config;
        require 'AopStreamWrapper.php';
        stream_wrapper_register(self::PROTOCOLL, 'Aop\AopStreamWrapper');
        spl_autoload_register(array('self', 'aopAutoload'));
    }
    
    private static function aopAutoload($class)
    {
        if (array_key_exists($class, self::$_config) && count(self::$_config[$class]) > 0) {
            require self::PROTOCOLL.'://'.$class.'?'.implode('&', self::$_config[$class]);
        }
        else {
            $pathToFile = $class.'.php';
            require $pathToFile;
        }
    }
    
    
}