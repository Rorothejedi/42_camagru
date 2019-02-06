<?php 
	$title = 'Camagru | Galerie';
	ob_start();
?>


<!-- HTML ici -->
<p>view Gallery OK</p>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>