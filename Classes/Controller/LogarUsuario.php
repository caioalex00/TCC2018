<?php
include_once '../../loader.php';

if(isset($_REQUEST['Logar'])){
    //Informações do Login
    $emailDoUsuario = $_REQUEST['Email-Formulario'];
    $senhaDoUsuario = $_REQUEST['Senha-Formulario'];
    
    //Utilizando classe Login para logar usuário
    $login = new Login($emailDoUsuario, $senhaDoUsuario);
    $login->logar();
}
