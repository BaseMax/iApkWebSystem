<?php
include "../_core.php";
if(!isset($_GET["id"])) {
	exit("Error!");
}
$id=$_GET["id"];
$clauses=["id"=>$id];
if(isset($_POST["submit"])) {
	unset($_POST["language"]);
	unset($_POST["source"]);
	unset($_POST["submit"]);
	$db->update("application", $clauses, $_POST);
}
$app=$db->select("application", $clauses, "", "title,packageName,categoryID,recentChanges,descriptionTiny,description,authorName,versionName,installs,rate,lastUpdated,minimumSDKVersion,size,icon,lang,source");
if(isset($_GET["log"])) {
	print_r($app);
}
$categories=$db->selects("application_category", ["name".strtoupper($app["lang"])=>["!=","and",""]], "", "id,slug,name".strtoupper($app["lang"]));
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Edit Application</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<h2><?= $app["title"] ?></h2>
			<form method="POST" class="form-horizontal" action="">
				<?php foreach($app as $key=>$value) { ?>
				<?php if($key == "source" or $key == "lang") {continue;} ?>
				<div class="form-group">
					<label class="control-label col-sm-2" for="<?= $key ?>"><?= $key ?>:</label>
					<div class="col-sm-10">
						<?php if($key == "categoryID") { ?>
						<select name="categoryID">
							<?php foreach($categories as $cat) { ?>
							<option<?= ($cat["id"] == $app[$key]) ? " selected" : "" ?> value="<?= $cat["id"] ?>"><?= $cat["name".strtoupper($app["lang"])] ?> (<?= $cat["slug"]?>)</option>
							<?php } ?>
						</select>
						<?php } else if($key == "description" or $key=="descriptionTiny" or $key=="recentChanges") { ?>
						<textarea class="form-control" id="<?= $key ?>" name="<?= $key ?>"><?= $value ?></textarea>
						<?php } else { ?>
						<input type="text" class="form-control" id="<?= $key ?>" name="<?= $key ?>" value="<?= $value ?>">
						<?php } ?>
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label class="control-label col-sm-2" for="language">language:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="language" name="lang" value="<?= $app["lang"] ?>" disable="">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="source">source:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="source" name="source" value="<?= $app["source"] == "1" ? "Cafe Bazzar" : "Google Play" ?>" disable="">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button name="submit" type="submit" class="btn btn-default">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
