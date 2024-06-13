let slideIndex = 0;

function showSlides() {
    const slides = document.querySelector('.slides');
    const totalSlides = slides.children.length;

    slides.style.transform = `translateX(${-slideIndex * 100}%)`;

    slideIndex = (slideIndex + 1) % totalSlides;
}

setInterval(showSlides, 3000); // Change slide every 3 seconds
