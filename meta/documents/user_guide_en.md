# plentyShop LTS Modern – The official theme plugin for plentyShop LTS

**plentyShop LTS Modern** is the official theme plugin for the default online shop of plentymarkets. plentyShop LTS Modern is compatible with plentyShop LTS versions 5.0.48 and higher.

## Installing plentyShop LTS Modern

1. Download the plugin **plentyShop LTS Modern** from the plentyMarketplace.
2. Open the **Plugins » Plugin set overview** menu in your plentymarkets backend.
3. Open the plugin set into which you want to integrate the theme plugin.
4. Click on **Add plugin**.
5. Enter "plentyShop LTS Modern" into the search bar or select the plugin from the list of plugins.
6. Click on **Install**.

The plugin is installed and will be available in your plugin set after publishing the plugin set again.

**Important:** You need to assign a priority to the **plentyShop LTS Modern** plugin that is *higher* than the priority of **plentyShop LTS** and lower than the priority of the plugin **IO**. You can set priorities by opening the plugin set and clicking on the tab **Set priorities**. 

### Container links

plentyShop LTS Modern uses CSS which replaces the usual CSS of plentyShops. For this, the theme uses a container link. Take the following steps to link the plentyShop LTS Modern styles:

1. Open the **Plugins » Plugin set overview** menu in your plentymarkets backend.
2. Open the plugin set in which you use the theme.
3. Open the plugin **plentyShop LTS Modern** by clicking on it.
4. Open the tab **Container links**.
5. In the section **Default container links**, select all options.
6. **Save** your changes.

## Setting up plentyShop LTS Modern

### Selecting light or dark theme

**plentyShop LTS Modern** offers 2 different styles: light and dark. The light theme is preselected and uses lighter colours and backgrounds for your shop. The dark theme displays the major part of the UI in darker colours. Try the different versions and decide which you like better!

Take the following steps to change the style of the theme:

1. Open the **Plugins » Plugin set overview** menu in your plentymarkets backend.
2. Open the plugin set in which you use the theme.
3. Open the plugin **plentyShop LTS Modern** by clicking on it.
4. The design settings of the plugin are opened.
5. Select the option **Light** or **Dark** for the **Theme** setting.
6. **Save** your changes.

### Carrying out colour settings

You can define 6 colours in the **plentyShop LTS Modern** plugin, which are used by ShopBuilder widgets. That way, you can customise the design of your shop according to your needs. Please note that the colour settings in the plugin override the colour settings that you can carry out in the design settings of the ShopBuilder.

Take the following steps to change the colours of your plentyShop:

1. Open the **Plugins » Plugin set overview** menu in your plentymarkets backend.
2. Open the plugin set in which you use the theme.
3. Open the plugin **plentyShop LTS Modern** by clicking on it.
4. The design settings of the plugin are opened.
5. Either enter a HEX value or click on the coloured box to open a colour picker.
6. Repeat this process for the remaining colours.
7. **Save** your changes.
8. **Deploy** the plugin set to effect the changes.

After **deploying** the plugin set, the colours are used by the ShopBuilder widgets of your shop.

### Transparency of the preset header

If you use plentyShop LTS Modern, new **presets** are available in the ShopBuilder.
In the header preset, the header widgets **Top Bar** and **Category navigation** have been equipped with the custom CSS class **bg-transparent**. 

This means that these widgets are initially transparent, so that the background image underneath is visible.
Only when the bottom-most widget, for which the setting **Fix when scrolling the page** is active, is reached during scrolling, the header is coloured white.

If you want the header to always be white (or black in the **Dark** theme), you can remove the custom CSS class **bg-transparent** from the widget settings of the header widgets and save your changes.

## You want to contribute to the **plentyShop LTS Modern** project?

If you want to help develop the **plentyShop LTS Modern** theme plugin, either by contributing bugfixes or features, our [Contribution Guide](https://github.com/plentymarkets/plugin-ceres/blob/stable/contributionGuide.md) provides ways of contacting our team as well as a number of guidelines you should kep in mind while developing for **plentyShop LTS Modern**. We're looking forward to your contribution.

## License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE. – find further information in the [LICENSE.md](https://github.com/plentymarkets/plugin-ceres/blob/stable/LICENSE.md).
