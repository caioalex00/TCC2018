<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <?php
        //Exemplo da função CREATE do CRUD
       /*
        include_once './Model/Create.php';
        $tabela = "usuarios";
        $dadosTabela = "ID,Nome,Email,DataNascimento,Senha";
        $dadosValues = "NULL,Caio Alexandre,caioxandres2000@gmail.com,2000-07-16,OlaMundo";
        
        include_once './Model/Conexao.php';
        $conexao = new Conexao();
        $create = new Create($conexao,$tabela, $dadosTabela, $dadosValues);
        */
       ?>
        
        <?php
        //Exemplo da função READ do CRUD
        //Se nenhuma coluna e  valor for selecionado, ele exibira toda tabela;
        /*
        include_once './Model/Read.php';
        
        $tabela = "usuarios";
        $colunas = "ID,Nome";
        $procura = "87,Caio Alexandre";
        
        include_once './Model/Conexao.php';
        $conexao = new Conexao();
        $read = new Read($conexao, $tabela, $colunas, $procura);
        $Users = $read->executarQuery();
        echo "<pre>";
        print_r($Users);
        echo "</pre>";
        */
        ?>
        
        <?php
        //Exemplo da função UPDATE do CRUD
        /*
        include_once './Model/Update.php';
        include_once './Model/Conexao.php';
        
        $conexao = new Conexao();
        $tabela = "usuarios";
        $colunas = "Nome,Email";
        $valores = "Luciana Sousa,lucydiamond@hotmail.com";
        $condicaoColuna = "ID";
        $condicaoValor = 77;
        
        $update = new Update($conexao, $tabela, $colunas, $valores, $condicaoColuna, $condicaoValor);
        */
        ?>
        
        <?php
        //Exemplo da função DELETE do CRUD
        /*
        include_once './Model/Delete.php';
        include_once './Model/Conexao.php';
        
        $conexao = new Conexao();
        $tabela = "usuarios";
        $condicaoColuna = "ID";
        $condicaoValor = 77;
        
        $delete = new Delete($conexao,$tabela, $condicaoColuna, $condicaoValor);
        */
        ?>
    </body>
</html>
