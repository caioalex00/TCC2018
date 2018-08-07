USE librason;
-- Tabelas do BD

CREATE TABLE Professor(
	ID INT AUTO_INCREMENT NOT NULL,
    Nome VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Senha VARCHAR(50) NOT NULL,
    PRIMARY KEY(ID)
);

CREATE TABLE Turma(
	COD VARCHAR(10) NOT NULL,
    Professor_ID_FK INT NOT NULL,
    Status BOOL NOT NULL,
    PRIMARY KEY(COD),
    FOREIGN KEY (Professor_ID_FK)
    REFERENCES Professor(ID)
);

CREATE TABLE Aluno(
	ID INT AUTO_INCREMENT NOT NULL,
    Nome VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Turma_COD_FK VARCHAR(10) NOT NULL,
    Senha VARCHAR(50) NOT NULL,
    PRIMARY KEY(ID),
    FOREIGN KEY (Turma_COD_FK)
    REFERENCES Turma(COD)
);

CREATE TABLE Modulo(
	ID INT AUTO_INCREMENT NOT NULL,
    Nome VARCHAR(50) NOT NULL,
    Descricao VARCHAR(200) NOT NULL,
    Imagem LONGBLOB,
    PRIMARY KEY (ID)
);

CREATE TABLE Video(
	ID INT AUTO_INCREMENT NOT NULL,
    Nome VARCHAR(50) NOT NULL,
    Descricao VARCHAR(200) NOT NULL,
    URL_Video VARCHAR(200) NOT NULL,
    Modulo_FK int NOT NULL, 
    PRIMARY KEY (ID),
    FOREIGN KEY (Modulo_FK)
    REFERENCES Modulo(ID)
);

CREATE TABLE Exercicio(
	ID INT AUTO_INCREMENT NOT NULL,
    Nome VARCHAR(50) NOT NULL,
    Descricao VARCHAR(200) NOT NULL,
    Modulo_FK int NOT NULL, 
    PRIMARY KEY (ID),
    FOREIGN KEY (Modulo_FK)
    REFERENCES Modulo(ID)
);

CREATE TABLE Questoes(
	ID INT AUTO_INCREMENT NOT NULL,
    Texto_Questao VARCHAR(50) NOT NULL,
    Exercicio_FK INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Exercicio_FK)
    REFERENCES Exercicio(ID)
);
    
CREATE TABLE Respostas(
	ID INT AUTO_INCREMENT NOT NULL,
    Texto_Resposta VARCHAR(50) NOT NULL,
    Questoes_FK INT NOT NULL,
    Aluno_FK INT NOT NULL,
    PRIMARY KEY(ID),
    FOREIGN KEY (Questoes_FK)
    REFERENCES Questoes(ID),
    FOREIGN KEY (Aluno_FK)
    REFERENCES Aluno(ID)
);

CREATE TABLE Perfil_Aluno(
	ID INT AUTO_INCREMENT NOT NULL,
    Imagem LONGBLOB NOT NULL,
    Aluno_FK INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Aluno_FK)
    REFERENCES Aluno(ID)
);

CREATE TABLE Perfil_Professor(
	ID INT AUTO_INCREMENT NOT NULL,
    Imagem LONGBLOB NOT NULL,
    Professor_FK INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Professor_FK)
    REFERENCES Professor(ID)
);

-- Inserido Dados diretamente no banco

-- Módulos

-- Modulo 1
INSERT INTO modulo (ID, Nome, Descricao, Imagem) VALUES (1, 'Uma breve introdução', 'Nesse módulo é feito uma introdução a aspectos importantes da Libras', NULL);
INSERT INTO video (ID, Nome, Descricao, URL_Video, Modulo_FK) VALUES (NULL, 'ABC', 'Descrição a ser escrita', '<iframe width="560" height="315" src="https://www.youtube.com/embed/uwJcGuR9hPI?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>', 1);
INSERT INTO video (ID, Nome, Descricao, URL_Video, Modulo_FK) VALUES (NULL, 'Parâmetros', 'Descrição a ser escrita', '<iframe width="560" height="315" src="https://www.youtube.com/embed/MldHJ02neEA?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>', 1);
INSERT INTO exercicio (ID, Nome, Descricao, Modulo_FK) VALUES (NULL, 'ABC', 'Exercicio referente ao Video do módulo 1 que ensina sobre o ABC em Libras', 1);
INSERT INTO exercicio (ID, Nome, Descricao, Modulo_FK) VALUES (NULL, 'Parâmetros', 'Exercicio referente ao Video do módulo 1 que ensina sobre os Parâmetros em Libras', 1);

-- Modulo 2
INSERT INTO modulo (ID, Nome, Descricao, Imagem) VALUES (2, 'Tempo', 'Nesse módulo é ensinado sobre períodos e dias da semana', NULL);
INSERT INTO video (ID, Nome, Descricao, URL_Video, Modulo_FK) VALUES (NULL, 'Períodos e Dias da semana', 'Descrição a ser escrita', '<iframe width="560" height="315" src="https://www.youtube.com/embed/hZtn0R-Cvec" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>', 2);
INSERT INTO video (ID, Nome, Descricao, URL_Video, Modulo_FK) VALUES (NULL, 'Dias da semana', 'Descrição a ser escrita', '<iframe width="560" height="315" src="https://www.youtube.com/embed/uwJcGuR9hPI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>', 2);
INSERT INTO exercicio (ID, Nome, Descricao, Modulo_FK) VALUES (NULL, 'Períodos e Dias da semana', 'Exercicio referente ao Video do módulo 2 que ensina sobre períodos e dias da semana em Libras', 2);
INSERT INTO exercicio (ID, Nome, Descricao, Modulo_FK) VALUES (NULL, 'Dias da semana', 'Exercicio referente ao Video do módulo 2 que ensina sobre os dias da semana em Libras', 2);

