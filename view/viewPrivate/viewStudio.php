<?php 
	$title = 'Studio';
	ob_start();
?>

<div class="container">
	<div id="alertNone"></div>
	<div class="row">
		<div class="col-xl-9">
			<div class="longbar">
				<form action="" method="POST">
					<h2 class="longbar-title">Studio</h2>
					<hr>
					
					<div id="slider1" class="mb-4">
						<label for="vador">
						<input type="checkbox" name="vador" value="ok" id="vador">
							<div class="item">
								<img src="./files/filters/vador.png" alt="Casque Dark Vador cartoon">
							</div>
						</label> 

						<label for="viking">
						<input type="checkbox" name="viking" value="ok" id="viking">
							<div class="item">
								<img src="./files/filters/viking.png" alt="Casque Viking cartoon">
							</div>
						</label> 

						<label for="hipster">
						<input type="checkbox" name="hipster" value="ok" id="hipster">
							<div class="item">
								<img src="./files/filters/hipster.png" alt="Style hipster">
							</div>
						</label> 
						
						<label for="cocktail">
						<input type="checkbox" name="cocktail" value="ok" id="cocktail">
							<div class="item">
								<img src="./files/filters/cocktail.png" alt="Cocktail">
							</div>
						</label> 
						
						<label for="hammer">
						<input type="checkbox" name="hammer" value="ok" id="hammer">
							<div class="item">
								<img src="./files/filters/hammer.png" alt="Marteau viking">
							</div>
						</label> 
						
						<label for="halo">
						<input type="checkbox" name="halo" value="ok" id="halo">
							<div class="item">
								<img src="./files/filters/halo.png" alt="Casque Halo">
							</div>
						</label> 
					</div>

					<div class="fakeScreen">
						<!-- Ajouter le bouton pour la prise de photo -->
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
				<h2 class="sidebar-title">Vos instashot</h2>
				<div class="fakeImg"></div>
				<div class="fakeImg"></div>
				<div class="fakeImg"></div>
				<div class="mt-4 mb-2">
					<a href="./" class="style-button button-color-sidebar">Voir toutes...</a>
				</div>
			</div>
		</div>
	</div>
</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/template.php');
?>