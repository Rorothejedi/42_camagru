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
		<!-- Small photos -->
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(0, 'small', $allImages) ?>
			<?= echoPicture(2, 'small', $allImages) ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(1, 'small', $allImages) ?>
			<?= echoPicture(3, 'small', $allImages) ?>
		</div>

		<!-- Big photos -->
		<div class="col-lg-6 col-sm-12">
			<?= echoPicture(4, 'big', $allImages) ?>
		</div>
		<div class="col-lg-6 col-sm-12">
			<?= echoPicture(5, 'big', $allImages) ?>
		</div>

		<!-- Small photos -->
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(6, 'small', $allImages) ?>
			<?= echoPicture(10, 'small', $allImages) ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(9, 'small', $allImages) ?>
			<?= echoPicture(11, 'small', $allImages) ?>
		</div>

		<!-- Small photos -->
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(12, 'small', $allImages) ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(13, 'small', $allImages) ?>
		</div>

		<!-- Small photos -->
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(14, 'small', $allImages) ?>
		</div>
		<div class="col-lg-3 col-sm-6">
			<?= echoPicture(15, 'small', $allImages) ?>
		</div>

		<!-- Big photos -->
		<div class="col-lg-6 col-sm-12">
			<?= echoPicture(16, 'big', $allImages) ?>
		</div>
		<div class="col-lg-6 col-sm-12">
			<?= echoPicture(17, 'big', $allImages) ?>
		</div>
	</div>
	<div class="row d-flex justify-content-center pageCounter">
		<?php 
			for ($i = 1; $i <= $totalPages; $i++)
			{ 
				if ($i == $currentPage)
					echo '<span class="currentPage">' . $i . '</span>';
				else
					echo '<a class="otherPages" href="./?page=' . $i . '">' . $i . '</a>';
			}
		?>
	</div>
</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/template.php');
?>