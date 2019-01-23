<?php
require_once '../../loader.php';

if(isset($_SESSION['Nivel_User'])){
echo '<script> window.location.href = "../../index.php";</script>';
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Librason - Pagina Inicial</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../../favicon.ico" type="image/x-icon"/>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap-4.1.0-dist/css/bootstrap.css">
        <!-- Pessoal CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/media_Style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light Borda-Bottom-Cor2">
            <section class="container">

                <a href="Pagina_Inicial.php" class="navbar-brand h1 mb-0">
                    <img class="Logo-Nav" src="imgs/logotipo.png" alt="Lbrason Logotipo"/>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#MenuPaginaPrincipal" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="MenuPaginaPrincipal">

                    <ul class="navbar-nav ml-auto Persona-Link Persona-Link-Cor1">

                        <li class="nav-item">
                            <a href="" class="nav-link Persona-Link-Cor1">Inicio</a>
                        </li>
                        
                        <li class="nav-item">
                            <button type="button" class="btn btn-adpt-link" data-toggle="modal" data-target="#ModalDeLogin">Login</button>
                        </li>

                        <li class="nav-item">
                            <button type="button" class="btn btn-adpt-link" data-toggle="modal" data-target="#ModalDeCadastro">Cadastro</button>
                        </li>

                    </ul>
                </div>
            </section>
        </nav>
        
        <section id="CarouselPrincipal" class="carousel slide Borda-Bottom-Cor2 " data-ride="carousel">
            
            <ol class="carousel-indicators">
                <li data-target="#CarouselPrincipal" data-slide-to="0" class="active"></li>
                <li data-target="#CarouselPrincipal" data-slide-to="1"></li>
                <li data-target="#CarouselPrincipal" data-slide-to="2"></li>
            </ol>
        
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fluid d-block" src="imgs/carosel/1.png">
                </div>

                <div class="carousel-item">
                    <img class="img-fluid d-block" src="imgs/carosel/2.png">
                </div>

                <div class="carousel-item">
                    <img class="img-fluid d-block" src="imgs/carosel/3.png">
                </div>
            </div>

            <a class="carousel-control-prev" href="#CarouselPrincipal" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>

            <a class="carousel-control-next" href="#CarouselPrincipal" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Proximo</span>
            </a>
        
        </section>
        
        <section class="jumbotron Objetivo">
            <h1 class="display-2 Objetivo-Titulo">NOSSO OBJETIVO</h1>
            <section class="row">
                <figure class="col-md-6 Objetivo-Imagem">
                    <img src="imgs/Libras_2.png" alt=""/>
                </figure>
                <article class="col-md-6 lead Objetivo-Texto">
                    O Librason tem como objetivo apresentar ao usuário o surdo e sua língua. Para realizar isso todo conteúdo do site e direcionado a apresentar a cultura surda e o mesmo vem integrado a um AVA (Ambiente virtual de aprendizagem) para realizar a introdução a 2° língua oficial do Brasi: a LIBRAS (Língua brasileira de sinais) e incentivar que os usuários busquem se aprofundar na mesma. Como objetivo final, esperamos oportunizar a interação entre os ouvintes e a comunidade surda.
                </article>
            </section>
        </section>
        
        <section id="Sessao-Funcionalidades" class="jumbotron">
            <h3 class="display-4 Alinhar-Centro">O QUE OFERECEMOS</h3>
            
            <section class="Funcionalidades-Grupos row">
                
                <div class="card col-md-4 persona-card-inicio">
                    <img class="card-img-top" src="imgs/Cards/card1.png" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text h1 Alinhar-Centro">Conhecimento</p>
                        <p class="card-text texto-card-persona lead">A busca pelo conhecimento é algo necessário. No Librason você encontra diversas informações sobre os surdos. Aqui as informações possuem fontes seguras como artigos científicos e livros, garantindo uma confiabilidade do que é lido. </p>
                    </div>
                </div>
                
                <div class="card col-md-4 persona-card-inicio">
                    <img class="card-img-top" src="imgs/Cards/card2.png" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text h1 Alinhar-Centro">Aprendizado</p>
                        <p class="card-text texto-card-persona lead">Um ambiente virtual de aprendizagem (AVA) vem integrado ao nosso website, nele é possível realizar um curso de introdução a Língua Brasileira de Sinais, a libras é a segunda língua oficial do Brasil, sendo usada para comunicação pela comunidade surda. </p>
                    </div>
                </div>
                
                <div class="card col-md-4 persona-card-inicio">
                    <img class="card-img-top" src="imgs/Cards/card3.png" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text h1 Alinhar-Centro">Inclusão</p>
                        <p class="card-text texto-card-persona lead">Com nosso conjunto de informações e nosso AVA, garantimos que cada vez mais pessoas conheçam melhor os surdos e garantimos que nossos usuários busquem e aprendam sobre os surdos, principalmente sobre como ter uma comunicação melhor com eles.</p>
                    </div>
                </div>
                
            </section>
            
        </section>
        
        <section class="Borda-Listrada"></section>
        
        <section id="Apresentacao-AVA">
            <h1 class="display-1 Apresentacao-AVA-Titulo">AVA</h1>
            <h2 class="h2 Alinhar-Centro Apresentacao-AVA-SubTitulo">Ambiente Virtual de Aprendizagem</h2>
            
            <section class="Borda-Listrada"></section>
            
            <section class=" container Apresentacao-AVA-Fotos row">
                <figure class="col-md-4 ">
                    <img class="Borda-Cor-2" src="imgs/AVA-Foto-1.png" alt=""/>
                </figure>
                <figure class="col-md-4">
                    <img class="Borda-Cor-1" src="imgs/AVA-Foto-2.png" alt=""/>
                </figure>
                <figure class="col-md-4">
                    <img class="Borda-Cor-2" src="imgs/AVA-Foto-3.png" alt=""/>
                </figure>
            </section>
            
            <article class="Apresentacao-AVA-Texto container">
                <h3>Porque utilizar um AVA?</h3>
                <p class="lead">O uso das tecnologias como facilitadores do ensino trouxe resultados positivos, com o advento da internet nas últimas décadas a procura por um método de ensino capaz de atingir um público maior com mais facilidade tem crescido, explicitando também a necessidade de um instrumento de ensino simples porem completo. Os ambientes virtuais de Ensino e aprendizagem se mostram um caminho muito eficiente de ensino, pois, dá ao aluno autonomia no ensino e usa elementos multididáticos no ensino (Schimiguel et al., 2014).</p>
            </article>
            <article class="Apresentacao-AVA-Texto container">
                <h3>O que será ensinado no AVA?</h3>
                <p class="lead">O AVA em função de melhorar a inclusão dos surdos, tem como principal foco o ensino da LIBRAS. A língua brasileira de sinais (Libras) é a língua natural das comunidades surdas brasileiras e esta  utiliza o canal visuo-espacial, fazendo uso de sinais, expressões faciais e corporais  para se expressar e comunicar, diferenciando-se, dessa forma, das línguas oral-auditivas como é o caso da língua portuguesa em sua modalidade oral onde se  faz uso da voz. A língua de sinais possui status de língua pois, é formada pelos aspectos: fonológico, morfológico, sintático e semântico, não sendo apenas meros sinais ou o português sinalizado como é comumente dito (QUADROS, 2007).</p>
            </article>
            <h2 class="Titulo-Link-Cadastro">Cadastre-se e obtenha acesso ao ambiente!</h2>
        </section>
        <footer>
            <p><span class="Logo-Footer">Libras<span class="Logo-Footer-Cor2">on</span></span> foi criado e desenvolvido por Caio Alexandre Ramos, Micaella Fernandes e Jacileia Nascimento Soares com orientação de Glaucielle Celestina de Sá e Iury Gomes</p>
        </footer>
        
        <!-- Modals FINALIZADOS-->
        <!-- Modal LOGIN-->
        <div class="modal fade" id="ModalDeLogin" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabelAluno">Login do Aluno</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>  
                    <div class="modal-body">
                        <form method="POST" action="../Controller/LogarUsuario.php" >
                            
                            <div class="form-group">
                                <label for="Email-Formulario">E-mail</label>
                                <input name="Email-Formulario" type="email" class="form-control input-cadastro" id="Email-Formulario" placeholder="Entre com seu e-mail">
                            </div>
                          
                            <div class="form-group">
                                <label for="Senha-formulario">Senha</label>
                                <input name="Senha-Formulario" type="password" class="form-control" id="Senha-formulario" placeholder="Entre com sua senha">
                                <small id="emailHelp" class="form-text text-muted">Você não deve compartilhar sua senha com ninguém!</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sair" data-dismiss="modal">Fechar</button>
                            <button type="submit" name="Logar" class="btn btn-cadastro">Logar</button>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        
        <!-- Modals CADASTRO-->
        <div class="modal fade" id="ModalDeCadastro" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabelAluno">Cadastro do Aluno</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>  
                    <div class="modal-body">
                        
                        <form method="POST" action="CarregarFotoAluno.php" enctype="multipart/form-data" >
                            
                            <?php include_once '../Controller/MSGErroCadastro.php'; ?>
                            
                            <div class="form-group">
                                <label for="Nome-Formulario-A-C">Nome Completo</label>
                                <input name="Nome-Formulario" type="text" class="form-control" id="Nome-Formulario-A-C" placeholder="Entre com seu nome completo" required="">
                            </div>
                                
                            <div class="form-group">
                                <label for="Email-Formulario-A-C">E-mail</label>
                                <input name="Email-Formulario" type="email" class="form-control" id="Email-Formulario-A-C" placeholder="Entre com seu e-mail" required="">
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="Senha-formulario-A-C">Senha</label>
                                    <input name="Senha-Formulario" type="password" class="form-control" minlength="8" maxlength="30" id="Senha-formulario-A-C" placeholder="Entre com sua senha" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ComSenha-Formulario-A-C">Confirmar Senha</label>
                                    <input name="ComSenha-Formulario" type="password" class="form-control" minlength="8" maxlength="30" id="ComSenha-formulario-A-C" placeholder="Senha novamente" required="">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="Formulario-Foto-A-C">Foto de perfil</label><br>
                                <label class="custom-file">
                                    <input name="Foto-Formulario" type="file" id="Formulario-Foto-P-C" class="custom-file-input" accept="image/jpeg" required>
                                    <label class="custom-file-label">Escolha uma foto...</label>
                                </label>
                            </div>
                                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sair" data-dismiss="modal">Fechar</button>
                        <button type="submit" name="Cadastrar-A" class="btn btn-cadastro">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- Cadastro Realizado -->
        <div class="modal fade" id="ModalDeSucessoCd" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabelCadastroSucesso">Cadastro realizado com sucesso!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            Você acaba de realizar o cadastro no nosso AVA! Aproveite do nosso curso de introdução a Língua brasileira de sinais (LIBRAS). Faça o login com seu e-mail e senha registrado.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sair" data-dismiss="modal">Fechar</button>
                        </div>
                </div>
            </div>
        </div>
        
        <!-- Erro no Login -->
        <div class="modal fade" id="ModalDeErroLogin" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabelCadastroSucesso">Erro no Login!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            Verifique se seu email e senha foram digitados corretamente.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sair" data-dismiss="modal">Fechar</button>
                        </div>
                </div>
            </div>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="bootstrap-4.1.0-dist/jquery-3.3.1.min.js"></script>
        <script src="bootstrap-4.1.0-dist/popper.js"></script>
        <script src="bootstrap-4.1.0-dist/js/bootstrap.js"></script>
        
        <!-- Modals Ativos -->
        <!-- Erros de Cadastro Aluno-->
        <?php if( isset($_REQUEST['MSGERR'])){?>
        <script>
                $('#ModalDeCadastro').modal('show');
        </script>
        <?php } ?>
        
        <!-- Erros de Login-->
        <?php if( isset($_REQUEST['Login'])){?>
        <script>
                $('#ModalDeErroLogin').modal('show');
        </script>
        <?php } ?>
        
        <!-- Sucesso de Cadastro -->
        <?php if(isset($_REQUEST['SucessoNoCadastro'])){?>
        <script>
                $('#ModalDeSucessoCd').modal('show');
        </script>
        <?php } ?>
        
    </body>
</html>
