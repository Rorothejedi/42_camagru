<?php
	require_once('./config/initRessources.php');
?>

<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Instagru | <?= $title ?></title>
		<?= $meta ?>

		<!-- Tags Open Graph -->
		<meta property="og:title" content="<?= $title ?>">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?= $urlAdress ?>">
		<meta property="og:image" content="<?= $urlAdress ?>/public/img/imgOpenGraph.jpg">
		<meta property="og:description" content="<?= $catchword ?>"/>
		<meta property="og:locale" content="fr_FR" />

		<!-- Tags Twitter Card -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="<?= $twitterTag ?>">
		<meta name="twitter:title" content="<?= $title ?>">
		<meta name="twitter:description" content="<?= $catchword ?>">
		<meta name="twitter:creator" content="<?= $twitterTag ?>">
		<meta name="twitter:image" content="<?= $urlAdress ?>/public/img/imgTwitterCard.jpg">

		<!-- Tags Google -->
		<meta name="description" content="<?= $title ?>">
		<meta name="keywords" content="<?= $keywords ?>">

		<!-- CSS Bootstrap / Icons FontAwesome / Stylesheet / Favicon -->
		<?php
			echo $cdnBootstrap;
			echo $cdnFontAwesome;
			echo $cdnGoogleFont;
			echo $stylesheet;
			echo $favicon;
		?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

	</head>

	<body>
		<header>
			<nav class="navbar">
				<div class="container">
					<a class="navbar-brand" href="./" title="Instagru">Instagru</a>
					<div>
						<a href="connexion" class="style-button button-color-first">Connexion</a>
						<a href="inscription" class="style-button button-color-second">Inscription</a>
					</div>
					<!-- <a href="#" title="Déconnexion">
						<i class="fas fa-power-off fa-lg"></i>
					</a> -->
				</div>
			</nav>
		</header>

		<section>
			<?php
				include('alerts.php');
				echo $content;
			?>
		</section>

		<script>
			if (alert = document.getElementById('alert')) {
				document.getElementById('alertNone').style.display = 'none';
				var interval = setInterval(function (){ animateOut(alert, 4); }, 1000);
				alert.onclick = function()
				{
					clearInterval(interval);
					animateOut(alert, 0);
				};
			}

			function animateOut(element, delay)
			{
				element.classList.remove("slideInDown");
				element.classList.add("slideOutUp");
				if (delay != 0)
				{
					element.classList.add("delay-4s");
					setInterval(function () {
						element.remove();
						document.getElementById('alertNone').style.display = "block";
					}, 5000);
				}
				else
				{
					element.classList.remove("delay-4s");
					setInterval(function () {
						element.remove();
						document.getElementById('alertNone').style.display = "block";
					}, 1000);
				}
			}
		</script>
	</body>

</html>
