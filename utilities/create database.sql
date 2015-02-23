CREATE DATABASE `radiologia` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE TABLE radiologia.radiologos (
	id_radiologo int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre varchar(100) NOT NULL
);

CREATE TABLE radiologia.pacientes (
	id_paciente int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	numeroHistorial varchar(100) NOT NULL, 
	nombre varchar(100) NOT NULL, 
	fechaNacimiento DATE NOT NULL, 
	sexo char (1), 
	enfermedadesConocidas varchar(500), 
	edad int, 
	edadConsulta int
);

CREATE TABLE radiologia.factoresDeRiesgo (
	id_factor int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre varchar(100) NOT NULL
);

CREATE TABLE radiologia.materiales (
	id_material int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre varchar(100) NOT NULL
);

CREATE TABLE radiologia.servicios (
	id_servicio int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre varchar(100) NOT NULL
);

CREATE TABLE radiologia.centros (
	id_centro int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre varchar(100) NOT NULL
);

CREATE TABLE radiologia.tipo_procedimiento (
	id_tipop int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre varchar(100) NOT NULL
);

CREATE TABLE radiologia.patologias (
	id_patologia int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre varchar(100) NOT NULL
);

CREATE TABLE radiologia.episodios (
	id_episodio int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre varchar(100) NOT NULL,
	fecha date NOT NULL,
	id_paciente int NOT NULL, 
	id_servicio int NOT NULL, 
	id_centro int NOT NULL, 
	id_patologia int NOT NULL, 
	FOREIGN KEY (id_paciente) REFERENCES pacientes(id_paciente) ON UPDATE CASCADE ON DELETE CASCADE, 
	FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio) ON UPDATE CASCADE ON DELETE CASCADE, 
	FOREIGN KEY (id_centro) REFERENCES centros(id_centro) ON UPDATE CASCADE ON DELETE CASCADE, 
	FOREIGN KEY (id_patologia) REFERENCES patologias(id_patologia) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE radiologia.diagnosticos (
	id_diagnostico int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre varchar(100) NOT NULL, 
	id_episodio int NOT NULL, 
	FOREIGN KEY (id_episodio) REFERENCES episodios(id_episodio) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE radiologia.pruebasDiagnosticas (
	id_pdiagnostica int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre varchar(100) NOT NULL, 
	id_radiologo int, 
	FOREIGN KEY (id_radiologo) REFERENCES radiologos(id_radiologo) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE radiologia.evoluciones (
	id_evolucion int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	resultado varchar(100), 
	notas VARCHAR (500)
);

CREATE TABLE radiologia.complicaciones (
	id_complicacion int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre varchar(100) NOT NULL, 
	mortalidadTemprana char(1), 
	mortalidadTardia char(1)
);

CREATE TABLE radiologia.procedimientos (
	id_procedimiento int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	id_tipop int, 
	id_evolucion int, 
	FOREIGN KEY (id_evolucion) REFERENCES evoluciones(id_evolucion) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (id_tipop) REFERENCES tipo_procedimiento(id_tipop) ON UPDATE CASCADE ON DELETE CASCADE	
);

CREATE TABLE radiologia.imagenes_pdiagnostica (
	id_imagen int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	image_name varchar(100) NOT NULL, 
	image LONGBLOB NOT NULL, 
	id_pdiagnostica int NOT NULL, 
	FOREIGN KEY (id_pdiagnostica) REFERENCES pruebasDiagnosticas(id_pdiagnostica) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE radiologia.imagenes_procedimiento (
	id_imagen int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	image_name varchar(100) NOT NULL, 
	image LONGBLOB NOT NULL, 
	id_procedimiento int NOT NULL, 
	FOREIGN KEY (id_procedimiento) REFERENCES procedimientos(id_procedimiento) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE radiologia.documentos_procedimiento (
	id_doc int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	doc_name varchar(100) NOT NULL, 
	doc LONGBLOB NOT NULL, 
	id_procedimiento int NOT NULL, 
	FOREIGN KEY (id_procedimiento) REFERENCES procedimientos(id_procedimiento) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE radiologia.relProcedimientoMaterial (
	id_procedimiento int NOT NULL, 
	id_material int NOT NULL, 
	PRIMARY KEY (id_procedimiento,id_material), 
	FOREIGN KEY (id_procedimiento) REFERENCES procedimientos(id_procedimiento) ON UPDATE CASCADE ON DELETE CASCADE, 
	FOREIGN KEY (id_material) REFERENCES materiales(id_material) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE radiologia.relEpisodioProcedimiento (
	id_episodio int NOT NULL, 
	id_procedimiento int NOT NULL, 
	PRIMARY KEY(id_episodio,id_procedimiento),
	FOREIGN KEY (id_procedimiento) REFERENCES procedimientos(id_procedimiento) ON UPDATE CASCADE ON DELETE CASCADE, 
	FOREIGN KEY (id_episodio) REFERENCES episodios(id_episodio) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE radiologia.relComplicacionProcedimiento (
	id_procedimiento int NOT NULL, 
	id_complicacion int NOT NULL, 
	PRIMARY KEY(id_procedimiento,id_complicacion),
	FOREIGN KEY (id_procedimiento) REFERENCES procedimientos(id_procedimiento) ON UPDATE CASCADE ON DELETE CASCADE, 
	FOREIGN KEY (id_complicacion) REFERENCES complicaciones(id_complicacion) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE radiologia.relPacienteFactor (
	id_paciente int NOT NULL, 
	id_factor int NOT NULL, 
	PRIMARY KEY (id_paciente,id_factor), 
	FOREIGN KEY (id_paciente) REFERENCES pacientes(id_paciente) ON UPDATE CASCADE ON DELETE CASCADE, 
	FOREIGN KEY (id_factor) REFERENCES factoresDeRiesgo(id_factor) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE radiologia.relEpisodioPdiagnostica (
	id_episodio int NOT NULL, 
	id_pdiagnostica int NOT NULL, 
	PRIMARY KEY (id_episodio,id_pdiagnostica), 
	FOREIGN KEY (id_episodio) REFERENCES episodios(id_episodio) ON UPDATE CASCADE ON DELETE CASCADE, 
	FOREIGN KEY (id_pdiagnostica) REFERENCES pruebasDiagnosticas(id_pdiagnostica) ON UPDATE CASCADE ON DELETE CASCADE
);


-- Insert de ejemplo
INSERT INTO radiologia.radiologos VALUES(NULL,'john Doe');
INSERT INTO radiologia.pacientes VALUES(NULL,'28AS','Mr james','2014-01-01','H','Ninguna enfermedad',32,32);
INSERT INTO radiologia.materiales VALUES(NULL,'Ejemplo Material');
INSERT INTO radiologia.servicios VALUES(NULL,'Ejemplo Servicio');
INSERT INTO radiologia.centros VALUES(NULL,'Ejemplo Centro');
INSERT INTO radiologia.patologias VALUES(NULL,'Ejemplo Patologia');
INSERT INTO radiologia.evoluciones VALUES(NULL,'Ejemplo Resultado','Ejemplo Notas');
INSERT INTO radiologia.complicaciones VALUES(NULL,'Ejemplo Complicacion','N','N');
INSERT INTO radiologia.factoresDeRiesgo VALUES(NULL, 'Fumador');
INSERT INTO radiologia.tipo_procedimiento VALUES(NULL,'Procedimiento de ejemplo');

-- PACIENTE SERVICIO Y CENTRO
SET @last_id_paciente := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.pacientes);
SET @last_id_servicio := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.servicios);
SET @last_id_centro := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.centros);
SET @last_id_patologia := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.patologias);
INSERT INTO radiologia.episodios VALUES(NULL,'Ejemplo Episodio','2014-01-01',@last_id_paciente,@last_id_servicio,@last_id_centro, @last_id_patologia);

-- DIAGNOSTICO
SET @last_id_episodio := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.episodios);
INSERT INTO radiologia.diagnosticos VALUES(NULL,'Ejemplo Diagnostico',@last_id_episodio);

-- EPISODIO
SET @last_id_radiologo := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.radiologos);
INSERT INTO radiologia.pruebasDiagnosticas VALUES(NULL,'Ejemplo Pdiagn', @last_id_radiologo);

-- EVOLUCION
SET @last_id_evolucion := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.evoluciones);
SET @last_id_tipop := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.tipo_procedimiento);
INSERT INTO radiologia.procedimientos VALUES(NULL,@last_id_tipop,@last_id_evolucion);

-- PROCEDIMIENTO MATERIAL
SET @last_id_procedimiento := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.procedimientos);
SET @last_id_materiales := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.materiales);
INSERT INTO radiologia.relProcedimientoMaterial VALUES(@last_id_procedimiento,@last_id_materiales);

-- EPISODIO PROCEDIMIENTO
SET @last_id_episodio := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.episodios);
SET @last_id_procedimiento := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.procedimientos);
INSERT INTO radiologia.relEpisodioProcedimiento VALUES(@last_id_episodio,@last_id_procedimiento);

-- PROCEDIMIENTO COMPLICACION
SET @last_id_procedimiento := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.procedimientos);
SET @last_id_complicacion := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.complicaciones);
INSERT INTO radiologia.relComplicacionProcedimiento VALUES(@last_id_procedimiento,@last_id_complicacion);

-- PACIENTE FACTOR
SET @last_numero_historial := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.pacientes);
SET @last_id_factor := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.factoresDeRiesgo);
INSERT INTO radiologia.relPacienteFactor VALUES(@last_numero_historial,@last_id_factor);

-- PDIAGNOSTICA EPISODIO
SET @last_id_episodio := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.episodios);
SET @last_id_pdiagnostica := (SELECT DISTINCT LAST_INSERT_ID() FROM radiologia.pruebasDiagnosticas);
INSERT INTO radiologia.relEpisodioPdiagnostica VALUES(@last_id_episodio, @last_id_pdiagnostica);