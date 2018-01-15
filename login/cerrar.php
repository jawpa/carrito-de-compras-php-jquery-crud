<?php
// comenzamos la sesión usuario
session_start();
// borramos la sesión usuario
unset($_SESSION['Usuario']);
// vamos a la página principal
header("Location: ../index.php");
?>