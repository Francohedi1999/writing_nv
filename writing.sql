create database writing;

delete from commentaire;
delete from facture;
delete from commande;


create table user_type
	(
		id_user_type int unsigned auto_increment primary key,
		user_type varchar(15) not null
	)engine = InnoDB
Default charset = 'UTf8';

insert into user_type( user_type ) values ( "Admin" );
insert into user_type( user_type ) values ( "Client" ); 

-- drop table user_type; 



-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa




create table pays 
	(
		id_pays int unsigned auto_increment primary key,
		nom_pays varchar(50) not null
	)engine = InnoDB
Default charset = 'UTf8';


-- insert into pays(nom_pays) values ("Afghanistan");
-- insert into pays(nom_pays) values ("Afrique du Sud");
-- insert into pays(nom_pays) values ("Aland");
-- insert into pays(nom_pays) values ("Albanie");
-- insert into pays(nom_pays) values ("Algérie");
-- insert into pays(nom_pays) values ("Allemagne");
-- insert into pays(nom_pays) values ("Andorre");
-- insert into pays(nom_pays) values ("Angola");
-- insert into pays(nom_pays) values ("Anguilla");
-- insert into pays(nom_pays) values ("Antarctique");
-- insert into pays(nom_pays) values ("Antigua-et-Barbuda");
-- insert into pays(nom_pays) values ("Arabie saoudite");

-- insert into pays(nom_pays) values ("Argentine");
-- insert into pays(nom_pays) values ("Arménie");
-- insert into pays(nom_pays) values ("Aruba");
-- insert into pays(nom_pays) values ("Australie");
-- insert into pays(nom_pays) values ("Autriche");
-- insert into pays(nom_pays) values ("Azerbaïdjan");
-- insert into pays(nom_pays) values ("Bahamas");
-- insert into pays(nom_pays) values ("Bahreïn");
-- insert into pays(nom_pays) values ("Bangladesh");
-- insert into pays(nom_pays) values ("Barbade");
-- insert into pays(nom_pays) values ("Biélorussie");
-- insert into pays(nom_pays) values ("Belgique");
-- insert into pays(nom_pays) values ("Belize");
-- insert into pays(nom_pays) values ("Bénin");

-- insert into pays(nom_pays) values ("Bermudes");
-- insert into pays(nom_pays) values ("Bhoutan");
-- insert into pays(nom_pays) values ("Bolivie");
-- insert into pays(nom_pays) values ("Bonaire");
-- insert into pays(nom_pays) values ("Bosnie-Herzégovine");
-- insert into pays(nom_pays) values ("Botswana");
-- insert into pays(nom_pays) values ("Île Bouvet");
-- insert into pays(nom_pays) values ("Brésil");
-- insert into pays(nom_pays) values ("Brunei");
-- insert into pays(nom_pays) values ("Bulgarie");
-- insert into pays(nom_pays) values ("Burkina Faso");
-- insert into pays(nom_pays) values ("Burundi");
-- insert into pays(nom_pays) values ("Îles Caïmans");
-- insert into pays(nom_pays) values ("Cambodge");
-- insert into pays(nom_pays) values ("Cameroun");
-- insert into pays(nom_pays) values ("Canada");

-- insert into pays(nom_pays) values ("Cap-Vert");
-- insert into pays(nom_pays) values ("République centrafricaine");
-- insert into pays(nom_pays) values ("Chili");
-- insert into pays(nom_pays) values ("Chine");
-- insert into pays(nom_pays) values ("Île Christmas");
-- insert into pays(nom_pays) values ("Chypre");
-- insert into pays(nom_pays) values ("Îles Cocos");
-- insert into pays(nom_pays) values ("Colombie");
-- insert into pays(nom_pays) values ("Comores");
-- insert into pays(nom_pays) values ("République du Congo");
-- insert into pays(nom_pays) values ("République démocratique du Congo");
-- insert into pays(nom_pays) values ("Îles Cook");
-- insert into pays(nom_pays) values ("Corée du Sud");
-- insert into pays(nom_pays) values ("Corée du Nord");
-- insert into pays(nom_pays) values ("Costa Rica");
-- insert into pays(nom_pays) values ("Côte d'Ivoire");
-- insert into pays(nom_pays) values ("Croatie");


