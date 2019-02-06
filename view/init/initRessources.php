<?php 

	/**
	 * initRessources.php contient les variables à intégrer aux templates. Celui-ci a pour but de centraliser tous les changements potentiels aux niveau des ressources visuels (css, favicon, etc), des CDN ou des appels aux scripts par exemple.
	 */
	
	/*-----------------------------------   Medias and social networks --------------------------------------*/

	$catchword  = "";
	$urlAdress  = "https://rodolphe.cabotiau.com" . \App\model\App::getDomainPath();
	$keywords   = "photos images montage";
	$twitterTag = "@RCabotiau";

	/*----------------------------------------   Common meta  ------------------------------------------------*/

	$meta = '<meta charset="UTF-8">'.
			'<meta http-equiv="X-UA-Compatible" content="IE=edge">'.
			'<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">'.
			'<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->'.
    		'<!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->'.
		    '<!--[if lt IE 9]>
		    	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js%22%3E</script>
		    	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js%22%3E</script>
		    <![endif]-->';

	/*------------------------------------------   Head link   -------------------------------------------------*/

	// Development stylesheet and minify version
	$stylesheet = '<link href="' . \App\model\App::getDomainPath() . '/public/css/stylesheet.css" rel="stylesheet">'.
				  '<!--<link href="' . \App\model\App::getDomainPath() . '/public/css/stylesheet.min.css" rel="stylesheet">-->';

	$favicon = '<link rel="icon" type="image/png" href="' . \App\model\App::getDomainPath() . '/public/img/favicon-32x32.png" sizes="32x32">' .
			   '<link rel="icon" type="image/png" href="' . \App\model\App::getDomainPath() . '/public/img/favicon-16x16.png" sizes="16x16">';

	/*---------------------------------------   CDN Calls   ------------------------------------------------*/

	$cdnBootstrap    = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">';

	$cdnFontAwesome   = '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">';

	$cdnGoogleFont = '<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600" rel="stylesheet">';

	/*------------------------------------   JavaScript files  ------------------------------------------------*/

	//$scriptAlert         = '<script src="' . \App\model\App::getDomainPath() . '/public/js/alert.js" async></script>';

	/*--------------------------------   JavaScript files : public part  ---------------------------------------------*/

	//$scriptPublicLoadingHome = '<script src="' . \App\model\App::getDomainPath() . '/public/js/scriptPublicLoadingHome.js"></script>';

	/*--------------------------------   JavaScript files : private part  ---------------------------------------------*/

	//$scriptPrivateOpenProjects = '<script src="' . \App\model\App::getDomainPath() . '/public/js/scriptPrivateOpenProjects.js"></script>';