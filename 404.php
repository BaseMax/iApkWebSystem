<?php
unset($isSingle);
$is404=true;
if(!defined("LOAD")) {
	include "_core.php";
}
header("HTTP/1.0 404 Not Found");
// include "_core.php";
// include "_begin.php";
include "_header.php";
?>
<div class="container mt-3">
	<?php include "_slider.php" ?>
	<div class="row">
		<div class="col-sm-12">
			<center>
				<h5><?= $translates[$lang]["index_h5_title"] ?></h5>
			</center>
			<br>
			<?php
			ads(1, $amp);
			$apps=$db->selects("application", ["lang"=>$lang], "ORDER BY `id` DESC LIMIT 12", $appModalFields);?>
			<br>
			<div class="row">
				<?php
				foreach($apps as $app) {
					modalApp($app);
				}
				?>
			</div>
			<?php
			ads(1, $amp);
			?>
		</div>
	</div>
</div>
<?php
include "_footer.php";
include "_close.php";
?>