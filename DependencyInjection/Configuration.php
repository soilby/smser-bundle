<?php

namespace Soil\SmserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('soil_smser');

        $rootNode->children()
            ->scalarNode('smspby_endpoint')->isRequired(true)->end()
            ->scalarNode('smspby_api_key')->isRequired(true)->end()
        ->end();


        return $treeBuilder;
    }
}
