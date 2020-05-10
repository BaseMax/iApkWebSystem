<?php include "_core.php" ?>
<?php include "_begin.php" ?>
<?php
if(!isset($_GET['q'])) {
	exit();
}
$q=$_GET['q'];
$q=urldecode($q);
$q=str_replace("%", "", $q);
$q=str_replace("'", "", $q);
$q=str_replace("\"", "", $q);
$apps=search($q);
// exec("php ../service/parser.php ".$q." &");
?>
<?php include "_header.php" ?>
<div class="container mt-3">
	<?php include "_slider.php" ?>
	<div class="row">
		<div class="col-sm-12">
			<br>
			<h2<?= $lang=="en"?"":" style=\"text-align: right;direction: rtl;\""?>><?= $lang == "en" ? "Search Application" : "جستجو اپلیکیشن اندرویدی" ?></h2>
			<h1<?= $lang=="en"?"":" style=\"text-align: right;direction: rtl;\""?>><?= $lang == "en" ? "Search" : "جستجو" ?> "<?= $q ?>"</h1>
			<br>
			<div class="row">
				<?php
				foreach($apps as $app) {
					modalApp($app);
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