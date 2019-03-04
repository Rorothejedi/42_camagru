<?php 
	$title = 'Galerie';
	ob_start();

	function echoPicture($num, $size, $object)
	{
		if (isset($object[$num]))
		{
			if ($size == 'big')
			{
				return '<div class=" bigPicture">
					<img class="imgGalleryBig img-fluid" 
					id="' . $object[$num]->id . '"
					src="./files/img/' . $object[$num]->name . '">
					</div>';
			}
			elseif ($size == 'small')
			{
				return '<div class="picture">
				<img class="imgGallery img-fluid" 
				id="' . $object[$num]->id . '" 
				src="./files/img/' . $object[$num]->name . '">
				</div>';
			}
		}
	}
?>

<div class="container">
	<div id="alertNone"></div>
	<div class="row d-flex justify-content-between col-sm-12">
		<h1 class="title">Derniers instashots</h1>
		<a href="mes_instashots" class="shotsLink">Mes shots</a>
	</div>
	<hr>
	<div class="row">

		<!-- Petites photos -->
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(0, 'small', $allImages) ?>
			<?= echoPicture(2, 'small', $allImages) ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(1, 'small', $allImages) ?>
			<?= echoPicture(3, 'small', $allImages) ?>
		</div>

		<!-- Grosses photos -->
		<div class="col-lg-6 col-sm-12">
			<?= echoPicture(4, 'big', $allImages) ?>
		</div>
		<div class="col-lg-6 col-sm-12">
			<?= echoPicture(5, 'big', $allImages) ?>
		</div>

		<!-- Petites photos -->
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(6, 'small', $allImages) ?>
			<?= echoPicture(10, 'small', $allImages) ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(9, 'small', $allImages) ?>
			<?= echoPicture(11, 'small', $allImages) ?>
		</div>

		<!-- Petites photos -->
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(12, 'small', $allImages) ?>
			<?= echoPicture(16, 'small', $allImages) ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(13, 'small', $allImages) ?>
			<?= echoPicture(17, 'small', $allImages) ?>
		</div>

		<!-- Petites photos -->
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(14, 'small', $allImages) ?>
			<?= echoPicture(18, 'small', $allImages) ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(15, 'small', $allImages) ?>
			<?= echoPicture(19, 'small', $allImages) ?>
		</div>
	</div>
</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/template.php');
?>