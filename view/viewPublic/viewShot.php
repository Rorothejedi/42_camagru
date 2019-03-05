<?php 
	$title = 'Shot';
	ob_start();
?>

<div class="container">
	<div id="alertNone"></div>
	<div class="row d-flex justify-content-between col-sm-12">
		<h1 class="title">Shot</h1>
		<a href="<?= \App\model\App::getDomainPath() ?>/" class="shotsLink" >Retour</a>
	</div>
	<hr>
	<div class="row">
	
	</div>
</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/template.php');
?>