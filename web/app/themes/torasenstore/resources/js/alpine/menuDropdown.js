export default (hasItems = false) => ({
    showing: true,
    hasItems: hasItems,
    init() {
        this.showing = this.isDesktop();

        window.addEventListener('resize', () => {
            this.checkVisible();
        })
    },
    toggle(e) {
        if (!this.isDesktop()) {
            if (this.hasItems) {
                e.preventDefault();
            }

            this.showing = !this.showing;
        }
    },
    checkVisible() {
        if (this.isDesktop()) {
            return this.showing = true;
        }

        this.showing = false;
    },
    isDesktop() {
        return window.innerWidth > 1023;
    }
})