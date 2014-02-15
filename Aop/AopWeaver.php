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
 * @package     AopWeaver
 * @author      Jan Fischer, bitWorking <info@bitworking.de>
 * @copyright   2014 Jan Fischer
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class AopWeaver
{

    const BASE_SUFFIX = '_Base';

    public function weave($url)
    {
        $class = $url['host'];
        $path = $class.'.php';
        $source = file_get_contents($path);

        $traits = str_replace('&', ', ', $url['query']);

        $source = $this->_str_replace_first('class '.$class, 'class '.$class.self::BASE_SUFFIX, $source);

        // create proxy class
        $source .= "\n";
        $source .= 'class '.$class.' extends '.$class.self::BASE_SUFFIX."{\n";
        $source .= "    use $traits;\n";
        $source .= '}';

        return $source;
    }
    
    protected function _str_replace_first($search, $replace, $subject)
    {
        $pos = strpos($subject, $search);
        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }


}