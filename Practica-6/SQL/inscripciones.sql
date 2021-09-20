create table inscripciones
(
	nIdInscripcion int auto_increment
		primary key,
	nIdClase int not null,
	nIdAlumno int not null,
	constraint nIdAlumno
		foreign key (nIdAlumno) references alumnos (nIdAlumno)
			on delete cascade,
	constraint nIdClase_fk_inscripciones
		foreign key (nIdClase) references clases (nIdClase)
			on delete cascade
);

