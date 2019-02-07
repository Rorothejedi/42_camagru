<?php
	$title = 'Confirmation d\'inscription';
	ob_start();
?>

<div class="container pb-5">
	<div class="row">
		<div class="col-md-12">
			<h1 class="title">Confirmez votre inscription pour accéder à votre compte</h1>
			<hr>
			<div class="pt-5">
				<p class="font-italic">
					Votre inscription a bien été prise en compte.
				</p>
				<br>
				<p>
					Un mail viens de vous être envoyé à l'adresse que vous avez renseignée.<br>
					Il est possible que celui-ci soit considéré comme un spam donc vérifiez vos courriers indésirables.
				</p>
				<p>
					Pour valider votre inscription, cliquez sur le bouton dédié présent dans cet e-mail.
				</p>
			</div>
		</div>
	</div>
</div>

<?php
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>
