PRAGMA foreign_keys = ON;
BEGIN TRANSACTION;

-- Table: Agenda
DROP TABLE IF EXISTS Agenda;

CREATE TABLE Agenda (
    dataInicio  DATE PRIMARY KEY,
    dataFim     DATE 
);

-- Table: Pais
DROP TABLE IF EXISTS Pais;

CREATE TABLE Pais (
    idPais      INTEGER PRIMARY KEY,
    nome        VARCHAR(15) UNIQUE NOT NULL 
);
insert into Pais(idPais, nome) values (1, "Portugal");
insert into Pais(idPais, nome) values (2, "United Kingdom");
insert into Pais(idPais, nome) values (3, "Spain");
insert into Pais(idPais, nome) values (4, "France");
insert into Pais(idPais, nome) values (5, "Germany");
insert into Pais(idPais, nome) values (6, "Norway");
insert into Pais(idPais, nome) values (7, "Poland");
insert into Pais(idPais, nome) values (8, "Italy");
insert into Pais(idPais, nome) values (9, "Greece");
insert into Pais(idPais, nome) values (10, "Belgium");
insert into Pais(idPais, nome) values (11, "Netherlands");
insert into Pais(idPais, nome) values (12, "Denmark");
insert into Pais(idPais, nome) values (13, "Sweden");
insert into Pais(idPais, nome) values (14, "Finland");
insert into Pais(idPais, nome) values (15, "Austria");
insert into Pais(idPais, nome) values (16, "Czech Republic");

-- Table: Cidade
DROP TABLE IF EXISTS Cidade;

CREATE TABLE Cidade (
    idCidade    INTEGER PRIMARY KEY,
    nome        VARCHAR(15) NOT NULL, 
    idPais      INTEGER REFERENCES Pais(idPais),
    UNIQUE(nome, idPais)
);

-- Table: Utilizador
DROP TABLE IF EXISTS Utilizador;