-- insert into pays(nom_pays) values ("Cuba");
-- insert into pays(nom_pays) values ("Curaçao");
-- insert into pays(nom_pays) values ("Danemark");
-- insert into pays(nom_pays) values ("Djibouti");
-- insert into pays(nom_pays) values ("République dominicaine");
-- insert into pays(nom_pays) values ("Dominique");
-- insert into pays(nom_pays) values ("Égypte");
-- insert into pays(nom_pays) values ("Salvador");
-- insert into pays(nom_pays) values ("Émirats arabes unis");
-- insert into pays(nom_pays) values ("Équateur");
-- insert into pays(nom_pays) values ("Érythrée");
-- insert into pays(nom_pays) values ("Espagne");
-- insert into pays(nom_pays) values ("Estonie");
-- insert into pays(nom_pays) values ("États-Unis");
-- insert into pays(nom_pays) values ("Éthiopie");
-- insert into pays(nom_pays) values ("Îles Malouines");
-- insert into pays(nom_pays) values ("Îles Féroé");
-- insert into pays(nom_pays) values ("Fidji");
-- insert into pays(nom_pays) values ("Finlande");

-- insert into pays(nom_pays) values ("France");
-- insert into pays(nom_pays) values ("Gabon");
-- insert into pays(nom_pays) values ("Gambie");
-- insert into pays(nom_pays) values ("Géorgie");
-- insert into pays(nom_pays) values ("Géorgie du Sud-et-les Îles Sandwich du Sud");
-- insert into pays(nom_pays) values ("Ghana");
-- insert into pays(nom_pays) values ("Gibraltar");
-- insert into pays(nom_pays) values ("Grèce");
-- insert into pays(nom_pays) values ("Grenade");
-- insert into pays(nom_pays) values ("Groenland");
-- insert into pays(nom_pays) values ("Guadeloupe");
-- insert into pays(nom_pays) values ("Guam");
-- insert into pays(nom_pays) values ("Guatemala");
-- insert into pays(nom_pays) values ("Guernesey");
-- insert into pays(nom_pays) values ("Guinée");
-- insert into pays(nom_pays) values ("Guinée-Bissau");
-- insert into pays(nom_pays) values ("Guinée équatoriale");
-- insert into pays(nom_pays) values ("Guyana");
-- insert into pays(nom_pays) values ("Guyane");
-- insert into pays(nom_pays) values ("Haïti");
-- insert into pays(nom_pays) values ("Îles Heard-et-MacDonald");
-- insert into pays(nom_pays) values ("Honduras");
-- insert into pays(nom_pays) values ("Hong Kong");


-- insert into pays(nom_pays) values ("Hongrie");
-- insert into pays(nom_pays) values ("Île de Man");
-- insert into pays(nom_pays) values ("Îles mineures éloignées des États-Unis");
-- insert into pays(nom_pays) values ("Îles Vierges britanniques");
-- insert into pays(nom_pays) values ("Îles Vierges des États-Unis");
-- insert into pays(nom_pays) values ("Inde");
-- insert into pays(nom_pays) values ("Indonésie");
-- insert into pays(nom_pays) values ("Iran");
-- insert into pays(nom_pays) values ("Irak");
-- insert into pays(nom_pays) values ("Irlande");
-- insert into pays(nom_pays) values ("Islande");
-- insert into pays(nom_pays) values ("Israël");
-- insert into pays(nom_pays) values ("Italie");
-- insert into pays(nom_pays) values ("Jamaïque");
-- insert into pays(nom_pays) values ("Japon");
-- insert into pays(nom_pays) values ("Jersey");
-- insert into pays(nom_pays) values ("Jordanie");

