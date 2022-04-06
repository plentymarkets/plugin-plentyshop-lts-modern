<?php

namespace plentyShopLTSModern\Widgets\Presets;

use Ceres\Config\CeresConfig;
use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class ItemCategoryPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for viewing item categories. It contains:
 * - ThreeColumnWidget
 * - BackgroundWidget
 * - InlineTextWidget
 * - CodeWidget
 * - ToolbarWidget
 * - ItemSortingWidget
 * - ItemsPerPageWidget
 * - AttributesPropertiesCharacteristicsFilterWidget
 * - PriceFilterWidget
 * - AvailabilityFilterWidget
 * - ManufacturerFilterWidget
 * - SelectedFilterWidget
 * - PaginationWidget
 * - TwoColumnWidget
 * - NavigationTreeWidget
 * - ItemGridWidget
 *
 * @package plentyShopLTSModern\Widgets\Presets
 */
class ItemCategoryPreset implements ContentPreset
{
    /** @var CeresConfig */
    private $ceresConfig;

    /** @var bool */
    private $showNavigationTree = false;

    /** @var PresetHelper */
    private $preset;

    /** @var threeColumnWidget */
    private $threeColumnWidget;

    /** @var PresetWidgetFactory */
    private $toolbarWidget;

    /** @var firstTwoColumnWidget */
    private $firstTwoColumnWidget;

    /** @var PresetWidgetFactory */
    private $twoColumnWidget;

    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->ceresConfig        = pluginApp(CeresConfig::class);
        $this->showNavigationTree = $this->ceresConfig->header->showNavBars == "side" || $this->ceresConfig->header->showNavBars == "both";

        $this->preset = pluginApp(PresetHelper::class);

        $this->createFirstTwoColumnWidget();
        $this->createInlineTextWidget();
        $this->createToolbarWidget();

        $this->createItemSortingWidget();
        $this->createItemsPerPageWidget();
        $this->createThreeColumnWidget();

        $this->createAttributesPropertiesCharacteristicsFilterWidget();
        $this->createManufacturerFilterWidget();
        $this->createRatingFilterWidget();
        $this->createAvailabilityFilterWidget();
        $this->createPriceFilterWidget();
        $this->createCategoryFilterWidget();

        $this->selectedFilterWidget();


        if ($this->showNavigationTree) {
            $this->createTwoColumnWidget();
            $this->createNavigationTreeWidget();
        }

        $this->createItemGridWidget();
        $this->paginationWidget();
        $this->createCodeWidgets();

