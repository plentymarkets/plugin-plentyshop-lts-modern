document.addEventListener("DOMContentLoaded", function() {

    // ToDO: Delete & integrate into ceres
    objectFitImages(); // Polyfill object-fit and object-position on images on IE9, IE10, IE11, Edge, Safari, ...

    // ToDO: Delete & integrate button into widget-image-carousel
    let widgetImageCarouselElements = document.querySelectorAll('.widget-image-carousel.action-button');
    for (let i = 0; i < widgetImageCarouselElements.length; i++) {
        let carouselItemElements = widgetImageCarouselElements[i].querySelectorAll('.carousel-item a');
        for (let j = 0; j < carouselItemElements.length; j++) {
            let itemLinkElementHref = carouselItemElements[j].getAttribute('href');
            let widgetCaptionElement = carouselItemElements[j].getElementsByClassName('widget-caption')[0];
            let widgetCaptionLabelElement = widgetCaptionElement.getElementsByTagName('h2')[0];
            let buttonElement = '<a href="' + itemLinkElementHref + '" class="btn btn-appearance">Shop now</a>';
            widgetCaptionLabelElement.insertAdjacentHTML('beforebegin', buttonElement);
        }
    }

    // ToDO: Delete & integrate into ceres
    let topBarElement = document.getElementsByClassName('top-bar');
    let navbarElement = document.getElementsByClassName('navbar');
    let breadcrumbElement = document.getElementsByClassName('breadcrumbs');
    let negativeMarginElements = document.getElementsByClassName('negative-margin-top');
    let topBarElementOffsetHeight = 0;
    let navbarElementOffsetHeight = 0;
    let breadcrumbElementOffsetHeight = 0;
    const bgTransparentClass = "bg-transparent";

    // set offset based on active header elements
    if (topBarElement.length) topBarElementOffsetHeight = topBarElement[0].offsetHeight;
    if (navbarElement.length)  navbarElementOffsetHeight = navbarElement[0].offsetHeight;
    if (breadcrumbElement.length)  breadcrumbElementOffsetHeight = breadcrumbElement[0].offsetHeight;

    // add negative margin to specified element
    if (negativeMarginElements.length) {
        let totalMarginTop = Math.ceil(topBarElementOffsetHeight + navbarElementOffsetHeight + breadcrumbElementOffsetHeight);
        negativeMarginElements[0].style.setProperty('margin-top', (totalMarginTop * -1) + 'px', 'important');
    }
    function updateHeaderBackgrounds() {
        if (window.pageYOffset > topBarElementOffsetHeight) {
            if (topBarElement.length) topBarElement[0].classList.remove(bgTransparentClass);
            if (navbarElement.length) navbarElement[0].classList.remove(bgTransparentClass);
            if (breadcrumbElement.length) breadcrumbElement[0].classList.remove(bgTransparentClass);
        }
        else {
            if (topBarElement.length) topBarElement[0].classList.add(bgTransparentClass);
            if (navbarElement.length) navbarElement[0].classList.add(bgTransparentClass);
            if (breadcrumbElement.length) breadcrumbElement[0].classList.add(bgTransparentClass);
        }
    }
    updateHeaderBackgrounds(); // init
    // add scroll listener for dynamic menu state
    document.addEventListener('scroll', function(e) {
        updateHeaderBackgrounds();
    });
});
