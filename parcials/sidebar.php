<?php
    require_once("vendor/autoload.php");
?>
<head>
    <!-- <link rel="stylesheet" href="../Css/sidebar.css"> -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<!--=============== NAV ===============-->
<div class="nav" id="nav">
    <nav class="nav__content">
        <div class="nav__toggle" id="nav-toggle">
            <i class="uil uil-arrow-right"></i>
        </div>

          <div class="nav__logo">

            <img src="./assets/images/logo.png" width="20px" alt="imagen">
            <div class="nav_logo_user">

              <span class="nav__logo-name">
                <?=$_SESSION['usuario']?>
              </span>
              <br>
              <span class="nav__name">
                <?php
                if($_SESSION['rol'] == 1){
                  echo "Administrador";
                }else{
                  echo "Secretario";
                }
                ?>
            </span>
            <hr>
          </div>
            
        </div>
        <div class="nav__list">
            <a href="./admCitas.php" class="nav__link">
                <i class="uil uil-file-alt"></i>
                <span class="nav__name">Citas</span>
            </a>

            <a href="./admPaciente.php" class="nav__link">
                <i class="uil uil-users-alt"></i>
                <span class="nav__name">Lista de Pacientes</span>
            </a>

            <a href="./admConsultorio.php" class="nav__link">
                <i class="uil uil-building"></i>
                <span class="nav__name">Consultorios</span>
            </a>
            <a href="./admProcedimientos.php" class="nav__link">
              <i class="uil uil-medkit"></i>
                <span class="nav__name">Control de Serivcios</span>
            </a>

            <?php
            if($_SESSION['rol'] == 1){
              echo '<a href="./admUsuarios.php" class="nav__link">
              <i class="uil uil-users-alt"></i>
                <span class="nav__name">Usuarios</span>
              </a>';
            }
            ?>
            <!-- <a href="./admUsuarios.php" class="nav__link">
              <i class="uil uil-users-alt"></i>
              <span class="nav__name">Usuarios</span>
            </a> -->
        </div>
        <div class="nav__out">
          <hr>
            <a href="salir.php" class="nav__link">
              <i class="uil uil-signout"></i>
              <span class="nav__name">Salir</span>
            </a>
        </div>
    </nav>
</div>



<style>
    /*=============== GOOGLE FONTS ===============*/
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

/*=============== VARIABLES CSS ===============*/
:root {
  /*========== Colors ==========*/
  /*Color mode HSL(hue, saturation, lightness)*/
  --first-color: hsl(228, 81%, 49%);
  --title-color: hsl(228, 12%, 15%);
  --text-color: hsl(228, 8%, 50%);
  --body-color: hsl(228, 100%, 99%);
  --container-color: #fff;

  /*========== Font and typography ==========*/
  /*.5rem = 8px | 1rem = 16px ...*/
  --body-font: 'Poppins', sans-serif;
  --normal-font-size: .938rem;
}

/* Responsive typography */
@media screen and (min-width: 968px) {
  :root {
    --normal-font-size: 1rem;
  }
}

/*=============== BASE ===============*/
* {
  box-sizing: border-box;
  padding: 0;
  margin: 0;
}

body {
  position: relative;
  font-family: var(--body-font);
  font-size: var(--normal-font-size);
  background-color: var(--body-color);
  color: var(--text-color);
}

h1 {
  color: var(--title-color);
}

a {
  text-decoration: none;
}

i{
    display: flex;
}

/*=============== NAV ===============*/
.nav__content{
  display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.container {
  margin-left: auto;
  max-width: 85%;
}

.section {
  padding: 2rem 0;
}

@media screen and (max-width: 767px) {
  .nav__logo, 
  .nav__toggle, 
  .nav__name {
    display: none;
  }

  .nav__list {
    position: fixed;
    bottom: 2rem;
    background-color: var(--container-color);
    box-shadow: 0 8px 24px hsla(228, 81%, 24%, .15);
    width: 90%;
    padding: 30px 40px;
    border-radius: 1rem;
    left: 0;
    right: 0;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    column-gap: 36px;
    transition: .4s;
  }
}

.nav__link {
  display: flex;
  color: var(--text-color);
  font-weight: 500;
  transition: .3s;
}

.nav__link i {
  font-size: 1.25rem;
}

.nav__link:hover {
  color: var(--first-color);
}

/* Active link */
.active-link {
  color: var(--first-color);
}

.nav{
  z-index: 1;
}

/*=============== BREAKPOINTS ===============*/
/* For small devices */
@media screen and (max-width: 320px) {
  .nav__list {
    column-gap: 20px;
  }
}

/* For medium devices */
@media screen and (min-width: 576px) {
  .nav__list {
    width: 332px;
  }
}

@media screen and (min-width: 767px) {
  .container {
    margin-left: 7rem;
    margin-right: 1.5rem;
  }
  .nav {
    position: fixed;
    left: 0;
    background-color: var(--container-color);
    box-shadow: 1px 0 4px hsla(228, 81%, 49%, .15);
    width: 84px;
    height: 100vh;
    padding: 2rem;
    transition: .3s;
  }
  .nav__logo {
    display: flex;
  }
  .nav__logo i {
    font-size: 1.25rem;
    color: var(--first-color);
  }
  .nav__logo-name {
    color: var(--title-color);
    font-weight: 600;
  }
  .nav__logo, .nav__link {
    align-items: center;
    column-gap: 1rem;
  }
  .nav__list {
    display: grid;
    row-gap: 2.5rem;
  }
  .nav__content {
    overflow: hidden;
    height: 100%;
  }
  .nav__toggle {
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: var(--title-color);
    color: #fff;
    border-radius: 50%;
    font-size: 1.20rem;
    display: grid;
    place-items: center;
    top: 2rem;
    right: -10px;
    cursor: pointer;
    transition: .4s;
  }
}

/* Show menu */
.show-menu {
  width: 255px;
}

/* Rotate toggle icon */
.rotate-icon {
  transform: rotate(180deg);
}

/* For 2K & 4K resolutions */
@media screen and (min-width: 2048px) {
  body {
    zoom: 1.7;
  }
}

@media screen and (min-width: 3840px) {
  body {
    zoom: 2.5;
  }
}
</style>




<script>
    
/*=============== LINK ACTIVE ===============*/
// const linkColor = document.querySelectorAll('.nav__link')

// function colorLink(){
//     linkColor.forEach(l => l.classList.remove('active-link'))
//     this.classList.add('active-link')
// }

// linkColor.forEach(l => l.addEventListener('click', colorLink))

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