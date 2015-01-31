<?php

namespace PhpGitHooks\Application\Config;

use PhpGitHooks\Infrastructure\Config\ConfigFileReader;

/**
 * Class PreCommitConfig
 * @package PhpGitHooks\Application\Config
 */
class PreCommitConfig implements HookConfigInterface
{
    /** @var ConfigFileReader */
    private $configFileReader;

    /**
     * @param ConfigFileReader $configFileReader
     */
    public function __construct(ConfigFileReader $configFileReader)
    {
        $this->configFileReader = $configFileReader;
    }

    /**
     * @param $service
     * @return bool
     */
    public function isEnabled($service)
    {
        $data = $this->getData();

        if (false === isset($data[$service]) || false === is_bool($data[$service])) {
            return false;
        }

        return $data[$service];
    }

    /**
     * @return array
     */
    private function getData()
    {
        $data = $this->configFileReader->getData();

        return $data['pre-commit']['execute'];
    }
}