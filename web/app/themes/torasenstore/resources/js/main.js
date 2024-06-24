import './alpine';

document.querySelectorAll('.modal-button').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();

        const detail = {
            content: button.dataset.content
        }

        const event = new CustomEvent('modal-open', { detail: detail });

        window.dispatchEvent(event);
    })
})