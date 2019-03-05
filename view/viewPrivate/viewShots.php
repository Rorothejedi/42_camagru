<?php 
	$title = 'Mes instashots';
	ob_start();
?>

<div class="container">
	<div id="alertNone"></div>
	<div class="row d-flex justify-content-between col-sm-12">
		<h1 class="title">Mes instashots</h1>
		<a href="<?= \App\model\App::getDomainPath() ?>/" class="shotsLink">Tous les shots</a>
	</div>
	<hr>
	<div class="row">
		<?php 
			foreach ($allMyImages as $key => $image):
		?>
		<div class="col-lg-4 col-sm-6">
			<div class="picture">
				<a href="<?= \App\model\App::getDomainPath() ?>/shot/<?= $image->id ?>">
					<img class="imgGalleryBig img-fluid" 
					id="<?= $image->id ?>"
					src="<?= \App\model\App::getDomainPath() ?>/files/img/<?= $image->name ?>">
					<span class="fa-stack icons icon-heart">
						<i class="far fa-heart fa-stack-2x"></i>
						<strong class="fa-stack-1x fa-stack-text heart-text"><?= $image->nbLike ?></strong>
					</span>
					<span class="fa-stack icons">
						<i class="far fa-comment-alt fa-stack-2x"></i>
						<strong class="fa-stack-1x fa-stack-text comment-text"><?= $image->nbComment ?></strong>
					</span>
				</a>
			</div>
		</div>
		<?php 
			endforeach; 
		?>
	</div>
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