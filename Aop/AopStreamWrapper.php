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
 * @package     AopStreamWrapper
 * @author      Jan Fischer, bitWorking <info@bitworking.de>
 * @copyright   2014 Jan Fischer
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class AopStreamWrapper
{

    private $_pos;
    private $_stream;

    public function stream_open($path, $mode, $options, &$opened_path)
    {
        $url = parse_url($path);
        $this->_pos = 0;

        require_once 'AopWeaver.php';
        $weaver = new AopWeaver();
        $this->_stream = $weaver->weave($url);

        if (!is_string($this->_stream)) {
            return false;
        }

        return true;
    }
    
    public function stream_read($count)
    {
        $p = &$this->_pos;
        $ret = substr($this->_stream, $this->_pos, $count);
        $this->_pos += strlen($ret);
        return $ret;
    }
    
    public function stream_eof()
    {
        return $this->_pos >= strlen($this->_stream);
    }
    
    public function stream_stat()
    {
        return array();
    }

}