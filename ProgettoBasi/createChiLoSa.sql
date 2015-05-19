CREATE TABLE Utente
	(nome VARCHAR(20) NOT NULL,
	 email VARCHAR(20) NOT NULL,
	 password VARCHAR(16) NOT NULL,
	 residenza VARCHAR(20), --opzionale
	 tipo VARCHAR(7) NOT NULL, -- il tipo  è normale/vip-> max_length=7
	 datanascita DATE,
	 PRIMARY KEY(nome),
	 UNIQUE(email)
	 );

CREATE TABLE Categoria
	(nomec VARCHAR(20) NOT NULL,
	 PRIMARY KEY(nomec)
	);

CREATE TABLE Sottocategoria
	(
	nomesc VARCHAR(20) NOT NULL,
	nomec  VARCHAR(20) NOT NULL  REFERENCES Categoria(nomec)
				ON DELETE RESTRICT
				ON UPDATE RESTRICT, --non permetto cambiamenti alle categoria per evitare grandi effetti cascata, guarda sotto
	PRIMARY KEY(nomesc,nomec)
	);
	
CREATE TABLE Preferenza
	(nome VARCHAR(20) NOT NULL REFERENCES Utente(nome)
						ON DELETE CASCADE --se tolgo un utente dal db la sua preferenza scompare
						ON UPDATE CASCADE,
	nomec VARCHAR(20) NOT NULL REFERENCES Categoria(nomec)
						ON DELETE RESTRICT --non permetto di cambiare nome alla categoria, avrei troppi effetti cascata in altri punti del progetto
						ON UPDATE RESTRICT, --es se un utente ha messo preferenza "cucina" io non posso cambiare il nome alla categoria e mettergli "pettinare_giraffe"
	PRIMARY KEY (nome,nomec)
	);
	
CREATE TABLE Domandaperta
	(idd int NOT NULL AUTO_INCREMENT,						
	datad DATETIME DEFAULT CURRENT_TIMESTAMP,
	testo TEXT NOT NULL,
	imgurl VARCHAR(50),
	imgtesto TEXT,
	chiusa BOOLEAN DEFAULT FALSE,-- quando un utente viene eliminato questo campo diventa true.
	nome VARCHAR(20) REFERENCES Utente(nome)
				ON DELETE SET NULL,
				ON UPDATE CASCADE,
	PRIMARY KEY (idd)
	);

CREATE TABLE Sondaggio
	(idd int NOT NULL AUTO_INCREMENT,						
	datad DATETIME DEFAULT CURRENT_TIMESTAMP,
	testo TEXT NOT NULL,
	imgurl VARCHAR(50),
	imgtesto TEXT,
	chiusa BOOLEAN DEFAULT FALSE,-- quando un utente viene eliminato questo campo diventa true.
	nome VARCHAR(20) REFERENCES Utente(nome)
				     ON DELETE NULL,
				     ON UPDATE CASCADE,
	PRIMARY KEY (idd)
	);
	
CREATE TABLE Topic1
		(nomec VARCHAR(20) NOT NULL REFERENCES Categoria(nomec)
						   ON DELETE RESTRICT
						   ON UPDATE RESTRICT,
		idd int NOT NULL REFERENCES Domandaperta(idd)
	                     ON DELETE CASCADE,				       
		PRIMARY KEY (nomec,idd)
		);
		
CREATE TABLE Topic2
		(nomec VARCHAR(20) NOT NULL REFERENCES Categoria(nomec)
						   ON DELETE RESTRICT
						   ON UPDATE RESTRICT,
		idd int NOT NULL REFERENCES Sondaggio(idd)
	                     ON DELETE CASCADE,				       
		PRIMARY KEY (nomec,idd)
		);
		
CREATE TABLE Rispostapredefinita
		(idr int NOT NULL AUTO_INCREMENT,	
		 anonimo BOOLEAN DEFAULT FALSE,
		 datar DATETIME DEFAULT CURRENT_TIMESTAMP,
		 testorisp TEXT NOT NULL,	
		 nome VARCHAR(20) REFERENCES Utente(nome)
				ON DELETE SET NULL,
				ON UPDATE CASCADE,
		idd int NOT NULL REFERENCES Sondaggio(idd)
	                     ON DELETE CASCADE,			 
		 PRIMARY KEY(idr)
		);
		
CREATE TABLE Rispostaperta
		(idr int NOT NULL AUTO_INCREMENT,	
		 anonimo BOOLEAN DEFAULT FALSE,
		 datar DATETIME DEFAULT CURRENT_TIMESTAMP,
		 testorisp TEXT NOT NULL,
		 votopositivo LONG DEFAULT 0,
		 votonegativo LONG DEFAULT 0,
		 nome VARCHAR(20) REFERENCES Utente(nome)
				ON DELETE SET NULL,
				ON UPDATE CASCADE,
		idd int NOT NULL REFERENCES Domandaperta(idd)
	                     ON DELETE CASCADE,			 
		 PRIMARY KEY(idr)		
		);
