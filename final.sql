drop database if exists midterm;

create database midterm;

use midterm;

/* PowerDesigner Begins Here **/
drop table if exists evaluation;

drop table if exists loginAttempt;

drop table if exists members;

drop table if exists students;

drop table if exists teachers;

drop table if exists teams;

/*==============================================================*/
/* Table: evaluation                                            */
/*==============================================================*/
create table evaluation
(
   teacher_id           char(23) not null,
   teams_id             int(11) not null,
   score                decimal(5,2),
   primary key (teacher_id, teams_id)
);

/*==============================================================*/
/* Table: loginAttempt                                          */
/*==============================================================*/
create table loginAttempt
(
   ID      int(11) not null auto_increment,
   Username varchar(65) default null,
   IP                   varchar(20) not null,
   LastLogin            datetime not null,
   Attempts             int(11) not null,
   primary key (ID)
);

/*==============================================================*/
/* Table: members                                               */
/*==============================================================*/
create table members
(
   id                   char(23) not null,
   username             varchar(65) not null default '',
   password             varchar(65) not null default '',
   email                varchar(65) not null,
   verified             tinyint(1) not null default '0',
   mod_timestamp        timestamp not null default current_timestamp on update current_timestamp,
   teacher_status       bool not null default '0',
   primary key (id)
);

/*==============================================================*/
/* Index: username_UN                                           */
/*==============================================================*/
create unique index username_UN on members
(
   username
);

/*==============================================================*/
/* Index: email_UN                                              */
/*==============================================================*/
create unique index email_UN on members
(
   email
);

/*==============================================================*/
/* Table: students                                              */
/*==============================================================*/
create table students
(
   id                   char(23) not null,
   teams_id             int(11),
   students_name        varchar(65),
   students_tel         varchar(11),
   primary key (id)
);

/*==============================================================*/
/* Table: teachers                                              */
/*==============================================================*/
create table teachers
(
   id                   char(23) not null,
   teachers_name        varchar(65),
   teachers_tel         varchar(11),
   primary key (id)
);

/*==============================================================*/
/* Table: teams                                                 */
/*==============================================================*/
create table teams
(
   teams_id             int(11) not null auto_increment,
   captain_id           char(23) not null,
   player_id            char(23) not null,
   product              varchar(1023) not null default '',
   avgscore             decimal(5,2),
   primary key (teams_id)
);

alter table evaluation add constraint FK_gives_score foreign key (teacher_id)
      references teachers (id) on delete restrict on update cascade;

alter table evaluation add constraint FK_has_score foreign key (teams_id)
      references teams (teams_id) on delete restrict on update cascade;

alter table students add constraint FK_is_student foreign key (id)
      references members (id) on delete restrict on update cascade;

alter table students add constraint FK_is_team foreign key (teams_id)
      references teams (teams_id) on delete restrict on update cascade;

alter table teachers add constraint FK_is_teacher foreign key (id)
      references members (id) on delete restrict on update cascade;

alter table teams add constraint FK_is_captain foreign key (captain_id)
      references students (id) on delete restrict on update cascade;

alter table teams add constraint FK_is_player foreign key (player_id)
      references students (id) on delete restrict on update cascade;
/* PowerDesigner ends here **/

CREATE OR REPLACE VIEW V_UP_EVAL AS SELECT evaluation.*, teams.product FROM evaluation INNER JOIN teams ON evaluation.teams_id = teams.teams_id;
GRANT ALL ON * TO 'cgi-secure'@'localhost';
GRANT SELECT, UPDATE (students_name, students_tel) ON students TO 'cgi-student'@'localhost';
GRANT SELECT, UPDATE (teachers_name, teachers_tel) ON teachers TO 'cgi-teacher'@'localhost';
GRANT SELECT, UPDATE (product) ON teams	TO 'cgi-student'@'localhost';
GRANT SELECT, UPDATE (score) ON V_UP_EVAL TO 'cgi-teacher'@'localhost';

create trigger create_evaluation_teams after insert on teams
   for each row
   insert into evaluation(teacher_id, teams_id)
		select id, NEW.teams_id from teachers;

create trigger create_evaluation_teachers after insert on teachers
	for each row
	insert into evaluation(teacher_id, teams_id)
		select NEW.id, teams_id from teams;

delimiter //

create procedure sort()
begin
		update teams inner join (select teams_id, avg(score) as ascore from evaluation group by teams_id) ev on teams.teams_id = ev.teams_id
			set teams.avgscore = ev.ascore;
		select * from teams order by avgscore desc;
end

//

delimiter ;

