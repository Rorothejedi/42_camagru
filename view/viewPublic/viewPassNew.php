<?php 
	$title = 'Mot de passe oublié';
	ob_start();
?>

<div class="container">
	<div id="alertNone" class="alertStudio"></div>
	<h1 class="title">Réinitialiser votre mot de passe</h1>
	<p class="details">Votre nouveau mot de passe doit contenir au moins 8 caractères, être composé de chiffres et de lettres minuscules et majuscules.</p>
	<hr>
	<form class="form-horizontal pt-5 pb-5" action="processPassNew&username=<?= $_GET['username'] ?>&key=<?= $_GET['key'] ?>" method="POST">
		<div class="row">
			<div class="col-md-4 field-label-responsive">
				<label for="pass">Nouveau mot de passe</label>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<input type="password" name="pass" class="form-control" id="pass" pattern=".{8,}" required autofocus>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 field-label-responsive">
				<label for="passconfirm">Confirmer le mot de passe</label>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<input type="password" name="passconfirm" class="form-control" id="passconfirm" pattern=".{8,}" required>
					</div>
				</div>
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-5">
				<button type="submit" class="style-button button-color-submit">Confirmer</button>
			</div>
		</div>
	</form>
</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/template.php');
?>