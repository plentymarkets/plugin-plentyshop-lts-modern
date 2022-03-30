<?php

namespace plentyShopLight\Widgets\Presets;

use Ceres\Config\CeresConfig;
use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use IO\Extensions\Filters\PatternFilter;
use IO\Helper\RouteConfig;
use IO\Helper\Utils;
use IO\Services\CategoryService;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;
use Plenty\Modules\Category\Models\Category;
use Plenty\Plugin\Translation\Translator;

/**
 * Class DefaultFooterPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a default footer. It contains:
 * - ThreeColumnWidget / TwoColumnWidget
 * - BackgroundWidget
 * - SeparatorWidget
 * - ListWidget
 * - LinkListWidget
 * - ThreeColumnWidget
 * - LegalInformationWidget
 * - CodeWidget
 * - CookieBarWidget
 *
 * @package plentyShopLight\Widgets\Presets
 */
class DefaultFooterPreset implements ContentPreset
{
    /** @var PresetHelper $preset */
    private $preset;

    /** @var CeresConfig $config */
    private $config;

    /** @var PatternFilter $patternFilter */
    private $patternFilter;

    /** @var CategoryService $categoryService */
    private $categoryService;

    /** @var Translator $translator */
    private $translator;

    /** @var string $lang */
    private $lang;

    private $gridDropzoneNames = [
        1 => "first",
        2 => "second",
        3 => "third"
    ];

    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->config = pluginApp(CeresConfig::class);
        $this->preset = pluginApp(PresetHelper::class);
        $this->patternFilter = pluginApp(PatternFilter::class);
        $this->categoryService = pluginApp(CategoryService::class);
        $this->translator = pluginApp(Translator::class);
        $this->lang = Utils::getLang();


        $row = $this->preset->createWidget("Ceres::TwoColumnWidget")
            ->withSetting("customClass", "mb-3 d-flex text-center")
            ->withSetting("layout", "stacked")
            ->withSetting("layoutTablet", "stackedTablet")
            ->withSetting("layoutMobile", "stackedMobile");

        // $this->createLinkListWidget($row);
        $this->createLinkListWidgetNew($row);
        $this->createTextWidget($row);
        $this->createCookieBar();

