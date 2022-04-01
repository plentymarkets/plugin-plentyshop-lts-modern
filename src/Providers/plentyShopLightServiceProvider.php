<?php

namespace plentyShopLTSModern\Providers;

use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;
use Plenty\Console\Commands\GenerateShopBuilderPresetsEvent;
use plentyShopLTSModern\Hooks\GenerateShopBuilderPresets;
use IO\Extensions\Functions\Partial;
use IO\Helper\ResourceContainer;

/**
 * Class plentyShopLTSModernServiceProvider
 * @package plentyShopLTSModern\Providers
 */
class plentyShopLTSModernServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
    }

    /**
     * @param Twig $twig
     * @param Dispatcher $eventDispatcher
     * @return bool
     */
    public function boot(Twig $twig, Dispatcher $eventDispatcher)
    {
        // import additional scripts
        $eventDispatcher->listen("IO.Resources.Import", function (ResourceContainer $container)
        {
            $container->addScriptTemplate("plentyShopLTSModern::content.plentyShopLTSModernScripts");
        }, 0);

        // generate shopbuilder presets
        $eventDispatcher->listen(GenerateShopBuilderPresetsEvent::class, GenerateShopBuilderPresets::class);
    }
}
