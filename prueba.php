<?php
	include '/services/documentosService.php';
	$image = get_by_id_documento(4, 'img_pd');
	// header('Content-Type: image/jpeg');
	// echo $image['image'];
?>
<html>
	<body>
		<img src="data:image/jpg;base64,<?php echo base64_encode($image['image']); ?>" />
	</body>
</html>