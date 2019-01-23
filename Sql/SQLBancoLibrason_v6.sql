-- Tabelas do BD

CREATE TABLE Aluno(
	ID INT AUTO_INCREMENT NOT NULL,
    Nome VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Senha VARCHAR(50) NOT NULL,
    PRIMARY KEY(ID)
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
    Descricao TEXT NOT NULL,
    Referencial TEXT,
    URL_Video VARCHAR(300) NOT NULL,
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
    Texto_Questao VARCHAR(200) NOT NULL,
    AlternativaA VARCHAR(200),
    AlternativaB VARCHAR(200),
    AlternativaC VARCHAR(200),
    AlternativaD VARCHAR(200),
    AlternativaE VARCHAR(200),
    Foto VARCHAR(200),
    Exercicio_FK INT NOT NULL,
    AlternativaCorreta VARCHAR(300),
    PRIMARY KEY (ID),
    FOREIGN KEY (Exercicio_FK)
    REFERENCES Exercicio(ID)
);
    
CREATE TABLE Respostas(
	ID INT AUTO_INCREMENT NOT NULL,
    Texto_Resposta VARCHAR(200) NOT NULL,
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

-- Funções do Sistema
-- Função de disponiblidade de Email
DELIMITER $$

CREATE FUNCTION disponiblidadeDeEmail (Email_User VARCHAR(100))
RETURNS BOOL
BEGIN

DECLARE email_Aluno VARCHAR(500);
DECLARE retorno BOOL;

SET retorno = TRUE;

SELECT a.Email INTO email_Aluno FROM Aluno a WHERE a.Email = Email_User;

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

DECLARE email_Aluno VARCHAR(500);
DECLARE retorno VARCHAR(1);
DECLARE verificarSenha VARCHAR(500);

SET retorno = 'N';

SELECT a.Email INTO email_Aluno FROM Aluno a WHERE a.Email = Email_User;

IF email_Aluno = Email_User THEN
	SELECT Senha INTO verificarSenha FROM Aluno WHERE Email = Email_User;
	
    IF verificarSenha = Senha_User THEN
		SET retorno = 'A';
	END IF;
END IF;

RETURN retorno;
END$$

DELIMITER ;

-- Store Procedures
DELIMITER $$
CREATE PROCEDURE QuestoesExercicio (ID_E int)
BEGIN
    SELECT e.ID as 'ID_Exercicio', q.ID, q.Texto_Questao, q.AlternativaA, q.AlternativaB, q.AlternativaC, q.AlternativaD, q.AlternativaE, q.Foto From Exercicio e INNER JOIN Questoes q ON e.ID = q.Exercicio_FK WHERE e.ID = ID_E;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE vereficarResposta (ID_U int, ID_Q int)
BEGIN
    SELECT r.ID, r.Questoes_FK, r.Texto_Resposta From Respostas r 
	INNER JOIN Questoes q ON q.ID = r.Questoes_FK 
	WHERE r.Aluno_FK = ID_U && Questoes_FK =ID_Q;
END $$
DELIMITER ;

