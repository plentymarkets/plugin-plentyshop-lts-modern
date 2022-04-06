class PlentyShopLTSModern {
    unfixedElementsHeight = 0;
    bgTransparentElements = [];

    constructor() {
        // Polyfill object-fit and object-position on images on IE9, IE10, IE11, Edge, Safari, ...
        objectFitImages();

        this.getHeaderElementsAndHeights();

        // add scroll listener for dynamic menu state
        document.addEventListener("scroll", () => this.updateHeaderBackgrounds());
    }

    /**
     * collect all top-bars, navbars and breadcrumbs, calculate their height and handle negative margin elements
     */
    getHeaderElementsAndHeights() {
        // TODO: document .negative-margin-top .bg-transparent
        this.bgTransparentElements = document.querySelectorAll("#page-header-parent > .bg-transparent:not(.unfixed)");

        const allheaderElements = document.querySelectorAll("#page-header-parent > *");
        const negativeMarginElements = document.querySelectorAll(".negative-margin-top");
        let allHeaderElementsHeight = 0;

        // set offset based on active header elements
        allheaderElements.forEach(element => allHeaderElementsHeight += element.offsetHeight);

        // add negative margin to specified element
        negativeMarginElements.forEach(element =>
            element.style.setProperty("margin-top", -Math.ceil(allHeaderElementsHeight) + "px", "important")
        );

        // collect element heights until a fixed element is found
        for (const element of allheaderElements) {
            if (!element.classList.contains("unfixed")) {
                // stop when the element is fixed
                break;
            }

            this.unfixedElementsHeight += element.offsetHeight;
        }

        // initial call
        this.updateHeaderBackgrounds();
    }

    /**
     * toggle the transparent class on the header elements
     */
    updateHeaderBackgrounds() {
        const hasUnfixedElementsPassed = window.pageYOffset > this.unfixedElementsHeight;
        this.bgTransparentElements.forEach(element => element.classList.toggle("bg-transparent", !hasUnfixedElementsPassed));
    }
}


document.addEventListener("DOMContentLoaded", () => { new PlentyShopLTSModern() });
