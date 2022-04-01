const BG_TRANSPARENT_CLASS = "bg-transparent";

class PlentyShopLTSModern {
    headerElements = [];
    negativeMarginElements = [];
    topBarOffsetHeight = 0;

    constructor() {
        document.addEventListener("DOMContentLoaded", () => this.init());
    }

    init() {
        // TODO: check if  really required
        // Polyfill object-fit and object-position on images on IE9, IE10, IE11, Edge, Safari, ...
        objectFitImages();

        // TODO: do we keep this?
        this.createImageCarouselButton();

        this.getHeaderElementsAndHeights();

        // initial call
        this.updateHeaderBackgrounds();

        // add scroll listener for dynamic menu state
        document.addEventListener("scroll", () => this.updateHeaderBackgrounds());
    }

    /**
     * create a 'shop now' button for each image carousel widget
     */
    createImageCarouselButton() {
        document.querySelectorAll(".widget-image-carousel.action-button .carousel-item a").forEach((carouselItemElement) => {
            const itemLinkElementHref = carouselItemElement.getAttribute("href");
            const widgetCaptionLabelElement = carouselItemElement.querySelector(".widget-caption h2");
            const buttonElement = `<a href="${itemLinkElementHref}" class="btn btn-appearance">Shop now</a>`;
    
            widgetCaptionLabelElement.insertAdjacentHTML("beforebegin", buttonElement);
        });
    }

    /**
     * collect all top-bars, navbars and breadcrumbs, calculate their height and handle negative margin elements
     */
    getHeaderElementsAndHeights() {
        this.headerElements = document.querySelectorAll(".top-bar, .navbar, .breadcrumbs");
        this.negativeMarginElements = document.querySelectorAll(".negative-margin-top");
        this.topBarOffsetHeight = 0;
        const topBarElement = document.querySelector(".top-bar");
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
        if (window.pageYOffset > this.topBarOffsetHeight) {
            this.headerElements.forEach(element => element.classList.remove(BG_TRANSPARENT_CLASS));
        }
        else {
            this.headerElements.forEach(element => element.classList.add(BG_TRANSPARENT_CLASS));
        }
    }
}

new PlentyShopLTSModern();