CREATE TABLE Utilizador (
    idUtilizador    INTEGER PRIMARY KEY,
    hashedPassword  TEXT NOT NULL,
    primeiroNome    VARCHAR(30) NOT NULL, 
    ultimoNome      VARCHAR(30) NOT NULL, 
    dataNascimento  DATE        NOT NULL, 
    email           VARCHAR(30) UNIQUE NOT NULL, 
    telefone        VARCHAR(15) NOT NULL, 
    foto            VARCHAR(30),
    altFoto         VARCHAR(50),
    idPais          INTEGER REFERENCES Pais (idPais) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Table: Reserva
DROP TABLE IF EXISTS Reserva;

CREATE TABLE Reserva (
    idReserva       INTEGER PRIMARY KEY, 
    dataCheckIn     DATE    NOT NULL,
    dataCheckOut    DATE   NOT NULL,
    numHospedes     INTEGER CHECK (numHospedes > 0), 
    precoTotal      REAL    CHECK (precoTotal > 0), 
    idEstado        INTEGER REFERENCES Estado(idEstado) ON DELETE CASCADE ON UPDATE CASCADE,
    idHabitacao     INTEGER REFERENCES Habitacao(idHabitacao),
    idUtilizador       INTEGER REFERENCES Utilizador(idUtilizador),
    UNIQUE (dataCheckIn, idHabitacao)
);

DROP TABLE IF EXISTS Estado;

CREATE TABLE Estado (
    idEstado    INTEGER PRIMARY KEY,                 
    estado      CHAR(9) UNIQUE NOT NULL
);

insert into Estado(idEstado,estado) values(0,"On hold");
insert into Estado(idEstado,estado) values(1,"Concluded");
insert into Estado(idEstado,estado) values(2,"Comented");
insert into Estado(idEstado,estado) values(3,"Canceled");

-- Table: Cancelamento
DROP TABLE IF EXISTS Cancelamento;

CREATE TABLE Cancelamento (
    reembolso   REAL     NOT NULL, 
    idReserva   INTEGER REFERENCES Reserva (idReserva)  ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(idReserva)
);

-- Table: ClassificacaoPorCliente
DROP TABLE IF EXISTS ClassificacaoPorCliente;

CREATE TABLE ClassificacaoPorCliente (
    limpeza     INTEGER CHECK(limpeza >= 1 AND limpeza <= 5), 
    valor       INTEGER CHECK(valor >= 1 AND valor <= 5),
    checkIn     INTEGER CHECK(checkIn >= 1 AND checkIn <= 5),
    localizacao INTEGER CHECK(localizacao >= 1 AND localizacao <= 5),
    outros      TEXT, 
    idReserva INTEGER REFERENCES Reserva (idReserva) ON DELETE RESTRICT ON UPDATE RESTRICT, 
    PRIMARY KEY (idReserva)
);

-- Table: Comodidade
DROP TABLE IF EXISTS Comodidade;

CREATE TABLE Comodidade (
    idComodidade    INTEGER PRIMARY KEY,
    nome            VARCHAR(15) UNIQUE NOT NULL
);

-- Table: TipoDeHabitacao
DROP TABLE IF EXISTS TipoDeHabitacao;

CREATE TABLE TipoDeHabitacao (
    idTipo  INTEGER PRIMARY KEY,
    nome    VARCHAR(30) UNIQUE NOT NULL
);

insert into TipoDeHabitacao(idTipo,nome) values (1,"Apartment");
insert into TipoDeHabitacao(idTipo,nome) values (2,"House");
insert into TipoDeHabitacao(idTipo,nome) values (3,"Bungalow");
insert into TipoDeHabitacao(idTipo,nome) values (4,"Tent");
insert into TipoDeHabitacao(idTipo,nome) values (5,"Hotel Room");
insert into TipoDeHabitacao(idTipo,nome) values (6,"Private Room");
insert into TipoDeHabitacao(idTipo,nome) values (7,"Shared Room");
insert into TipoDeHabitacao(idTipo,nome) values (8,"Hostel");

-- Table: PoliticaDeCancelamento
DROP TABLE IF EXISTS PoliticaDeCancelamento;

CREATE TABLE PoliticaDeCancelamento (
    idPolitica              INTEGER PRIMARY KEY,
    nome                    VARCHAR(25) UNIQUE NOT NULL, 
    descricao               VARCHAR(500) NOT NULL, 
    percentagemReembolso    INTEGER CHECK (percentagemReembolso >= 0 AND percentagemReembolso <= 1)
);

insert into PoliticaDeCancelamento(idPolitica, nome, descricao, percentagemReembolso) values(1,"Flexible", "100% full price refund.", 1);
insert into PoliticaDeCancelamento(idPolitica, nome, descricao, percentagemReembolso) values(2,"Moderate", "50% full price refund.", 0.5);
insert into PoliticaDeCancelamento(idPolitica, nome, descricao, percentagemReembolso) values(3,"Strict", "25% full price refund.",0.25);
insert into PoliticaDeCancelamento(idPolitica, nome, descricao, percentagemReembolso) values(4,"Super Strict", "Not refundable.", 0);

-- Table: Habitacao
DROP TABLE IF EXISTS Habitacao;

CREATE TABLE Habitacao (
    idHabitacao INTEGER PRIMARY KEY,
    nome        TEXT,
    numQuartos  INTEGER CHECK (numQuartos > 0), 
    maxHospedes INTEGER CHECK (maxHospedes > 0),  
    precoNoite  REAL    CHECK (precoNoite > 0), 
    taxaLimpeza REAL CHECK (taxaLimpeza >= 0), 
    descricao   TEXT,
    latitude    REAL    CHECK(latitude>=-90 and latitude<=90),
    longitude   REAL    CHECK(longitude>=-180 and longitude<=180),
    morada      TEXT,
    idCidade    INTEGER REFERENCES Cidade(idCidade) ON DELETE RESTRICT ON UPDATE RESTRICT, 
    idUtilizador INTEGER REFERENCES Utilizador(idUtilizador) ON DELETE CASCADE ON UPDATE CASCADE,
    idTipo      INTEGER REFERENCES TipoDeHabitacao (idTipo) ON DELETE SET NULL ON UPDATE CASCADE, 
    idPolitica  INTEGER REFERENCES PoliticaDeCancelamento (idPolitica) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Table: Disponivel
DROP TABLE IF EXISTS Disponivel;

CREATE TABLE Disponivel (
    idHabitacao     INTEGER REFERENCES Habitacao (idHabitacao)  ON DELETE CASCADE ON UPDATE CASCADE, 
    data            DATE REFERENCES Agenda (data)  ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (idHabitacao, data)
);

-- Table: Dispoe
DROP TABLE IF EXISTS Dispoe;

CREATE TABLE Dispoe (
    idComodidade  INTEGER REFERENCES Comodidade (idComodidade) ON DELETE CASCADE ON UPDATE CASCADE, 
    idHabitacao   INTEGER REFERENCES Habitacao (idHabitacao) ON DELETE CASCADE ON UPDATE CASCADE, 
    PRIMARY KEY (idComodidade, idHabitacao)
);

-- Table: Favorito
DROP TABLE IF EXISTS Favorito;

CREATE TABLE Favorito (
    idUtilizador     INTEGER REFERENCES Utilizador (idUtilizador) ON DELETE CASCADE ON UPDATE CASCADE, 
    idHabitacao   INTEGER REFERENCES Habitacao (idHabitacao) ON DELETE CASCADE ON UPDATE CASCADE, 
    PRIMARY KEY (idUtilizador, idHabitacao)
);

-- Table: Fotografia
DROP TABLE IF EXISTS Imagem;

CREATE TABLE Imagem (
    urlImagem   VARCHAR(20) PRIMARY KEY, 
    legenda TEXT,
    idHabitacao   INTEGER REFERENCES Habitacao(idHabitacao) ON DELETE CASCADE ON UPDATE CASCADE
);

-----------------povoar para exemplo--------------------
INSERT INTO Utilizador(idUtilizador, hashedPassword, primeiroNome, ultimoNome, dataNascimento, email, telefone, idPais)
VALUES(1, "$2y$10$jJ.U9HQxd1pzG.uisT4TauxwLqq8fPAM.VQIr1/Ci6wjRM8wM9May", "Leonor", "Sousa", "1999-12-27", "leonor@gmail.com", 943434535, 1);
--password: 1234

INSERT INTO Cidade(idCidade, nome, idPais) VALUES (1, "Porto", 1);

INSERT INTO Habitacao(idHabitacao, nome, numQuartos, maxHospedes, precoNoite, taxaLimpeza, descricao, latitude, longitude, morada, idCidade, idUtilizador, idTipo, idPolitica)
VALUES(1, "Apartamento Barato Porto", 2, 4, 100, 3.45, "Nao sou nada barato porque estou no Porto", 41.150150, -8.610320, "Rua X", 1, 1, 1, 1);

INSERT INTO Reserva(idReserva, dataCheckIn, dataCheckOut, numHospedes, precoTotal, idEstado, idHabitacao, idUtilizador)
VALUES (1, "2019-03-01", "2019-03-04", 4, 345.12, 1, 1, 1);

COMMIT TRANSACTION;