        return $this->preset->toArray();
    }

    private function createLinkListWidgetNew(PresetWidgetFactory $row)
    {
        // Overview of the 3 footer columns:

        /**
         * LEGAL
         * 
         * Terms & Conditions
         * Cancellation Rights
         * Legal Disclosure
         * Privacy Policy
         */

         /**
          * SERVICE 
          *
          * Contact
          * Cancellation Form
          * Returns
          * Shipping
          */

          /**
           * ENTERPRISE
           * 
           * About us
           * Career
           * Press
           * Blog
           */

        // grid - containing a grid with link lists and a text widget
        $linkListGrid = $row->createChild("first", "Ceres::ThreeColumnWidget")
            ->withSetting("customClass", "mt-4")
            ->withSetting("layout", "oneToOneToOne");

        $footerLinkColumns = [
            "first" => [
                "title" => $this->translator->trans("plentyShopLight::Widget.presetFooterLegal"),
                "entries" => $this->getLegalLinkEntries()
            ],
            "second" => [
                "title" => $this->translator->trans("plentyShopLight::Widget.presetFooterService"),
                "entries" => $this->getServiceLinkEntries()
            ],
            "third" => [
                "title" => $this->translator->trans("plentyShopLight::Widget.presetFooterEnterprise"),
                "entries" => $this->getEnterpriseLinkEntries()
            ]
        ];

        foreach ($footerLinkColumns as $dropzone => $footerLinks) {
            // create link list
             $linkList = $linkListGrid->createChild($dropzone, "Ceres::LinkListWidget")
                ->withSetting("customClass", "d-block d-lg-inline-block text-left")
                ->withSetting("title", $footerLinks["title"])
                ->withSetting("icon", "none")
                ->withSetting("centered", false)
                ->withSetting("entries", $footerLinks["entries"]);
        }
    }

    private function getLegalLinkEntries() {
        $legal = [
            [
                "text" => $this->translator->trans("Ceres::Template.termsAndConditions"),
                "categoryId" => RouteConfig::getCategoryId(RouteConfig::TERMS_CONDITIONS)
            ],
            [
                "text" => $this->translator->trans("Ceres::Template.cancellationRights", ["hyphen" => ""]),
                "categoryId" => RouteConfig::getCategoryId(RouteConfig::CANCELLATION_RIGHTS)
            ],
            [
                "text" => $this->translator->trans("Ceres::Template.legalDisclosure"),
                "categoryId" => RouteConfig::getCategoryId(RouteConfig::LEGAL_DISCLOSURE)
            ],
            [
                "text" => $this->translator->trans("Ceres::Template.privacyPolicy", ["hyphen" => ""]),
                "categoryId" => RouteConfig::getCategoryId(RouteConfig::PRIVACY_POLICY)
            ]
        ];

        $entries = [];

        foreach ($legal as $value) {
            if ($value["categoryId"] > 0) {
                $entries[] = [
                    "text" => $value["text"],
                    "rel" => "none",
                    "url" => [
                        "value" => $value["categoryId"],
                        "type" => "category",
                        "openInNewTab" => true
                    ]
                ];
            }
        }

        return $entries;
    }

    private function getServiceLinkEntries() {
        $service = [
            [
                "text" => $this->translator->trans("Ceres::Template.contact"),
                "categoryId" => RouteConfig::getCategoryId(RouteConfig::CONTACT)
            ],
            [
                "text" => $this->translator->trans("Ceres::Template.cancellationForm", ["hyphen" => ""]),
                "categoryId" => RouteConfig::getCategoryId(RouteConfig::CANCELLATION_FORM)
            ],
            [
                "text" => $this->translator->trans("Ceres::Template.return"),
                "categoryId" => RouteConfig::getCategoryId(RouteConfig::ORDER_RETURN)
            ],
            [
                "text" => $this->translator->trans("Ceres::Template.privacyPolicy", ["hyphen" => ""]),
                "categoryId" => RouteConfig::getCategoryId(RouteConfig::PRIVACY_POLICY)
            ]
        ];

        $entries = [];

        foreach ($service as $value) {
            if ($value["categoryId"] > 0) {
                $entries[] = [
                    "text" => $value["text"],
                    "rel" => "none",
                    "url" => [
                        "value" => $value["categoryId"],
                        "type" => "category",
                        "openInNewTab" => true
                    ]
                ];
            }
        }

        return $entries;
    }

    private function getEnterpriseLinkEntries() {
        $enterprise = [
            [
                "text" => $this->translator->trans("plentyShopLight::Widget.presetFooterAboutUs"),
                "urlDE" => "https://www.plentymarkets.com/de/unternehmen/",
                "urlEN" => "https://www.plentymarkets.com/company/"
            ],
            [
                "text" => $this->translator->trans("plentyShopLight::Widget.presetFooterCareer"),
                "urlDE" => "https://www.plentymarkets.com/de/karriere/",
                "urlEN" => "https://www.plentymarkets.com/careers/"
            ],
            [
                "text" => $this->translator->trans("plentyShopLight::Widget.presetFooterPress"),
                "urlDE" => "https://www.plentymarkets.com/de/presse/",
                "urlEN" => "https://www.plentymarkets.com/press/"
            ],
            [
                "text" => $this->translator->trans("plentyShopLight::Widget.presetFooterBlog"),
                "urlDE" => "https://www.plentymarkets.eu/blog/",
                "urlEN" => "https://www.plentymarkets.co.uk/blog/"
            ]
        ];

        $entries = [];

        foreach ($enterprise as $value) {
            $url = $value["urlDE"];
            if ($this->lang !== "de") {
                $url = $value["urlEN"];
            }

            $entries[] = [
                "text" => $value["text"],
                "rel" => "nofollow",
                "url" => [
                    "value" => $url,
                    "type" => "external",
                    "openInNewTab" => true
                ]
            ];
        }

        return $entries;
    }

    private function createLinkListWidget($row)
    {
        $configuredCategories = [
            1 => $this->config->footer->col1Categories,
            2 => $this->config->footer->col2Categories,
            3 => $this->config->footer->col3Categories
        ];

        $linkListGridPreset = $row->createChild("first", "Ceres::ThreeColumnWidget")
            ->withSetting("customClass", "mt-4");

        for ($i = 1; $i <= 3; $i++) {
            $columnTitleTranslation = $this->translator->trans("Ceres::Template.footerColumnTitle" . $i);
            $linkListPreset = $linkListGridPreset->createChild($this->gridDropzoneNames[$i], "Ceres::LinkListWidget")
                ->withSetting("customClass", "d-block d-lg-inline-block text-left")
                ->withSetting("title", $columnTitleTranslation)
                ->withSetting("icon", "none");

            $categoryIds = $this->patternFilter->findPattern($configuredCategories[$i], "[0-9]+");
            $entries = [];
            foreach ($categoryIds as $key => $categoryId) {
                $category = $this->categoryService->get($categoryId);

                if ($category instanceof Category && $category->details[0] !== null) {
                    $categoryName = $category->details[0]->name;
                    $categoryUrl = $this->categoryService->getURL($category);

                    $entries[] = [
                        "text" => $categoryName,
                        "url" => $categoryUrl
                    ];
                }
            }

            $linkListPreset->withSetting("entries", $entries);
            $linkListPreset->withSetting("centered", false);
        }
    }

    private function createTextWidget($row)
    {
        $defaultText = "
            <div class=\"text-center align-self-center mb-2\">
                <a href=\"https://www.instagram.com/plentysystems\" target=\"_blank\" class=\"fa fa-lg fa-instagram pl-2 px-1\"></a>
                <a href=\"https://www.facebook.com/plentymarkets/\" target=\"_blank\" class=\"fa fa-lg fa-facebook-f pl-2 px-1\"></a>
                <a href=\"https://twitter.com/plentymarkets\" target=\"_blank\" class=\"fa fa-lg fa-twitter pl-2 px-1\"></a>
            </div>
            <div class=\"copyright text-center\">
                <!--<a class=\"d-inline-block mb-2\" rel=\"nofollow\" href=\"https://www.plentymarkets.eu\">
                    <img alt=\"Plentymarkets GmbH Logo\" class=\"svg plenty-brand\" src=\"{{ plugin_path(\"Ceres\") }}/images/plentymarkets-logo.svg\" rel=\"nofollow\">
                </a>-->
                <small class=\"d-block\">&copy; Copyright {{ \"now\" | date(\"Y\") }} | {{ trans(\"Ceres::Template.footerAllRightsReserved\") }}</small>
            </div>
        ";

        $row->createChild("second", "Ceres::CodeWidget")
            ->withSetting("appearance", "none")
            ->withSetting("text", $defaultText);
    }

    private function createCookieBar()
    {
        $this->preset->createWidget("Ceres::CookieBarWidget")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("appearance", "primary")
            ->withSetting("buttonOrder", "1-2-3")
            ->withSetting("showRejectAll", true);
    }
}
