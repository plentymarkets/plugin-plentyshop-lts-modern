<?php

namespace plentyShopLTSModern\Hooks;

use Plenty\Console\Commands\GenerateShopBuilderPresetsEvent;
use Plenty\Modules\ShopBuilder\Contracts\ContentRepositoryContract;
use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Translation\Translator;

/**
 *
 * @package plentyShopLTSModern\Hooks
 */
class GenerateShopBuilderPresets
{
    private static $presetsData = [
        [
            "containerName" => "Ceres::Header",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultHeaderPreset",
            "type" => "header",
            "name" => "Widget.presetHeaderDefault"
        ],
        [
            "containerName" => "Ceres::Footer",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultFooterPreset",
            "type" => "footer",
            "name" => "Widget.presetFooterDefault"
        ],
        [
            "containerName" => "ShopBuilder::Category.0",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultSingleItemPreset",
            "type" => "singleitem",
            "name" => "Widget.presetSingleItemDefault"
        ],
        [
            "containerName" => "ShopBuilder::Category.0",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\ItemSetPreset",
            "type" => "itemset",
            "name" => "Widget.presetItemSetDefault"
        ],
        [
            "containerName" => "ShopBuilder::Category.0",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\ItemCategoryPreset",
            "type" => "categoryitem",
            "name" => "Widget.presetItemCategoryDefault"
        ],
        [
            "configKey" => "IO.routing.category_home",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultHomepagePreset",
            "type" => "content",
            "name" => "Widget.presetHomepageDefault"
        ],
        [
            "configKey" => "IO.routing.category_basket",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultBasketPreset",
            "type" => "content",
            "name" => "Widget.presetBasketDefault"
        ],
        [
            "configKey" => "IO.routing.category_checkout",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultCheckoutPreset",
            "type" => "checkout",
            "name" => "Widget.presetCheckoutDefault"
        ],
        [
            "configKey" => "IO.routing.category_my-account",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultMyAccountPreset",
            "type" => "myaccount",
            "name" => "Widget.presetMyAccountDefault"
        ],
        [
            "configKey" => "IO.routing.category_search",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\ItemSearchPreset",
            "type" => "itemsearch",
            "name" => "Widget.presetItemSearchDefault"
        ],
        [
            "configKey" => "IO.routing.category_login",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultLoginPreset",
            "type" => "content",
            "name" => "Widget.presetLoginDefault"
        ],
        [
            "configKey" => "IO.routing.category_register",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\RegistrationPreset",
            "type" => "content",
            "name" => "Widget.presetRegistration"
        ],
        [
            "configKey" => "IO.routing.category_confirmation-guest",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultOrderConfirmationPreset",
            "type" => "content",
            "name" => "Widget.presetOrderConfirmationDefault"
        ],
        [
            "configKey" => "IO.routing.category_cancellation-rights",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\Legal\\DefaultCancellationRightsPreset",
            "type" => "content",
            "name" => "Widget.presetCancellationRightsDefault"
        ],
        [
            "configKey" => "IO.routing.category_cancellation-form",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\Legal\\DefaultCancellationFormPreset",
            "type" => "content",
            "name" => "Widget.presetCancellationFormDefault"
        ],
        [
            "configKey" => "IO.routing.category_legal-disclosure",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\Legal\\DefaultLegalDisclosurePreset",
            "type" => "content",
            "name" => "Widget.presetLegalDisclosureDefault"
        ],
        [
            "configKey" => "IO.routing.category_privacy-policy",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\Legal\\DefaultPrivacyPolicyPreset",
            "type" => "content",
            "name" => "Widget.presetPrivacyPolicyDefault"
        ],
        [
            "configKey" => "IO.routing.category_gtc",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\Legal\\DefaultGTCPreset",
            "type" => "content",
            "name" => "Widget.presetGTCDefault"
        ],
        [
            "configKey" => "IO.routing.category_contact",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultContactPreset",
            "type" => "content",
            "name" => "Widget.presetContactDefault"
        ],
        [
            "configKey" => "IO.routing.category_wish-list",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\WishListPreset",
            "type" => "content",
            "name" => "Widget.presetWishList"
        ],
        [
            "configKey" => "IO.routing.category_change-mail",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultChangeMailPreset",
            "type" => "content",
            "name" => "Widget.presetChangeMailDefault"
        ],
        [
            "configKey" => "IO.routing.category_password-reset",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\ChangePasswordPreset",
            "type" => "content",
            "name" => "Widget.presetChangePassword"
        ],
        [
            "configKey" => "IO.routing.category_newsletter-opt-out",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultNewsletterUnsubscribePreset",
            "type" => "content",
            "name" => "Widget.presetNewsletterUnsubscribe"
        ],
        [
            "configKey" => "IO.routing.category_order-return",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\OrderReturnPreset",
            "type" => "content",
            "name" => "Widget.presetOrderReturn"
        ],
        [
            "configKey" => "IO.routing.category_page-not-found",
            "presetClass" => "plentyShopLTSModern\\Widgets\\Presets\\DefaultPageNotFoundPreset",
            "type" => "content",
            "name" => "Widget.presetPageNotFound"
        ]
    ];

    public function handle(GenerateShopBuilderPresetsEvent $event)
    {
        self::generatePresets($event);
        self::generatePresets($event, "en");
    }

    /**
     * @param GenerateShopBuilderPresetsEvent $event
     * @param String $lang
     */
    public static function generatePresets(GenerateShopBuilderPresetsEvent $event, string $lang = "de")
    {
        /** @var Translator $translator */
        $translator = pluginApp(Translator::class);
        /** @var ConfigRepository $config */
        $config = pluginApp(ConfigRepository::class);
        /** @var ContentRepositoryContract $contentRepository */
        $contentRepository = pluginApp(ContentRepositoryContract::class);

        foreach (self::$presetsData as $presetData) {
            $containerName = $presetData["containerName"];
            $categoryId = $config->get($presetData["configKey"]);

            if (!$containerName && $categoryId) {
                $containerName = "ShopBuilder::Category.$categoryId";
            }

            if ($containerName) {
                $data = [
                    "presetClass" => $presetData["presetClass"],
                    "dataProviderName" => "{$translator->trans("Ceres::{$presetData['name']}")} ({$translator->trans("plentyShopLTSModern::Widget.presetDefault")})",
                    "type" => $presetData["type"],
                    "link" => [
                        "containerName" => $containerName,
                        "pluginSetId" => $event->getPluginSet()->id,
                        "language" => $lang,
                        "active" => true
                    ]
                ];

                $contentRepository->createContent($event->getPluginSet()->id, $data, $lang);
            }
        }
    }
}
