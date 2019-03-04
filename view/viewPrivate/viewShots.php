<?php 
	$title = 'Mes instashots';
	ob_start();

	function echoPicture($num, $object)
	{
		if (isset($object[$num]))
		{
			return '<div class=" bigPicture">
				<img class="imgGalleryBig img-fluid" 
				id="' . $object[$num]->id . '"
				src="./files/img/' . $object[$num]->name . '">
				</div>';
		}
	}
?>

<div class="container">
	<div id="alertNone"></div>
	<div class="row d-flex justify-content-between col-sm-12">
		<h1 class="title">Mes instashots</h1>
		<a href="./" class="shotsLink">Tous les shots</a>
	</div>
	<hr>
	<div class="row">
		<?php 
			foreach ($allMyImages as $key => $image):
		?>
		<div class="col-lg-4 col-sm-6">
			<div class="picture">
				<img class="imgGalleryBig img-fluid" 
				id="<?= $image->id ?>"
				src="./files/img/<?= $image->name ?>">
			</div>
		</div>
		<?php 
			endforeach; 
		?>
	</div>
</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/template.php');
?>