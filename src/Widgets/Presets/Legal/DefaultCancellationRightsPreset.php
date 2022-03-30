<?php

namespace plentyShopLight\Widgets\Presets\Legal;

use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class DefaultCancellationRightsPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for viewing the shop"s cancellation policy. It contains:
 * - CodeWidget
 * - SeparatorWidget
 * - LegalTextsWidget
 *
 * @package plentyShopLight\Widgets\Presets\Legal
 */
class DefaultCancellationRightsPreset implements ContentPreset
{
    /** @var PresetHelper $preset */
    private $preset;

    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->preset = pluginApp(PresetHelper::class);

        $this->createHeadline();
        $this->createLegalTextsWidget();

        return $this->preset->toArray();
    }

    private function createHeadline()
    {
        $text = "";
        $text .= "{% autoescape false %}";
        $text .= "<h1 class=\"print-header\">{{ trans(\"Ceres::Template.cancellationRights\", {\"hyphen\": \"&shy;\"}) }}</h1>";
        $text .= "{% endautoescape %}";

        $this->preset->createWidget("Ceres::CodeWidget")
            ->withSetting("customClass", "container mx-auto")
            ->withSetting("text", $text)
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.top.value", 5)
            ->withSetting("spacing.margin.top.unit", null)
            ->withSetting("spacing.margin.bottom.value", 4)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function createLegalTextsWidget()
    {
        $this->preset->createWidget("Ceres::LegalTextsWidget")
        ->withSetting("type", "cancellationRights")
        ->withSetting("customClass", "container")
        ->withSetting("spacing.customMargin", true)
        ->withSetting("spacing.margin.bottom.value", 5)
        ->withSetting("spacing.margin.bottom.unit", null);
    }
}
