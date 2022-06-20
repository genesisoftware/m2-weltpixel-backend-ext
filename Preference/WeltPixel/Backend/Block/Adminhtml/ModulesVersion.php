<?php

namespace Genesisoft\BackendExt\Preference\WeltPixel\Backend\Block\Adminhtml;

/**
 * Class ModulesVersion
 * @package WeltPixel\Backend\Block\Adminhtml
 */
class ModulesVersion extends \WeltPixel\Backend\Block\Adminhtml\ModulesVersion
{    /**
     * @param $moduleName
     * @return string
     */
    protected function getComposerVersion($moduleName, $type) {
        $path = $this->componentRegistrar->getPath(
            $type,
            $moduleName
        );

        if (!$path) {
            return __('N/A');
        }

        $dirReader = $this->readFactory->create($path);
        $composerJsonData = $dirReader->readFile('composer.json');
        $data = json_decode($composerJsonData, true);
        return true;

    }
}
