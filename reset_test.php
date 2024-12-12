<?php
session_start();

// Eliminar todos los datos de la sesión
session_unset();
session_destroy();

// Redirigir al inicio del test
header("Location: index.html");
exit;
?>
