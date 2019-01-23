<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Turmas - Professor</title>
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

                <a href="../../index.php" class="navbar-brand h1 mb-0">
                    <img class="Logo-Nav" src="imgs/logotipo.png" alt="Lbrason Logotipo"/>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#MenuPaginaPrincipal" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="MenuPaginaPrincipal">

                    <ul class="navbar-nav ml-auto Persona-Link Persona-Link-Cor1">

                        <li class="nav-item">
                            <a href="../../index.php" class="nav-link Persona-Link-Cor1">Inicio</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="Curso.php" class="nav-link Persona-Link-Cor1">Curso</a>
                        </li>

                        <li class="nav-item">
                            <a href="Surdo.php" class="nav-link Persona-Link-Cor1">Surdo</a>
                        </li>

                        <li class="nav-item">
                            <a href="Libras.php" class="nav-link Persona-Link-Cor1">Libras</a>
                        </li>
                        
                        <li class="nav-item menu-user-adpt">
                            <section class="UI-User-Interna row menu-user-adpt">
                                <figure class="ft-User-Drop">
                                    <img src="../Controller/CarregarImagens.php?FotoPerfil" alt="# Foto DO Usuario #"/>
                                </figure>
                                <section class="Usuario-Menu">
                                    <div class="dropdown btn-user-log">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownDoUsuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           <?php echo $User->nome; ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="../View/Configuracoes.php">Configurações</a>
                                            <a class="dropdown-item" href="../Controller/EncerrarLogin.php">Logoff</a>
                                        </div>
                                    </div>
                                    <div class="Turma-Log-Drop">
                                        Professor
                                    </div>
                                </section> 
                            </section>
                        </li>
                    </ul>
                </div>
            </section>
        </nav>
        
        <main class="Principal-Conteudo">
            <div class="container">
                <h1 class="titulo-sessoes">Suas turmas cadastradas</h1>
                
                <div class="Card-Group-Turmas row">
                    <?php $ExibirTurmas = "TRUE"; include_once '../Controller/FuncoesTurma.php'; ?>
                    <section class="Card-Turma col-md-3">
                        <div class="Card-Turma-back">
                            <a onclick="$('#ModalConfirmacaoTurma').modal('show');">
                                <figure>
                                    <center>
                                        <img src="imgs/Cards/Card-Link-5.png" alt="Icon Turma">
                                    </center>
                                </figure>
                                <p class="Card-Turma-Cod">Abrir nova turma</p>
                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </main>
        
        <footer>
            <p><span class="Logo-Footer">Libras<span class="Logo-Footer-Cor2">on</span></span> foi criado e desenvolvido por Caio Alexandre Ramos, Micaella Fernandes e Jacileia Nascimento Soares com orientação de Glaucielle Celestina de Sá e Iury Gomes</p>
        </footer>
        
        <!-- Modals-->
        <!-- Modal de Comfirmação de criação de turma-->
        <div class="modal fade" id="ModalConfirmacaoTurma" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabelModalConfirmacaoTurma">Criar nova turma</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <p>Você está preste a abrir uma nova turma.</p>
                            <p>1. Será gerado um código da turma para o aluno ser registrado em sistema.</p>
                            <p>2. O código deve ser repassado aos alunos de sua turma.</p>
                            <p>3. Turmas fechadas apenas impossibilitam a entrada de alunos nela.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sair" data-dismiss="modal">Cancelar</button>
                            <form action="../Controller/FuncoesTurma.php?CriarNovaTurma" method="POST">
                                <button type="submit" class="btn btn-confirmar">Criar nova turma</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
        
        <!-- Modal de Criação Sucesso -->
        <?php if(isset($_REQUEST['NovaTurmaCriada'])){?>
        <div class="modal fade" id="ModalSucessoTurma" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabelModalSucesoTurma">Sucesso na criação da turma</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <p>A Turma <strong style="color: #ff3229"><?php echo $_REQUEST['NovaTurmaCriada']; ?></strong> foi criada com sucesso!</p>
                            <p>Para alunos entrarem nela forneça o Codigo <strong style="color: #ff3229"><?php echo $_REQUEST['NovaTurmaCriada']; ?></strong> para eles usarem no cadastro!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sair" data-dismiss="modal">Fechar</button>
                        </div>
                </div>
            </div>
        </div>
        <?php } ?>
        
        <!-- Modal de Erro Autotização -->
        <?php if(isset($_REQUEST['ERRO-Autorizacao-Professor'])){?>
        <div class="modal fade" id="ErroAutorizaTurma" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabelModalSucesoTurma">Erro - Autorização</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <p>Você não tem autorização para administrar essa turma!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sair" data-dismiss="modal">Fechar</button>
                        </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="bootstrap-4.1.0-dist/jquery-3.3.1.min.js"></script>
        <script src="bootstrap-4.1.0-dist/popper.js"></script>
        <script src="bootstrap-4.1.0-dist/js/bootstrap.js"></script>
        <?php if(isset($_REQUEST['NovaTurmaCriada'])){?><script>$('#ModalSucessoTurma').modal('show');</script><?php } ?>
        <?php if(isset($_REQUEST['ErroCriacaoTurmas'])){?><script>$('#ErroSucessoTurma').modal('show');</script><?php } ?>
        <?php if(isset($_REQUEST['ERRO-Autorizacao-Professor'])){?><script>$('#ErroAutorizaTurma').modal('show');</script><?php } ?>
    </body>
</html>
