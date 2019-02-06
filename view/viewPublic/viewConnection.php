<?php 
	$title = 'Connexion';
	ob_start();
?>

<div class="container">
	<h1 class="title">Connectez-vous</h1>
	<hr>
	<form class="form-horizontal pt-5 pb-5">
		<div class="row">
			<div class="col-md-4 field-label-responsive">
				<label for="username">Nom d'utilisateur <span class="text-secondary">(ou e-mail)</span></label>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<input type="text" name="username" class="form-control" id="username" required autofocus>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 field-label-responsive">
				<label for="pass">Mot de passe</label>
			</div>
			<div class="col-md-8">
				<div class="form-group has-danger">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<input type="password" name="pass" class="form-control" id="pass" required>
					</div>
				</div>
			</div>
		</div>

		<br>

		<div class="row">
			<div class="col-md-10 ml-4">
				<input type="checkbox" name="remember" class="form-check-input">
					Se souvenir de moi ?
			</div>
		</div>

		<br><br>

		<div class="row">
			<div class="col-md-4 col-sm-12 pb-3">
				<button type="submit" class="style-button button-color-submit">C'est parti !</button>
			</div>
			<div class="col-md-8 col-sm-12 text-md-right">
				<a href="mot_de_passe_oublie">Mot de passe oublié ?</a>
			</div>
		</div>
	</form>

</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>