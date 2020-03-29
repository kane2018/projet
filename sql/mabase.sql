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

drop table if exists inscription;

drop table if exists profmatiere;

drop table if exists pedagogie;

drop table if exists matiereserie;

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
/* Table : inscription                                        */
/*==============================================================*/
create table inscription
(
   idUser               int not null,
   idClasse             int not null,
   valide               bool,
   primary key (idUser, idClasse)
);

/*==============================================================*/
/* Table : profmatiere                                        */
/*==============================================================*/
create table profmatiere
(
   idUser               int not null,
   idMat int,
   idUser int,
   statut            int,
   primary key (idUser)
);

/*==============================================================*/
/* Table : pedagogie                                        */
/*==============================================================*/
create table pedagogie
(
   idUser               int not null,
   valide               bool,
   primary key (idUser)
);

/*==============================================================*/
/* Table : matiereserie                                         */
/*==============================================================*/
create table matiereserie
(
   idMatSerie int not null,
   idMat int,
   idSerie int,
   coefficient          int
);

alter table Classe add constraint FK_classeserie foreign key (idSerie)
      references Serie on delete restrict on update restrict;

alter table Classe add constraint FK_classeannee foreign key (idAnnee)
      references AnneeAcademique on delete restrict on update restrict;

alter table Eleve add constraint FK_Generalisation_1 foreign key (idUser)
      references Utilisateur (idUser) on delete restrict on update restrict;

alter table Eleve add constraint FK_parenteleve foreign key (Par_idUser)
      references Parent (idUser) on delete restrict on update restrict;

alter table Evaluation add constraint FK_evamatserie foreign key (idMatSerie)
      references matiereserie on delete restrict on update restrict;

alter table Note add constraint FK_evanote foreign key (idEva)
      references Evaluation on delete restrict on update restrict;

alter table Note add constraint FK_elevenote foreign key (idUser)
      references Eleve (idUser) on delete restrict on update restrict;

alter table Parent add constraint FK_userparent foreign key (idUser)
      references Utilisateur (idUser) on delete restrict on update restrict;

alter table Professeur add constraint FK_userprof foreign key (idUser)
      references Utilisateur (idUser) on delete restrict on update restrict;

alter table Surveillant add constraint FK_usersurv foreign key (idUser)
      references Utilisateur (idUser) on delete restrict on update restrict;

alter table inscription add constraint FK_inscriptionclasse foreign key (idClasse)
      references Classe (idClasse) on delete restrict on update restrict;

alter table inscription add constraint FK_inscriptioneleve foreign key (idUser)
      references Eleve (idUser) on delete restrict on update restrict;

alter table profmatiere add constraint FK_profmatiere foreign key (idMat)
      references Matiere on delete restrict on update restrict;

alter table profmatiere add constraint FK_matiereprof foreign key (idUser)
      references Professeur (idUser) on delete restrict on update restrict;

alter table pedagogie add constraint FK_pedagogieeleve foreign key (idUser)
      references Eleve (idUser) on delete restrict on update restrict;

alter table pedagogie add constraint FK_pedagogiematiere foreign key (idMatSerie)
      references matiereserie on delete restrict on update restrict;

alter table matiereserie add constraint FK_seriematiere foreign key (idMat)
      references Matiere on delete restrict on update restrict;

alter table matiereserie add constraint FK_matiereserie foreign key (idSerie)
      references Serie on delete restrict on update restrict;