-- insert into pays(nom_pays) values ("Kazakhstan");
-- insert into pays(nom_pays) values ("Kenya");
-- insert into pays(nom_pays) values ("Kirghizistan");
-- insert into pays(nom_pays) values ("Kiribati");
-- insert into pays(nom_pays) values ("Koweït");
-- insert into pays(nom_pays) values ("Laos");
-- insert into pays(nom_pays) values ("Lesotho");
-- insert into pays(nom_pays) values ("Lettonie");
-- insert into pays(nom_pays) values ("Liban");
-- insert into pays(nom_pays) values ("Liberia");
-- insert into pays(nom_pays) values ("Libye");
-- insert into pays(nom_pays) values ("Liechtenstein");
-- insert into pays(nom_pays) values ("Lituanie");
-- insert into pays(nom_pays) values ("Luxembourg");
-- insert into pays(nom_pays) values ("Macao");
-- insert into pays(nom_pays) values ("Macédoine");
-- insert into pays(nom_pays) values ("Madagascar");
-- insert into pays(nom_pays) values ("Malaisie");
-- insert into pays(nom_pays) values ("Malawi");
-- insert into pays(nom_pays) values ("Maldives");
-- insert into pays(nom_pays) values ("Mali");
-- insert into pays(nom_pays) values ("Malte");
 
 
 
-- insert into pays(nom_pays) values ("Îles Mariannes du Nord");
-- insert into pays(nom_pays) values ("Maroc");
-- insert into pays(nom_pays) values ("Marshall");
-- insert into pays(nom_pays) values ("Martinique");
-- insert into pays(nom_pays) values ("Maurice");
-- insert into pays(nom_pays) values ("Mauritanie");
-- insert into pays(nom_pays) values ("Mayotte");
-- insert into pays(nom_pays) values ("Mexique");
-- insert into pays(nom_pays) values ("Micronésie");
-- insert into pays(nom_pays) values ("Moldavie");
-- insert into pays(nom_pays) values ("Monaco");
-- insert into pays(nom_pays) values ("Mongolie");
-- insert into pays(nom_pays) values ("Monténégro");
-- insert into pays(nom_pays) values ("Montserrat");
-- insert into pays(nom_pays) values ("Mozambique");
-- insert into pays(nom_pays) values ("Birmanie");
-- insert into pays(nom_pays) values ("Namibie");
-- insert into pays(nom_pays) values ("Nauru");
-- insert into pays(nom_pays) values ("Népal");


-- insert into pays(nom_pays) values ("Nicaragua");
-- insert into pays(nom_pays) values ("Niger");
-- insert into pays(nom_pays) values ("Nigeria");
-- insert into pays(nom_pays) values ("Niue");
-- insert into pays(nom_pays) values ("Île Norfolk");
-- insert into pays(nom_pays) values ("Norvège");
-- insert into pays(nom_pays) values ("Nouvelle-Calédonie");
-- insert into pays(nom_pays) values ("Nouvelle-Zélande");
-- insert into pays(nom_pays) values ("Territoire britannique de l'océan Indien");
-- insert into pays(nom_pays) values ("Oman");
-- insert into pays(nom_pays) values ("Ouganda");
-- insert into pays(nom_pays) values ("Ouzbékistan");
-- insert into pays(nom_pays) values ("Pakistan");
-- insert into pays(nom_pays) values ("Palaos");
-- insert into pays(nom_pays) values ("Autorité Palestinienne");
-- insert into pays(nom_pays) values ("Panama");
-- insert into pays(nom_pays) values ("Papouasie-Nouvelle-Guinée");
-- insert into pays(nom_pays) values ("Paraguay");
-- insert into pays(nom_pays) values ("Pays-Bas");
-- insert into pays(nom_pays) values ("Pérou");
-- insert into pays(nom_pays) values ("Philippines");


