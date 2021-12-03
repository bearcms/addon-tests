<?php

/*
 * Bear CMS addon test utilities
 * https://github.com/bearcms/addon-tests
 * Copyright (c) Amplilabs Ltd.
 * Free to use under the MIT license.
 */

namespace BearCMS\AddonTests;

/**
 *
 */
class PHPUnitTestCase extends \BearFramework\AddonTests\PHPUnitTestCase
{

    /**
     * 
     * @param boolean $setLogger
     * @param boolean $setDataDriver
     * @param boolean $setCacheDriver
     * @param boolean $addAddon
     * @return \BearFramework\App
     */
    protected function initializeApp(bool $setLogger = true, bool $setDataDriver = true, bool $setCacheDriver = true, bool $addAddon = true): \BearFramework\App
    {
        $app = parent::initializeApp($setLogger, $setDataDriver, $setCacheDriver, false);
        $app->addons->add('bearcms/bearframework-addon');
        $app->bearCMS->initialize([]);
        $this->initializeAddon($app->bearCMS);
        return $app;
    }

    /**
     * 
     * @param \BearFramework\App $app
     * @param array $options
     * @return void
     */
    protected function initializeAddon(\BearCMS $bearCMS)
    {
        $addonID = $this->getTestedAddonID();
        if ($addonID !== null) {
            $bearCMS->addons->add($addonID);
        }
    }

    /**
     * Try to find the tested Bear CMS addon ID
     * @return string|null
     */
    private function getTestedAddonID(): ?string
    {
        $currentDir = str_replace('\\', '/', __DIR__);
        $expectedPath = '/vendor/bearcms/addon-tests/src';
        $expectedPathLength = strlen($expectedPath);
        if (substr($currentDir, -$expectedPathLength) === $expectedPath) {
            $addonDir = substr($currentDir, 0, -$expectedPathLength);
            if (is_file($addonDir . '/bearcms.json')) {
                $data = json_decode(file_get_contents($addonDir . '/bearcms.json'), true);
                if (isset($data['id'])) {
                    return $data['id'];
                }
            }
        }
        return null;
    }
}
