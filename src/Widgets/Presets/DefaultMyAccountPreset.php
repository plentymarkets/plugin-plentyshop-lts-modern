<?php

namespace plentyShopLTSModern\Widgets\Presets;

use Ceres\Config\CeresConfig;
use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class DefaultMyAccountPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page where customers can view and interact with their contact data, orders, and returns. It contains:
 * - TwoColumnWidget
 * - BackgroundWidget
 * - SeparatorWidget
 * - GreetingWidget
 * - AddressWidget
 * - LogoutButtonWidget
 * - AccountSettingsWidget
 * - BankDataSelectWidget
 * - OrderHistoryWidget
 * - OrderReturnHistoryWidget
 * - InlineTextWidget
 *
 * @package plentyShopLTSModern\Widgets\Presets
 */
class DefaultMyAccountPreset implements ContentPreset
{
    /** @var PresetHelper */
    private $preset;

    /** @var CeresConfig */
    private $ceresConfig;

    /** @var PresetWidgetFactory */
    private $twoColumnWidgetTop;

    /** @var PresetWidgetFactory */
    private $twoColumnWidgetAddresses;

    /** @var PresetWidgetFactory */
    private $twoColumnWidgetAccountSettings;

    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->preset = pluginApp(PresetHelper::class);
        $this->ceresConfig = pluginApp(CeresConfig::class);

        $this->createHeadline();

        $this->createTwoColumnWidgetAddresses();
        $this->createAddressWidget("1");
        $this->createAddressWidget("2");

        $this->createTwoColumnWidgetAccountSettings();
        $this->createAccountSettingsWidget();
        $this->createBankDataSelectWidget();

        $this->createOrderHistoryWidget();
        $this->createOrderReturnHistoryWidget();

        return $this->preset->toArray();
    }

    private function createHeadline()
    {
        $this->createTwoColumnWidgetTop();

        $this->twoColumnWidgetTop->createChild("first", "Ceres::InlineTextWidget")
            ->withSetting("text", "<h1>{{ trans(\"Ceres::Template.myAccount\") }}</h1>")
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null);

        $this->createGreetingWidget();
        $this->createLogoutButtonWidget();
    }

    private function createGreetingWidget()
    {
        $this->twoColumnWidgetTop->createChild("first", "Ceres::GreetingWidget")
            ->withSetting("salutation", "firstname_surname");
    }

    private function createLogoutButtonWidget()
    {
        $this->twoColumnWidgetTop->createChild("second", "Ceres::LogoutButtonWidget");
    }

    private function createAddressWidget($type = "1")
    {
        if ($type == "1") {
            $this->twoColumnWidgetAddresses->createChild("first", "Ceres::AddressWidget")->withSetting("addressType", $type)
                ->withSetting("customClass", "widget-transparent")
                ->withSetting("addressFieldsInvoiceDE", $this->ceresConfig->addresses->billingAddressShow)
                ->withSetting("addressRequiredFieldsInvoiceDE", $this->ceresConfig->addresses->billingAddressRequire)
                ->withSetting("addressFieldsInvoiceGB", $this->ceresConfig->addresses->billingAddressShow_en)
                ->withSetting("addressRequiredFieldsInvoiceGB", $this->ceresConfig->addresses->billingAddressRequire_en)
                ->withSetting("hintText", "<h2>{{ trans(\"Ceres::Template.myAccountInvoiceAddresses\") }}</h2>");
        } elseif ($type == "2") {
            $this->twoColumnWidgetAddresses->createChild("second", "Ceres::AddressWidget")->withSetting("addressType", $type)
                ->withSetting("customClass", "widget-transparent")
                ->withSetting("addressFieldsShippingDE", $this->ceresConfig->addresses->deliveryAddressShow)
                ->withSetting("addressRequiredFieldsShippingDE", $this->ceresConfig->addresses->deliveryAddressRequire)
                ->withSetting("addressFieldsShippingGB", $this->ceresConfig->addresses->deliveryAddressShow_en)
                ->withSetting("addressRequiredFieldsShippingGB", $this->ceresConfig->addresses->deliveryAddressRequire_en)
                ->withSetting("hintText", "<h2>{{ trans(\"Ceres::Template.myAccountShippingAddresses\") }}</h2>");
        }
    }

    private function createAccountSettingsWidget()
    {
        $this->twoColumnWidgetAccountSettings->createChild("first", "Ceres::AccountSettingsWidget")
            ->withSetting("appearance", "primary")
            ->withSetting("customClass", "widget-transparent")
            ->withSetting("text", "<h2>{{ trans(\"Ceres::Template.myAccountChangePaymentInformation\") }}</h2>
                <p>{{ trans(\"Ceres::Template.myAccountChangePaymentInformation\") }}</p>");
    }

    private function createBankDataSelectWidget()
    {
        $this->twoColumnWidgetAccountSettings->createChild("second", "Ceres::BankDataSelectWidget")
            ->withSetting("appearance", "primary")
            ->withSetting("customClass", "widget-transparent")
            ->withSetting("text", "<h2>{{ trans(\"Ceres::Template.myAccountBankDetails\") }}</h2>
                <p>{{ trans(\"Ceres::Template.myAccountChangePaymentInformation\") }}</p>");
    }

    private function createOrderHistoryWidget()
    {
        $this->preset->createWidget("Ceres::OrderHistoryWidget")
            ->withSetting("appearance", "primary")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("ordersPerPage", $this->ceresConfig->myAccount->ordersPerPage)
            ->withSetting("allowPaymentProviderChange", $this->ceresConfig->myAccount->changePayment)
            ->withSetting("allowReturn", $this->ceresConfig->myAccount->orderReturnActive)
            ->withSetting("hintText", "<h2>{{ trans(\"Ceres::Template.orderHistory\") }}</h2>")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 5)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function createOrderReturnHistoryWidget()
    {
        $this->preset->createWidget("Ceres::OrderReturnHistoryWidget")
            ->withSetting("appearance", "primary")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("returnsPerPage", 5)
            ->withSetting("hintText", "<h2>{{ trans(\"Ceres::Template.returnHistory\") }}</h2>")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 5)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function createTwoColumnWidgetTop()
    {
        $this->twoColumnWidgetTop = $this->preset->createWidget("Ceres::TwoColumnWidget")
        ->withSetting("customClass", "mt-5 mb-4")
        ->withSetting("layout", "nineToThree");
    }

    private function createTwoColumnWidgetAddresses()
    {
        $this->twoColumnWidgetAddresses = $this->preset->createWidget("Ceres::TwoColumnWidget")
            ->withSetting("layout", "oneToOne")
            ->withSetting("customClass", "mb-4");
    }

    private function createTwoColumnWidgetAccountSettings()
    {
        $this->twoColumnWidgetAccountSettings = $this->preset->createWidget("Ceres::TwoColumnWidget")
            ->withSetting("layout", "oneToOne")
            ->withSetting("customClass", "mb-2");
    }
}
