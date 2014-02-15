<?php

/**
 * Aspect oriented programming with PHP
 *
 * PHP version 5.4
 */
namespace Traits;

/**
 * Aspect oriented programming with PHP
 *
 * @category    Aop
 * @package     TestAspect
 * @author      Jan Fischer, bitWorking <info@bitworking.de>
 * @copyright   2014 Jan Fischer
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */
trait TestAspect
{

    public function run()
    {
        echo 'TestAspect->run() (before)';
        echo '<br>';

        parent::run();

        echo '<br>';
        echo 'TestAspect->run() (after)';
    }    
}
