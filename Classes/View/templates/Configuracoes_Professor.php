<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Configurações Professor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                                            <a class="dropdown-item" href="Configuracoes.php">Configurações</a>
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
        
        <main class="Principal-Conteudo" style="padding-bottom: 50px;">
            
            <h1 class="titulo-sessoes">Configurações da conta</h1>
            
            <section class="row AlterCaixa">
                
                <section class="col-md-4">
                    <figure class="Perfil-Config" style="margin-top: 0px;">
                        <img src="../Controller/CarregarImagens.php?FotoPerfil" alt="# Foto DO Usuario #"/>
                    </figure>
                    <form class="row" style="margin-top: 20px; padding: 10px;" method="POST" enctype="multipart/form-data" action="CarregarFotoProfessor.php">
                        <div class="col-sm-6">
                            <label class="custom-file">
                                <input name="Foto-Formulario" type="file" id="Formulario-Foto-P-C" class="custom-file-input" accept="image/png, image/jpeg" required>
                                <label class="custom-file-label">Arquivo...</label>
                            </label>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" name="AtualizarFoto" style="width: 100%" class="btn btn-cadastro">Alterar Foto</button>
                        </div>
                    </form>
                </section>
                
                <section class="col-md-8">
                    
                    <form class="container" method="POST" action="../Controller/AtualizarConfiguracoes.php">
                        <div class="form-group">
                            <label for="Email">Endereço de E-mail: <div class="custom-control custom-checkbox"><input type="checkbox" onclick="atvDstFormularios()" class="custom-control-input" id="customCheck1"><label class="custom-control-label" for="customCheck1">Alterar?</label></div></label>
                            <div id="caixaEmailAlter"><input name="Email" type="email" disabled="" class="form-control" id="Email" placeholder="Alterar e-mail" value="<?php echo $User->email; ?>"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="Nome">Nome do usuário: <div class="custom-control custom-checkbox"><input type="checkbox" onclick="atvDstFormularios()" class="custom-control-input" id="customCheck2"><label class="custom-control-label" for="customCheck2">Alterar?</label></div></label>
                            <div id="caixaNomeAlter"><input name="Nome" disabled="" type="text" class="form-control" id="Nome" placeholder="Nome do usuário" value="<?php echo $User->nome; ?>"></div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Senha1">Senha do usuário:<div class="custom-control custom-checkbox"><input type="checkbox" onclick="atvDstFormularios()" class="custom-control-input" id="customCheck4"><label class="custom-control-label" for="customCheck4">Alterar?</label></div></label>
                                <div id="caixaSenha1Alter"><input name="Senha1" disabled="" type="password" class="form-control" id="Senha1" placeholder="Senha" value="aaaaaaaaaaa"></div>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="Senha2">Senha de confirmação:<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="customCheck3"></div></label>
                                <div id="caixaSenha2Alter"><input name="Senha2" disabled="" type="password" class="form-control" id="Senha2" placeholder="Senha de Confirmação" value="aaaaaaaaaaa"></div>
                            </div>
                        </div>
                        
                        <div id="BotaoAtualizacaoConfig"><button type="submit" disabled="" name="AlterarInfs" style="width: 100%;" class="btn btn-cadastro">Confirmar Alterações</button></div>
                    </form>
                </section>
            </section>
            
        </main>
        
        <footer>
            <p><span class="Logo-Footer">Libras<span class="Logo-Footer-Cor2">on</span></span> foi criado e desenvolvido por Caio Alexandre Ramos, Micaella Fernandes e Jacileia Nascimento Soares com orientação de Glaucielle Celestina de Sá e Iury Gomes</p>
        </footer>
        
        <!-- Modals -->
        <!-- Erro na atualizacão -->
        <div class="modal fade" id="ModalDeSucessoAlteracao" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabelSucessolteracao">Sucesso na alteração!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <p>Os dados foram atualizados com sucesso!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sair" data-dismiss="modal">Fechar</button>
                        </div>
                </div>
            </div>
        </div>
        <!-- Erro na atualizacão -->
        <div class="modal fade" id="ModalDeErroAlteracao" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabelErroAlteracao">Erro na alteração!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <p>Houve um erro na atualização dos seus dados!</p>
                            <p>Verifique os seguintes casos:</p>
                            <ol>
                                <li>O novo e-mail ja consta no sistema.</li>
                                <li>Algum campo a ser alterado ficou vazio.</li>
                                <li>A senha de confirmação não é compativel com a senha nova.</li>
                                <li>A senha possui menos de 8 caracteres.</li>
                            </ol>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sair" data-dismiss="modal">Fechar</button>
                        </div>
                </div>
            </div>
        </div>
        <!-- Erro na atualizacão -->
        <div class="modal fade" id="ModalDeSucessoAlteracaoFoto" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabelSucessoAlteracaoFoto">Sucesso na alteração de foto!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <p>Sua foto de perfil foi alterada com sucesso!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sair" data-dismiss="modal">Fechar</button>
                        </div>
                </div>
            </div>
        </div>
        <!-- Obrigatorio JavaScript -->
        <script src="js/jsConfig.js"></script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="bootstrap-4.1.0-dist/jquery-3.3.1.min.js"></script>
        <script src="bootstrap-4.1.0-dist/popper.js"></script>
        <script src="bootstrap-4.1.0-dist/js/bootstrap.js"></script>
        <!-- Codigo de ativação dos modals -->
        <?php if(isset($_REQUEST['ERROR'])){?><script>$('#ModalDeErroAlteracao').modal('show');</script><?php } ?>
        <?php if(isset($_REQUEST['Sucesso'])){?><script>$('#ModalDeSucessoAlteracao').modal('show');</script><?php } ?>
        <?php if(isset($_REQUEST['SucessoFoto'])){?><script>$('#ModalDeSucessoAlteracaoFoto').modal('show');</script><?php } ?>
    </body>
</html>
