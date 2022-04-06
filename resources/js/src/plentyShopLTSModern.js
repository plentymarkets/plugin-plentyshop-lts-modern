export default class PlentyShopLTSModern {
    constructor() {
        this.headerHeight = 0;
        this.unfixedElementsHeight = 0;
        this.headerElements = [];
        this.unfixedHeaderElements = [];
        this.negativeMarginElements = [];

        this.getElements();

        this.calculateHeight();

        this.setNegativeMargin();

        this.updateHeaderBackgrounds();

        document.addEventListener("scroll", this.updateHeaderBackgrounds.bind(this));
    }

    getElements() {
        this.headerElements = [...document.querySelectorAll("#page-header-parent > *")];
        this.unfixedHeaderElements = [...document.querySelectorAll("#page-header-parent > .bg-transparent:not(.unfixed)")];
        this.negativeMarginElements = [...document.querySelectorAll(".negative-margin-top")];
    }

    calculateHeight() {
        let firstUnfixed = false;
        this.headerElements.forEach(element => {
            this.headerHeight += element.offsetHeight;

            if(element.classList.contains("unfixed")){
                firstUnfixed = true
            }

            if(!firstUnfixed){
                this.unfixedElementsHeight += element.offsetHeight;
            }
        })
    }

    setNegativeMargin() {
        this.negativeMarginElements.forEach((element) =>
            element.style.setProperty("margin-top", `${-this.headerHeight}px`, "important")
        );
    }

    updateHeaderBackgrounds() {
        const hasUnfixedElementsPassed = window.pageYOffset > this.unfixedElementsHeight;

        this.unfixedHeaderElements.forEach((element) =>
            element.classList.toggle("bg-transparent", !hasUnfixedElementsPassed)
        );
    }
}