-- insert into pays(nom_pays) values ("Îles Pitcairn");
-- insert into pays(nom_pays) values ("Pologne");
-- insert into pays(nom_pays) values ("Polynésie française");
-- insert into pays(nom_pays) values ("Porto Rico");
-- insert into pays(nom_pays) values ("Portugal");
-- insert into pays(nom_pays) values ("Qatar");
-- insert into pays(nom_pays) values ("La Réunion");
-- insert into pays(nom_pays) values ("Roumanie");
-- insert into pays(nom_pays) values ("Royaume-Uni");
-- insert into pays(nom_pays) values ("Russie");
-- insert into pays(nom_pays) values ("Rwanda");
-- insert into pays(nom_pays) values ("Sahara occidental");
-- insert into pays(nom_pays) values ("Saint-Barthélemy");
-- insert into pays(nom_pays) values ("Saint-Christophe-et-Niévès");
-- insert into pays(nom_pays) values ("Saint-Marin");
-- insert into pays(nom_pays) values ("Saint-Martin (Antilles françaises)");
-- insert into pays(nom_pays) values ("Saint-Martin");
-- insert into pays(nom_pays) values ("Saint-Pierre-et-Miquelon");
-- insert into pays(nom_pays) values ("Saint-Siège (État de la Cité du Vatican)");
-- insert into pays(nom_pays) values ("Saint-Vincent-et-les-Grenadines");



-- insert into pays(nom_pays) values ("Sainte-Hélène");
-- insert into pays(nom_pays) values ("Sainte-Lucie");
-- insert into pays(nom_pays) values ("Salomon");
-- insert into pays(nom_pays) values ("Samoa");
-- insert into pays(nom_pays) values ("Samoa américaines");
-- insert into pays(nom_pays) values ("Sao Tomé-et-Principe");
-- insert into pays(nom_pays) values ("Sénégal");
-- insert into pays(nom_pays) values ("Serbie");
-- insert into pays(nom_pays) values ("Seychelles");
-- insert into pays(nom_pays) values ("Sierra Leone");
-- insert into pays(nom_pays) values ("Singapour");
-- insert into pays(nom_pays) values ("Slovaquie");
-- insert into pays(nom_pays) values ("Slovénie");
-- insert into pays(nom_pays) values ("Somalie");
-- insert into pays(nom_pays) values ("Soudan");
-- insert into pays(nom_pays) values ("Soudan du Sud");
-- insert into pays(nom_pays) values ("Sri Lanka");
-- insert into pays(nom_pays) values ("Suède");
-- insert into pays(nom_pays) values ("Suisse");
-- insert into pays(nom_pays) values ("Suriname");
-- insert into pays(nom_pays) values ("Svalbard et Île Jan Mayen");
-- insert into pays(nom_pays) values ("Swaziland");
-- insert into pays(nom_pays) values ("Syrie");
-- insert into pays(nom_pays) values ("Tadjikistan");


-- insert into pays(nom_pays) values ("Taïwan / (République de Chine (Taïwan))");
-- insert into pays(nom_pays) values ("Tanzanie");
-- insert into pays(nom_pays) values ("Tchad");
-- insert into pays(nom_pays) values ("République tchèque");
-- insert into pays(nom_pays) values ("Terres australes et antarctiques françaises");
-- insert into pays(nom_pays) values ("Thaïlande");
-- insert into pays(nom_pays) values ("Timor oriental");
-- insert into pays(nom_pays) values ("Togo");
-- insert into pays(nom_pays) values ("Tokelau");
-- insert into pays(nom_pays) values ("Tonga");
-- insert into pays(nom_pays) values ("Trinité-et-Tobago");
-- insert into pays(nom_pays) values ("Tunisie");
-- insert into pays(nom_pays) values ("Turkménistan");
-- insert into pays(nom_pays) values ("Îles Turques-et-Caïques");
-- insert into pays(nom_pays) values ("Turquie");
-- insert into pays(nom_pays) values ("Tuvalu");
-- insert into pays(nom_pays) values ("Ukraine");
-- insert into pays(nom_pays) values ("Uruguay");
-- insert into pays(nom_pays) values ("Vanuatu");
-- insert into pays(nom_pays) values ("Venezuela");
-- insert into pays(nom_pays) values ("Viêt Nam");
-- insert into pays(nom_pays) values ("Wallis-et-Futuna");
-- insert into pays(nom_pays) values ("Yémen");
-- insert into pays(nom_pays) values ("Zambie");
-- insert into pays(nom_pays) values ("Zimbabwe");


