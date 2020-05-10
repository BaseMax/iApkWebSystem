<?php if(!$amp) { ?>			<div class="container-fluid searchBox">
				<br>
				<br>
				<center>
					<h2><?= $translates[$lang]["slider_title"] ?></h2>
					<h3><?= $translates[$lang]["slider_subtitle"] ?></h3>
				</center>
				<br>
				<br>
				<form class="input-group" action="<?= $site ?>/<?= $lang ?>/search/" method="GET">
					<input name="q" type="text" class="form-control" placeholder="<?= $translates[$lang]["search_field"] ?>" aria-label="Search">
					<div class="input-group-append">
						<button class="btn btn-secondary" type="button">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</form>
				<br>
				<!-- <img src="https://images.idgesg.net/images/article/2019/09/android-10-100809921-large.jpg" width="100%"> -->
				<br>
			</div>
			<br>
<?php } ?>
