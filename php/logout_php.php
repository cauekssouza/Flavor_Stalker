<?php
session_start();

// destroi a sessao
session_destroy();

header("Location: ../index.php");
?>