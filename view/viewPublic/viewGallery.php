<?php 
	$title = 'Galerie';
	ob_start();
?>

<div class="container">
	<div id="alertNone"></div>
	<h1 class="title">Dernières photos postées</h1>
	<hr>
	<p>Ici les ptites photos !!!</p>
</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/template.php');
?>