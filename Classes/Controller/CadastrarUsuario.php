<?php
/**
 * @project: librason
 * @name: CadastrarUsuario
 * @description: realizar o cadastro do usuário e algumas verificações de cadastro
 * usando também a classe Cadastro
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.4
 */
include_once '../../loader.php';

//Inicia processo de cadastro caso botão de cadastro do Aluno tenha sido pressionado
if(isset($_REQUEST['Cadastrar-A'])){
    
    //Coletando Informações para o Cdastro do Aluno
    $nomeCompleto = $_REQUEST['Nome-Formulario'];
    $email = $_REQUEST['Email-Formulario'];
    $senha = $_REQUEST['Senha-Formulario'];
    $senhaComfirmacao = $_REQUEST['ComSenha-Formulario'];
    $fotoDePerfil = $_FILES['Foto-Formulario'];
    $turma = $_REQUEST['Turma-Formulario'];
    
    // Instanciando Objeto Cadastro para cadastrar Aluno no Sistema
    $cadastro = new Cadastro();
    $cadastro -> cadastroAluno($nomeCompleto, $email, $senha, $senhaComfirmacao, $fotoDePerfil, $turma);
}

//Inicia processo de cadastro caso botão de cadastro do Aluno tenha sido pressionado
if(isset($_REQUEST['Cadastrar-P'])){
    
    //Coletando Informações para o Cadastro do Professor
    $nomeCompleto = $_REQUEST['Nome-Formulario'];
    $email = $_REQUEST['Email-Formulario'];
    $senha = $_REQUEST['Senha-Formulario'];
    $senhaComfirmacao = $_REQUEST['ComSenha-Formulario'];
    $fotoDePerfil = $_FILES['Foto-Formulario'];
    
    // Instanciando Objeto Cadastro para cadastrar Professor no Sistema
    $cadastro = new Cadastro();
    $cadastro -> cadastroProfessor($nomeCompleto, $email, $senha, $senhaComfirmacao, $fotoDePerfil);
}