-- Modulo 3
INSERT INTO modulo (ID, Nome, Descricao, Imagem) VALUES (3, 'Natureza', 'Nesse módulo é ensinado sobre Animais, Clima e a Natureza', NULL);
INSERT INTO video (ID, Nome, Descricao, URL_Video, Modulo_FK) VALUES (NULL, 'Animais e Classificadores', 'Descrição a ser escrita', '<iframe width="560" height="315" src="https://www.youtube.com/embed/cORmwVOz_5M" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>', 3);
INSERT INTO video (ID, Nome, Descricao, URL_Video, Modulo_FK) VALUES (NULL, 'Natureza, Animais, Clima e Estações', 'Descrição a ser escrita', '<iframe width="560" height="315" src="https://www.youtube.com/embed/wlSE6ayEC8c" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>', 3);
INSERT INTO exercicio (ID, Nome, Descricao, Modulo_FK) VALUES (NULL, 'Animais e Classificadores', 'Exercicio referente ao Video do módulo 3 que ensina sobre animais e classificadores', 3);
INSERT INTO exercicio (ID, Nome, Descricao, Modulo_FK) VALUES (NULL, 'Natureza, Animais, Clima e Estações', 'Exercicio referente ao Video do módulo 3 que ensina sobre natureza, animais, clima e estações em Libras', 3);

-- Funções do Sistema
-- Função de disponiblidade de Email
DELIMITER $$

CREATE FUNCTION disponiblidadeDeEmail (Email_User VARCHAR(100))
RETURNS BOOL
BEGIN

DECLARE email_Professor VARCHAR(500);
DECLARE email_Aluno VARCHAR(500);
DECLARE retorno BOOL;

SET retorno = TRUE;

SELECT p.Email INTO email_Professor FROM Professor p WHERE p.Email = Email_User;
SELECT a.Email INTO email_Aluno FROM Aluno a WHERE a.Email = Email_User;

IF email_Professor = Email_User THEN
SET retorno = FALSE;
END IF;

IF email_Aluno = Email_User THEN
SET retorno = FALSE;
END IF;

RETURN retorno;
END$$

DELIMITER ;

-- Função de Autenticação
DELIMITER $$

CREATE FUNCTION autenticar (Email_User VARCHAR(100), Senha_User VARCHAR(100))
RETURNS VARCHAR(1)
BEGIN

DECLARE email_Professor VARCHAR(500);
DECLARE email_Aluno VARCHAR(500);
DECLARE retorno VARCHAR(1);
DECLARE verificarSenha VARCHAR(500);

SET retorno = 'N';

SELECT p.Email INTO email_Professor FROM Professor p WHERE p.Email = Email_User;
SELECT a.Email INTO email_Aluno FROM Aluno a WHERE a.Email = Email_User;

IF email_Professor = Email_User THEN

	SELECT Senha INTO verificarSenha FROM Professor WHERE Email = Email_User;
	
    IF verificarSenha = Senha_User THEN
		SET retorno = 'P';
	END IF;
    
END IF;

IF email_Aluno = Email_User THEN
	SELECT Senha INTO verificarSenha FROM Aluno WHERE Email = Email_User;
	
    IF verificarSenha = Senha_User THEN
		SET retorno = 'A';
	END IF;
END IF;

RETURN retorno;
END$$

DELIMITER ;

-- Função de qtsDeTurmasProfessor
DELIMITER $$

CREATE FUNCTION qtsDeTurmasProfessor(ID_Professor INT)
RETURNS INT
BEGIN

DECLARE retorno INT;

SELECT COUNT(t.COD) INTO retorno FROM Professor p 
INNER JOIN Turma t ON t.Professor_ID_FK = p.ID
WHERE p.ID = ID_Professor;

RETURN retorno;
END$$

DELIMITER ;

-- Função de qtsDeTurmasProfessorAtivas
DELIMITER $$

CREATE FUNCTION qtsDeTurmasProfessorAtivas(ID_Professor INT)
RETURNS INT
BEGIN

DECLARE retorno INT;

SELECT COUNT(t.COD) INTO retorno FROM Professor p 
INNER JOIN Turma t ON t.Professor_ID_FK = p.ID
WHERE p.ID = ID_Professor AND t.Status = true;

RETURN retorno;
END$$

DELIMITER ;

-- Função de disponiblidade de Codico de Turma
DELIMITER $$

CREATE FUNCTION disponiblidadeDeTurma (Turma_COD VARCHAR(10))
RETURNS BOOL
BEGIN

DECLARE turma VARCHAR(10);
DECLARE retorno BOOL;

SET retorno = TRUE;

SELECT t.COD INTO turma FROM turma t WHERE t.COD = Turma_COD;

IF turma = Turma_COD THEN
SET retorno = FALSE;
END IF;

RETURN retorno;
END$$

DELIMITER ;

-- Views do Banco

CREATE VIEW Alunos_Turma AS
SELECT a.ID, a.nome, a.Turma_COD_FK FROM Aluno a;