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
    PRIMARY KEY (ID)
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