-- drop table pays;



-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa



create table promotion 
	(
		id_promotion int unsigned auto_increment primary key,
		code_promo varchar(15) not null,
		desc_promo text not null,
		reduction decimal(18 , 8) not null,
		activee boolean default true,
		date_promotion date not null
	)engine = InnoDB
Default charset = 'UTf8';

create or replace view details_promotion as 
select 
id_promotion,
code_promo,
desc_promo,
reduction,
activee as is_activee,
case 
	when activee = 0 then "Désactivée"
	else "Activée"
	end as activee,
date_promotion

from promotion;


-- drop table promotion;

-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa



create table user
	(
		id_user int unsigned auto_increment primary key,
		nom_user varchar(125) not null,
		mail_user varchar(125) not null,
		mdp_user text not null,
		id_user_type int unsigned default 2,
		banni boolean default false,
		fidele boolean default false,
		date_reset_password timestamp null default null,
		reduction_fidelite decimal(18 , 8) default 0,
		date_inscri date not null,
		foreign key (id_user_type) references user_type(id_user_type)
	)engine = InnoDB
Default charset = 'UTf8';
-- ---------------------------------------------------------------------------------------MBOLA TSY TAFIDITRA---------------------------------------------------------------------------------------------------

-- alter table user add reduction_fidelite decimal(18 , 8) default 0;
-- alter table user add date_reset_password timestamp null default null;
-- update user set nom_user = 'writing is Bae' , mail_user = 'writingisbae7@gmail.com',  mdp_user = sha1('Writingisbaefoana*7') where id_user = 1;
-- ---------------------------------------------------------------------------------------MBOLA TSY TAFIDITRA---------------------------------------------------------------------------------------------------

insert into user(nom_user , mail_user , mdp_user , id_user_type , date_inscri) values('Writing is Bae' , 'writingisbae7@gmail.com' , sha1('Writingisbaefoana*7') , 1 , current_date );


create or replace view client as 
select 

user.id_user as id_user,
user.nom_user as nom_user,
user.mail_user as mail_user,
user.mdp_user as mdp_user,
user.date_inscri as date_inscri,
user.banni as is_banni,
user.fidele as is_fidele,
user.date_reset_password as date_reset_password,
user.reduction_fidelite as reduction_fidelite,


user_type.id_user_type as id_user_type,
user_type.user_type as user_type,

case 
	when user.banni = 0 then "Activé"
	else "Désactivé"
	end as banni,

case
	when user.fidele = 0 then "Sans badge"
	else "Avec badge"
	end as fidele

from
user
join 
user_type on user_type.id_user_type = user.id_user_type;

-- ---------------------------------------------------------------------------------------MBOLA TSY TAFIDITRA---------------------------------------------------------------------------------------------------

create or replace view nb_client as
select
id_user_type , fidele , count(id_user) as nb_user from user group by fidele, id_user_type  order by fidele desc;

-- ---------------------------------------------------------------------------------------MBOLA TSY TAFIDITRA---------------------------------------------------------------------------------------------------


-- drop table user;
-- alter table user add fidele boolean default false;


-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa




create or replace view users as 
select 
user.id_user as id_user ,
user.nom_user as nom_user ,
user.mail_user as mail_user ,
user_type.user_type as user_type ,
user_type.id_user_type as id_user_type,
user.banni as banni
from 
user 
join user_type on user.id_user_type = user_type.id_user_type;


-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa




