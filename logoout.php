<?php
session_start(); //iniciamos a sess�o que foi aberta
session_destroy(); //pei!!! destruimos a sess�o ;)
session_unset(); //limpamos as variaveis globais das sess�es

echo "logoffok";
header("Location: index.php");
?>