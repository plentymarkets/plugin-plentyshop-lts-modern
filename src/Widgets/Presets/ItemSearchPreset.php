<?php

namespace plentyShopLTSModern\Widgets\Presets;

use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class ItemSearchPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for viewing item search results. It contains:
 * - ThreeColumnWidget
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
 * - ItemGridWidget
 *
 * @package plentyShopLTSModern\Widgets\Presets
 */
class ItemSearchPreset implements ContentPreset
{
    /** @var PresetHelper */
    private $preset;

    /** @var PresetWidgetFactory */
    private $toolbarWidget;

    /** @var PresetWidgetFactory */
    private $threeColumnWidget;

    /** @var PresetWidgetFactory */
    private $twoColumnWidget;

    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->preset = pluginApp(PresetHelper::class);

        $this->createTwoColumnWidget();
        $this->createSearchStringCodeWidget();

        $this->createToolbarWidget();
        $this->createItemSortingWidget();
        $this->createItemsPerPageWidget();

        $this->createAttributesPropertiesCharacteristicsFilterWidget();
        $this->createManufacturerFilterWidget();
        $this->createRatingFilterWidget();
        $this->createAvailabilityFilterWidget();
        $this->createPriceFilterWidget();
        $this->createCategoryFilterWidget();

        $this->selectedFilterWidget();
        $this->createItemGridWidget();
        $this->paginationWidget();

        $this->createNoResultCodeWidget();

        return $this->preset->toArray();
    }

    private function createTwoColumnWidget()
    {
        $this->twoColumnWidget = $this->preset->createWidget("Ceres::TwoColumnWidget")
            ->withSetting("layout", "oneToOne")
            ->withSetting("layoutTablet", "stackedTablet")
            ->withSetting("layoutMobile", "stackedMobile")
            ->withSetting("customClass", "mt-5 mb-3");
    }
    private function createSearchStringCodeWidget()
    {
        // DO NOT CHANGE INDENTATION
        // Leading whitespaces will be displayed in code editor of the shopbuilder
        $this->twoColumnWidget->createChild("first", "Ceres::CodeWidget")
            ->withSetting(
                "text",
                '{% if category is empty and searchString is empty %}
                {% set searchString = trans("Ceres::Template.itemSearchSearchTerm") %}
                {% set itemCountTotal = 20 %}
            {% endif %}
            <div class="row">
                <div class="col-12">
                    <h1>
                        {% if isTag %}
                            {{ trans("Ceres::Template.tagSearchResults", {"searchString": searchString}) }}
                        {% elseif itemCountTotal > 0 and suggestionString | length > 0 %}
                            <p class="text-muted">{{ trans("Ceres::Template.itemSearchNoResults", {"searchString": searchString}) }}</p>
                            <p>
                                {% autoescape false %}
                                    {% set suggestionStringHtml -%}
                                        <a href="{{ queryString({query: suggestionString }) }}">{{ suggestionString }}</a>
                                    {%- endset %}
                                    {{ trans("Ceres::Template.itemSearchDidYouMean", {"suggestionString": suggestionStringHtml }) }}
                                {% endautoescape %}
                            </p>
                        {% elseif itemCountTotal > 0 %}
                            {{ trans("Ceres::Template.itemSearchResults") }} {{ searchString }}
                        {% endif %}
                    </h1>
                </div>
            </div>'
            );
    }

    private function createNoResultCodeWidget()
    {
        // DO NOT CHANGE INDENTATION
        // Leading whitespaces will be displayed in code editor of the shopbuilder
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
                {% set categoryName = category.details[0].name %}
                {% set categoryDescription = category.details[0].description %}
                {% set categoryDescription2 = category.details[0].description2 %}
            {% else %}
               {% set categoryName = trans("Ceres::Widget.backgroundPreviewTextCategoryName") %}
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

        $this->preset->createWidget("Ceres::CodeWidget")
            ->withSetting(
                "text",
                '{% if itemCountTotal <= 0 %}
                {% if category is empty and searchString is empty %}{% set searchString = trans("Ceres::Template.itemSearchSearchTerm") %}{% endif %}
                <p class="h4 text-muted text-center">{{ trans("Ceres::Template.itemSearchNoResults", {"searchString": searchString}) }}</p>
            {% endif%}'
            )
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 5)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function createToolbarWidget()
    {
        $this->toolbarWidget = $this->twoColumnWidget->createChild("second", "Ceres::ToolbarWidget")
            ->withSetting("customClass", "text-right widget-dark")
            ->withSetting("outline", true);
    }

    private function createItemSortingWidget()
    {
        $this->toolbarWidget->createChild("toolbar", "Ceres::ItemSortingWidget")
            ->withSetting("itemSortOptions", ["texts.name1_asc", "texts.name1_desc", "sorting.price.avg_asc", "sorting.price.avg_desc"]);
    }

    private function createItemsPerPageWidget()
    {
        $this->toolbarWidget->createChild("toolbar", "Ceres::ItemsPerPageWidget");
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
            ->withSetting("alignment", "right")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 3)
            ->withSetting("spacing.margin.bottom.unit", null);
    }

    private function paginationWidget()
    {
        $this->preset->createWidget("Ceres::PaginationWidget")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("alignment", "center");
    }

    private function createItemGridWidget()
    {
        $this->preset->createWidget("Ceres::ItemGridWidget")
            ->withSetting("numberOfColumns", 4)
            ->withSetting("customClass", "widget-dark")
            ->withSetting("outline", true)
            ->withSetting("noVat", true);
    }
}
