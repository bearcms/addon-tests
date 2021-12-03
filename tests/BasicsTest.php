<?php

/*
 * Bear CMS addon test utilities
 * https://github.com/bearcms/addon-tests
 * Copyright (c) Amplilabs Ltd.
 * Free to use under the MIT license.
 */

use BearCMS\AddonTests\PHPUnitTestCase;

/**
 * 
 */
class BasicsTest extends PHPUnitTestCase
{

    /**
     * @runInSeparateProcess
     */
    public function testApp()
    {
        $app = $this->getApp();
        $this->assertTrue($app instanceof \BearFramework\App);
    }
}
