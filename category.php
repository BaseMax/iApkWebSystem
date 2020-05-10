<?php include "_core.php" ?>
<?php include "_begin.php" ?>
<?php
if(!isset($_GET['id'])) {
	exit();
}
$id=$_GET['id'];
$id=urldecode($id);
$id=str_replace("'", "", $id);
$category=$db->select("application_category", ["slug"=>$id], "", $categoryFields);
if(isset($category["id"])) {
	$apps=$db->selects("application", ["lang"=>$lang,"categoryID"=>$category["id"]], "", $appModalFields);
}
else {
	include "404.php";
	exit();
}
$name=$category["name".strtoupper($lang)];
$title=(($category["isGame"] == 1) ? $translates[$lang]["title_app_category_for"] : $translates[$lang]["title_game_category_for"]).$name;
?>
<?php include "_header.php" ?>
		<div class="container mt-3">
<?php include "_slider.php" ?>
			<div class="row">
				<div class="col-sm-12">
					<br>
					<h1<?= isRTL($lang) ? " style=\"text-align: right;direction: rtl;\"" : ""?>><?= $name ?></h1>
					<h2<?= isRTL($lang) ? " style=\"text-align: right;direction: rtl;\"" : ""?>><?= $title ?></h2>
					<br>
					<div class="row">
						<?php
						foreach($apps as $app) {
							modalApp($app, 2, 4, 6, 12, $category["slug"], $category["isGame"]);
						}
						?>
					</div>
				</div>
			</div>
		</div>
<?php
include "_footer.php";
include "_close.php";
?>