<?php 
	$title = 'Galerie';
	ob_start();

	function echoPicture($num, $size, $object)
	{
		if (isset($object[$num]))
		{
			if ($size == 'big')
			{
				echo '<div class="bigPicture text-right">
					<a href="' . \App\model\App::getDomainPath() . '/shot/' . $object[$num]->id . '">
					<img class="imgGalleryBig img-fluid" 
					id="' . $object[$num]->id . '"
					src="' . \App\model\App::getDomainPath() . '/files/img/' . $object[$num]->name . '">
					<em class="icon-author" title="By ' . $object[$num]->username . '">By ' . $object[$num]->username . '</em>
					<span class="fa-stack icons icon-heart" title="' . $object[$num]->nbLike . ' likes">
						<i class="far fa-heart fa-stack-2x"></i>
						<strong class="fa-stack-1x fa-stack-text heart-text">' . $object[$num]->nbLike . '</strong>
					</span>
					<span class="fa-stack icons" title="' . $object[$num]->nbComment . ' commentaires">
						<i class="far fa-comment-alt fa-stack-2x"></i>
						<strong class="fa-stack-1x fa-stack-text comment-text">' . $object[$num]->nbComment . '</strong>
					</span>
					</a>
					</div>';
			}
			elseif ($size == 'small')
			{
				echo '<div class="picture">
					<a href="' . \App\model\App::getDomainPath() . '/shot/' . $object[$num]->id . '">
					<img class="imgGallery img-fluid" 
					id="' . $object[$num]->id . '" 
					src="' . \App\model\App::getDomainPath() . '/files/img/' . $object[$num]->name . '">
					<em class="icon-author" title="By ' . $object[$num]->username . '">By ' . $object[$num]->username . '</em>
					<span class="fa-stack icons icon-heart" title="' . $object[$num]->nbLike . ' likes">
						<i class="far fa-heart fa-stack-2x"></i>
						<strong class="fa-stack-1x fa-stack-text heart-text">' . $object[$num]->nbLike . '</strong>
					</span>
					<span class="fa-stack icons" title="' . $object[$num]->nbComment . ' commentaires">
						<i class="far fa-comment-alt fa-stack-2x"></i>
						<strong class="fa-stack-1x fa-stack-text comment-text">' . $object[$num]->nbComment . '</strong>
					</span>
					</a>
					</div>';
			}
		}
	}
?>

<div class="container">
	<div id="alertNone" class="alertStudio"></div>
	<div class="row d-flex justify-content-between col-sm-12">
		<h1 class="title">Derniers instashots</h1>
		<?php if (!empty($_SESSION['user_username'])): ?>
		<a href="mes_instashots" class="shotsLink">Mes shots</a>
		<?php endif; ?>
	</div>
	<hr>
	<div class="row">
		<?php 
			if (!isset($allImages))
				echo "<div class='col-lg-12'>
						<em>Soyez le premier à poster votre shot !</em>
					</div>";
		?>
		<!-- Small photos -->
		<div class="col-lg-3 col-sm-6">
			<?php if(isset($allImages)) echoPicture(0, 'small', $allImages); ?>
			<?php if(isset($allImages)) echoPicture(2, 'small', $allImages); ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?php if(isset($allImages)){ echoPicture(1, 'small', $allImages);} ?>
			<?php if(isset($allImages)){ echoPicture(3, 'small', $allImages);} ?>
		</div>

		<!-- Big photos -->
		<div class="col-lg-6 col-sm-12">
			<?php if(isset($allImages)){ echoPicture(4, 'big', $allImages);} ?>
		</div>
		<div class="col-lg-6 col-sm-12">
			<?php if(isset($allImages)){ echoPicture(5, 'big', $allImages);} ?>
		</div>

		<!-- Small photos -->
		<div class="col-lg-3 col-sm-6">
			<?php if(isset($allImages)){ echoPicture(6, 'small', $allImages);} ?>
			<?php if(isset($allImages)){ echoPicture(10, 'small', $allImages);} ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?php if(isset($allImages)){ echoPicture(9, 'small', $allImages);} ?>
			<?php if(isset($allImages)){ echoPicture(11, 'small', $allImages);} ?>
		</div>

		<!-- Small photos -->
		<div class="col-lg-3 col-sm-6">
			<?php if(isset($allImages)){ echoPicture(12, 'small', $allImages);} ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?php if(isset($allImages)){ echoPicture(13, 'small', $allImages);} ?>
		</div>

		<!-- Small photos -->
		<div class="col-lg-3 col-sm-6">
			<?php if(isset($allImages)){ echoPicture(14, 'small', $allImages);} ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?php if(isset($allImages)){ echoPicture(15, 'small', $allImages);} ?>
		</div>

		<!-- Big photos -->
		<div class="col-lg-6 col-sm-12">
			<?php if(isset($allImages)){ echoPicture(16, 'big', $allImages);} ?>
		</div>
		<div class="col-lg-6 col-sm-12">
			<?php if(isset($allImages)){ echoPicture(17, 'big', $allImages);} ?>
		</div>
	</div>
	<div class="row d-flex justify-content-center pageCounter">
		<?php 
			if (isset($totalPages)) 
			{
				for ($i = 1; $i <= $totalPages; $i++)
				{ 
					if ($i == $currentPage)
						echo '<span class="currentPage">' . $i . '</span>';
					else
						echo '<a class="otherPages" href="./' . $i . '">' . $i . '</a>';
				}
			}
		?>
	</div>
</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/template.php');
?>