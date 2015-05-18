CREATE TABLE Utente
	(nome VARCHAR(20) PRIMARY KEY,
	 email VARCHAR(20) NOT NULL UNIQUE,
	 password VARCHAR(16) NOT NULL,
	 residenza VARCHAR(20), --opzionale
	 tipo VARCHAR(7) NOT NULL, -- il tipo  è normale/vip-> max_length=7
	 datanascita DATE
	 );

CREATE TABLE Categoria
	(nomec VARCHAR(20) PRIMARY KEY
	);

CREATE TABLE Sottocategoria
	(
	nomesc VARCHAR(20),
	categoria REFERENCES Categoria(nomec)
				ON DELETE RESTRICT
				ON UPDATE RESTRICT, --non permetto cambiamenti alle categoria per evitare grandi effetti cascata, guarda sotto
	PRIMARY KEY(nomesc,categoria)
	);
	
CREATE TABLE Preferenza
	(utentep VARCHAR(20) REFERENCES Utente(nome)
						ON DELETE CASCADE --se tolgo un utente dal db la sua preferenza scompare
						ON UPDATE CASCADE,
	categoriap VARCHAR(20) REFERENCES Categoria(nomec)
						ON DELETE RESTRICT --non permetto di cambiare nome alla categoria, avrei troppi effetti cascata in altri punti del progetto
						ON UPDATE RESTRICT, --es se un utente ha messo preferenza "cucina" io non posso cambiare il nome alla categoria e mettergli "pettinare_giraffe"
	PRIMARY KEY (utentep,categoriap)
	);
	
CREATE TABLE Domandaperta
	(utented VARCHAR(20) REFERENCES Utente(nome)
						ON DELETE SET NULL --ci teniamo anche le domande senza utente per fare una sorta di history?
						ON UPDATE CASCADE, --per esempio se l'utente ha bisogno di cambiare o username o pass
	datad DATETIME DEFAULT CURRENT_TIMESTAMP,
	testo TEXT NOT NULL,
	imgurl VARCHAR(50),
	imgtesto TEXT,
	chiusa BOOLEAN DEFAULT FALSE,
	PRIMARY KEY (utented,datad)
	);

CREATE TABLE Sondaggio
	(utentes VARCHAR(20) REFERENCES Utente(nome)
						ON DELETE SET NULL --ci teniamo anche le domande senza utente per fare una sorta di history?
						ON UPDATE CASCADE, --per esempio se l'utente ha bisogno di cambiare o username o pass
	datas DATETIME DEFAULT CURRENT_TIMESTAMP,
	testo TEXT NOT NULL,
	imgurl VARCHAR(50),
	imgtesto TEXT,
	chiusa BOOLEAN DEFAULT FALSE,
	PRIMARY KEY (utentes,datas)
	);
	
CREATE TABLE Topic1
		(categoriat1 VARCHAR(20) references Categoria(nomec)
						ON DELETE RESTRICT
						ON UPDATE RESTRICT,
		nomet1 VARCHAR(20),
		datat1 DATETIME,
		FOREIGN KEY(nomet1,datat1) references Domandaperta(utented,datad)  --non capisco come riferirmi a una chiave primaria composta da piu attributi
		PRIMARY KEY (categoriat1,nomet1,datat1)
		);
		
CREATE TABLE Topic2
		(categoriat2 VARCHAR(20) references Categoria(nomec)
						ON DELETE RESTRICT
						ON UPDATE RESTRICT,
		nomet2 VARCHAR(20),
		datat2 DATETIME,
		FOREIGN KEY(nomet2,datat2) references Sondaggio(utentes,datas)  --non capisco come riferirmi a una chiave primaria composta da piu attributi
		PRIMARY KEY (categoriat2,nomet2,datat2)
		);
		
CREATE TABLE Rispostapredefinita
		(utenterispostap REFERENCES Utente(nome)
				ON DELETE SET NULL
				ON UPDATE CASCADE,
		 utentesondaggio VARCHAR(20), 
	     datasondaggio DATETIME,
		 anonimo BOOLEAN DEFAULT FALSE,
		 testorisp VARCHAR(30) NOT NULL,
		 FOREIGN KEY(utentesondaggio,datasondaggio) references Sondaggio(utentes,datas),
		 PRIMARY KEY(utenterispostap,utentesondaggio,datasondaggio)
		);
		
CREATE TABLE Rispostaperta
		(utenterispostaperta REFERENCES Utente(nome)
				ON DELETE SET NULL
				ON UPDATE CASCADE,
		 datara DATETIME DEFAULT CURRENT_TIMESTAMP,
		 testora TEXT NOT NULL,
		 anonimo BOOLEAN DEFAULT FALSE,		
		 votopos LONG DEFAULT 0,
		 votoneg LONG DEFAULT 0,
		 utentedomandaperta VARCHAR(20), 
	     datadomandaperta DATETIME,
		 FOREIGN KEY(utentedomandaperta,datadomandaperta) references Domandaperta(utented,datad),
		 PRIMARY KEY(utenterispostaperta,datara)
		);
