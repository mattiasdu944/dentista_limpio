<head>
    <link rel="stylesheet" href="../Css/sidebar.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<!--=============== NAV ===============-->
<div class="nav" id="nav">
    <nav class="nav__content">
        <div class="nav__toggle" id="nav-toggle">
            <i class="uil uil-arrow-right"></i>
        </div>

        <a href="#" class="nav__logo">
            <img src="../src/images/logo.png" width="20px" alt="">
            <span class="nav__logo-name">Dentista</span>
        </a>

        <div class="nav__list">
            <a href="#" class="nav__link active-link">
                <i class="uil uil-file-alt"></i>
                <span class="nav__name">Citas</span>
            </a>

            <a href="#" class="nav__link">
                <i class="uil uil-users-alt"></i>
                <span class="nav__name">Lista de Pacientes</span>
            </a>

            <a href="#" class="nav__link">
                <i class="uil uil-building"></i>
                <span class="nav__name">Consultorios</span>
            </a>
        </div>
    </nav>
</div>

<script>
    
/*=============== LINK ACTIVE ===============*/
const linkColor = document.querySelectorAll('.nav__link')

function colorLink(){
    linkColor.forEach(l => l.classList.remove('active-link'))
    this.classList.add('active-link')
}

linkColor.forEach(l => l.addEventListener('click', colorLink))

/*=============== SHOW HIDDEN MENU ===============*/
const showMenu = (toggleId, navbarId) =>{
    const toggle = document.getElementById(toggleId),
    navbar = document.getElementById(navbarId)

    if(toggle && navbar){
        toggle.addEventListener('click', ()=>{
            /* Show menu */
            navbar.classList.toggle('show-menu')
            /* Rotate toggle icon */
            toggle.classList.toggle('rotate-icon')
        })
    }
}
showMenu('nav-toggle','nav')
</script>