export default (hasItems = false, showOnDesktop = false) => ({
    showing: false,
    hasItems: hasItems,
    showOnDesktop: showOnDesktop,
    init() {
        if (this.isDesktop()) {
            return this.showing = showOnDesktop;
        }

        window.addEventListener('resize', () => {
            this.checkVisible();
        })
    },
    toggle(e) {
        if (this.isDesktop() && this.showOnDesktop) {
            return;
        }

        if (this.hasItems) {
            e.preventDefault();

            this.showing = !this.showing;
        }
    },
    checkVisible() {
        if (this.isDesktop()) {
            return this.showing = showOnDesktop;
        }
    },
    isDesktop() {
        return window.innerWidth > 1023;
    }
})