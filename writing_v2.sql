
create database writing_v2;

_______________________________________________________________________________________________________________________________________________________________________

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

_______________________________________________________________________________________________________________________________________________________________________

create table user_type
	(
		id_user_type int unsigned auto_increment primary key,
		user_type varchar(15) not null
	)engine = InnoDB
Default charset = 'UTf8';

insert into user_type( user_type ) values ( "Administrateur" );
insert into user_type( user_type ) values ( "Client" ); 
insert into user_type( user_type ) values ( "Rédaction" ); 

_______________________________________________________________________________________________________________________________________________________________________

create table langue_text
	(
		id_langue_text int unsigned auto_increment primary key,
		langue_text varchar(25) not null,
		activee boolean default true
	)engine = InnoDB
Default charset = 'UTf8';

insert into langue_text( id_langue_text ) values('Français');
insert into langue_text( id_langue_text ) values('Anglais');

_______________________________________________________________________________________________________________________________________________________________________

create table type_redacteur
	(
		id_type_redacteur int unsigned auto_increment primary key,
		type_redacteur text default null,
		desc_redacteur text default null,
		activee boolean default true
	)engine = InnoDB
Default charset = 'UTf8';

insert into type_redacteur( type_redacteur , desc_redacteur ) values('Rédacteur junior' , 
'Rédacteur débutant (expérience de moins d\’un an), affecté aux tâches de rédaction de publications sur réseaux sociaux, de rédactions de fiches-produits, d\’articles institutionnels et de blogs personnels.'
);
insert into type_redacteur( type_redacteur , desc_redacteur ) values('Rédacteur medium' ,
'Rédacteur expérimenté d\’un à deux ans, affecté aux tâches de rédaction de textes publicitaires et textes optimisés SEO sans balisage.'
);
insert into type_redacteur( type_redacteur , desc_redacteur ) values('Rédacteur senior' ,
'Rédacteur expérimenté de deux ans et plus, affecté aux tâches de rédaction de textes optimisés SEO avec balisage, textes informatifs, articles d\’investigations, articles créatifs (livres, ebooks, romans, etc…).'
);

_______________________________________________________________________________________________________________________________________________________________________

create table pays 
	(
		id_pays int unsigned auto_increment primary key,
		nom_pays varchar(50) not null
	)engine = InnoDB
Default charset = 'UTf8';


insert into pays(nom_pays) values ("Afghanistan");
insert into pays(nom_pays) values ("Afrique du Sud");
insert into pays(nom_pays) values ("Aland");
insert into pays(nom_pays) values ("Albanie");
insert into pays(nom_pays) values ("Algérie");
insert into pays(nom_pays) values ("Allemagne");
insert into pays(nom_pays) values ("Andorre");
insert into pays(nom_pays) values ("Angola");
insert into pays(nom_pays) values ("Anguilla");
insert into pays(nom_pays) values ("Antarctique");
insert into pays(nom_pays) values ("Antigua-et-Barbuda");
insert into pays(nom_pays) values ("Arabie saoudite");

_______________________________________________________________________________________________________________________________________________________________________

create table user
(
	id_user int unsigned auto_increment primary key,
	id_user_type int unsigned not null,

	nom_user text default null,
	mail_user text default null,
	mdp_user text default null,

	id_pays int unsigned default null,
	adresse text default null,
	ville text default null,
	region text default null,	

	pseudo_user text default null,
	nom_plume text default null,

	nom_entreprise text default null,
	num_eng_fiscal text default null,

	bio text default null,
	domaine_predilection text default null,

	id_langue_text int unsigned default null,

	tel_user text default null,
	whatsapp_user text default null,
	skype_user text default null,

	id_type_redacteur int unsigned default null,

	banni boolean default false,
	fidele boolean default false,
	reduction_fidelite decimal(18 , 8) default 0,

	date_reset_password timestamp null default null,
	date_inscri date not null,

	foreign key (id_user_type) references user_type(id_user_type),
	foreign key (id_pays) references pays(id_pays),
	foreign key (id_langue_text) references langue_text(id_langue_text),
	foreign key (id_type_redacteur) references type_redacteur(id_type_redacteur)

)engine = InnoDB
Default charset = 'UTf8';

v

