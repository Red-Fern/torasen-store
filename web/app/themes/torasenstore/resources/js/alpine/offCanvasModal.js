export default () => ({
    showing: false,
    currentContent: null,
    init() {
        window.addEventListener('modal-open', (e) => {
            this.currentContent = e.detail.content;

            this.showing = true;
            document.body.classList.add('overflow-hidden');
        })
    },
    hide() {
        this.showing = false;
        document.body.classList.remove('overflow-hidden');
    }
})