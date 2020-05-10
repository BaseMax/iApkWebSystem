<?php
$isSingle=true;
include "_core.php";
include "_begin.php";
?>
<?php
if(isset($argv[1], $argv[2])) {
	$package=$argv[1];
	$cat=$argv[2];
}
else if(!isset($_GET['package']) || !isset($_GET['category'])) {
	include "404.php";
	exit();
}
else {
	$package=$_GET['package'];
	$cat=$_GET['category'];
}
$app=$db->select("application", ["packageName"=>$package,"lang"=>$lang], "", $appSingleFields);
if($app==[]) {
	$tag=$db->select("tag", ["path"=>$package]);
	if($tag==[]) {
		include "404.php";
		exit();
	}
	$app=$db->select("application", ["id"=>$tag["appID"]], "", $appSingleFields);
}
$category=$db->select("application_category", ["id"=>$app["categoryID"]] , "" , $categoryFields);
if($cat != $category["slug"]) {
	include "404.php";
	exit();
}
// if(isset($tag) and $tag != []) {
if(isset($tag)) {
	$ampLinkNormal=$site."/fa/".$category["slug"]."/".$app["packageName"]."/";
}
$screenshots=$db->selects("app_screenshot", ["appID"=>$app["id"]]);
if(isset($tag)) {
	$title=$tag["value"];
}
else {
	if($category["isGame"] == 1) {
		$title=$translates[$lang]["title_single_game"];
	}
	else {
		$title=$translates[$lang]["title_single_app"];
	}
	$title.=$app["title"];
}
// $image=appIcon($app);
$image=appIcon($app);
// $description=html_entity_decode(str_replace("\"", "'",strip_tags($app["description"])) ,ENT_COMPAT,"UTF-8");
$descriptionText=$app["description"];
$descriptionText=str_replace([
	"<br> </br>",
	"<p> <br> </br></p>",
	"<br> </br>",
	"<p> <br> </p>",
	"<font>",
	"<font >",
	"</font>",
	"\"",
	"\n\n",
	"\n\n\n",
	"\t",
	"  ",
	"   ",
	"  ",
	"<<<",
], ["","","","","","","","'", "\n", "\n" ," ", " ", " ", " ", "<<< \n"], $descriptionText);
// (\?([^ ]+)|)
// $url = strtok($url, '?');
if($app["source"] == 1) {
	$descriptionText=preg_replace('/(\'|\")http(s|):\/\/(www\.|)cafebazaar.ir\/app\/([^\/]+)\/(\?([a-zA-Z0-9\=\&\-]+)|)/i', "$1".'https://iapk.org/'.$lang.'/search/?q='."$4", $descriptionText);
	$descriptionText=preg_replace('/http(s|):\/\/(www\.|)cafebazaar.ir\/app\/([^\/]+)\/(\?([a-zA-Z0-9\=\&\-]+)|)/i', "\n".'<a href="https://iapk.org/'.$lang.'/search/?q='."$3".'">'."جستجوی برنامه $3".'</a>', $descriptionText);
}
$descriptionTiny=$app["descriptionTiny"];
$descriptionTiny=str_replace([
	"<br> </br>",
	"<p> <br> </br></p>",
	"<br> </br>",
	"<p> <br> </p>",
	"<font>",
	"<font >",
	"</font>",
	"\"",
	"\n\n",
	"\n\n\n",
	"\t",
	"  ",
	"   ",
	"  ",
], ["","","","","","","","'", "\n", "\n" ," ", " ", " ", " "], $descriptionTiny);
if($app["source"] == 1) {
	$descriptionTiny=preg_replace('/http(s|):\/\/(www\.|)cafebazaar.ir\/app\/([^\/]+)\/(\?([a-zA-Z0-9\=\&\-]+)|)/i', "\n".'<a href="https://iapk.org/'.$lang.'/search/?q='."$3".'">'."جستجوی برنامه $3".'</a>', $descriptionTiny);
}
$description=strip_tags($descriptionText);
$description=str_replace("\ ", "", $description);
if($descriptionTiny == "") {
	$keywordDubliacte=true;
	$keyword=$description;
}
else {
	$keyword=$descriptionTiny;
}
$keyword=strip_tags($keyword);
// else {
// 	// $keyword=html_entity_decode(str_replace("\"", "'",strip_tags($app["descriptionTiny"])) ,ENT_COMPAT,"UTF-8");
// 	$keyword=$app["descriptionTiny"];
// 	$keyword=str_replace("\"", "'", $keyword);
// }
$others=[];
$size=$db->count("application", ["lang"=>$lang, "categoryID"=>$app["categoryID"]], "", "id");
$size=$size-10;
if($size < 0) {
	$size=0;
} 
$others=$db->selects("application", ["lang"=>$lang, "categoryID"=>$app["categoryID"]], "ORDER BY `id` DESC LIMIT 6 OFFSET ".rand(0, $size), $appModalFields);
// $others=$db->selects("application", ["categoryID"=>$app["categoryID"], "packageName"=>["!=", "", $app["packageName"] ]], "ORDER BY RAND() LIMIT 6", "id,name,icon,packageName,categoryID,isGame,path,source");
$ampLinkNormal=$site."/fa/".$category["slug"]."/".$app["packageName"]."/";
if($app["icon"] != "") {
	$thumbnail=$site."/thumbnail.php?id=".$app["id"]."";
}
?>
<?php include "_header.php" ?>
<div class="container mt-3">
	<?php include "_slider.php" ?>
	<div class="row">
		<div class="col-sm-3">
			<?= $amp ? "<amp-img layout=\"responsive\" ".$default_image_info."" : "<img class=\"lazyload\"";?> src="<?= $image ?>" alt="<?= $category["isGame"] ? $translates[$lang]["download_game"] : $translates[$lang]["download_app"] ?> <?= $app["title"]?>"><?= $amp ? "</amp-img>" : ""; ?>
			<?php if(!$amp) { ?>
			<noscript>
			<img src="<?= $image ?>" alt="<?= $category["isGame"] ? $translates[$lang]["download_game"] : $translates[$lang]["download_app"] ?> <?= $app["title"]?>">
			</noscript>
			<?php } ?>
			<br>
			<br>
		</div>
		<div class="col-sm-9">
			<?php if(!$amp) { ?><br><?php } ?>
			<h1><?= $category["isGame"] ? $translates[$lang]["title_game_category"] : $translates[$lang]["title_app_category"] ?><?= $app["title"] ?></h1>
			<h4><?= $app["packageName"] ?></h4>
		</div>
		<br>
		<?php
		ads(3, $amp);
		?>
		<div class="col-sm-12">
			<div class="base" id="base">
			<?php
			foreach($screenshots as $screenshot) {
				$image=appIcon($app, true);
				$image_info=appIconInfo($screenshot["thumbnail"]);
				$image=$image[1];
				if($app["source"] == 1) {
					if(file_exists("image/".$app["id"]."/".$screenshot["id"].".jpg")) {
						$image=$site."/image/".$app["id"]."/".$screenshot["id"].".jpg";
					}
					else {
						$image=$screenshot["image"];
					}
				}
				else {
					$image=$screenshot["image"];
				}
				if($amp) { break; }
				if(!isset($imgscrn)) {
					$imgscrn=$image;
				}
				?>
				<div class="item">
					<div class="img img-2">
						<?= $amp ? "<amp-img ".$image_info." layout=\"responsive\"" : "<img"; ?> src="<?= $image ?>"><?= $amp ? "</amp-img>" : ""; ?>
					</div>
				</div>
				<?php if($amp) { ?><br><?php } ?>
			<?php } ?>
		</div>
		</div><div class="col-sm-12<?= isRTL($lang) ? " app-content" : "" ?>">
			<?php if(!$amp) { ?>
			<script type="application/ld+json">{"@context" : "http://schema.org","@type" : "MobileApplication","applicationCategory" : "<?= path($category["slug"]) ?>","name" : "<?= $app["title"] ?>", "description" : "<?= $description ?>","operatingSystem" : "Android","installUrl" : "<?= $site ?>/<?= $lang ?>/download/<?= $app["packageName"] ?>","image" : "<?= $site."/image/" . $app["id"] ."/icon.webp" ?>","screenshot" : "<?= $imgscrn ?>", "aggregateRating": {"@type": "AggregateRating","ratingValue": "4","ratingCount": "<?= $app["id"] ?>","reviewCount": "<?= 1+ceil($app["id"] / 10) ?>"},"offers" : {"@type" : "Offer","url" : "<?= $site ?>/<?= $lang ?>/<?= $category["slug"]?>/<?= $app["packageName"] ?>/","price": 0,"priceCurrency" : "USD"}}</script>
			<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "BreadcrumbList",
				"itemListElement": [{
					"@type": "ListItem",
					"position": 1,
					"name": "<?= $translates[$lang]["broad_title"] ?>",
					"item": "<?= $site ?>/<?= $lang ?>/"
				},{
					"@type": "ListItem",
					"position": 2,
					"name": "<?= $category["name".strtoupper($lang)] ?>",
					"item": "<?= $site ?>/<?= $lang ?>/<?= $category["slug"] ?>/"
				},{
					"@type": "ListItem",
					"position": 3,
					"name": "<?= $app["title"] ?>"
				}]
			}
			</script>
			<?php } ?>
			<br>
			<div<?= isRTL($lang) ? " class=\"app-content\"" : ""?>>
			<?= $descriptionText ?>
			<?php ads(2, $amp); ?>
			<?= isset($keywordDubliacte) ? "" : $descriptionTiny?>
			</div>
			<br>
			<a target="_blank" href="<?= $site ?>/<?=$lang?>/download/<?= $app["packageName"] ?>/" class="btn btn-primary btn-block download btn-lg"><?= $category["isGame"] == 1 ? $translates[$lang]["download_game"] : $translates[$lang]["download_app"] ?></a>
			<?php if(!$amp) { ?><br><?php } ?>
			<br>
		</div>
		<?php
		ads(3, $amp);
		?>
		<?php if(count($others) > 0 && !$amp) { ?>
		<div class="col-sm-12">
			<h3<?= isRTL($lang) ? " class=\"app-content\"" : ""?>><?= $translates[$lang]["relateds"] ?></h3>
			<br>
			<div class="row">
			<?php
			foreach($others as $other) {
				modalApp($other, 2, 3, 6, 6, $category["slug"], $category["isGame"]);
			}
			?>
			</div>
		</div>
		<?php
		}
		ads(3, $amp);
		?>
	</div>
</div>
<?php if(!$amp) { ?>
<script type="text/javascript">
var dls = $(".download").offset().top;
console.log(dls);
$(window).scroll(function(event){
	var st = $(this).scrollTop();
	$(".download").fadeIn();
	/*
	if(st > 100){
	}
	*/
});
</script>
<?php } ?>
<?php
include "_footer.php";
include "_close.php";
?>
