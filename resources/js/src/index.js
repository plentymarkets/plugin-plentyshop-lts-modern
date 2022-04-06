import objectFitImages from "object-fit-images";
import PlentyShopLTSModern from "./plentyShopLTSModern";

document.addEventListener("DOMContentLoaded", () => {
    // Polyfill object-fit and object-position on images on IE9, IE10, IE11, Edge, Safari, ...
    objectFitImages();
    
    new PlentyShopLTSModern();
});