create or replace view users_client as
select
	user.id_user as id_user,
	user_type.id_user_type as id_user_type,
	user_type.user_type as user_type,

	user.nom_user as nom_user,
	user.mail_user as mail_user,
	user.mdp_user as mdp_user,

	pays.id_pays as id_pays,
	pays.nom_pays as nom_pays,

	user.adresse as adresse,
	user.ville as ville,
	user.region as region,	

	user.pseudo_user as pseudo_user,
	user.nom_plume as nom_plume,

	user.nom_entreprise as nom_entreprise,
	user.num_eng_fiscal as num_eng_fiscal,

	user.bio as bio,
	user.domaine_predilection as domaine_predilection,

	user.tel_user as tel_user,
	user.whatsapp_user as whatsapp_user,
	user.skype_user as skype_user,
	user.banni as banni,
	user.fidele as fidele,
	user.reduction_fidelite as reduction_fidelite,

	user.date_reset_password as date_reset_password,
	user.date_inscri as date_inscri

	from user 
	join user_type on user.id_user_type = user_type.id_user_type
	join pays on user.id_pays = pays.id_pays  where user_type.id_user_type = 2;

create or replace view users_redacteur as
select
	user.id_user as id_user,
	user_type.id_user_type as id_user_type,
	user_type.user_type as user_type,

	user.nom_user as nom_user,
	user.mail_user as mail_user,
	user.mdp_user as mdp_user,

	pays.id_pays as id_pays,
	pays.nom_pays as nom_pays,

	user.adresse as adresse,
	user.ville as ville,
	user.region as region,	

	user.pseudo_user as pseudo_user,
	user.nom_plume as nom_plume,

	user.nom_entreprise as nom_entreprise,
	user.num_eng_fiscal as num_eng_fiscal,

	user.bio as bio,
	user.domaine_predilection as domaine_predilection,

	langue_text.id_langue_text as id_langue_text,
	case 
	when langue_text.id_langue_text = null then null
	else langue_text.langue_text
	end as langue_text,

	user.tel_user as tel_user,
	user.whatsapp_user as whatsapp_user,
	user.skype_user as skype_user,

	type_redacteur.id_type_redacteur as id_type_redacteur,
	case 
	when type_redacteur.id_type_redacteur = null then null
	else type_redacteur.type_redacteur
	end as type_redacteur,

	user.banni as banni,
	user.fidele as fidele,
	user.reduction_fidelite as reduction_fidelite,

	user.date_reset_password as date_reset_password,
	user.date_inscri as date_inscri

	from user 
	join user_type on user.id_user_type = user_type.id_user_type
	join pays on user.id_pays = pays.id_pays
	join langue_text on user.id_langue_text = langue_text.id_langue_text
	join type_redacteur on user.id_type_redacteur = type_redacteur.id_type_redacteur   where user_type.id_user_type = 3;
_______________________________________________________________________________________________________________________________________________________________________

create table type_paiement
	(
		id_type_paiement int unsigned auto_increment primary key,
		type_paiement text default null,
		active boolean default true,
		desc_type_paiement text default null
	)engine = InnoDB
Default charset = 'UTf8';

insert into type_paiement(type_paiement) values ("Mobile-banking: Mvola/Orange Money");
insert into type_paiement(type_paiement) values ("Western Union");
insert into type_paiement(type_paiement) values ("Moneygram");
insert into type_paiement(type_paiement) values ("Vanilla Pay");
insert into type_paiement(type_paiement) values ("Unex");
insert into type_paiement(type_paiement) values ("Virement bancaire");

_______________________________________________________________________________________________________________________________________________________________________

create table tarif
	(
		id_tarif int unsigned auto_increment primary key,
		id_type_redacteur  int unsigned not null,
		type_text text default null,
		active boolean default true,
		prix_par_mot decimal(18 , 8) not null,

		foreign key ( id_type_redacteur ) references type_redacteur( id_type_redacteur )
	)engine = InnoDB
Default charset = 'UTf8';

insert into tarif( id_type_redacteur , type_text , prix_par_mot) values( 1 , 'Rédaction de publications sur réseaux sociaux' , 35);
insert into tarif( id_type_redacteur , type_text , prix_par_mot) values( 1 , 'Rédactions de fiches-produits' , 35);
insert into tarif( id_type_redacteur , type_text , prix_par_mot) values( 1 , 'Articles institutionnels' , 35);
insert into tarif( id_type_redacteur , type_text , prix_par_mot) values( 1 , 'Blogs personnels' , 35);

