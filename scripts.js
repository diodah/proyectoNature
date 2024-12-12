window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 100) {
        navbar.classList.add('shrink');
    } else {
        navbar.classList.remove('shrink');
    }
});

window.addEventListener('scroll', function() {
    const vines = document.querySelector('.vines');
    vines.style.transform = `translateY(${window.scrollY * 0.3}px)`; /* Efecto parallax para movimiento hacia arriba o abajo */
});

