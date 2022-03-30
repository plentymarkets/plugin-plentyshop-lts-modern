<?php

namespace plentyShopLight\Widgets\Presets;

use Ceres\Widgets\Helper\PresetHelper;
use IO\Extensions\Constants\ShopUrls;
use IO\Helper\RouteConfig;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;
use Plenty\Plugin\Translation\Translator;

/**
 * Class DefaultLoginPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for signing in customers. It contains:
 * - TwoColumnWidget
 * - InlineTextWidget
 * - LoginWidget
 * - GuestLoginWidget
 * - LinkWidget
 *
 * @package plentyShopLight\Widgets\Presets
 */
class DefaultLoginPreset implements ContentPreset
{
    /** @var PresetHelper */
    private $preset;

    /** @var PresetHelper */
    private $twoColumnWidget;

    /** @var PresetHelper */
    private $loginTwoColumnWidget;

    /** @var ShopUrls */
    private $shopUrls;

    /** @var Translator */
    private $translator;
    
    /**
     * @inheritDoc
     */
    public function getWidgets(): array
    {
        $this->preset = pluginApp(PresetHelper::class);
        $this->translator = pluginApp(Translator::class);
        $this->shopUrls = pluginApp(ShopUrls::class);

        $this->createTwoColumnWidget();
        $this->createLoginTwoColumnWidget();

        $this->createTextWidgetLogin();
        $this->createLoginWidget();
        $this->createTextWidgetGuest();
        $this->createGuestLoginWidget();
        $this->createTextWidgetRegister();
        $this->createRegisterLinkWidget();

        return $this->preset->toArray();
    }

    private function createTwoColumnWidget(): void
    {
        $this->twoColumnWidget = $this->preset->createWidget("Ceres::TwoColumnWidget")
            ->withSetting("customClass", "px-lg-5 mx-xl-5 my-5")
            ->withSetting("layout", "oneToOne")
            ->withSetting("layoutTablet", "oneToOne")
            ->withSetting("layoutMobile", "stackedMobile");
    }

    private function createLoginTwoColumnWidget(): void
    {
        $this->loginTwoColumnWidget = $this->twoColumnWidget->createChild("first", "Ceres::TwoColumnWidget")
            ->withSetting("customClass", "mr-md-3")
            ->withSetting("layout", "stacked")
            ->withSetting("layoutTablet", "stackedTablet")
            ->withSetting("layoutMobile", "stackedMobile");
    }

    private function createTextWidgetLogin(): void
    {
        $this->loginTwoColumnWidget->createChild("first", "Ceres::InlineTextWidget")
            ->withSetting("text", "<h2>{{ trans(\"Ceres::Template.login\") }}</h2>")
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null);
    }

    private function createLoginWidget(): void
    {
        $this->loginTwoColumnWidget->createChild("first", "Ceres::LoginWidget")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 4)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function createTextWidgetGuest(): void
    {
        $this->twoColumnWidget->createChild("second", "Ceres::InlineTextWidget")
            ->withSetting("customClass", "ml-md-3")
            ->withSetting("text", "<h2>{{ trans(\"Ceres::Template.loginOrderAsGuest\") }}</h2>")
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.left.value", 0)
            ->withSetting("spacing.margin.left.unit", null)
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null);
    }

    private function createGuestLoginWidget(): void
    {
        $this->twoColumnWidget->createChild("second", "Ceres::GuestLoginWidget")
            ->withSetting("customClass", "widget-dark ml-md-3")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.left.value", 0)
            ->withSetting("spacing.margin.left.unit", null);
    }

    private function createTextWidgetRegister(): void
    {
        $this->loginTwoColumnWidget->createChild("second", "Ceres::InlineTextWidget")
            ->withSetting("customClass", "text-right")
            ->withSetting("text", "<h5>{{ trans(\"Ceres::Template.loginCallToAction\") }}</h5>")
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null)
            ->withSetting("spacing.customMargin", true);
    }

    private function createRegisterLinkWidget(): void
    {
        $registerLinkWidget = $this->loginTwoColumnWidget->createChild("second", "Ceres::LinkWidget")
            ->withSetting("customClass", "widget-dark text-right")
            ->withSetting("block", false)
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 4)
            ->withSetting("spacing.margin.bottom.unit", null)
            ->withSetting("spacing.margin.right.value", 0)
            ->withSetting("spacing.margin.right.unit", null)
            ->withSetting("text", $this->translator->trans("Ceres::Template.loginRegister"));

        if (in_array(RouteConfig::REGISTER, RouteConfig::getEnabledRoutes())
            && RouteConfig::getCategoryId(RouteConfig::REGISTER) > 0
            && !$this->shopUrls->equals($this->shopUrls->registration, "/register")) {
            $registerLinkWidget->withSetting("url.type", "category")
                ->withSetting("url.value", RouteConfig::getCategoryId(RouteConfig::REGISTER));
        } else {
            $registerLinkWidget->withSetting("url.type", "external")
                ->withSetting("url.value", $this->shopUrls->registration);
        }
    }
}
