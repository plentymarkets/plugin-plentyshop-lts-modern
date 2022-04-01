<?php

namespace plentyShopLTSModern\Widgets\Presets;

use Ceres\Config\CeresConfig;
use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use plentyShopLTSModern\Widgets\Presets\Helper\HasWhiteBackground;
use IO\Extensions\Constants\ShopUrls;
use IO\Helper\RouteConfig;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;
use Plenty\Plugin\Translation\Translator;

/**
 * Class DefaultOrderConfirmationPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for viewing the customer's order confirmation. It contains:
 * - InlineTextWidget
 * - OrderDataWidget
 * - PurchasedItemsWidget
 * - LinkWidget
 * - OrderDocumentsWidget
 * - OrderTotalsWidget
 * - FourColumnWidget
 * - ThreeColumnWidget
 * - TwoColumnWidget
 *
 * @package plentyShopLTSModern\Widgets\Presets
 */
class DefaultOrderConfirmationPreset implements ContentPreset
{
    use HasWhiteBackground;

    /** @var PresetHelper */
    private $preset;

    /** @var CeresConfig */
    private $ceresConfig;

    /** @var ShopUrls */
    private $shopUrls;

    /** @var Translator */
    private $translator;

    /** @var PresetWidgetFactory */
    private $twoColumnWidget;

    /** @var PresetWidgetFactory */
    private $threeColumnWidget;

    /** @var PresetWidgetFactory */
    private $fourColumnWidget;

    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->preset = pluginApp(PresetHelper::class);
        $this->ceresConfig = pluginApp(CeresConfig::class);
        $this->translator = pluginApp(Translator::class);

        $this->shopUrls = pluginApp(ShopUrls::class);

        $this->createHeadline();

        $this->createTwoColumnWidget();

        $this->createOrderDataWidget();

        $this->createTrackingLinkWidget();
        $this->createRetourLinkWidget();
        $this->createOrderDocumentsWidget();

        $this->createPurchasedItemsWidget();
        $this->createOrderTotalsWidget();

        $this->createFourColumnWidget();
        $this->createBottomNavigation();

