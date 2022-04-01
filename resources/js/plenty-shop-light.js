document.addEventListener("DOMContentLoaded", () => {
    // TODO: check if  really required
    objectFitImages(); // Polyfill object-fit and object-position on images on IE9, IE10, IE11, Edge, Safari, ...

    document.querySelectorAll(".widget-image-carousel.action-button .carousel-item a").forEach((carouselItemElement) => {
        const itemLinkElementHref = carouselItemElement.getAttribute("href");
        const widgetCaptionLabelElement = carouselItemElement.querySelector(".widget-caption h2");
        const buttonElement = `<a href="${itemLinkElementHref}" class="btn btn-appearance">Shop now</a>`;

        widgetCaptionLabelElement.insertAdjacentHTML("beforebegin", buttonElement);
    });

    const topBarElements = document.querySelectorAll(".top-bar");
    const navbarElements = document.querySelectorAll(".navbar");
    const breadcrumbElements = document.querySelectorAll(".breadcrumbs");
    const negativeMarginElements = document.querySelectorAll(".negative-margin-top");
    const BG_TRANSPARENT_CLASS = "bg-transparent";
    let topBarElementOffsetHeight = 0;
    let navbarElementOffsetHeight = 0;
    let breadcrumbElementOffsetHeight = 0;

    // set offset based on active header elements
    topBarElements.forEach(element => topBarElementOffsetHeight += element.offsetHeight);
    navbarElements.forEach(element => navbarElementOffsetHeight += element.offsetHeight);
    breadcrumbElements.forEach(element => breadcrumbElementOffsetHeight += element.offsetHeight);

    // add negative margin to specified element
    if (negativeMarginElements.length) {
        let totalMarginTop = Math.ceil(topBarElementOffsetHeight + navbarElementOffsetHeight + breadcrumbElementOffsetHeight);
        negativeMarginElements.forEach(element =>
            element.style.setProperty("margin-top", -totalMarginTop + "px", "important")
        );
    }
    function updateHeaderBackgrounds() {
        if (window.pageYOffset > topBarElementOffsetHeight) {
            topBarElements.forEach(element => element.classList.remove(BG_TRANSPARENT_CLASS));
            navbarElements.forEach(element => element.classList.remove(BG_TRANSPARENT_CLASS));
            breadcrumbElements.forEach(element => element.classList.remove(BG_TRANSPARENT_CLASS));
        }
        else {
            topBarElements.forEach(element => element.classList.add(BG_TRANSPARENT_CLASS));
            navbarElements.forEach(element => element.classList.add(BG_TRANSPARENT_CLASS));
            breadcrumbElements.forEach(element => element.classList.add(BG_TRANSPARENT_CLASS));
        }
    }

    // initial call
    updateHeaderBackgrounds();

    // add scroll listener for dynamic menu state
    document.addEventListener("scroll", () => {
        updateHeaderBackgrounds();
    });
});