create table info_user
	(
		id_info_user int unsigned auto_increment primary key,
		nom_entreprise varchar(75) default null,
		adresse varchar(75) default null,
		id_pays int unsigned, 
		ville varchar(50) default null,
		region varchar(50) default null,
		num_TVA varchar(25) default null,
		code_postal varchar(10) default null,
		id_user int unsigned,
		foreign key (id_pays) references pays(id_pays),
		foreign key (id_user) references user(id_user)
	)engine = InnoDB
Default charset = 'UTf8';



-- drop table info_user;
-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa





 -- id_info_user |nom_entreprise |adresse |id_pays |nom_pays |ville |region|num_TVA |code_postal |id_user

create or replace view informations_user as 
select
info_user.id_info_user as id_info_user,
info_user.nom_entreprise as nom_entreprise,
info_user.adresse as adresse,

pays.id_pays as id_pays,
pays.nom_pays as nom_pays,

info_user.ville as ville,
info_user.region as region,
info_user.num_TVA as num_TVA,
info_user.code_postal as code_postal,
info_user.id_user as id_user

from
info_user
join pays on info_user.id_pays = pays.id_pays;


-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa






create table tarif
	(
		id_tarif int unsigned auto_increment primary key,
		type_redacteur varchar(50) not null,
		type_text varchar(50) not null,
		active boolean default true,
		prix_par_mot decimal(18 , 8) not null
	)engine = InnoDB
Default charset = 'UTf8';

insert into tarif(type_redacteur , type_text , prix_par_mot) values('Rédacteur junior' , 'Rédaction de publications sur réseaux sociaux' , 35);
insert into tarif(type_redacteur , type_text , prix_par_mot) values('Rédacteur junior' , 'Rédactions de fiches-produits' , 35);
insert into tarif(type_redacteur , type_text , prix_par_mot) values('Rédacteur junior' , 'Articles institutionnels' , 35);
insert into tarif(type_redacteur , type_text , prix_par_mot) values('Rédacteur junior' , 'Blogs personnels' , 35);

insert into tarif(type_redacteur , type_text , prix_par_mot) values('Rédacteur medium' , 'Rédaction de textes publicitaires' , 60);
insert into tarif(type_redacteur , type_text , prix_par_mot) values('Rédacteur medium' , 'Textes optimisés SEO sans balisage' , 60);

insert into tarif(type_redacteur , type_text , prix_par_mot) values('Rédacteur senior' , 'Rédaction de textes optimisés SEO avec balisage' , 80);
insert into tarif(type_redacteur , type_text , prix_par_mot) values('Rédacteur senior' , 'Textes informatifs' , 80);
insert into tarif(type_redacteur , type_text , prix_par_mot) values('Rédacteur senior' , "Articles d’investigations" , 80);
insert into tarif(type_redacteur , type_text , prix_par_mot) values('Rédacteur senior' , 'Articles créatifs (livres, ebooks, romans, etc…)' , 80);


create or replace view tarifs as
select 
id_tarif ,
type_redacteur ,
type_text ,
active as is_active,

case 
	when active = 1 then "Activé"
	else "Désactivé"
	end as active,

prix_par_mot 
from tarif ;


-- drop table tarif;


-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa


create table langue_text
	(
		id_langue_text int unsigned auto_increment primary key,
		langue_text varchar(25) not null,
		activee boolean default true
	)engine = InnoDB
Default charset = 'UTf8';

insert into langue_text(langue_text) values('Français');
insert into langue_text(langue_text) values('Anglais');

create or replace view langues as
select 
id_langue_text,
langue_text,
activee as is_activee,

case 
	when activee = 1 then "Activée"
	else "Désactivée"
	end as activee

from langue_text;

-- drop table langue_text;


-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa




create table etat_commande
	(
		id_etat_commande int unsigned auto_increment primary key,
		etat_commande text not null
	)engine = InnoDB
Default charset = 'UTf8';