        return $this->preset->toArray();
    }

    private function createHeadline()
    {
        $this->preset->createWidget("Ceres::InlineTextWidget")
            ->withSetting("text", "<h1>{{ trans(\"Ceres::Template.orderConfirmationThanks\") }}</h1>")
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null)
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.top.value", 5)
            ->withSetting("spacing.margin.top.unit", null);

        $this->preset->createWidget("Ceres::InlineTextWidget")
            ->withSetting("text", "<p>{{ trans(\"Ceres::Template.orderConfirmationWillBeProcessed\") }}</p>")
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null)
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 3)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function createOrderDataWidget()
    {
        $this->twoColumnWidget->createChild("first", "Ceres::OrderDataWidget")
            ->withSetting("customClass", "order-data border-0 mr-lg-3 widget-dark")
            ->withSetting("outline", true)
            ->withSetting("addressFields", ["title", "contactPerson", "name1", "name2", "name3", "name4", "address1", "address2", "address3", "address4", "postalCode", "town", "country"])
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 3)
            ->withSetting("spacing.margin.bottom.unit", null)
            ->withSetting("spacing.margin.right.value", 0)
            ->withSetting("spacing.margin.right.unit", null)
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null);
    }

    private function createPurchasedItemsWidget()
    {
        $this->twoColumnWidget->createChild("second", "Ceres::PurchasedItemsWidget")
            ->withSetting("customClass", "item-data border-0 ml-lg-3 widget-dark")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 4)
            ->withSetting("spacing.margin.bottom.unit", null)
            ->withSetting("spacing.margin.left.value", 0)
            ->withSetting("spacing.margin.left.unit", null)
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null);
    }

    private function createTrackingLinkWidget()
    {
        $this->twoColumnWidget->createChild("first", "Ceres::LinkWidget")
            ->withSetting("customClass", "order-tracking widget-dark mr-lg-3")
            ->withSetting("block", "true")
            ->withSetting("text", $this->translator->trans("Ceres::Widget.urlTrackingLabel"))
            ->withSetting("url.value", "tracking")
            ->withSetting("url.type", "internalLink")
            ->withSetting("url.openInNewTab", true)
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.right.value", 0)
            ->withSetting("spacing.margin.right.unit", null)
            ->withSetting("spacing.margin.bottom.value", 3)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function createOrderDocumentsWidget()
    {
        $this->twoColumnWidget->createChild("first", "Ceres::OrderDocumentsWidget")
            ->withSetting("customClass", "order-documents widget-dark mr-lg-3")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.right.value", 0)
            ->withSetting("spacing.margin.right.unit", null)
            ->withSetting("spacing.margin.bottom.value", 3)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function createRetourLinkWidget()
    {
        $this->twoColumnWidget->createChild("first", "Ceres::LinkWidget")
            ->withSetting("customClass", "order-return widget-dark mr-lg-3")
            ->withSetting("block", "true")
            ->withSetting("text", $this->translator->trans("Ceres::Widget.urlReturnLabel"))
            ->withSetting("url.value", "return")
            ->withSetting("url.type", "internalLink")
            ->withSetting("url.openInNewTab", false)
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.right.value", 0)
            ->withSetting("spacing.margin.right.unit", null)
            ->withSetting("spacing.margin.bottom.value", 3)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function createOrderTotalsWidget()
    {
        $this->twoColumnWidget->createChild("second", "Ceres::OrderTotalsWidget")
            ->withSetting("customClass", "border-0 ml-lg-3")
            ->withSetting("visibleFields", ["orderValueNet", "orderValueGross", "rebate", "shippingCostsNet", "shippingCostsGross", "promotionCoupon", "totalSumNet", "vats", "totalSumGross", "salesCoupon", "openAmount", "additionalCosts"])
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.left.value", 0)
            ->withSetting("spacing.margin.left.unit", null);
    }

    private function createSeparatorWidget()
    {
        $this->preset->createWidget("Ceres::SeparatorWidget");
    }

    private function createFourColumnWidget()
    {
        $this->fourColumnWidget = $this->preset->createWidget("Ceres::FourColumnWidget")
            ->withSetting("customClass", "mt-4 mb-5");
    }

    private function createBottomNavigation()
    {
        $this->fourColumnWidget->createChild("second", "Ceres::LinkWidget")
            ->withSetting("appearance", "primary")
            ->withSetting("block", "true")
            ->withSetting("text", $this->translator->trans("Ceres::Template.orderConfirmationHomepage"))
            ->withSetting("customClass", "widget-dark mr-lg-3")
            ->withSetting("url.type", "external")
            ->withSetting("url.value", $this->shopUrls->home)
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.right.value", 0)
            ->withSetting("spacing.margin.right.unit", null);

        $myAccountLinkWidget = null;
        $myAccountLinkWidget = $this->fourColumnWidget->createChild("third", "Ceres::LinkWidget")
            ->withSetting("appearance", "primary")
            ->withSetting("customClass", "widget-dark ml-lg-3")
            ->withSetting("block", "true")
            ->withSetting("text", $this->translator->trans("Ceres::Template.orderConfirmationMyAccount"))
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.left.value", 0)
            ->withSetting("spacing.margin.left.unit", null);

        if (
            in_array(RouteConfig::MY_ACCOUNT, RouteConfig::getEnabledRoutes())
            && RouteConfig::getCategoryId(RouteConfig::MY_ACCOUNT) > 0
            && !$this->shopUrls->equals($this->shopUrls->myAccount, "/my-account")
        ) {
            $myAccountLinkWidget->withSetting("url.type", "category")
                ->withSetting("url.value", RouteConfig::getCategoryId(RouteConfig::MY_ACCOUNT));
        } else {
            $myAccountLinkWidget->withSetting("url.type", "external")
                ->withSetting("url.value", $this->shopUrls->myAccount);
        }
    }

    private function createTwoColumnWidget()
    {
        $this->twoColumnWidget = $this->preset->createWidget("Ceres::TwoColumnWidget")
            ->withSetting("customClass", "order-data border-0 mr-0 mr-lg-3")
            ->withSetting("layout", "oneToOne");
    }

    private function createThreeColumnWidget()
    {
        $this->threeColumnWidget = $this->twoColumnWidget->createChild("first", "Ceres::ThreeColumnWidget")
            ->withSetting("layout", "oneToOneToOne");
    }
}
