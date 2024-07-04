import './alpine';
import './swiper';

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

document.querySelectorAll('.video-button').forEach(button => {
    const video = button.parentElement.querySelector('video');
            
    if (video) {
        video.pause();

        button.addEventListener('click', () => {
            video.play();
            button.style.display = "none";
        });
    }
})