<?php
include "_core.php";
$isMain=true;
include "_begin.php";
include "_header.php";
?>
<div class="container mt-3">
	<?php include "_slider.php" ?>
	<div class="row">
		<div class="col-sm-12">
			<center>
				<h5><?= $translates[$lang]["index_h5_title"] ?></h5>
			</center>
			<?php if(!$amp) { ?>
			<br>
			<?php } ?>
			<?php
			ads(1, $amp);
			$i=1;
			$cats=array_merge($cats_app, $cats_game);
			foreach($cats as $category) {
				$apps=$db->selects("application", ["lang"=>$lang,"categoryID"=>$category["id"]], "ORDER BY `id` DESC LIMIT 6", $appModalFields);
				if(isset($apps[0])) {
					?>
					<br>
					<h2<?= isRTL($lang) ? " style=\"text-align: right;direction: rtl;\"" : ""?>><?= $translates[$lang]["index_category_title"]?> <?= $category["name".strtoupper($lang)] ?></h2>
					<br>
					<div class="row">
						<?php
						foreach($apps as $app) {
							modalApp($app, 2, 4, 6, 6, $category["slug"], $category["isGame"]);
						}
						?>
					</div>
					<?php
					if($i % 4 == 0) {
						ads(1, $amp);
					}
					$i++;
				}
			}
			?>
		</div>
	</div>
</div>
<script type="application/ld+json">
{
	"@context": "https://schema.org",
	"@type": "WebSite",
	"url": "<?= $site ?>/<?= $lang ?>/",
	"potentialAction": {
		"@type": "SearchAction",
		"target": "<?= $site ?>/<?= $lang ?>/?q={search_term_string}",
		"query-input": "required name=search_term_string"
	}
}
</script>
<script type="application/ld+json">
{
	"@context": "https://schema.org",
	"@type": "BreadcrumbList",
	"itemListElement": [{
		"@type": "ListItem",
		"position": 1,
		"name": "<?= $translates[$lang]["broad_title"] ?>",
		"item": "<?= $site ?>/<?= $lang ?>/"
	}]
}
</script>
<?php
include "_footer.php";
include "_close.php";
?>
