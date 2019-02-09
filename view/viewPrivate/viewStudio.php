<?php 
	$title = 'Studio';
	ob_start();
?>

<div class="container">
	<div id="alertNone"></div>
	<h1 class="title">Studio</h1>
	<hr>
	<p>Table de montage !!!</p>
</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>