insert into etat_commande(etat_commande) values('En attente de validation du site');
insert into etat_commande(etat_commande) values('En cours de rédaction');
insert into etat_commande(etat_commande) values('Livrée');
insert into etat_commande(etat_commande) values('Echouée');

-- ---------------------------------------------------------------------------- MBOLA TSY VITA -------------------------------------------------------------------

insert into etat_commande(etat_commande) values('Annulée');


-- drop table etat_commande;

-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa


create table type_paiement
	(
		id_type_paiement int unsigned auto_increment primary key,
		type_paiement text not null,
		active boolean default true,
		desc_type_paiement text
	)engine = InnoDB
Default charset = 'UTf8';
insert into type_paiement(type_paiement) values ("Mobile-banking: Mvola/Orange Money");
insert into type_paiement(type_paiement) values ("Western Union");
insert into type_paiement(type_paiement) values ("Moneygram");
insert into type_paiement(type_paiement) values ("Vanilla Pay");
insert into type_paiement(type_paiement) values ("Unex");
insert into type_paiement(type_paiement) values ("Virement bancaire");

create or replace view details_type_paiement as
select 
id_type_paiement,
type_paiement,
desc_type_paiement,
active as is_active,

case 
	when active = 1 then "Activé"
	else "Désactivé"
	end as active
from type_paiement;

-- drop table type_paiement;

-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa



create table commande
	(
		id_commande int unsigned auto_increment primary key,

		id_tarif int unsigned not null,
		id_langue_text int unsigned,
		nb_mot int unsigned not null,
		mot_cle text not null,
		titre_commande text not null,
		remarque text default null,

		nom_user varchar(125) not null,
		nom_entreprise varchar(75) default null,
		adresse varchar(75) default null,
		nom_pays varchar(50) default null, 
		ville varchar(50) default null,
		region varchar(50),
		code_postal varchar(10) default null,
		num_TVA varchar(25) default null,
		modifiable boolean default true,

		date_commande date not null,
		date_commencement date default null,
		date_livraison date default null,

		id_etat_commande int unsigned default 1,
		id_type_paiement int unsigned not null,

		code_promo varchar(15) default null,
		reduction_fidelite decimal(18 , 8) default 0,
		reduction_promo decimal(18 , 8) default 0,

		id_user int unsigned,
		fidele int not null,
		prix_prestation decimal(18 , 8),

		foreign key (id_tarif) references tarif(id_tarif),
		foreign key (id_type_paiement) references type_paiement(id_type_paiement),
		foreign key (id_langue_text) references langue_text(id_langue_text),
		foreign key (id_etat_commande) references etat_commande(id_etat_commande),
		foreign key (id_user) references user(id_user)
	)engine = InnoDB
Default charset = 'UTf8';
-- ---------------------------------------------------------------------------------------MBOLA TSY TAFIDITRA---------------------------------------------------------------------------------------------------

-- alter table commande add reduction_fidelite decimal(18 , 8) default 0;
-- alter table commande add reduction_promo decimal(18 , 8) default 0;
-- alter table commande add fidele int not null;
-- ---------------------------------------------------------------------------------------MBOLA TSY TAFIDITRA---------------------------------------------------------------------------------------------------

-- drop table commande;


create or replace view details_commande as 
select 
commande.id_commande as id_commande , 

tarif.id_tarif as id_tarif ,
tarif.type_redacteur as type_redacteur ,
tarif.type_text as type_text ,
tarif.prix_par_mot as prix_par_mot ,

langue_text.id_langue_text as id_langue_text ,
langue_text.langue_text as langue_text ,

commande.mot_cle as mot_cle ,
commande.nb_mot as nb_mot ,
commande.titre_commande as titre_commande,
commande.remarque as remarque ,
commande.nom_user as nom_user ,
commande.nom_entreprise as nom_entreprise ,
commande.adresse as adresse ,
commande.nom_pays as nom_pays , 
commande.ville as ville ,
commande.region as region ,
commande.code_postal as code_postal ,
commande.num_TVA as num_TVA ,
commande.date_commande as date_commande ,
commande.date_commencement as date_commencement ,
commande.date_livraison as date_livraison , 
commande.code_promo as code_promo ,
commande.prix_prestation as prix_prestation ,
commande.modifiable as modifiable ,

