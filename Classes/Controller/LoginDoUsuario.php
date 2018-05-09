<?php
/**
 * @project: librason
 * @name: Login do usuário
 * @description: realizar o Login do usuário e algumas verificações de cadastro
 * usando também a classe Login
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.3
 */
include_once '../../loader.php';

if(isset($_REQUEST['Logar'])){
    //Informações do Login
    $emailDoUsuario = $_REQUEST['Email-Formulario'];
    $senhaDoUsuario = $_REQUEST['Senha-Formulario'];
    
    //Utilizando classe Login para logar usuário
    $login = new Login($emailDoUsuario, $senhaDoUsuario);
    $login->logar();
}
