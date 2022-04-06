<?php

namespace plentyShopLTSModern\Widgets\Presets;

use Ceres\Config\CeresConfig;
use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class DefaultCheckoutPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for viewing and interacting with the checkout. It contains:
 * - TwoColumnWidget
 * - BackgroundWidget
 * - AddressWidget
 * - ShippingProfileWidget
 * - PaymentProviderWidget
 * - ContactWishWidget
 * - ShippingPrivacyCheckWidget
 * - GtcCheckWidget
 * - BasketWidget
 * - BasketTotalsWidget
 * - CouponWidget
 * - PlaceOrderWidget
 * - CancelPaymentWidget
 *
 * @package plentyShopLTSModern\Widgets\Presets
 */
class DefaultCheckoutPreset implements ContentPreset
{
    /** @var PresetHelper */
    private $preset;

    /** @var CeresConfig */
    private $ceresConfig;
    
    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->preset = pluginApp(PresetHelper::class);
        $this->ceresConfig = pluginApp(CeresConfig::class);

        $this->createHeadline();

        $twoColumnWidget = $this->preset->createWidget("Ceres::TwoColumnWidget")
            ->withSetting("layout", "sevenToFive");

        $this->createLeftSide($twoColumnWidget);
        $this->createRightSide($twoColumnWidget);

        $this->createAsterisk();

