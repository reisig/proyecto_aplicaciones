
create table asignatura(
	id int not null,
	nombre varchar(30),
	rut_profersor varchar(30),
	primary key(id)
);

/*usuarios.tipo: ADMINISTRADOR, PROFESOR, ALUMNO*/
create table usuarios(
	rut varchar(12) not null,
	nombre varchar(20), 
	apellidop varchar(20), 
	apellidom varchar(20), 
	pass varchar(20), 
	correo varchar(20), 
	tipo varchar(15),
	primary key(rut)
);
			
/*guias.estado: ACTIVA, INACTIVA*/
create table guias(
	id int not null,
	titulo varchar(30),
	descripcion text,
	fecha date,
	id_asignatura int,
	estado varchar(10),
	primary key(id),
	foreign key(id_asignatura) references asignatura(id)
);			
			
create table usuario_asignatura(
	rut_usuario varchar(12) not null,
	id_asignatura int,
	foreign key(rut_usuario) references usuarios(rut),
	foreign key(id_asignatura) references asignatura(id)
);
			
create table repositorio(
    id MEDIUMINT NOT NULL AUTO_INCREMENT,
	ruta varchar(50) not null,
	rut_alumno varchar(12),
	descripcion text,
	tincion varchar(30),
	diametro int,
	aumento int,
	ruta_dibujo varchar(50),
	fecha date,
	primary key(id),
	foreign key(rut_alumno) references usuarios(rut)
);

/*preguntas.tipo_respuesta: TITULO, TEXTO, AREA, MULTIPLE*/
create table preguntas(
	id int not null,
	id_guia int,
	enunciado text,
	tipo_respuesta text,
	primary key(id),
	foreign key(id_guia) references guias(id) on delete cascade
);

/*seleccion_multiple.tipo: CHECKBOX, RADIO o LISTA*/
create table seleccion_multiple(
	id_pregunta int not null,
	valor_alternativa varchar(30),
	tipo varchar(15),
	foreign key(id_pregunta) references preguntas(id) on delete cascade
);

create table respuesta(
	id_pregunta int not null,
	id_guia int,
	respuesta text,
	fecha date,
	rut_usuario varchar(12),
	foreign key(id_guia) references guias(id) on delete cascade,
	foreign key(id_pregunta) references preguntas(id) on delete cascade,
	foreign key(rut_usuario) references usuarios(rut) on delete cascade
);