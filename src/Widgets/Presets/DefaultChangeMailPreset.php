<?php

namespace plentyShopLight\Widgets\Presets;

use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class DefaultChangeMailPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for changing the customer's email. It contains:
 * - ThreeColumnWidget
 * - InlineTextWidget
 * - ChangeMailWidget
 *
 * @package plentyShopLight\Widgets\Presets
 */
class DefaultChangeMailPreset implements ContentPreset
{
    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        /** @var PresetHelper */
        $preset = pluginApp(PresetHelper::class);

        /** @var PresetWidgetFactory $row */
        $row = $preset
            ->createWidget("Ceres::ThreeColumnWidget")
            ->withSetting("customClass", "my-5")
            ->withSetting("layout", "oneToTwoToOne");

        $row->createChild("second", "Ceres::InlineTextWidget")
            ->withSetting("text", "<h2>{{ trans(\"Ceres::Template.myAccountChangeEmail\") }}</h2><p>{{ trans(\"Ceres::Template.myAccountChangeEmailInfoText\") }}</p>")
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null);

        $row->createChild("second", "Ceres::ChangeMailWidget")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("appearance", "primary");

        return $preset->toArray();
    }
}
