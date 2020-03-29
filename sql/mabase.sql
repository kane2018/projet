drop table if exists AnneeAcademique;

drop table if exists Classe;

drop table if exists Eleve;

drop table if exists Evaluation;

drop table if exists Matiere;

drop table if exists Note;

drop table if exists Parent;

drop table if exists Professeur;

drop table if exists Serie;

drop table if exists Surveillant;

drop table if exists Utilisateur;

drop table if exists association10;

drop table if exists association11;

drop table if exists association13;

drop table if exists association8;

/*==============================================================*/
/* Table : AnneeAcademique                                      */
/*==============================================================*/
create table AnneeAcademique
(
   idAnnee              int,
   libelle              varchar(254),
   encours              int
);

/*==============================================================*/
/* Table : Classe                                               */
/*==============================================================*/
create table Classe
(
   idClasse             int not null,
   nom                  varchar(254),
   primary key (idClasse)
);

/*==============================================================*/
/* Table : Eleve                                                */
/*==============================================================*/
create table Eleve
(
   idUser               int not null,
   Par_idUser           int not null,
   dateNaissance        varchar(254),
   lieuNaissance        varchar(254),
   primary key (idUser)
);

/*==============================================================*/
/* Table : Evaluation                                           */
/*==============================================================*/
create table Evaluation
(
   idEva                int,
   type                 varchar(254)
);

/*==============================================================*/
/* Table : Matiere                                              */
/*==============================================================*/
create table Matiere
(
   idMat                int,
   nomMat               varchar(254)
);

/*==============================================================*/
/* Table : Note                                                 */
/*==============================================================*/
create table Note
(
   idUser               int not null,
   idNote               int,
   note                 float,
   justification        varchar(254)
);

/*==============================================================*/
/* Table : Parent                                               */
/*==============================================================*/
create table Parent
(
   idUser               int not null,
   profession           varchar(254),
   primary key (idUser)
);

/*==============================================================*/
/* Table : Professeur                                           */
/*==============================================================*/
create table Professeur
(
   idUser               int not null,
   matricule            varchar(254),
   primary key (idUser)
);

/*==============================================================*/
/* Table : Serie                                                */
/*==============================================================*/
create table Serie
(
   idSerie              int,
   nomSerie             varchar(254)
);

/*==============================================================*/
/* Table : Surveillant                                          */
/*==============================================================*/
create table Surveillant
(
   idUser               int not null,
   grade                varchar(254),
   primary key (idUser)
);

/*==============================================================*/
/* Table : Utilisateur                                          */
/*==============================================================*/
create table Utilisateur
(
   idUser               int not null,
   prenom               varchar(254),
   nom                  varchar(254),
   telephone            varchar(254),
   adresse              varchar(254),
   email                varchar(254),
   login                varchar(254),
   mdp                  varchar(254),
   primary key (idUser)
);

/*==============================================================*/
/* Table : association10                                        */
/*==============================================================*/
create table association10
(
   idUser               int not null,
   idClasse             int not null,
   valide               bool,
   primary key (idUser, idClasse)
);

/*==============================================================*/
/* Table : association11                                        */
/*==============================================================*/
create table association11
(
   idUser               int not null,
   attribut1            int,
   primary key (idUser)
);

/*==============================================================*/
/* Table : association13                                        */
/*==============================================================*/
create table association13
(
   idUser               int not null,
   valide               bool,
   primary key (idUser)
);

/*==============================================================*/
/* Table : association8                                         */
/*==============================================================*/
create table association8
(
   coefficient          int
);

alter table Classe add constraint FK_association3 foreign key ()
      references Serie on delete restrict on update restrict;

alter table Classe add constraint FK_association9 foreign key ()
      references AnneeAcademique on delete restrict on update restrict;

alter table Eleve add constraint FK_Generalisation_1 foreign key (idUser)
      references Utilisateur (idUser) on delete restrict on update restrict;

alter table Eleve add constraint FK_association2 foreign key (Par_idUser)
      references Parent (idUser) on delete restrict on update restrict;

alter table Evaluation add constraint FK_association14 foreign key ()
      references association8 on delete restrict on update restrict;

alter table Note add constraint FK_association1 foreign key ()
      references Evaluation on delete restrict on update restrict;

alter table Note add constraint FK_association12 foreign key (idUser)
      references Eleve (idUser) on delete restrict on update restrict;

alter table Parent add constraint FK_Generalisation_2 foreign key (idUser)
      references Utilisateur (idUser) on delete restrict on update restrict;

alter table Professeur add constraint FK_Generalisation_3 foreign key (idUser)
      references Utilisateur (idUser) on delete restrict on update restrict;

alter table Surveillant add constraint FK_Generalisation_4 foreign key (idUser)
      references Utilisateur (idUser) on delete restrict on update restrict;

alter table association10 add constraint FK_association10 foreign key (idClasse)
      references Classe (idClasse) on delete restrict on update restrict;

alter table association10 add constraint FK_association10 foreign key (idUser)
      references Eleve (idUser) on delete restrict on update restrict;

alter table association11 add constraint FK_association11 foreign key ()
      references Matiere on delete restrict on update restrict;

alter table association11 add constraint FK_association11 foreign key (idUser)
      references Professeur (idUser) on delete restrict on update restrict;

alter table association13 add constraint FK_association13 foreign key (idUser)
      references Eleve (idUser) on delete restrict on update restrict;

alter table association13 add constraint FK_association13 foreign key ()
      references association8 on delete restrict on update restrict;

alter table association8 add constraint FK_association8 foreign key ()
      references Matiere on delete restrict on update restrict;

alter table association8 add constraint FK_association8 foreign key ()
      references Serie on delete restrict on update restrict;
