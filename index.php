<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <?php
       require_once './loader.php';
        //Exemplo da função CREATE do CRUD
        /*
        $tabela = "usuarios";
        $dadosTabela = "ID,Nome,Email,DataNascimento,Senha";
        $dadosValues = "NULL,Caio Alexandre,caioxandres2000@gmail.com,2000-07-16,OlaMundo";
        $create = new Create($tabela, $dadosTabela, $dadosValues);
        $create -> executarQuery();
        */
       ?>
        
        <?php
        //Exemplo da função READ do CRUD
        //Se nenhuma coluna e  valor for selecionado, ele exibira toda tabela;
        /*
        $tabela = "usuarios";
        $dadosTabela = "ID,Nome";
        $dadosValues = "1,Caio Alexandre";
        
        $read = new Read($tabela, $dadosTabela, $dadosValues);
        $read->executarQuery();
        $Users = $read ->getResultado();
        echo "<pre>";
        print_r($Users);
        echo "</pre>";
        echo "<pre> Foram Encontrados: ";
        print_r($read->getQtsResultado());
        echo " Resultados!</pre>";
        /*
        ?>
        
        <?php
        //Exemplo da função UPDATE do CRUD
        /*
        $tabela = "usuarios";
        $dadosTabela = "Nome,Email";
        $dadosValues = "Luciana Sousa,lucydiamond@hotmail.com";
        $condicaoColuna = "ID";
        $condicaoValor = 1;
        
        $update = new Update($tabela, $dadosTabela, $dadosValues, $condicaoColuna, $condicaoValor);
        $update->executarQuery();
         */
        ?>
        
        <?php
        //Exemplo da função DELETE do CRUD
        /*
        $tabela = "usuarios";
        $condicaoColuna = "ID";
        $condicaoValor = 1;
        
        $delete = new Delete($tabela, $condicaoColuna, $condicaoValor);
        $delete ->executarQuery();
        */
        ?>
    </body>
</html>