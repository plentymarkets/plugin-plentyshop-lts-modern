<?php

namespace plentyShopLTSModern\Widgets\Presets;

use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class DefaultNewsletterUnsubscribePreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for unsubscribing the customer from a newsletter. It contains:
 * - ThreeColumnWidget
 * - InlineTextWidget
 * - NewsletterUnsubscribeWidget
 *
 * @package plentyShopLTSModern\Widgets\Presets
 */
class DefaultNewsletterUnsubscribePreset implements ContentPreset
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
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null)
            ->withSetting("text", "<h2>{{ trans(\"Ceres::Template.newsletterOptOutTitle\") }}</h2><p>{{ trans(\"Ceres::Template.newsletterOptOutInfoText\") }}</p>");

        $row->createChild("second", "Ceres::NewsletterUnsubscribeWidget")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("appearance", "primary");

        return $preset->toArray();
    }
}
