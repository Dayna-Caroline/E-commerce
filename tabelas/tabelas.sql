/* TABELAS - CUP&MUG */

/*------------------------------------------------------------------*/

DROP TABLE IF EXISTS carrinho;
DROP TABLE IF EXISTS compra;
DROP TABLE IF EXISTS produto;
DROP TABLE IF EXISTS usuario;
CREATE TABLE usuario
(
    id_user             SERIAL PRIMARY KEY      NOT NULL,
    nome                VARCHAR(40)             NOT NULL,
    sobrenome           VARCHAR(40)             NOT NULL,
    sexo                VARCHAR(01)             NOT NULL,
    data_nascimento     DATE                    NOT NULL,
    cpf                 VARCHAR(40)             NOT NULL,
    email               VARCHAR(40)             NOT NULL UNIQUE,
    senha               VARCHAR(40)             NOT NULL,
    telefone            VARCHAR(15),
    cep                 VARCHAR(15),
    excluido            BOOLEAN                 DEFAULT FALSE,
    data_exclusao       DATE                    DEFAULT NULL,
    adm                 BOOLEAN                 DEFAULT FALSE
);

INSERT INTO usuario  (id_user, nome, sobrenome, sexo, data_nascimento, cpf, email, senha, telefone, cep, excluido, data_exclusao, adm)
VALUES (DEFAULT, 'Augusto', 'Creppe', 'M', '23/07/2004', '455491018-07', 'augusto.creppe@gmail.com', 'augusto123', '14996786342', '17018-786', false, null, true);

/*------------------------------------------------------------------*/


CREATE TABLE produto
(
    id_produto          SERIAL PRIMARY KEY      NOT NULL,
    produto             VARCHAR(30)             NOT NULL,
    descricao           VARCHAR(100)            NOT NULL,
    quantidade          INT                     NOT NULL,
    preco               FLOAT                   NOT NULL,
    imagem              CHARACTER VARYING(120)  NOT NULL,
    material            VARCHAR(40)             NOT NULL,
    cor                 VARCHAR(40)             NOT NULL,
    tamanho             CHARACTER(03)           NOT NULL,
    excluido            BOOLEAN                 DEFAULT FALSE,
    data_exclusao       DATE                    DEFAULT NULL
);

/*------------------------------------------------------------------*/


CREATE TABLE compra
(
    id_compra           SERIAL PRIMARY KEY      NOT NULL,
    id_user             SERIAL                  REFERENCES usuario(id_user),
    id_produto          SERIAL                  REFERENCES produto(id_produto),
    quantidade          INT                     NOT NULL,
    data_compra         DATE,
    excluido            BOOLEAN                 DEFAULT FALSE
);

/*------------------------------------------------------------------*/


CREATE TABLE carrinho
(
    id_user             BIGINT                  REFERENCES usuario(id_user),
    id_produto          BIGINT                  REFERENCES produto(id_produto),
    quantidade          INT                     NOT NULL
);
