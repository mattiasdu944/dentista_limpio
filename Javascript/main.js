const navbar = document.getElementById('navbar');
window.addEventListener('scroll', function () {
    if (window.scrollY > 300) {
        navbar.classList.add('navbar-scrolled');
    }
    else {
        navbar.classList.remove('navbar-scrolled');
    }
});




// MOSTRART NAVBAR
const btnToggle= document.getElementById('nav-toggle');
btnToggle.addEventListener('click', () => {
    const navMenu = document.getElementById('nav-menu');
    navMenu.classList.add('navbar_menu_show');
});


// QUITAR NAVBAR CON LOS ENLACES Y EL BOTON
const navClose = document.getElementById('nav-close');
navClose.addEventListener('click', () => {
    const navMenu = document.getElementById('nav-menu');
    navMenu.classList.remove('navbar_menu_show');
});

const navLinks = document.querySelectorAll('.navbar_item_link');
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        const navMenu = document.getElementById('nav-menu');
        navMenu.classList.remove('navbar_menu_show');
    });
});

