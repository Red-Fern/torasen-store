import "./alpine";
import "./swiper";

document.querySelectorAll(".modal-button").forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();

        const detail = {
            content: button.dataset.content,
        };

        const event = new CustomEvent("modal-open", { detail: detail });

        window.dispatchEvent(event);
    });
});

document.querySelectorAll(".video-button").forEach((button) => {
    const video = button.parentElement.querySelector("video");

    if (video) {
        video.pause();

        button.addEventListener("click", () => {
            video.play();
            button.style.display = "none";
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const mainContent = document.querySelector(
        ".wp-block-group.woocommerce.product"
    );
    const scrollPrompt = document.querySelector(".scroll-prompt");

    if (!mainContent || !scrollPrompt) {
        console.error("Required elements not found");
        return;
    }

    let totalOffsetHeight = 0;

    const recalculateHeights = () => {
        const directChildrenDivs = Array.from(mainContent.children).filter(
            (div) => div.tagName === "DIV"
        );
        const firstThreeDivs = directChildrenDivs.slice(0, 3);
        totalOffsetHeight = firstThreeDivs.reduce(
            (total, div) => total + div.offsetHeight,
            0
        );
    };

    recalculateHeights();

    const onScroll = () => {
        if (window.scrollY > totalOffsetHeight) {
            scrollPrompt.classList.add("show");
        } else {
            scrollPrompt.classList.remove("show");
        }
    };

    window.addEventListener("scroll", onScroll);
    window.addEventListener("resize", () => {
        recalculateHeights();
        onScroll(); // Check if the class needs to be added or removed immediately after resize
    });
});