insert into tarif( id_type_redacteur , type_text , prix_par_mot) values( 2 , 'Rédaction de textes publicitaires' , 60);
insert into tarif( id_type_redacteur , type_text , prix_par_mot) values( 2 , 'Textes optimisés SEO sans balisage' , 60);

insert into tarif( id_type_redacteur , type_text , prix_par_mot) values( 3 , 'Rédaction de textes optimisés SEO avec balisage' , 80);
insert into tarif( id_type_redacteur , type_text , prix_par_mot) values( 3 , 'Textes informatifs' , 80);
insert into tarif( id_type_redacteur , type_text , prix_par_mot) values( 3 , "Articles d’investigations" , 80);
insert into tarif( id_type_redacteur , type_text , prix_par_mot) values( 3 , 'Articles créatifs (livres, ebooks, romans, etc…)' , 80);

create or replace view tarifs as
select 
tarif.id_tarif as id_tarif,
tarif.type_text as type_text,
tarif.prix_par_mot as prix_par_mot,
tarif.active as is_active,

case 
	when active = 0 then "Désactivé"
	else "Activé"
	end as active,

type_redacteur.id_type_redacteur as id_type_redacteur,
type_redacteur.type_redacteur as type_redacteur

from tarif join type_redacteur  on tarif.id_type_redacteur = type_redacteur.id_type_redacteur group by id_tarif;
_______________________________________________________________________________________________________________________________________________________________________

create table etat_commande
	(
		id_etat_commande int unsigned auto_increment primary key,
		etat_commande text not null
	)engine = InnoDB
Default charset = 'UTf8';

insert into etat_commande(etat_commande) values('En attente de validation du site');
insert into etat_commande(etat_commande) values('Validé');
insert into etat_commande(etat_commande) values('En cours de rédaction');
insert into etat_commande(etat_commande) values('Livrée');
insert into etat_commande(etat_commande) values('Echouée');
insert into etat_commande(etat_commande) values('Annulée');

_______________________________________________________________________________________________________________________________________________________________________

create table commande
	(
		id_commande int unsigned auto_increment primary key,

		-- type de texte
		id_tarif int unsigned not null,

		id_user int unsigned not null,

		fidele int not null,
		reduction_fidelite decimal(18 , 8) default 0,

		nom_user text default null,
		mail_user text default null,
		nom_entreprise text default null,
		num_eng_fiscal text default null,

		id_langue_text int unsigned not null,

		cible text default null,
		ton text default null,

		titre text default null,
		intertitres text default null,

		nb_mots_paragraphe int unsigned not null,

		mot_cle_1 text default null,
		mot_cle_2 text default null,

		mise_en_forme text default null,

		meta_titre text default null,
		meta_desc text default null,

		balise text default null,

		remarques text default null,

		code_promo text default null,
		reduction_promo decimal(18 , 8) default 0,

		modifiable boolean default true,

		date_commande date not null,
		date_commencement date default null,
		date_livraison date default null,

		id_redacteur int unsigned default null, 

		id_etat_commande int unsigned default 1,

		id_type_paiement int unsigned not null,
		prix_prestation decimal(18 , 8),

		foreign key( id_tarif ) references tarif( id_tarif ),
		foreign key( id_user ) references user( id_user ),
		foreign key( id_langue_text ) references langue_text( id_langue_text ),
		foreign key( id_redacteur ) references user( id_user ),
		foreign key( id_etat_commande ) references etat_commande( id_etat_commande ),
		foreign key( id_type_paiement ) references type_paiement( id_type_paiement )
	)engine = InnoDB
Default charset = 'UTf8';

_______________________________________________________________________________________________________________________________________________________________________

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

_______________________________________________________________________________________________________________________________________________________________________

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

_______________________________________________________________________________________________________________________________________________________________________
-- insert into user(nom_user , mail_user , mdp_user , id_user_type ) values('Writing is Bae' , 'writingisbae7@gmail.com' , sha1('Writingisbaefoana*7') , 1 );

