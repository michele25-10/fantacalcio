create database fantacalcio;

create table fantacalcio.`user`(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
nickname            VARCHAR(64)  NOT null,
pw 					VARCHAR(256) not null,
active				BOOLEAN  NOT NULL DEFAULT (TRUE) 
);

create table fantacalcio.squad(
id					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
name 				VARCHAR(30) not NULL,
id_user 			INT UNSIGNED NOT null,
score				INT not null DEFAULT(0)
);

create table fantacalcio.league(
id					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
name 				VARCHAR(30) not NULL,
id_trustee			INT UNSIGNED NOT null
);

create table fantacalcio.squad_league(
id					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY key,
id_squad			INT UNSIGNED NOT null,
id_league			INT UNSIGNED NOT null
);

create table fantacalcio.rosa(
id					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
id_squad			INT UNSIGNED NOT null,
id_league			INT UNSIGNED NOT null,
id_player			INT UNSIGNED NOT null
);

create table fantacalcio.player(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
name				VARCHAR(30) not NULL,		
surname				VARCHAR(30) not NULL,
`role`				VARCHAR(30) not NULL
);

create table fantacalcio.`match`(
id 					INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
number_match 		int not null,
id_squad1			INT UNSIGNED NOT null,
id_squad2			INT UNSIGNED NOT null,
score1				INT not null,
score2				INT not null,
id_league			INT UNSIGNED NOT null
);

ALTER TABLE fantacalcio.squad ADD CONSTRAINT fk_user_squad FOREIGN KEY ( id_user ) REFERENCES fantacalcio.`user` ( id );

ALTER TABLE fantacalcio.league ADD CONSTRAINT fk_user_league FOREIGN KEY ( id_trustee ) REFERENCES fantacalcio.`user` ( id );

ALTER TABLE fantacalcio.rosa ADD CONSTRAINT fk_squad_rosa FOREIGN KEY ( id_squad ) REFERENCES fantacalcio.squad ( id );

ALTER TABLE fantacalcio.rosa ADD CONSTRAINT fk_player_rosa FOREIGN KEY ( id_player ) REFERENCES fantacalcio.player ( id );

ALTER TABLE fantacalcio.rosa ADD CONSTRAINT fk_league_rosa FOREIGN KEY ( id_league ) REFERENCES fantacalcio.league ( id );

ALTER TABLE fantacalcio.`match` ADD CONSTRAINT fk_match_squad1 FOREIGN KEY ( id_squad1 ) REFERENCES fantacalcio.squad ( id );

ALTER TABLE fantacalcio.`match` ADD CONSTRAINT fk_match_squad2 FOREIGN KEY ( id_squad2 ) REFERENCES fantacalcio.squad ( id );

ALTER TABLE fantacalcio.squad_league ADD CONSTRAINT fk_squad_squad FOREIGN KEY ( id_squad ) REFERENCES fantacalcio.squad ( id );

ALTER TABLE fantacalcio.squad_league ADD CONSTRAINT fk_league_league FOREIGN KEY ( id_league ) REFERENCES fantacalcio.league ( id );

