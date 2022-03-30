<?php

namespace plentyShopLight\Containers;

use Plenty\Plugin\Templates\Twig;

class plentyShopLightStylesContainer
{
    public function call(Twig $twig):string
    {
        return $twig->render('plentyShopLight::content.plentyShopLightStyles');
    }
}