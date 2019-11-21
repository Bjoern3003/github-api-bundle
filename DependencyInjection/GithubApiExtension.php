<?php

namespace KimaiPlugin\GithubApiBundle\DependencyInjection;

use Github\Client;
use App\Plugin\AbstractPluginExtension;
use KimaiPlugin\GithubApiBundle\Configuration\GithubApiConfigLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class GithubApiExtension extends AbstractPluginExtension implements PrependExtensionInterface
{
    const CACHED_CLIENT_CLASS = 'Github\HttpClient\CachedHttpClient';

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        try {
            $config = $this->processConfiguration($configuration, $configs);
        } catch (InvalidConfigurationException $e) {
            trigger_error('Found invalid "github-api" configuration: ' . $e->getMessage());
            throw $e;
        }

        $this->registerBundleConfiguration($container, $config);

        $container->setParameter('github_api', $config);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $clientDefinition = $container->findDefinition('Github\Client');

       /*
        // Configure cache
        if (true === $config['cache']['enabled']) {
            $clientDefinition->setClass(self::CACHED_CLIENT_CLASS);
            $clientDefinition->addMethodCall('addCache', array(new Reference($config['cache']['service'])));
        }

        // Configure client options
        if (isset($config['client'])) {
            foreach ($config['client'] as $key => $value) {
                $clientDefinition->addMethodCall('setOption', array($key, $value));
            }
        }

        // Configure enterprise url
        if ($config['enterprise_url']) {
            $clientDefinition->addMethodCall('setEnterpriseUrl', [$config['enterprise_url']]);
        }*/
        // Configure authentication

        if (Configuration::AUTHENTICATION_DISABLED !== $config['authentication']['type']) {
            $tokenOrLogin = null;
            $password = null;

            switch ($config['authentication']['type']) {
                case Client::AUTH_HTTP_TOKEN:
                case Client::AUTH_URL_TOKEN:
                    $tokenOrLogin = $config['authentication']['token'];
                    break;
                case Client::AUTH_URL_CLIENT_ID:
                    $tokenOrLogin = $config['authentication']['client_id'];
                    $password = $config['authentication']['client_secret'];
                    break;
                case Client::AUTH_HTTP_PASSWORD:
                    $tokenOrLogin = $config['authentication']['username'];
                    $password = $config['authentication']['password'];
            }

            //$clientDefinition->addMethodCall('authenticate', array($tokenOrLogin, $password, $config['authentication']['type']));
         /*   dd($clientDefinition->getMethodCalls());

            dd($container->getDefinition('Github\Client'));*/


            //dd($container->getDefinition('Github\Client')->getMethodCalls());
        }

    }

    public function prepend(ContainerBuilder $container)
    {
        /*$container->prependExtensionConfig('kimai', [
            'github_api' => [
                'base_url'
            ],
        ]);*/
    }
}
