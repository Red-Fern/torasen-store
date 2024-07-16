export default () => ({
    showing: false,
    init() {
        window.addEventListener('resize', () => {
            this.hide();
        })
    },
    toggle() {
        this.showing = !this.showing;

        document.querySelector('body').classList.toggle('overflow-hidden');
    },
    hide() {
        this.showing = false;
        document.querySelector('body').classList.remove('overflow-hidden');
    }
})