commande.reduction_promo as reduction_promo ,
commande.reduction_fidelite as reduction_fidelite ,
commande.fidele as fidele ,


etat_commande.id_etat_commande as id_etat_commande ,
etat_commande.etat_commande as etat_commande ,

user.id_user as id_user ,
user.mail_user as mail_user ,

type_paiement.id_type_paiement as id_type_paiement,
type_paiement.type_paiement as type_paiement

from commande
join tarif on tarif.id_tarif = commande.id_tarif
join langue_text on langue_text.id_langue_text = commande.id_langue_text
join etat_commande on etat_commande.id_etat_commande = commande.id_etat_commande
join type_paiement on type_paiement.id_type_paiement = commande.id_type_paiement
join user on user.id_user = commande.id_user;


-- insert into etat_commande(etat_commande) values('En attente de validation du site');
-- insert into etat_commande(etat_commande) values('En cours de rédaction');
-- insert into etat_commande(etat_commande) values('Livrée');
-- insert into etat_commande(etat_commande) values('Echouée');

---------------------------------------------------------------------MBOLA TSY VITA--------------------------------------------------------------------------------------
create or replace view nb_commande_user as 
select
id_user , id_etat_commande , etat_commande , count(id_commande) as nb_commande from details_commande where modifiable = 0 group by id_etat_commande , id_user;


create or replace view nb_commande_etat as
select
id_etat_commande , etat_commande , count(id_commande) as nb_commande from details_commande where modifiable = 0 group by id_etat_commande ;

create or replace view nb_commande_tarif as
select
id_tarif , type_redacteur , type_text , sum(prix_prestation) as prix_prestation , count(id_commande) as nb_commande from details_commande where modifiable = 0 group by id_tarif ;

-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa




create table facture
	(
		id_facture int unsigned auto_increment primary key,
		date_facturation date not null,
		date_livraison date default null,
		id_commande int unsigned not null,
		payee boolean default false,
		id_user int unsigned not null,
		foreign key (id_commande) references commande(id_commande),
		foreign key (id_user) references user(id_user)
	)engine = InnoDB
Default charset = 'UTf8';

create or replace view details_facture as 
select 

facture.id_facture as id_facture,
facture.date_facturation as date_facturation,
facture.date_livraison as date_livraison,
facture.payee as payee,
facture.id_user as id_user,

case 
	when payee = 0 then "Non payée"
	else "Payée"
	end as etat_facture, 

details_commande.id_commande as id_commande,
details_commande.prix_prestation as prix_prestation,
details_commande.id_type_paiement as id_type_paiement,
details_commande.type_paiement as type_paiement

from facture 
join details_commande on details_commande.id_commande = facture.id_commande;


-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

-- ETO ZAO

create table commentaire
	(
		id_commentaire int unsigned auto_increment primary key,
		commentaire text not null,
		id_user int unsigned,
		id_commande int unsigned,
		fichier varchar(50) default null,
		date_commentaire timestamp default current_timestamp,
		foreign key (id_user) references user(id_user),
		foreign key (id_commande) references commande(id_commande)
	)engine = InnoDB
Default charset = 'UTf8';



create or replace view details_commentaire as
select 
commentaire.id_commentaire as id_commentaire,
commentaire.commentaire as commentaire,
commentaire.id_commande as id_commande,
 
case 
	when commentaire.fichier = null then ""
	else commentaire.fichier
	end as fichier,

commentaire.date_commentaire as date_commentaire,

commentaire.id_user as id_user,
user.nom_user as nom_user,
user.id_user_type as id_user_type

from commentaire join user  on user.id_user = commentaire.id_user order by date_commentaire asc;