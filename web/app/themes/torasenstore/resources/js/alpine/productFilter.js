export default () => ({
    showing: false,
    init() {
        this.showing = !this.isMobile();

        window.addEventListener('resize', () => {
            this.checkVisible()
        })
    },
    toggle() {
        this.showing = !this.showing;

        if (this.isMobile()) {
            document.querySelector('body').classList.toggle('overflow-hidden');
        }
    },
    hide() {
        this.showing = false;

        document.querySelector('body').classList.remove('overflow-hidden');
    },
    checkVisible() {
        if (!this.isMobile()) {
            return this.showing = true;
        }

        this.showing = false;

        document.querySelector('body').classList.remove('overflow-hidden');
    },
    isMobile() {
        return window.innerWidth < 782;
    }
})