export default () => ({
    menuOpen: true,
    init() {
        this.menuOpen = this.isDesktop();

        window.addEventListener('resize', () => {
            this.checkVisible()
        })
    },
    toggle() {
        if (!this.isDesktop()) {
            this.menuOpen = !this.menuOpen;

            document.querySelector('body').classList.toggle('overflow-hidden');
        }
    },
    checkVisible() {
        if (this.isDesktop()) {
            return this.menuOpen = true;
        }

        this.menuOpen = false;

        document.querySelector('body').classList.remove('overflow-hidden');
    },
    isDesktop() {
        return window.innerWidth > 1023;
    }
})