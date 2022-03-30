<?php

namespace plentyShopLight\Widgets\Presets\Legal;

use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class DefaultCancellationFormPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for viewing the shop"s cancellation form. It contains:
 * - CodeWidget
 * - SeparatorWidget
 * - LegalTextsWidget
 * - PrintButtonWidget
 *
 * @package plentyShopLight\Widgets\Presets\Legal
 */
class DefaultCancellationFormPreset implements ContentPreset
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
        $text .= "<h1 class=\"print-header\">{{ trans(\"Ceres::Template.cancellationForm\", {\"hyphen\": \"&shy;\"}) }}</h1>";
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
        $twoColumnWidget = $this->preset->createWidget("Ceres::TwoColumnWidget")
            ->withSetting("customClass", "container mx-auto px-0 mb-5")
            ->withSetting("layout", "stacked")
            ->withSetting("layoutTablet", "stacked")
            ->withSetting("layoutMobile", "stackedMobile");
        $twoColumnWidget->createChild("first", "Ceres::LegalTextsWidget")
            ->withSetting("type", "cancellationForm")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 0)
            ->withSetting("spacing.margin.bottom.unit", null);

        $this->createPrintButtonWidget($twoColumnWidget);
    }

    private function createPrintButtonWidget($row)
    {
        $row->createChild("second", "Ceres::PrintButtonWidget")
            ->withSetting("customClass", "widget-dark text-right")
            ->withSetting("buttonSize", "md");
    }
}
