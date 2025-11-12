CREATE TABLE Modelo_impr(
    idModelo_impr INT PRIMARY KEY AUTO_INCREMENT,
    nomeModelo_impr VARCHAR(100) NOT NULL,
    marcaModelo_impr VARCHAR(100) NOT NULL
);

CREATE TABLE Aparelhos (
    idAparelho INT PRIMARY KEY AUTO_INCREMENT,
    nomeAparelho VARCHAR(100) NOT NULL,
    idRelativo INT NOT NULL,
    tipoRelativo ENUM('impressora') NOT NULL
);

CREATE TABLE Impressoras (
    idImpressora INT PRIMARY KEY AUTO_INCREMENT,
    nomeImpressora VARCHAR(100) NOT NULL,
    fk_idModelo_impr INT NOT NULL,
    FOREIGN KEY (fk_idModelo_impr) REFERENCES Modelo_impr(idModelo_impr)
);

CREATE TABLE Toners (
    idToner INT PRIMARY KEY AUTO_INCREMENT,
    modeloToner VARCHAR(100) NOT NULL,
    cor VARCHAR(30) NOT NULL,
    cheio INT NOT NULL,
    Vazio INT NOT NULL
);

CREATE TABLE Imps_toners(
    idImp_toner INT PRIMARY KEY AUTO_INCREMENT,
    fkIdImpressora INT NOT NULL,
    fkId_toner INT NOT NULL
)