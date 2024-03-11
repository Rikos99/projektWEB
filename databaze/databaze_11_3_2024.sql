-- DDL Generated from https:/databasediagram.com

CREATE TABLE Kniha (
  knihaId int PRIMARY KEY,
  knihaNazev string,
  knihaObdobi int REFERENCES Obdobi(obdobiId),
  knihaAutor int REFERENCES Autor(autorId)
);

CREATE TABLE Autor (
  autorId int PRIMARY KEY,
  autorJmeno varchar(100),
  autorPrijmeni varchar(100)
);

CREATE TABLE KnihaUzivatel (
  knihaId int PRIMARY KEY REFERENCES Kniha(knihaId),
  uzivatelId int PRIMARY KEY REFERENCES Uzivatel(uzivatelId),
  oblibena bit,
  povinna bit
);

CREATE TABLE Obdobi (
  obdobiId int PRIMARY KEY,
  obdobiNazev varchar(100)
);

CREATE TABLE Uzivatel (
  uzivatelId int PRIMARY KEY,
  uzivatelJmeno varchar(100),
  uzivatelPrijmeni varchar(100),
  uzivatelPrezdivka varchar(100),
  uzivatelEmail varchar(100),
  uzivatelHeslo varchar(100),
  uzivatelIkona varchar(100),
  uzivatelKnihy varchar(100),
  uzivatelRole int REFERENCES Role(RoleId),
  uzivatelTrida int REFERENCES Trida(TridaId)
);

CREATE TABLE Trida (
  TridaId int PRIMARY KEY,
  TridaSkola int PRIMARY KEY REFERENCES Skola(SkolaId),
  TridaNazev varchar(100),
  TridaZkratka varchar(100)
);

CREATE TABLE Skola (
  SkolaId int PRIMARY KEY,
  SkolaNazev varchar(100),
  SkolaZkratka varchar(100)
);

CREATE TABLE Role (
  RoleId int PRIMARY KEY,
  RoleAdmin bit,
  RoleUcitel bit,
  RoleModerator bit
);

CREATE TABLE Prispevek (
  prispevekId int PRIMARY KEY,
  prispevekNazev varchar(100),
  prispevekDatumNahrani date,
  prispevekRozbor bit,
  prispevekCtenarskyDenik bit,
  prispevekKviz bit,
  prispevekKnihaId int REFERENCES Kniha(knihaId),
  prispevekObdobiId int REFERENCES Obdobi(obdobiId),
  prispevekAutorId int REFERENCES Autor(autorId),
  prispevekUzivatelId int REFERENCES Uzivatel(uzivatelId),
  prispevek undefined
);

CREATE TABLE Komentar (
  komentarId int PRIMARY KEY,
  komentarObsah varchar(100),
  komentarPrispevekId int REFERENCES Prispevek(prispevekId),
  komentarUzivatel int REFERENCES Uzivatel(uzivatelId)
);

CREATE TABLE Nahlaseni (
  nahlaseniId int PRIMARY KEY,
  nahlaseniPrispevek int REFERENCES Prispevek(prispevekId),
  nahalseniDuvod varchar(100),
  nahlaseniUzivatel int REFERENCES Uzivatel(uzivatelId)
);
