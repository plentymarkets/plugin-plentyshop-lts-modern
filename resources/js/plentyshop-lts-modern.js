const BG_TRANSPARENT_CLASS = "bg-transparent";

class PlentyShopLTSModern {
    topBarOffsetHeight = 0;
    bgTransparentElements = [];

    constructor() {
        document.addEventListener("DOMContentLoaded", () => this.init());
    }

    init() {
        // Polyfill object-fit and object-position on images on IE9, IE10, IE11, Edge, Safari, ...
        objectFitImages();

        this.getHeaderElementsAndHeights();

        // initial call
        this.updateHeaderBackgrounds();

        // add scroll listener for dynamic menu state
        document.addEventListener("scroll", () => this.updateHeaderBackgrounds());
    }

    /**
     * collect all top-bars, navbars and breadcrumbs, calculate their height and handle negative margin elements
     */
    getHeaderElementsAndHeights() {
        // TODO: document .negative-margin-top .bg-transparent
        // TODO: alle Widgets berücksichtigen

        this.bgTransparentElements = document.querySelectorAll("#page-header-parent > .bg-transparent:not(.unfixed)");

        const allheaderElements = document.querySelectorAll("#page-header-parent > *");
        // const fixedElements = allheaderElements.querySelectorAll(":not(.unfixed)");
        // const unfixedElements = allheaderElements.querySelectorAll(".unfixed");
        
        const negativeMarginElements = document.querySelectorAll(".negative-margin-top");
        const topBarElement = document.querySelector(".top-bar.unfixed");
        let allHeaderElementsHeight = 0;

        // set offset based on active header elements
        allheaderElements.forEach(element => allHeaderElementsHeight += element.offsetHeight);

        // add negative margin to specified element
        negativeMarginElements.forEach(element =>
            element.style.setProperty("margin-top", -Math.ceil(allHeaderElementsHeight) + "px", "important")
        );

        if (topBarElement) {
            this.topBarOffsetHeight = topBarElement.offsetHeight;
        }
    }

    /**
     * toggle the transparent class on the header elements
     */
    updateHeaderBackgrounds() {
        // TODO: statt topBaxrOffsetHeight die höhe der Elemente, die wegscrollen
        // TODO: wert renamen
        const wert = window.pageYOffset > this.topBarOffsetHeight;
        this.bgTransparentElements.forEach(element => element.classList.toggle(BG_TRANSPARENT_CLASS, wert));
    }
}

new PlentyShopLTSModern();
