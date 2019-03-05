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
	<form action="proccessLike" method="POST">
		<div class="row">
			<div class="d-flex justify-content-between col-lg-12">
				<p>By <em><?= $image->username ?></em></p>
				<button type="submit" value="oneLikeMore" class="oneLikeMore">
					<span class="fa-stack">
						<i class="far fa-heart buttonLike"></i>
						<strong class="fa-stack-1x fa-stack-text heart-button-text heart-text"><?= $image->nbLike ?></strong>
					</span>
				</button>
			</div>
			<div class="col-lg-12">
				<img class='shot' src="<?= \App\model\App::getDomainPath() ?>/files/img/<?= $image->name ?>" alt="<?= $image->name ?>">
			</div>
			<div class="col-lg-12">
				<p class="mt-2 pb-2 small">Publié le <em><?= $image->comment_date ?></em></p>
			</div>
		</div>
	</form>
	<form action="proccessComment" method="POST">
	<h2 class="comment-title mt-4">Commentaires</h2>
	<hr>
		<div class="row">
			<?php
				if (empty($_SESSION['user_username'])) {
			?>

			<p class="connect-comment col-lg-12 mt-3">
				<em>Vous devez être connecté pour poster un commentaire <br>
					<a href="<?= \App\model\App::getDomainPath() ?>/connexion">Connectez-vous</a> ou <a href="<?= \App\model\App::getDomainPath() ?>/inscription">inscrivez-vous</a>
				</em>
			</p>

			<?php 
				}
				if ($image->nbComment == 0)
					echo "<em class='no-comment col-lg-12 mt-3 mb-5'>Il n'y a pas encore de commentaires</em>";
			 ?>
		</div>
	</form>


</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/template.php');
?>