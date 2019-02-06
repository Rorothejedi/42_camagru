<?php 
	require_once('./view/init/initRessources.php');
?>

<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Instagru | 404</title>
		<?php 
			echo $meta;
			echo $cdnBootstrap; 
			echo $cdnFontAwesome;
			echo $cdnGoogleFont;
			echo $stylesheet;
			echo $favicon;
		?>
	</head>

	<body class="error-body">
		<div class="container">
			<div>
				<a href="./" class="error-link">
					<h1 class="navbar-brand error-title d-flex justify-content-center">Instagru</h1>
				</a>
			</div>
			<hr>
			<div class="pt-5">
				<h2 class="pt-3 pb-5 d-flex justify-content-center">Erreur 404 - Page introuvable</h2>
				<p class="d-flex justify-content-center">Vous allez être redirigé vers la galerie dans <span id="countdown">8</span> secondes</p>	
			</div>
		</div>
		<script src="./public/js/countdown.js"></script>
	</body>
</html>