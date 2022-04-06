<?php

namespace plentyShopLTSModern\Widgets\Presets;

use Ceres\Config\CeresConfig;
use Ceres\Widgets\Helper\PresetHelper;
use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;
use Plenty\Plugin\Application;

/**
 * Class DefaultHeaderPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a default header. It contains:
 * - TopBarWidget
 * - SearchSuggestionItemWidgets (all 3)
 * - NavigationWidget
 * - BreadcrumbWidget
 *
 * @package plentyShopLTSModern\Widgets\Presets
 */
class DefaultHeaderPreset implements ContentPreset
{
    /** @var CeresConfig $config */
    private $config;

    /** @var PresetHelper */
    private $preset;

    /** @var PresetWidgetFactory */
    private $topBarWidget;
    
    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->config = pluginApp(CeresConfig::class);
        $this->preset = pluginApp(PresetHelper::class);

        $this->createTopBarWidget();
        $this->createNavigationWidget();
        $this->createBreadcrumbWidget();

        return $this->preset->toArray();
    }

    private function createTopBarWidget(): void
    {
        $this->topBarWidget = $this->preset->createWidget("Ceres::TopBarWidget")
            ->withSetting("isFixed", false)
            ->withSetting("searchStyle", "onDemand")
            ->withSetting("enableLogin", true)
            ->withSetting("enableRegistration", true)
            ->withSetting("enableLanguageSelect", false)
            ->withSetting("enableShippingCountrySelect", false)
            ->withSetting("enableCurrencySelect", false)
            ->withSetting("enableWishList", false)
            ->withSetting("enableBasketPreview", true)
            ->withSetting("basketValues", "quantity")
            ->withSetting("showItemImages", false)
            ->withSetting("customClass", "bg-transparent pt-3");

        $this->createSearchSuggestions();
    }

    private function createSearchSuggestions(): void
    {
        // stacked (2:1) three column grid
        $searchSuggestionGrid = $this->topBarWidget->createChild("suggestions", "Ceres::ThreeColumnWidget")
            ->withSetting("layout", "twoToOneStacked");

        // create item suggestions
        $searchSuggestionGrid->createChild("first", "Ceres::SearchSuggestionItemWidget")
            ->withSetting("showImages", true)
            ->withSetting("showAdditionalInformation", true);

        // create category suggestions
        $searchSuggestionGrid->createChild("second", "Ceres::SearchSuggestionCategoryWidget")
            ->withSetting("showAdditionalInformation", true);
            
        // create search suggestions
        $searchSuggestionGrid->createChild("third", "Ceres::SearchSuggestionSuggestionWidget")
            ->withSetting("showCount", true);
    }

    private function createNavigationWidget(): void
    {
        $companyLogo = $this->config->header->companyLogo;
        if ( strpos($companyLogo, "http") !== 0 && strpos($companyLogo, "layout/") !== 0 )
        {
            /** @var Application $app */
            $app = pluginApp(Application::class);
            $companyLogo = $app->getUrlPath("Ceres") . "/" . $companyLogo;
        }

        $this->preset->createWidget("Ceres::NavigationWidget")
            ->withSetting("isFixed", $this->config->header->fixedNavBar)
            ->withSetting("navigationStyle",  "megaMenu")
            ->withSetting("megaMenuLevels", $this->config->header->megamenuLevels)
            ->withSetting("megaMenuMaxItems.stage1", $this->config->header->megamenuItemsStage1)
            ->withSetting("megaMenuMaxItems.stage2", $this->config->header->megamenuItemsStage2)
            ->withSetting("megaMenuMaxItems.stage3", $this->config->header->megamenuItemsStage3)
            ->withSetting("companyLogoUrl", $companyLogo)
            ->withSetting("customClass", "bg-transparent");
    }

    private function createBreadcrumbWidget(): void
    {
        $this->preset->createWidget("Ceres::BreadcrumbWidget")
            ->withSetting("isFixed", false)
            ->withSetting("showOnHomepage", false)
            ->withSetting("showOnMyAccount", false)
            ->withSetting("showOnCheckout", false)
            ->withSetting("showOnContentCategory", false)
            ->withSetting("showOnLegalPages", false);
    }
}
