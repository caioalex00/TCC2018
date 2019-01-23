<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home - Aluno</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="favicon.ico" type="image/x-icon"/>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="Classes/View/bootstrap-4.1.0-dist/css/bootstrap.css">
        <!-- Pessoal CSS -->
        <link href="Classes/View/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="Classes/View/css/media_Style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        
        <nav class="navbar navbar-expand-md navbar-light Borda-Bottom-Cor2">
            <section class="container">

                <a href="index.php" class="navbar-brand h1 mb-0">
                    <img class="Logo-Nav" src="Classes/View/imgs/logotipo.png" alt="Lbrason Logotipo"/>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#MenuPaginaPrincipal" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="MenuPaginaPrincipal">

                    <ul class="navbar-nav ml-auto Persona-Link Persona-Link-Cor1">

                        <li class="nav-item">
                            <a href="index.php" class="nav-link Persona-Link-Cor1">Inicio</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="Classes/View/Curso.php" class="nav-link Persona-Link-Cor1">Curso</a>
                        </li>

                        <li class="nav-item">
                            <a href="Classes/Controller/EncerrarLogin.php" class="nav-link Persona-Link-Cor1">Sair</a>
                        </li>

                        <li class="nav-item menu-user-adpt">
                            <section class="UI-User-Interna row menu-user-adpt">
                                <figure class="ft-User-Drop">
                                    <img src="Classes/Controller/CarregarImagens.php?FotoPerfil" alt="# Foto DO Usuario #"/>
                                </figure>
                                <section class="Usuario-Menu">
                                    <div class="dropdown btn-user-log">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownDoUsuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           <?php echo $User->nome; ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="Classes/View/Configuracoes.php">Configurações</a>
                                            <a class="dropdown-item" href="Classes/Controller/EncerrarLogin.php">Logoff</a>
                                        </div>
                                    </div>
                                    <div class="Turma-Log-Drop">
                                        Aluno
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
                
                <h1 class="titulo-sessoes">Seja bem vindo ao Librason</h1>
            
                <section class="row cards-link-grupo">
                    
                    <div class="card col-md-3 persona-card-inicio link-card-sessao">
                        <div class="link-card-sessao-in">
                        </div>
                    </div>
                    
                    <div class="card col-md-3 persona-card-inicio link-card-sessao">
                        <div class="link-card-sessao-in">
                            <a href="Classes/View/Curso.php">
                                <center>
                                    <img class="card-img-top adpt-link-card-img" src="Classes/View/imgs/Cards/Card-Link-1.png" alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text h1 link-card-sessao-titulo">AVA</p>
                                    </div>
                                </center>
                            </a>
                        </div>
                    </div>
                    
                    <div class="card col-md-3 persona-card-inicio link-card-sessao">
                        <div class="link-card-sessao-in">
                            <center>
                                <a href="Classes/Controller/EncerrarLogin.php">
                                    <img class="card-img-top adpt-link-card-img" src="Classes/View/imgs/Cards/Card-Link-4.png" alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text h1 Alinhar-Centro link-card-sessao-titulo">SAIR</p>
                                    </div>
                                </a>
                            </center>
                        </div>
                    </div>
                    
                    <div class="card col-md-3 persona-card-inicio link-card-sessao">
                        <div class="link-card-sessao-in">
                        </div>
                    </div>
                    
                </section>
            </div>
        </main>
        
        <footer>
            <p><span class="Logo-Footer">Libras<span class="Logo-Footer-Cor2">on</span></span> foi criado e desenvolvido por Caio Alexandre Ramos, Micaella Fernandes e Jacileia Nascimento Soares com orientação de Glaucielle Celestina de Sá e Iury Gomes</p>
        </footer>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="Classes/View/bootstrap-4.1.0-dist/jquery-3.3.1.min.js"></script>
        <script src="Classes/View/bootstrap-4.1.0-dist/popper.js"></script>
        <script src="Classes/View/bootstrap-4.1.0-dist/js/bootstrap.js"></script>
    </body>
</html>