        return $this->preset->toArray();
    }

    //======================================
    // LEFT SIDE
    //======================================

    /**
     * @param PresetWidgetFactory $twoColumnWidget
     */
    private function createLeftSide($twoColumnWidget)
    {
        $bgContainer = $twoColumnWidget->createChild("first", "Ceres::BackgroundWidget")
            ->withSetting("fullWidth", "false")
            ->withSetting("colorPalette", "white")
            ->withSetting("customClass", "pr-lg-3")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null);

        $this->createAddressWidget("1", $bgContainer);
        $this->createAddressWidget("2", $bgContainer);
        $this->createShippingProfileWidget($bgContainer);
        $this->createPaymentProviderWidget($bgContainer);
        $this->createContactWishWidget($bgContainer);
        $this->createShippingPrivacyCheckWidget($bgContainer);
        $this->createGtcCheckWidget($bgContainer);
    }

    /**
     * @param string $type
     * @param PresetWidgetFactory $bgContainer
     */
    private function createAddressWidget($type, $bgContainer)
    {
        $addressWidget = $bgContainer->createChild("background", "Ceres::AddressWidget");
        
        $addressWidget
        ->withSetting("addressType", $type)
        ->withSetting("customClass", "widget-transparent");

        if ($type == "1") {
            $addressWidget
                ->withSetting("addressFieldsInvoiceDE", $this->ceresConfig->addresses->billingAddressShow)
                ->withSetting("addressRequiredFieldsInvoiceDE", $this->ceresConfig->addresses->billingAddressRequire)
                ->withSetting("addressFieldsInvoiceGB", $this->ceresConfig->addresses->billingAddressShow_en)
                ->withSetting("addressRequiredFieldsInvoiceGB", $this->ceresConfig->addresses->billingAddressRequire_en)
                ->withSetting("hintText", "<h2>{{ trans(\"Ceres::Template.checkoutInvoiceAddress\") }}</h2>");
        } elseif ($type == "2") {
            $addressWidget
                ->withSetting("addressFieldsShippingDE", $this->ceresConfig->addresses->deliveryAddressShow)
                ->withSetting("addressRequiredFieldsShippingDE", $this->ceresConfig->addresses->deliveryAddressRequire)
                ->withSetting("addressFieldsShippingGB", $this->ceresConfig->addresses->deliveryAddressShow_en)
                ->withSetting("addressRequiredFieldsShippingGB", $this->ceresConfig->addresses->deliveryAddressRequire_en)
                ->withSetting("hintText", "<h2>{{ trans(\"Ceres::Template.checkoutShippingAddress\") }}</h2>");
        }
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createShippingProfileWidget($bgContainer)
    {
        $bgContainer->createChild("background", "Ceres::ShippingProfileWidget")
            ->withSetting("hintText", "<h2>{{ trans(\"Ceres::Template.checkoutShippingProfile\") }}</h2>");
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createPaymentProviderWidget($bgContainer)
    {
        $bgContainer->createChild("background", "Ceres::PaymentProviderWidget")
        ->withSetting("hintText", "<h2>{{ trans(\"Ceres::Template.checkoutPaymentMethod\") }}</h2>");
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createContactWishWidget($bgContainer)
    {
        $bgContainer->createChild("background", "Ceres::ContactWishWidget")
            ->withSetting("hintText", "<h2>{{ trans(\"Ceres::Template.checkoutContactWish\") }}</h2>");
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createShippingPrivacyCheckWidget($bgContainer)
    {
        $bgContainer->createChild("background", "Ceres::ShippingPrivacyCheckWidget");
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createGtcCheckWidget($bgContainer)
    {
        $bgContainer->createChild("background", "Ceres::GtcCheckWidget")
            ->withSetting("isPreselected", false)
            ->withSetting("isRequired", true);
    }

    //======================================
    // RIGHT SIDE
    //======================================

    /**
     * @param PresetWidgetFactory $twoColumnWidget
     */
    private function createRightSide($twoColumnWidget)
    {
        $bgContainer = $twoColumnWidget->createChild("second", "Ceres::BackgroundWidget");
        $bgContainer->withSetting("customClass", "pl-lg-3 h-100 bg-white")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null);

        $this->createBasketWidget($bgContainer);

        $stickyContainer = $bgContainer->createChild("background", "Ceres::StickyContainerWidget");
        $this->createBasketTotalsWidget($stickyContainer);
        $this->createCouponWidget($stickyContainer);
        $this->createPlaceOrderWidget($stickyContainer);
        $this->createCancelPaymentWidget($stickyContainer);
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createBasketWidget($bgContainer)
    {
        $bgContainer->createChild("background", "Ceres::InlineTextWidget")
            ->withSetting("text", "<h2>{{ trans(\"Ceres::Template.checkoutBasket\") }}</h2>")
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.top.value", 0)
            ->withSetting("spacing.padding.top.unit", null)
            ->withSetting("spacing.padding.bottom.value", 0)
            ->withSetting("spacing.padding.bottom.unit", null)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null);

        $bgContainer->createChild("background", "Ceres::BasketWidget")
            ->withSetting("appearance", "primary")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("basketDetailsData", [""]);

    }

    /**
     * @param PresetWidgetFactory $stickyContainer
     */
    private function createCouponWidget($stickyContainer)
    {
        $stickyContainer->createChild("sticky", "Ceres::CouponWidget")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("appearance", "primary")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 3)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    /**
     * @param PresetWidgetFactory $stickyContainer
     */
    private function createBasketTotalsWidget($stickyContainer)
    {
        $stickyContainer->createChild("sticky", "Ceres::BasketTotalsWidget")
            ->withSetting(
                "visibleFields",
                [
                    "basketValueNet",
                    "basketValueGross",
                    "rebate",
                    "shippingCostsNet",
                    "shippingCostsGross",
                    "promotionCoupon",
                    "totalSumNet",
                    "vats",
                    "additionalCosts",
                    "totalSumGross",
                    "salesCoupon",
                    "openAmount"
                ]
            )
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 3)
            ->withSetting("spacing.margin.bottom.unit", null);
    }


    /**
     * @param PresetWidgetFactory $stickyContainer
     */
    private function createPlaceOrderWidget($stickyContainer)
    {
        $stickyContainer->createChild("sticky", "Ceres::PlaceOrderWidget");
    }

    /**
     * @param PresetWidgetFactory $stickyContainer
     */
    private function createCancelPaymentWidget($stickyContainer)
    {
        $stickyContainer->createChild("sticky", "Ceres::CancelPaymentWidget")
            ->withSetting("appearance", "primary");
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createAsterisk()
    {
        $text = "*)&nbsp;{{ trans(\"Ceres::Template.contactRequiredField\") }}";
        $this->preset->createWidget("Ceres::InlineTextWidget")
            ->withSetting("text", $text)
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.top.value", 2)
            ->withSetting("spacing.padding.top.unit", null)
            ->withSetting("spacing.padding.bottom.value", 2)
            ->withSetting("spacing.padding.bottom.unit", null)
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 0)
            ->withSetting("spacing.margin.top.unit", null);
    }

    private function createHeadline()
    {
        $text = "";
        $text .= "{% set overrideCheckoutHeadline = LayoutContainer.show(\"Ceres::Checkout.Headline\") %}";
        $text .= "{% if overrideCheckoutHeadline | trim is empty %}";
        $text .= "<h1>";
        $text .= "{% if not checkout.readOnly %}";
        $text .= "{{ trans(\"Ceres::Template.checkout\") }}";
        $text .= "{% else %}";
        $text .= "{{ trans(\"Ceres::Template.checkoutCheckOrder\") }}";
        $text .= "{% endif %}";
        $text .= "</h1>";
        $text .= "{% else %}";
        $text .= "{{ overrideCheckoutHeadline }}";
        $text .= "{% endif %}";

        $this->preset->createWidget("Ceres::InlineTextWidget")
            ->withSetting("text", $text)
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.top.value", 5)
            ->withSetting("spacing.margin.top.unit", null);
    }
}