        return $this->preset->toArray();
    }

    private function createFirstTwoColumnWidget()
    {
        $this->firstTwoColumnWidget = $this->preset->createWidget("Ceres::TwoColumnWidget")
            ->withSetting("layout", "fiveToSeven")
            ->withSetting("layoutTablet", "stackedTablet")
            ->withSetting("layoutMobile", "stackedMobile")
            ->withSetting("customClass", "mt-5 mb-3");
    }
    private function createCodeWidgets()
    {
        $twoColumnWidget = $this->preset->createWidget("Ceres::TwoColumnWidget")
            ->withSetting("customClass", "mb-5")
            ->withSetting("layout", "stacked")
            ->withSetting("layoutTablet", "stacked")
            ->withSetting("layoutMobile", "stackedMobile");

        $twoColumnWidget->createChild("first", "Ceres::CodeWidget")
            ->withSetting(
                "text",
                "{% if category is not empty %}
            <p class=\"mb-0\">{{ trans(\"Ceres::Template.singleItemFootnote1\") }} {% if services.customer.showNetPrices() %}{{ trans(\"Ceres::Template.singleItemExclVAT\") }}{% else %}{{ trans(\"Ceres::Template.singleItemInclVAT\") }}{% endif %} {{ trans(\"Ceres::Template.singleItemExclusive\") }} <a {% if ceresConfig.global.shippingCostsCategoryId > 0 %} data-toggle=\"modal\" href=\"#shippingscosts\"{% endif %} title=\"{{ trans(\"Ceres::Template.singleItemShippingCosts\") }}\">{{ trans(\"Ceres::Template.singleItemShippingCosts\") }}</a></p>
            {% endif %}"
            );
        $twoColumnWidget->createChild("second", "Ceres::CodeWidget")
            ->withSetting(
                "text",
                '{% if category is not empty %}
            {% set categoryDescription = category.details[0].description %}
            {% set categoryDescription2 = category.details[0].description2 %}
        {% else %}
           {% set categoryDescription = trans("Ceres::Widget.backgroundPreviewTextCategoryDescription") ~ " 1" %}
           {% set categoryDescription2 = trans("Ceres::Widget.backgroundPreviewTextCategoryDescription") ~ " 2" %}
        {% endif %}

        {% set descriptionSetting = ceresConfig.item.showCategoryDescriptionBottom %}
        {% if descriptionSetting == "both" %}
             <div class="category-description mb-3">{{ categoryDescription | raw }}</div>
             <div class="category-description mb-3">{{ categoryDescription2 | raw }}</div>
        {% else %}
            <div class="category-description mb-3">{% if descriptionSetting == "description1" %}{{ categoryDescription | raw }}{% elseif descriptionSetting == "description2" %}{{ categoryDescription2 | raw }}{% endif %}</div>
        {% endif %}'
            );
    }

    private function createInlineTextWidget()
    {
        $this->firstTwoColumnWidget->createChild("first", "Ceres::CodeWidget")
            ->withSetting(
                "text",
                '{% if category is not empty %}
                {% set categoryName = category.details[0].name %}
                {% set categoryDescription = category.details[0].description %}
                {% set categoryDescription2 = category.details[0].description2 %}
            {% else %}
                {% set categoryName = trans("Ceres::Widget.backgroundPreviewTextCategoryName") %}
                {% set categoryDescription = trans("Ceres::Widget.backgroundPreviewTextCategoryDescription") ~ " 1" %}
                {% set categoryDescription2 = trans("Ceres::Widget.backgroundPreviewTextCategoryDescription") ~ " 2" %}
            {% endif %}
            {% set descriptionSetting = ceresConfig.item.showCategoryDescriptionTop %}<h1 class="category-title">{{ categoryName }}</h1>
            {% if descriptionSetting == "both" %}
                <p class="category-description">{{ categoryDescription | raw }}</p>
                <p class="category-description">{{ categoryDescription2 | raw }}</p>
            {% else %}
                <p class="category-description">{% if descriptionSetting == "description1" %}{{ categoryDescription | raw }}{% elseif descriptionSetting == "description2" %}{{ categoryDescription2 | raw }}{% endif %}</p>
            {% endif %}'
            );
    }

    private function createToolbarWidget()
    {
        $innerFirstTwoColumnWidget = $this->firstTwoColumnWidget->createChild("second", "Ceres::ToolbarWidget")
            ->withSetting("layout", "oneToTwo")
            ->withSetting("layoutTablet", "oneToTwo")
            ->withSetting("layoutMobile", "stackedMobile");

        $this->toolbarWidget = $innerFirstTwoColumnWidget->createChild("second", "Ceres::ToolbarWidget")
            ->withSetting("customClass", "text-right widget-dark")
            ->withSetting("outline", true)
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 4)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function createItemSortingWidget()
    {
        $this->toolbarWidget->createChild("toolbar", "Ceres::ItemSortingWidget")
            ->withSetting(
                "itemSortOptions",
                [
                    "texts.name1_asc",
                    "texts.name1_desc",
                    "sorting.price.avg_asc",
                    "sorting.price.avg_desc"
                ]
            );
    }

    private function createItemsPerPageWidget()
    {
        $this->toolbarWidget->createChild("toolbar", "Ceres::ItemsPerPageWidget")
            ->withSetting("entries", [
                ["text" => "20"],
                ["text" => "40"],
                ["text" => "100"]
            ]);
    }

    private function createThreeColumnWidget()
    {
        $this->threeColumnWidget = $this->toolbarWidget->createChild("collapsable", "Ceres::ThreeColumnWidget")
            ->withSetting("layout", "oneToOneToOne");
    }

    private function createAttributesPropertiesCharacteristicsFilterWidget()
    {
        $this->toolbarWidget->createChild("collapsable", "Ceres::AttributesPropertiesCharacteristicsFilterWidget");
    }
    private function createPriceFilterWidget()
    {
        $this->toolbarWidget->createChild("collapsable", "Ceres::PriceFilterWidget")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 4)
            ->withSetting("spacing.margin.bottom.unit", null);
    }
    private function createAvailabilityFilterWidget()
    {
        $this->toolbarWidget->createChild("collapsable", "Ceres::AvailabilityFilterWidget");
    }
    private function createManufacturerFilterWidget()
    {
        $this->toolbarWidget->createChild("collapsable", "Ceres::ManufacturerFilterWidget");
    }
    private function createRatingFilterWidget()
    {
        $this->toolbarWidget->createChild("collapsable", "Feedback::RatingFilterWidget");
    }
    private function createCategoryFilterWidget()
    {
        $this->toolbarWidget->createChild("collapsable", "Ceres::CategoryFilterWidget");
    }

    private function selectedFilterWidget()
    {
        $this->preset->createWidget("Ceres::SelectedFilterWidget")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("appearance", "primary")
            ->withSetting("alignment", "left");
    }

    private function paginationWidget()
    {
        $this->preset->createWidget("Ceres::PaginationWidget")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("alignment", "center")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.top.value", 0)
            ->withSetting("spacing.margin.top.unit", null)
            ->withSetting("spacing.margin.bottom.value", 0)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function createTwoColumnWidget()
    {
        $this->twoColumnWidget = $this->preset->createWidget("Ceres::TwoColumnWidget")
            ->withSetting("layout", "threeToNine")
            ->withSetting("layoutTablet", "stackedTablet")
            ->withSetting("layoutMobile", "stackedMobile");
    }

    private function createNavigationTreeWidget()
    {
        $this->twoColumnWidget->createChild("first", "Ceres::NavigationTreeWidget")
            ->withSetting("expandableChildren", true)
            ->withSetting("showItemCount", true);
    }

    private function createItemGridWidget()
    {
        if ($this->showNavigationTree) {
            $this->twoColumnWidget->createChild("second", "Ceres::ItemGridWidget")
                ->withSetting("customClass", "widget-dark item-border")
                ->withSetting("outline", true)
                ->withSetting("noVat", true)
                ->withSetting("numberOfColumnsDesktop", 3)
                ->withSetting("numberOfColumnsTablet", 2)
                ->withSetting("numberOfColumnsMobile", 1)
                ->withSetting("spacing.customMargin", true)
                ->withSetting("spacing.margin.bottom.value", 0)
                ->withSetting("spacing.margin.bottom.unit", null);
        } else {
            $this->preset->createWidget("Ceres::ItemGridWidget")
                ->withSetting("customClass", "widget-dark item-border")
                ->withSetting("outline", true)
                ->withSetting("noVat", true)
                ->withSetting("numberOfColumnsDesktop", 4)
                ->withSetting("numberOfColumnsTablet", 3)
                ->withSetting("numberOfColumnsMobile", 1)
                ->withSetting("spacing.customMargin", true)
                ->withSetting("spacing.margin.bottom.value", 0)
                ->withSetting("spacing.margin.bottom.unit", null);
        }
    }
}
