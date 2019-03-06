<?php 
	$title = 'Shot';
	ob_start();
?>

<div class="container">
	<div id="alertNone" class="alertStudio"></div>
	<div class="row d-flex justify-content-between col-sm-12">
		<h1 class="title">Shot</h1>
		<a href="<?= \App\model\App::getDomainPath() ?>/" class="shotsLink" >Retour</a>
	</div>
	<hr>
	<form action="<?= \App\model\App::getDomainPath() ?>/processLike" method="POST">
		<div class="row">
			<div class="d-flex justify-content-between col-lg-12">
				<p>By <em><?= $image->username ?></em></p>
				<?php if (isset($likeCheck)) { ?>
					<button type="submit" name="img" value="<?= $image->id ?>" class="oneLikeMore" title="<?= $nbLikes ?> likes">
						<span class="fa-stack">
							<i class="far fa-heart buttonLike <?php if ($likeCheck == 1) echo 'checked' ?>"></i>
							<strong class="fa-stack-1x fa-stack-text heart-button-text heart-text <?php if ($likeCheck == 1) echo 'checked' ?>"><?= $nbLikes ?></strong>
						</span>
					</button>
				<?php } else { ?>
					<span class="fa-stack">
						<i class="far fa-heart buttonLike"></i>
						<strong class="fa-stack-1x fa-stack-text heart-button-text heart-text"><?= $nbLikes ?></strong>
					</span>
				<?php } ?>
			</div>
			<div class="col-lg-12">
				<img class='shot' src="<?= \App\model\App::getDomainPath() ?>/files/img/<?= $image->name ?>" alt="<?= $image->name ?>">
			</div>
			<div class="col-lg-12">
				<p class="mt-2 pb-2 small">Publié le <em><?= $image->comment_date ?></em></p>
			</div>
		</div>
	</form>
	<form action="<?= \App\model\App::getDomainPath() ?>/processNewComment" method="POST">
	<h2 class="comment-title mt-4"><label for="comment-area">Commentaires</label></h2>
	<hr>
		<div class="row">
			<?php if (empty($_SESSION['user_username'])) { ?>

			<p class="connect-comment col-lg-12 mt-3">
				<em>Vous devez être connecté pour poster un commentaire <br>
					<a href="<?= \App\model\App::getDomainPath() ?>/connexion">Connectez-vous</a> ou <a href="<?= \App\model\App::getDomainPath() ?>/inscription">inscrivez-vous</a>
				</em>
			</p>

			<?php } else { ?>
		
			<div class="form-group col-lg-12">
  				<textarea class="form-control textarea-comment" rows="7" id="comment-area" placeholder="Merci de respecter les règles de courtoisie élémentaires ainsi que les autres utilisateurs. Tout message ne respectant pas ces règles, pourra être supprimé et son auteur sanctionné." name="comment"></textarea>
			</div>
			<div class="col-lg-12 mb-4">
				<button type="submit" name="img" value="<?= $image->id ?>" class="style-button button-color-settings mb-4">Poster mon commentaire</button>
			</div>

			<?php 
				}
				if ($nbComments == 0)
					echo '<div class="col-lg-12">
							<div class="col-lg-12 comment mt-3 mb-3 pt-3 pb-3">
								<em class="no-comment">Il n\'y a pas encore de commentaires.</em>
							</div>
						</div>';
				else
				{
					foreach ($comments as $key => $comment)
					{
						echo '<div class="col-lg-12">
								<div class="col-lg-12 comment mt-1 mb-3 pt-3 pb-3 ';
						if ($comment->username == $_SESSION['user_username'])
							echo "my-comment";
						
						echo '"><p class="comment-text-content">'. $comment->content . '</p>' . 
								'<small class="text-muted">Posté par <strong>'
									.  $comment->username . 
									'</strong> le '
									. $comment->comment_date . '
								</small>
							</div>
						</div>';
					}
				}
			?>
			
		</div>
	</form>
</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/template.php');
?>