<?php

namespace plentyShopLTSModern\Widgets\Presets;

use Ceres\Widgets\Helper\PresetHelper;
use plentyShopLTSModern\Widgets\Presets\Helper\HasWhiteBackground;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class OrderReturnPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for viewing the order return form. It contains:
 * - InlineTextWidget
 * - OrderReturnWidget
 *
 * @package plentyShopLTSModern\Widgets\Presets
 */
class OrderReturnPreset implements ContentPreset
{
    /** @var PresetHelper */
    private $preset;

    use HasWhiteBackground;

    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->preset = pluginApp(PresetHelper::class);

        $this->preset->createWidget("Ceres::InlineTextWidget")
            ->withSetting("text", "<h1>{{ trans(\"Ceres::Template.return\") }}</h1>")
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.top.value", 5)
            ->withSetting("spacing.margin.top.unit", null)
            ->withSetting("spacing.margin.bottom.value", 3)
            ->withSetting("spacing.margin.bottom.unit", null);

        $this->preset->createWidget("Ceres::OrderReturnWidget")
            ->withSetting("appearance", "primary")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("itemDetailsData", ["availability"])
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.right.value", 0)
            ->withSetting("spacing.margin.right.unit", null)
            ->withSetting("spacing.margin.left.value", 0)
            ->withSetting("spacing.margin.left.unit", null)
            ->withSetting("spacing.margin.bottom.value", 5)
            ->withSetting("spacing.margin.bottom.unit", null);

        return $this->preset->toArray();
    }
}
