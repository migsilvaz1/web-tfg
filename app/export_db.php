<?php
	$DB_USER = "radio-user";
	$DB_PASS = "radio";
	$DB_NAME = "radiologia";
	$command = "\"C:\\Program Files\\MySQL\\MySQL Server 5.6\\bin\\mysqldump.exe\" --opt --skip-extended-insert --complete-insert --user=".$DB_USER.
	" --password=".$DB_PASS." ".$DB_NAME." > C:\\xampp\\htdocs\\root\\docs\\radiologia.sql";
	exec($command, $ret_arr, $ret_code);
?>
<div>
	Se ha generado automaticamente el bolcado de la base de datos. Puede obtener el archivo en el siguiente enlace: <a href="/root/docs/radiologia.sql" download>Archivo</a>
</div>
