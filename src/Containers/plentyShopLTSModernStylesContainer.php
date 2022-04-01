<?php

namespace plentyShopLTSModern\Containers;

use Plenty\Plugin\Templates\Twig;

class plentyShopLTSModernStylesContainer
{
    public function call(Twig $twig):string
    {
        return $twig->render('plentyShopLTSModern::content.plentyShopLTSModernStyles');
    }
}