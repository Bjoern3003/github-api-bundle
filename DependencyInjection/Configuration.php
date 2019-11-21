<?php

namespace KimaiPlugin\GithubApiBundle\DependencyInjection;

use Github\Client;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    const AUTHENTICATION_DISABLED = 'none';

    const DEFAULT_BASE_URL = 'https://api.github.com';

    const DEFAULT_API_VERSION = 'v3';

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('github_api');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('cache')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enabled')->defaultFalse()->end()
                        ->scalarNode('service')->defaultValue('github.http.cache')->end()
                    ->end()
                ->end()
                ->scalarNode('base_url')->defaultValue(self::DEFAULT_BASE_URL)->end()
                ->scalarNode('api_version')->defaultValue(self::DEFAULT_API_VERSION)->end()
                ->arrayNode('authentication')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->enumNode('type')
                            ->values(self::getValidAuthMethods())
                            ->defaultValue(self::AUTHENTICATION_DISABLED)
                        ->end()
                        ->scalarNode('token')->defaultNull()->end()
                        ->scalarNode('client_id')->defaultNull()->end()
                        ->scalarNode('client_secret')->defaultNull()->end()
                        ->scalarNode('username')->defaultNull()->end()
                        ->scalarNode('password')->defaultNull()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }

    private static function getValidAuthMethods()
    {
        return array(
            Client::AUTH_HTTP_PASSWORD,
            Client::AUTH_HTTP_TOKEN,
            Client::AUTH_URL_CLIENT_ID,
            Client::AUTH_URL_TOKEN,
            self::AUTHENTICATION_DISABLED
        );
    }
}