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

        // Focus the search input if the modal is shown
        if (this.showing) {
            this.$nextTick(() => {
                const searchInput = document.querySelector('#woocommerce-product-search-field');

                if (searchInput) {
                    searchInput.focus();
                }
            });
        }
    },
    hide() {
        this.showing = false;
        document.querySelector('body').classList.remove('overflow-hidden');
    }
})