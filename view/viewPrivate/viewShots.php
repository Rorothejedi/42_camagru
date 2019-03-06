<?php 
	$title = 'Mes instashots';
	ob_start();
?>

<div class="container">
	<div id="alertNone" class="alertStudio"></div>
	<div class="row d-flex justify-content-between col-sm-12">
		<h1 class="title">Mes instashots</h1>
		<a href="<?= \App\model\App::getDomainPath() ?>/" class="shotsLink">Tous les shots</a>
	</div>
	<hr>
	<form action="processDeleteImage" method="POST">
		<div class="row">
			<?php 
				if (!isset($allMyImages[0]))
					echo "<div class='col-lg-12'><em>C'est tout vide ici !</em></div>";
				foreach ($allMyImages as $key => $image):
			?>
			<div class="col-lg-4 col-sm-6">
				<div class="picture">
					<a href="<?= \App\model\App::getDomainPath() ?>/shot/<?= $image->id ?>">
						<img class="imgGalleryBig img-fluid" 
						id="<?= $image->id ?>"
						src="<?= \App\model\App::getDomainPath() ?>/files/img/<?= $image->name ?>">
						<button onclick="return confirm('Etes-vous sûr de vouloir supprimer ce shot ?')" type="submit" name="img" value="<?= $image->id ?>" class="icon-delete">
							<i class="fas fa-times  fa-lg" title="Supprimer ce shot"></i>
						</button>
						<span class="fa-stack icons icon-heart" title="<?= $image->nbLike ?> likes">
							<i class="far fa-heart fa-stack-2x"></i>
							<strong class="fa-stack-1x fa-stack-text heart-text"><?= $allMyLikes[$key]->nb ?></strong>
						</span>
						<span class="fa-stack icons" title="<?= $image->nbComment ?> commentaires">
							<i class="far fa-comment-alt fa-stack-2x"></i>
							<strong class="fa-stack-1x fa-stack-text comment-text"><?= $allMyComments[$key]->nb ?></strong>
						</span>
					</a>
				</div>
			</div>
			<?php 
				endforeach; 
			?>
		</div>
		<input type="hidden" name="page" value="mes_instashots">
	</form>
	<div class="row d-flex justify-content-center pageCounter">
		<?php 
			for ($i = 1; $i <= $totalPages; $i++)
			{ 
				if ($i == $currentPage)
					echo '<span class="currentPage">' . $i . '</span>';
				else
					echo '<a class="otherPages" href="' . \App\model\App::getDomainPath() .'/mes_instashots/' . $i . '">' . $i . '</a>';
			}
		?>
	</div>
</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/template.php');
?>