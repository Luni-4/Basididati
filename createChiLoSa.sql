CREATE TABLE Utente
	(nome VARCHAR(20) NOT NULL,
	 email VARCHAR(20) NOT NULL,
	 password VARCHAR(16) NOT NULL,
	 residenza VARCHAR(20) DEFAULT NULL, --opzionale
	 tipo VARCHAR(7) NOT NULL DEFAULT 'normale', -- il tipo  è normale/vip-> max_length=7
	 datanascita DATE DEFAULT NULL,
	 PRIMARY KEY(nome),
	 UNIQUE(email)
	 );

CREATE TABLE Categoria
	(nomec VARCHAR(20) NOT NULL,
	 nomesuperc VARCHAR(20) DEFAULT NULL REFERENCES Categoria(nomec)
						ON DELETE RESTRICT 
						ON UPDATE RESTRICT, 
	 PRIMARY KEY(nomec)
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
(   idd serial NOT NULL,	
    titolo VARCHAR(50) NOT NULL,					
	datad TIMESTAMP DEFAULT CURRENT_TIMESTAMP,	
	testo TEXT NOT NULL,
	imgurl VARCHAR(50),
	imgtesto TEXT,
	chiusa BOOLEAN DEFAULT FALSE,-- quando un utente viene eliminato questo campo diventa true.
	nome VARCHAR(20) DEFAULT NULL REFERENCES Utente(nome)
				ON DELETE SET NULL
				ON UPDATE CASCADE,
	PRIMARY KEY (idd)
	);

CREATE TABLE Sondaggio
(   idd serial NOT NULL,	
    titolo VARCHAR(50) NOT NULL,	
	datad TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	testo TEXT NOT NULL,
	imgurl VARCHAR(50),
	imgtesto TEXT,
	chiusa BOOLEAN DEFAULT FALSE,-- quando un utente viene eliminato questo campo diventa true.
	nome VARCHAR(20) DEFAULT NULL REFERENCES Utente(nome)
				     ON DELETE SET NULL
				     ON UPDATE CASCADE,
	PRIMARY KEY (idd)
	);
	
CREATE TABLE Topic1
		(nomec VARCHAR(20) NOT NULL REFERENCES Categoria(nomec)
						   ON DELETE RESTRICT
						   ON UPDATE RESTRICT,
		idd integer NOT NULL REFERENCES Domandaperta(idd)
	                     ON DELETE CASCADE,				       
		PRIMARY KEY (nomec,idd)
		);
		
CREATE TABLE Topic2
		(nomec VARCHAR(20) NOT NULL REFERENCES Categoria(nomec)
						   ON DELETE RESTRICT
						   ON UPDATE RESTRICT,
		idd integer NOT NULL REFERENCES Sondaggio(idd)
	                     ON DELETE CASCADE,				       
		PRIMARY KEY (nomec,idd)
		);
		
CREATE TABLE Rispostapredefinita
		(idr serial NOT NULL,	
		 anonimo BOOLEAN DEFAULT FALSE,
		 datar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		 testorisp TEXT NOT NULL,	
		 nome VARCHAR(20) DEFAULT NULL REFERENCES Utente(nome)
				ON DELETE SET NULL
				ON UPDATE CASCADE,
		idd integer NOT NULL REFERENCES Sondaggio(idd)
	                     ON DELETE CASCADE,			 
		 PRIMARY KEY(idr)
		);
		
CREATE TABLE Rispostaperta
		(idr serial NOT NULL,	
		 anonimo BOOLEAN DEFAULT FALSE,
		 datar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		 testorisp TEXT NOT NULL,
		 votopositivo integer DEFAULT 0,
		 votonegativo integer DEFAULT 0,
		 nome VARCHAR(20) DEFAULT NULL REFERENCES Utente(nome)
				ON DELETE SET NULL
				ON UPDATE CASCADE,
		idd integer NOT NULL REFERENCES Domandaperta(idd)
	                     ON DELETE CASCADE,			 
		 PRIMARY KEY(idr)		
		);
