<?php
namespace KimaiPlugin\GithubApiBundle\Configuration;

use App\Configuration\ConfigLoaderInterface;
use App\Configuration\StringAccessibleConfigTrait;
use App\Configuration\SystemBundleConfiguration;

class GithubApiConfiguration implements SystemBundleConfiguration, \ArrayAccess
{
    use StringAccessibleConfigTrait;

    public function getPrefix(): string
    {
        return 'github_api';
    }

    protected function getConfigurations(ConfigLoaderInterface $repository): array
    {
        return $repository->getConfiguration();
    }
}