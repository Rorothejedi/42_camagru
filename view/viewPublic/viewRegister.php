<?php 
	$title = 'Instagru | Inscription';
	ob_start();
?>

<div class="container">
	<h1 class="title">Inscrivez-vous...</h1>
	<p class="details">... pour prendre vos propres photos, faire vos propres montages et les partager avec les autres utilisateurs ! <br>Vous pourrez également liker et commenter leurs photos !</p>
	<hr>
	<p>Ici la petite inscription !!</p>
</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>