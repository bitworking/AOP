<?php

/**
 * Aspect oriented programming with PHP
 *
 * PHP version 5.4
 */

require 'Aop/Aop.php';


Aop\Aop::init(array(
    'Test' => array(
        'Traits\TestAspect',
    )
));


$test = new Test();
$test->run();