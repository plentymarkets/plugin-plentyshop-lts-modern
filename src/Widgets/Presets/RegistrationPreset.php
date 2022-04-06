<?php

namespace plentyShopLTSModern\Widgets\Presets;

use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class RegistrationPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for viewing the account registration. It contains:
 * - ThreeColumnWidget
 * - CodeWidget
 * - RegistrationWidget
 *
 * @package plentyShopLTSModern\Widgets\Presets
 */
class RegistrationPreset implements ContentPreset
{
    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        /** @var PresetHelper */
        $preset = pluginApp(PresetHelper::class);

        /** @var PresetWidgetFactory $row */
        $threeColumnWidget = $preset->createWidget("Ceres::ThreeColumnWidget")
                                    ->withSetting("layout", "oneToTwoToOne")
                                    ->withSetting("customClass", "my-5");

        $popper = "<div class=\"d-flex justify-content-between align-items-center\"><h2 class=\"d-inline m-0\">{{ trans(\"Ceres::Template.regRegisterAccount\") }}</h2><popper v-cloak class=\"float-right\" style=\"z-index:1;\"><template #handle><button class=\"btn btn-icon btn-secondary btn-sm\"><i class=\"fa fa-info\"></i></button></template><template #title>{{ trans(\"Ceres::Template.regContactInformations\") }}</template><template #content><ul class=\"pl-3\"><li class=\"mb-3\">{{ trans(\"Ceres::Template.regContactInfoText1\") }}</li><li class=\"mb-3\">{{ trans(\"Ceres::Template.regContactInfoText2\") }}</li><li class=\"mb-3\">{{ trans(\"Ceres::Template.regContactInfoText3\") }}</li><li>{{ trans(\"Ceres::Template.regContactInfoText4\") }}</li></ul></template></popper></div>";

        $threeColumnWidget->createChild("second", "Ceres::CodeWidget")
                          ->withSetting("text", $popper)
                          ->withSetting("appearance", "none")
                          ->withSetting("spacing.customPadding", true)
                          ->withSetting("spacing.padding.bottom.value", 2)
                          ->withSetting("spacing.padding.bottom.unit", null);

        $threeColumnWidget->createChild("second", "Ceres::RegistrationWidget")
                          ->withSetting("customClass", "widget-dark");

        return $preset->toArray();
    }
}
