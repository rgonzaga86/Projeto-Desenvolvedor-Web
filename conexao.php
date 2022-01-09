<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$bd = "bdprojeto";

try{
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);
} catch(PDOException $e){
    echo $e->getMessage();
}
