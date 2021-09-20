create table clases
(
	nIdClase int auto_increment
		primary key,
	nIdProfesor int not null,
	nIdMateria int not null,
	sHorario varchar(45) not null,
	constraint nIdMateria_fk_clases
		foreign key (nIdMateria) references materias (nIdMateria)
			on delete cascade,
	constraint nIdProfesor_fk_clases
		foreign key (nIdProfesor) references clases (nIdClase)
);

create index nIdMateria_fk_clases_idx
	on clases (nIdMateria);

create index nIdProfesor_fk_clases_idx
	on clases (nIdProfesor);

