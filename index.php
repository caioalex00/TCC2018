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
        include_once './Classes/Model/Conexao.php';
        include_once './Classes/Model/Create.php';
        $tabela = "usuarios";
        $dadosTabela = "ID,Nome,Email,DataNascimento,Senha";
        $dadosValues = "NULL,Caio Alexandre,caioxandres2000@gmail.com,2000-07-16,OlaMundo";
        $create = new Create($tabela, $dadosTabela, $dadosValues);
        $create -> ExecutarQuery();
        */
       ?>
        
        <?php
        //Exemplo da função READ do CRUD
        //Se nenhuma coluna e  valor for selecionado, ele exibira toda tabela;
        /*
        include_once './Classes/Model/Conexao.php';
        include_once './Classes/Model/Read.php';
        
        $tabela = "usuarios";
        $colunas = "ID,Nome";
        $procura = "1,Caio Alexandre";
        
        $read = new Read($tabela, $colunas, $procura);
        $Users = $read->executarQuery();
        echo "<pre>";
        print_r($Users);
        echo "</pre>";
        */
        ?>
        
        <?php
        //Exemplo da função UPDATE do CRUD
        /*
        include_once './Classes/Model/Conexao.php';
        include_once './Classes/Model/Update.php';
        
        $tabela = "usuarios";
        $colunas = "Nome,Email";
        $valores = "Luciana Sousa,lucydiamond@hotmail.com";
        $condicaoColuna = "ID";
        $condicaoValor = 1;
        
        $update = new Update($tabela, $colunas, $valores, $condicaoColuna, $condicaoValor);
        $update->executarQuery();
         */
        ?>
        
        <?php
        //Exemplo da função DELETE do CRUD
        /*
        include_once './Classes/Model/Conexao.php';
        include_once './Classes/Model/Delete.php';
        
        $tabela = "usuarios";
        $condicaoColuna = "ID";
        $condicaoValor = 88;
        
        $delete = new Delete($tabela, $condicaoColuna, $condicaoValor);
        $delete ->executarQuery();
        */
        ?>
    </body>
</html>