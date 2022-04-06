# plentyShop LTS Modern – Das offizielle Theme-Plugin für plentyShop LTS

**plentyShop LTS Modern** ist das offizielle Theme-Plugin für den Standard-Webshop von plentymarkets. plentyShop LTS Modern ist kompatibel mit allen plentyShop LTS Versionen ab 5.0.48.

## plentyShop LTS Modern installieren

1. Lade das Plugin **plentyShop LTS Modern** im plentyMarketplace herunter.
2. Öffne im plentyMarkets-Backend das Menü **Plugins » Plugin-Set-Übersicht**.
3. Öffne das Plugin-Set, in dem du das Theme verwenden willst.
4. Klicke auf **Plugin hinzufügen**.
5. Gib "plentyShop LTS Modern" in die Suche ein oder wähle das Plugin aus der Liste.
6. Klicke auf **Installieren**.

Das Plugin wird installiert und ist nach dem nächsten **Bereitstellen** des Plugin-Sets aktiv.

**Wichtig:** Das Plugin **plentyShop LTS Modern** muss eine Priorität haben, die höher als die des Plugins **plentyShop LTS** und niedriger als die des Plugins **IO** ist. Du kannst Prioritäten zuweisen, indem du dein Plugin-Set öffnest und auf der linken Seite den Menüpunkt **Prioritäten festlegen** klickst. 

### Container-Verknüpfung

plentyShop LTS Modern verwendet CSS, das das normale CSS von plentyShops überschreibt. Dafür ist eien Container-Verknüpfung notwendig. Standardmäßig ist nach der Installation von plentyShop LTS Modern der richtige Container **Ceres::Template.StyleOverwrite** bereits verknüpft. 

Falls noch kein Container verknüpft ist, gehe wie folgt vor, um den richtigen Container zuzuweisen:

1. Öffne im plentyMarkets-Backend das Menü **Plugins » Plugin-Set-Übersicht**.
2. Öffne das Plugin-Set, in dem du das Theme verwendest.
3. Öffne das Plugin **plentyShop LTS Mordern** indem du darauf klickst.
4. Öffne das Tab **Container-Verknüpfungen**.
5. Wähle im Abschnitt **Container-Verknüpfungen** für die Einstellung **Data-Provider** die Option **plentyShop LTS Modern Styles**.
6. Wähle für die Einstellung **Plugin-Name** die Option **Ceres**.
7. Suche den Eintrag **Template.StyleOverwrite** in der Liste der Container und aktiviere die Checkbox.
8. **Speichere** deine Einstellungen.

## plentyShop LTS Modern einrichten

### Light- oder Dark-Theme wählen

**plentyShop LTS Modern** bietet dir 2 Styles für deinen plentyShop: Light und Dark. Das Light-Theme ist der vorausgewählte Standard und verwendet helle Farben und Hintergründe. Das Dark-Theme stellt den größten Teil der Shop-UI in dunklen Farben da. Probier aus, welcher Stil dir besser gefällt! 

Gehe wie folgt vor, um den Stil des Themes zu ändern:

1. Öffne im plentyMarkets-Backend das Menü **Plugins » Plugin-Set-Übersicht**.
2. Öffne das Plugin-Set, in dem du das Theme verwendest.
3. Öffne das Plugin **plentyShop LTS Mordern** indem du darauf klickst.
4. Die Design-Einstellungen des Plugins werden geöffnet.
5. Wähle für die Einstellung **Theme** entweder **Light** oder **Dark**.
6. **Speichere** die Einstellungen.

### Farbeinstellungen vornehmen

In **plentyShop LTS Modern** kannst du 6 Farben hinterlegen, auf die ShopBuilder-Widgets zugreifen können. Damit kannst du das Aussehen deines Shops nach Belieben individualisieren. Beachte, dass die Farben, die du in den Design-Einstellungen des ShopBuilders hinterlegt hast, durch **plentyShop LTS Modern** überschrieben werden.

Gehe wie folgt vor, um Farbeinstellungen vorzunehmen:

1. Öffne im plentyMarkets-Backend das Menü **Plugins » Plugin-Set-Übersicht**.
2. Öffne das Plugin-Set, in dem du das Theme verwendest.
3. Öffne das Plugin **plentyShop LTS Mordern** indem du darauf klickst.
4. Die Design-Einstellungen des Plugins werden geöffnet.
5. Gib für eine Farbe entweder einen HEX-Code ein oder klicke auf das farbige Kästchen, um die Farbauswahl zu öffnen.
6. Wiederhole diesen Vorgang für die verbleibenden Farben.
7. Speichere deine Einstellungen.

Die Farben werden nun von den ShopBuilder-Widgets deines Shops verwendet.

### Transparenz des Vorlagen-Headers

Wenn du plentyShop LTS Modern verwendest, stehen dir im ShopBuilder neue **Vorlagen** zur Verfügung.
In der Vorlage des Headers wurden die Header-Widgets Top Bar und Kategorienavigation mit der Custom CSS-Klasse **bg-transparent** ausgestattet. 

Dadurch sind diese Widgets zunächst transparent, sodass das darunterliegende Hintergrundbild sichtbar ist.
Erst wenn das unterste Widget, für das die Einstellung **Beim Scrollen der Seite fixieren** aktiv ist, beim Scrollen erreicht wird, wird der Header weiß gefärbt.

Wenn du willst, dass der Header immer weiß (bzw. schwarz im **Dark**-Theme) angezeigt wird, kannst du die Custom CSS-Klasse **bg-transparent** aus den Widget-Einstellungen der Header-Widgets entfernen und deine Änderungen speichern.

## Du willst dich an der Entwicklung von **plentyShop LTS Modern** beteiligen?

Wenn du das Open-Source-Projekt **plentyShop LTS Modern** unterstützen willst, indem du Bugfixes oder Features beisteuerst, findest du in unserem [Contribution Guide](https://github.com/plentymarkets/plugin-ceres/blob/stable/contributionGuide.md) Wege, dich mit uns in Verbindung zu setzen und eine Reihe von Richtlinien, auf die du bei der Entwicklung berücksichtigen solltest. Wir freuen uns auf deinen Beitrag!

## Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen findest du in der [LICENSE.md](https://github.com/plentymarkets/plugin-ceres/blob/stable/LICENSE.md).
