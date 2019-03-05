<?php
	$title = 'Studio';
	ob_start();
?>

<div class="container">
	<div id="alertNone" class="alertStudio"></div>
	<div class="row" >
		<div class="col-xl-9">
			<div class="longbar">
				<form action="processSaveImage" method="POST">
					<h2 class="longbar-title">Studio</h2>
					<hr>

					<div id="slider1" class="mb-4">
						<label for="vador">
						<input type="radio" name="layer" value="vador" id="vador" onClick="replyClick(this.id)">
							<div class="item">
								<img src="./files/filters/vador_mini.png" alt="Casque Dark Vador cartoon">
							</div>
						</label>

						<label for="viking">
						<input type="radio" name="layer" value="viking" id="viking" onClick="replyClick(this.id)">
							<div class="item">
								<img src="./files/filters/viking_mini.png" alt="Casque Viking cartoon">
							</div>
						</label>

						<label for="hipster">
						<input type="radio" name="layer" value="hipster" id="hipster" onClick="replyClick(this.id)">
							<div class="item">
								<img src="./files/filters/hipster_mini.png" alt="Style hipster">
							</div>
						</label>

						<label for="cocktail">
						<input type="radio" name="layer" value="cocktail" id="cocktail" onClick="replyClick(this.id)">
							<div class="item">
								<img src="./files/filters/cocktail_mini.png" alt="Cocktail">
							</div>
						</label>

						<label for="hammer">
						<input type="radio" name="layer" value="hammer" id="hammer" onClick="replyClick(this.id)">
							<div class="item">
								<img src="./files/filters/hammer_mini.png" alt="Marteau viking">
							</div>
						</label>

						<label for="halo">
						<input type="radio" name="layer" value="halo" id="halo" onClick="replyClick(this.id)">
							<div class="item">
								<img src="./files/filters/halo_mini.png" alt="Casque Halo">
							</div>
						</label>

						<!-- Ici d'autres minatures de layers -->
					</div>

					<div class="fakeScreen">
						<canvas class='canvas d-none' id="canvas" width="1280" height="720"></canvas>
						<video id="videoElement" autoplay></video>
						<div class="allLayers">
							<img class="d-none layerPlayer" src="./files/filters/vador.png" id="vadorLayer">
							<img class="d-none layerPlayer" src="./files/filters/viking.png" id="vikingLayer">
							<img class="d-none layerPlayer" src="./files/filters/hipster.png" id="hipsterLayer">
							<img class="d-none layerPlayer" src="./files/filters/cocktail.png" id="cocktailLayer">
							<img class="d-none layerPlayer" src="./files/filters/hammer.png" id="hammerLayer">
							<img class="d-none layerPlayer" src="./files/filters/halo.png" id="haloLayer">
							<!-- Ici d'autres layers -->

						</div>
						<input id="imgHidden" name="imgHidden" type="hidden" value="">
					</div>

					<div class="text-right takePhotoParent">
						<button type='submit' id="takePhoto" class="style-button button-color-photo" onclick="instashot();" disabled></button>
					</div>

					<div class="text-right mt-3">
						<p class="small">Utilisez votre webcam ou <label class="font-italic label-file" for="loadImg"> chargez une image </label></p>
						<input type="file" class="small input-file" id="loadImg" accept=".png, .jpg">
					</div>
				</form>
			</div>
		</div>

		<!-- Gérer l'affichage en fonction du nombre de photo de l'user -->

		<div class="col-xl-3">
			<div class="sidebar">
				<form action="processDeleteImage" method="POST">
					<h2 class="sidebar-title">Vos derniers instashots</h2>
					<?php 
						foreach ($lastImages as $key => $lastImage):
					?>
					<button type="submit" class="fakeImg col-sm-5 col-xl-12 pr-sm-3 pl-sm-3" name="img" value="<?= $lastImage->id ?>">
						<img src="./files/img/<?= $lastImage->name ?>" alt="<?= $lastImage->name ?>">
						<i class="fas fa-times"></i>
					</button>	
					<?php 
						endforeach;
					?>
					<div class="mt-4 mb-2">
						<a href="mes_instashots" class="style-button button-color-sidebar">Voir tous...</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	$content = ob_get_clean();
	require('./view/template/template.php');
?>
