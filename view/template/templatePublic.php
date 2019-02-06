<?php 
	require_once('./view/init/initRessources.php');
?>

<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>yolo</title>
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
			echo $stylesheet;
			echo $favicon;
		?>
	</head>

	<body>
		<!-- Mettre navbar ici !! -->
		<p>template Public OK</p>

		<?php 
			echo $content;
		?>
	</body>

</html>