<?php 
	$title = 'Instagru | Connexion';
	ob_start();
?>

<div class="container">
	<h1 class="title">Connectez-vous</h1>
	<hr>
	<p>Ici la petite connexion !!</p>
</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>