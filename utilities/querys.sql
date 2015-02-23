#Que porcentaje de una patologia A ha presentado complicaciones?
#Numero de procedimientos de una patologia
SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia INNER JOIN relepisodioprocedimiento on 
episodios.id_episodio = relepisodioprocedimiento.id_episodio INNER JOIN procedimientos ON relepisodioprocedimiento.id_procedimiento = 
procedimientos.id_procedimiento WHERE patologias.nombre = 'Ejemplo Patologia';
#Numero de procediciemntos con complicaciones de una patologia
SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia INNER JOIN relepisodioprocedimiento on 
episodios.id_episodio = relepisodioprocedimiento.id_episodio INNER JOIN procedimientos ON relepisodioprocedimiento.id_procedimiento = 
procedimientos.id_procedimiento INNER JOIN relcomplicacionprocedimiento ON procedimientos.id_procedimiento = 
relcomplicacionprocedimiento.id_procedimiento WHERE patologias.nombre = 'Ejemplo Patologia';

#Que porcentaje/num de pacientes con una patologia A presentaban factores de riesgo?
#Total de pacientes con una patologia
SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia INNER JOIN pacientes ON 
episodios.numeroHistorial = pacientes.numeroHistorial WHERE patologias.nombre = 'Ejemplo Patologia';
#Numero de pacientes con factores de riesgo de una patologia
SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia INNER JOIN pacientes ON 
episodios.numeroHistorial = pacientes.numeroHistorial INNER JOIN relpacientefactor ON pacientes.numeroHistorial = relpacientefactor.numeroHistorial
WHERE patologias.nombre = 'Ejemplo Patologia';

#Edad media de pacientes con una patologia
SELECT AVG(pacientes.edad) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia INNER JOIN pacientes ON 
episodios.numeroHistorial = pacientes.numeroHistorial WHERE patologias.nombre = 'Ejemplo Patologia';

#Porcentaje de varones/ mujeres con una determinada patologia
#Total pacientes con una patologia (arriba)
#Total de pacientes con una patologia que sean hombre o mujer
SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia INNER JOIN pacientes ON 
episodios.numeroHistorial = pacientes.numeroHistorial WHERE patologias.nombre = 'Ejemplo Patologia' AND pacientes.sexo = 'H';

#Cuantos pacientes con una patologia A han muerto en un periodo de 30 dias?
SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia INNER JOIN relepisodioprocedimiento on 
episodios.id_episodio = relepisodioprocedimiento.id_episodio INNER JOIN procedimientos ON relepisodioprocedimiento.id_procedimiento = 
procedimientos.id_procedimiento INNER JOIN relcomplicacionprocedimiento ON procedimientos.id_procedimiento = 
relcomplicacionprocedimiento.id_procedimiento INNER JOIN complicaciones ON relcomplicacionprocedimiento.id_complicacion = 
complicaciones.id_complicacion WHERE patologias.nombre = 'Ejemplo Patologia' AND complicaciones.mortalidadTemprana = 'S';

#Cuantos pacientes con una patologia y un procedimiento concretos se han curado?
SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia INNER JOIN relepisodioprocedimiento on 
episodios.id_episodio = relepisodioprocedimiento.id_episodio INNER JOIN procedimientos ON relepisodioprocedimiento.id_procedimiento = 
procedimientos.id_procedimiento INNER JOIN relcomplicacionprocedimiento ON procedimientos.id_procedimiento = 
relcomplicacionprocedimiento.id_procedimiento INNER JOIN complicaciones ON relcomplicacionprocedimiento.id_complicacion = 
complicaciones.id_complicacion WHERE patologias.nombre = 'Ejemplo Patologia' AND procedimientos.nombre = 'Ejemplo Procedimiento' 
AND complicaciones.mortalidadTemprana = 'N' AND complicaciones.mortalidadTardia = 'N';