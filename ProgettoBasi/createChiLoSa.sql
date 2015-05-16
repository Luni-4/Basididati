CREATE TABLE Utente
	(username VARCHAR(20) PRIMARY KEY,
	 email VARCHAR(20) NOT NULL UNIQUE,
	 residenza VARCHAR(20), --opzionale
	 tipo VARCHAR(7) NOT NULL, -- il tipo  è normale/vip-> max_length=7
	 data_nascita DATE,
	 );

CREATE TABLE Categoria
	(nome VARCHAR(20) PRIMARY KEY,
	);

CREATE TABLE Sottocategoria
	(
	nome VARCHAR(20) UNIQUE,
	categoria REFERENCES Categoria(nome)
				ON DELETE RESTRICT
				ON UPDATE RESTRICT, --non permetto cambiamenti alle categoria per evitare grandi effetti cascata, guarda sotto
	PRIMARY KEY(nome,categoria),
	);
	
CREATE TABLE Preferenza
	(utente VARCHAR(20) REFERENCES Utente(username)
						ON DELETE CASCADE --se tolgo un utente dal db la sua preferenza scompare
						ON UPDATE CASCADE,
	categoria VARCHAR(20) REFERENCES Categoria(nome)
						ON DELETE RESTRICT --non permetto di cambiare nome alla categoria, avrei troppi effetti cascata in altri punti del progetto
						ON UPDATE RESTRICT, --es se un utente ha messo preferenza "cucina" io non posso cambiare il nome alla categoria e mettergli "pettinare_giraffe"
	PRIMARY KEY (utente,categoria),
	);
	
CREATE TABLE Domandaaperta
	(utente VARCHAR(20) REFERENCES Utente(utente)
						ON DELETE SET NULL --ci teniamo anche le domande senza utente per fare una sorta di history?
						ON UPDATE CASCADE, --per esempio se l'utente ha bisogno di cambiare o username o pass
	data DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (utente,data),
	);

CREATE TABLE Sondaggio
	(utente VARCHAR(20) REFERENCES Utente(utente)
						ON DELETE SET NULL --ci teniamo anche le domande senza utente per fare una sorta di history?
						ON UPDATE CASCADE, --per esempio se l'utente ha bisogno di cambiare o username o pass
	data DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (utente,data),
	);
	
CREATE TABLE Topic1
		(categoria VARCHAR(20) references Categoria(nome)
						ON DELETE RESTRICT
						ON UPDATE RESTRICT,
		domanda_ap --non capisco come riferirmi a una chiave primaria composta da piu attributi
		PRIMARY KEY (categoria,domanda_ap),
		);
		
CREATE TABLE Topic2
		(categoria VARCHAR(20) references Categoria(nome)
						ON DELETE RESTRICT
						ON UPDATE RESTRICT,
		sondaggio --non capisco come riferirmi a una chiave primaria composta da piu attributi
		PRIMARY KEY (categoria,sondaggio),
		);
		
CREATE TABLE Rispostapredefinita
		(utente REFERENCES Utente(nome)
				ON DELETE SET NULL
				ON UPDATE CASCADE,
		anonimo BOOLEAN DEFAULT FALSE,
		sondaggio --stesso problema
		PRIMARY KEY (utente,sondaggio),
		);
		
CREATE TABLE Rispostaaperta
		(utente REFERENCES Utente(nome)
				ON DELETE SET NULL
				ON UPDATE CASCADE,
		anonimo BOOLEAN DEFAULT FALSE,
		domanda_ap --stesso problema
		votoPos LONG DEFAULT 0,
		votoNeg LONG DEFAULT 0,
		PRIMARY KEY (utente,domanda_ap),
		);
