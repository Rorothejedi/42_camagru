<?php 
	$title = 'Mot de passe oublié';
	ob_start();
?>

<div class="container">
	<div id="alertNone"></div>
	<h1 class="title">Réinitialiser votre mot de passe</h1>
	<p class="details">Indiquez votre adresse mail et nous vous enverrons un lien pour réinitialiser votre mot de passe. Pensez à vérifier les spam de votre boite de reception.</p>
	<hr>
	<form class="form-horizontal pt-5 pb-5" action="processPassForgotten" method="POST">
		<div class="row">
			<div class="col-md-4 field-label-responsive">
				<label for="email">Email</label>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<input type="email" name="email" class="form-control" id="email" required autofocus>
					</div>
				</div>
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-5">
				<button type="submit" class="style-button button-color-submit">Soumettre</button>
			</div>
		</div>
	</form>
</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>