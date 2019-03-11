<?php
	$title = 'Studio';
	ob_start();
?>

<div class="container">
	<div id="alertNone" class="alertStudio"></div>
	<div class="row" >
		<div class="col-xl-9">
			<div class="longbar">
				<form action="processSaveImage" method="POST" name="saveImg">
					<h2 class="longbar-title">Studio</h2>
					<hr>
					<div id="slider1" class="mb-4">
						<label for="vador" class="item">
							<input type="radio" name="layer" value="vador" id="vador" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/vador_mini.png" alt="Casque Dark Vador cartoon" class="imgSlider">
						</label>
						<label for="viking" class="item">
							<input type="radio" name="layer" value="viking" id="viking" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/viking_mini.png" alt="Casque Viking cartoon" class="imgSlider">
						</label>
						<label for="hipster" class="item">
							<input type="radio" name="layer" value="hipster" id="hipster" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/hipster_mini.png" alt="Style hipster" class="imgSlider">
						</label>
						<label for="cocktail" class="item">
							<input type="radio" name="layer" value="cocktail" id="cocktail" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/cocktail_mini.png" alt="Cocktail" class="imgSlider">
						</label>
						<label for="hammer" class="item">
							<input type="radio" name="layer" value="hammer" id="hammer" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/hammer_mini.png" alt="Marteau viking" class="imgSlider">
						</label>
						<label for="batman" class="item">
							<input type="radio" name="layer" value="batman" id="batman" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/batman_mini.png" alt="Masque de Batman" class="imgSlider">
						</label>
						<label for="hope" class="item">
							<input type="radio" name="layer" value="hope" id="hope" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/hope_mini.png" alt="Symbole Superman" class="imgSlider">
						</label>
						<label for="halo" class="item">
							<input type="radio" name="layer" value="halo" id="halo" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/halo_mini.png" alt="Casque Halo" class="imgSlider">
						</label>
						<label for="chimpanze" class="item">
							<input type="radio" name="layer" value="chimpanze" id="chimpanze" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/chimpanze_mini.png" alt="Chimpanze" class="imgSlider">
						</label>
						<label for="chat" class="item">
							<input type="radio" name="layer" value="chat" id="chat" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/chat_mini.png" alt="Chat" class="imgSlider">
						</label>
						<label for="trump" class="item">
							<input type="radio" name="layer" value="trump" id="trump" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/trump_mini.png" alt="Trump" class="imgSlider">
						</label>
						<label for="trollface1" class="item">
							<input type="radio" name="layer" value="trollface1" id="trollface1" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/trollface1_mini.png" alt="Trollface 1" class="imgSlider">
						</label>
						<label for="trollface2" class="item">
							<input type="radio" name="layer" value="trollface2" id="trollface2" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/trollface2_mini.png" alt="Trollface 2" class="imgSlider">
						</label>
						<label for="trollface3" class="item">
							<input type="radio" name="layer" value="trollface3" id="trollface3" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/trollface3_mini.png" alt="Trollface 3" class="imgSlider">
						</label>
						<label for="explosion" class="item">
							<input type="radio" name="layer" value="explosion" id="explosion" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/explosion_mini.png" alt="Explosion" class="imgSlider">
						</label>
						<label for="nyancat" class="item">
							<input type="radio" name="layer" value="nyancat" id="nyancat" onClick="replyClick(this.id)">
							<img src="<?= \App\model\App::getDomainPath() ?>/files/filters/nyancat_mini.png" alt="Nyan cat" class="imgSlider">
						</label>
						<!-- Other miniature layers here -->
					</div>
					<div class="fakeScreen">
						<canvas class='canvas d-none' id="canvas" width="1280" height="720"></canvas>
						<video id="videoElement" autoplay></video>
						<div class="allLayers">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/vador.png" id="vadorLayer" alt="Miniature casque Dark Vador cartoon">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/viking.png" id="vikingLayer" alt="Miniature casque Viking cartoon">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/hipster.png" id="hipsterLayer" alt="Miniature style hipster">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/cocktail.png" id="cocktailLayer" alt="Miniature cocktail">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/hammer.png" id="hammerLayer" alt="Miniature marteau viking">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/batman.png" id="batmanLayer" alt="Miniature masque de batman">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/hope.png" id="hopeLayer" alt="Miniature symbole de superman">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/halo.png" id="haloLayer" alt="Miniature casque Halo">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/chimpanze.png" id="chimpanzeLayer" alt="Miniature chimpanze">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/chat.png" id="chatLayer" alt="Miniature chat">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/trump.png" id="trumpLayer" alt="Miniature Trump">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/trollface1.png" id="trollface1Layer" alt="Miniature Trollface 1">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/trollface2.png" id="trollface2Layer" alt="Miniature Trollface 2">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/trollface3.png" id="trollface3Layer" alt="Miniature Trollface 3">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/explosion.png" id="explosionLayer" alt="Miniature explosion">
							<img class="d-none layerPlayer" src="<?= \App\model\App::getDomainPath() ?>/files/filters/nyancat.png" id="nyancatLayer" alt="Miniature Nyancat">
							<!-- Other layers here -->
						</div>
						<input id="imgHidden" name="imgHidden" type="hidden" value="">
					</div>
					<div class="text-right takePhotoParent">
						<button type='submit' id="takePhoto" class="style-button button-color-photo" onclick="instashot();" disabled></button>
					</div>
					<div class="text-right mt-3">
						<p class="small">Utilisez votre webcam ou <label class="font-italic label-file" for="loadImg" title="Taille conseillé: 1280x720px (png/jpg)"> chargez une image </label></p>
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
					<?php foreach ($lastImages as $key => $lastImage): ?>
					<button onclick="return confirm('Etes-vous sûr de vouloir supprimer ce shot ?')" type="submit" class="fakeImg col-sm-5 col-xl-12 mr-sm-1 ml-sm-1 mb-3" name="img" value="<?= $lastImage->id ?>" title='Supprimer ce shot'>
						<img src="<?= \App\model\App::getDomainPath() ?>/files/img/<?= $lastImage->name ?>" alt="<?= $lastImage->name ?>">
						<i class="fas fa-times icon-delete-studio"></i>
					</button>
					<?php endforeach; ?>
					<div class="mt-4 mb-2">
						<a href="mes_instashots" class="style-button button-color-sidebar">Voir tous...</a>
					</div>
					<input type="hidden" name="page" value="studio">
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	$content = ob_get_clean();
	require('./view/template/template.php');
?>
