<?php
//Conexão com o banco de dados     
try {
    $username = 'root';
    $password = '';
    $pdo = new PDO('mysql:host=localhost;dbname=tcc2018', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    //Gera Erro
    echo 'Erro na conexão: ' . $ex->getMessage();
}