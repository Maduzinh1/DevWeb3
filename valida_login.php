<?php
if (!isset($_SESSION['idusuario'])) {
    header("Location: /DevWeb3/Login/index.html");
    exit();
}
?>