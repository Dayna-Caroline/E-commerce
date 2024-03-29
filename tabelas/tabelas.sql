/* TABELAS - CUP&MUG */

/*------------------------------------------------------------------*/

DROP TABLE IF EXISTS carrinho;
DROP TABLE IF EXISTS itens;
DROP TABLE IF EXISTS compra;
DROP TABLE IF EXISTS usuario;
DROP TABLE IF EXISTS produto;

/*------------------------------------------------------------------*/

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

INSERT INTO usuario  
(id_user, nome, sobrenome, sexo, data_nascimento, cpf, email, senha, telefone, cep, excluido, data_exclusao, adm)
VALUES
(DEFAULT, 'Dayna', 'Caroline', 'F', '12/07/2004', '455.103.657-21', 'dayna.caroline@unesp.br', 'Y3Rp', '(14) 99101-5603', '17.033-410', false, null, true),
(DEFAULT, 'Fernanda', 'Modolo', 'F', '08/12/2003', '435.231.987-01', 'modolo.fer@unesp.br', 'Y3Rp', '(14) 99428-0935', '17.563-142', false, null, false),
(DEFAULT, 'Augusto', 'Creppe', 'M', '23/07/2004', '455.491.018-07', 'augusto.creppe@unesp.br', 'Y3Rp', '(14) 99678-6342', '17.018-786', false, null, true),
(DEFAULT, 'Marcos', 'Silva', 'M', '08/12/1973', '656.546.942-56', 'silva.marcus@unesp.br', 'Y3Rp', '(14) 45465-5465', '54.564-565', false, null, false),
(DEFAULT, 'Lucas', 'Freitas', 'M', '08/12/1998', '670.545.654-68', 'lucas.freitas@unesp.br', 'Y3Rp', '(14) 65654-9450', '64.456-465', false, null, false),
(DEFAULT, 'Leticia', 'Lima', 'F', '08/12/1889', '671.655.656-56', 'lima.leticia@unesp.br', 'Y3Rp', '(14) 15984-2546', '32.456-659', true, null, false),
(DEFAULT, 'Ana', 'Maria', 'F', '23/11/2006', '455.185.021-49', 'maria.ana@unesp.br', 'Y3Rp', '(14) 99155-9876', '19.641-601', true, null, false);

/*------------------------------------------------------------------*/

CREATE TABLE produto
(
    id_produto          SERIAL PRIMARY KEY      NOT NULL,
    produto             VARCHAR(30)             NOT NULL,
    cupormug            CHARACTER(02)           NOT NULL,
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

INSERT INTO produto
(id_produto, produto, cupormug, descricao, quantidade, preco, imagem, material, cor, tamanho, excluido, data_exclusao)
VALUES
(1, 'Caneca Long com Frase', 2, 'Caneca na cor cinza com frase colorida, disponível no tamanho de 450mL e feita de alumínio.', 	40, 30, '/imgs/produtos/caneca1.jpg', 	'Alumínio', 'Cinza',	450, FALSE, NULL),
(2, 'Copo Twister', 	1, 'Copo twister, feito de acrílico, com tampa e canudo e capacidade para 700mL.', 					20, 50, '/imgs/produtos/copo1.jpg', 	'Acrílico', 'Azul',	700, FALSE, NULL),
(3, 'Caneca Coffe',     2, 'Caneca de cerâmica com cores variadas, estampada com uma frase, 350mL.', 						50, 40, '/imgs/produtos/caneca2.jpg', 	'Cerâmica', 'Preto',	350, FALSE, NULL),
(4, 'Copo com Luzes', 	1, 'Copo com luzes, estampado com uma frase e capacidade para 400mL.', 								10, 90, '/imgs/produtos/copo2.jpg', 	'Acrílico', 'Variada',	400, FALSE, NULL),
(5,'Caneca com Tirante',2, 'Caneca com cores variadas estampada com uma frase, feita de acrílico e com tamanho de 400mL.', 	80, 35, '/imgs/produtos/caneca3.jpg', 	'Acrílico', 'Preto',	400, FALSE, NULL),
(6, 'Copo com Canudo', 	1, 'Copo de acrílico com tampa e canuco, estampado com uma frase e capacidade para 700mL.', 		40, 60, '/imgs/produtos/copo3.jpg', 	'Acrílico', 'Rosa',	700, FALSE, NULL),
(7, 'Caneca com Frase', 2, 'Caneca de alumínio com 500mL, feita com cores variadas e com a estampa de uma frase.', 			40, 30, '/imgs/produtos/caneca4.jpg', 	'Alumínio', 'Preto',	500, FALSE, NULL),
(8, 'Copo Long', 		1, 'Copo long, estampado com uma frase e capacidade para 300mL.', 									35, 45, '/imgs/produtos/copo4.jpg', 	'Acrílico', 'Variada',	300, FALSE, NULL),
(9,'Caneca de Alumínio',2, 'Caneca feita de alumínio, com cores variadas e capacidade de 850mL.', 						    12, 39, '/imgs/produtos/caneca5.jpg', 	'Alumínio', 'Preto',	850, FALSE, NULL),
(10, 'Long Drink', 		1, 'Copo long, com cores variadas e capacidade para 300mL.', 										11, 57, '/imgs/produtos/copo5.jpg', 	'Acrílico', 'Variada',	300, FALSE, NULL),
(11, 'Caneca Lisa', 	2, 'Caneca feita de alumínio, com cores variadas e capacidade para 500mL.', 						29, 30, '/imgs/produtos/caneca6.jpg', 	'Alumínio', 'Preto',	500, FALSE, NULL),
(12, 'Copo Yard', 		1, 'Copo yard, feito de plástico com tampa e canudo, e capacidade para 900mL.', 					40, 65, '/imgs/produtos/copo6.jpg', 	'Plástico', 'Variada', 	900, FALSE, NULL);

/*------------------------------------------------------------------*/

CREATE TABLE carrinho
(
    id_user             BIGINT                  REFERENCES usuario(id_user),
    id_produto          BIGINT                  REFERENCES produto(id_produto),
    quantidade          INT                     NOT NULL,
    excluido            BOOLEAN                 DEFAULT FALSE
);

/*------------------------------------------------------------------*/

CREATE TABLE compra
(
    id_compra           SERIAL PRIMARY KEY      NOT NULL,
    id_user             SERIAL                  REFERENCES usuario(id_user),
    data_compra         DATE,
    excluido            BOOLEAN                 DEFAULT FALSE
);

/*------------------------------------------------------------------*/

CREATE TABLE itens
(
    id_itens            SERIAL PRIMARY KEY      NOT NULL,
    id_compra           BIGINT                  REFERENCES compra(id_compra),
    id_produto          BIGINT                  REFERENCES produto(id_produto),
    quantidade          INT                     NOT NULL
);