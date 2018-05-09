<?php
/**
 * @project: librason
 * @name: CadastroDoUsuario
 * @description: realizar o cadastro do usuário e algumas verificações de cadastro
 * usando também a classe Cadastro
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.3
 */

include_once '../../loader.php';

//Inicia processo de cadastro caso botão de cadastro tenha sido pressionado
if(isset($_REQUEST['Cadastrar'])){
    //Informações do Usuário
    $nomeDoUsuario = $_REQUEST['Nome-Formulario'];
    $emailDoUsuario = $_REQUEST['Email-Formulario'];
    $senhaDoUsuario = $_REQUEST['Senha-Formulario'];
    $cadastro = new Cadastro($nomeDoUsuario, $emailDoUsuario, $senhaDoUsuario);
    
    //Vereficando se E-mail já foi cadastrado
    if($cadastro -> vereficarDisponibilidade()){
        
        //Vereficando se dados são validos
        $VereficarDados = $cadastro ->validarDados();
        if($VereficarDados == "ERROR-None"){
            //Realizando Cadastro
            $cadastro ->Cadastrar();
            //Redireciondo para pagina Inicial
            header("Location: ../View/Pagina_Inicial.php?SucessoNoCadastro");
        }else{
            header("Location: ../View/Pagina_Inicial.php?$VereficarDados");
        }
    }else{
        header("Location: ../View/Pagina_Inicial.php?ERROR-Email-1");
    }
}
//$cadastro ->realizarCadastro();