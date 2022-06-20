<?php
include_once("seguridad.php");
session_unset();
session_destroy();
header("Location:index.html");


?>