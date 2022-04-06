const BG_TRANSPARENT_CLASS = "bg-transparent";

class PlentyShopLTSModern {
    headerElements = [];
    negativeMarginElements = [];
    topBarOffsetHeight = 0;

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
        // TODO: this.headerElements = document.querySelectorAll("#page-header-parent > .bg-transparent");
        this.headerElements = document.querySelectorAll(".top-bar, .navbar, .breadcrumbs");
        this.negativeMarginElements = document.querySelectorAll(".negative-margin-top");
        this.topBarOffsetHeight = 0;
        const topBarElement = document.querySelector(".top-bar.unfixed");
        let headerElementOffsetHeight = 0;

        // set offset based on active header elements
        this.headerElements.forEach(element => headerElementOffsetHeight += element.offsetHeight);
        headerElementOffsetHeight = Math.ceil(headerElementOffsetHeight);

        if (topBarElement) {
            this.topBarOffsetHeight = topBarElement.offsetHeight;
        }

        // add negative margin to specified element
        this.negativeMarginElements.forEach(element =>
            element.style.setProperty("margin-top", -headerElementOffsetHeight + "px", "important")
        );
    }

    /**
     * toggle the transparent class on the header elements
     */
    updateHeaderBackgrounds() {
        // TODO: statt topBarOffsetHeight die höhe der Elemente, die wegscrollen
        // TODO: nur auf Elementen ausführen, die schon die Klasse haben
        if (window.pageYOffset > this.topBarOffsetHeight) {
            this.headerElements.forEach(element => element.classList.remove(BG_TRANSPARENT_CLASS));
        }
        else {
            this.headerElements.forEach(element => element.classList.add(BG_TRANSPARENT_CLASS));
        }
    }
}

new PlentyShopLTSModern();
