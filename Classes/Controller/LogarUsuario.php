<?php
/**
 * @project: librason
 * @name: LogarUsuario
 * @description: realiza o login do sistema
 * @copyright (c) 09/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.5
 */

include_once '../../loader.php';

//Execulta o codigo caso o usuário pressione o botão de login
if(isset($_REQUEST['Logar'])){
    //Informações do Login
    $emailDoUsuario = $_REQUEST['Email-Formulario'];
    $senhaDoUsuario = $_REQUEST['Senha-Formulario'];
    
    //Utilizando classe Login para logar usuário
    $login = new Login($emailDoUsuario, $senhaDoUsuario);
    $login->logar();
}
