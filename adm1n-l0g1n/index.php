<?php
include "../_core.php";
$lang="en";
if(isset($_GET["lang"])) {
	$lang=$_GET["lang"];
}
$page=1;
if(isset($_GET["page"])) {
	$page=(int)$_GET["page"];
}
function table($lang) {
	global $db;
	global $site;
	global $page;
	$pageItem=100;
	$result=
'	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Package Name</th>
				<th>Category</th>
				<th>Source</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>';
	$count=$db->count("application", ["lang"=>$lang], "", "id");
	$apps=$db->selects("application", ["lang"=>$lang], "ORDER BY `id` DESC LIMIT ".$pageItem." OFFSET ".($page-1)*$pageItem, "id,title,packageName,categoryID,date,source");
	foreach($apps as $app) {
		$catCount=$db->count("application_category", ["id"=>$app["categoryID"]], "", "id");
		if($catCount > 0) {
			$app["category"]=$db->select("application_category", ["id"=>$app["categoryID"]], "", "name".strtoupper($lang).",slug");
			$app["categorySlug"]=$app["category"]["slug"];
			$app["category"]=$app["category"]["name".strtoupper($lang)];
			$app["categoryLink"]='<a href="'.$site."/".$app["categorySlug"]."/".$app["packageName"]."/".'">'.$app["category"].'</a>';
		}
	$result.='<tr';
	if($count == 0) {
		$result.=' style="background:red;"';
	}
	else if($app["packageName"] == "") {
		$result.=' style="background:blue;"';
	}
	$result.='>
				<td><a href="view.php?id='.$app["id"].'">'.$app["id"].'</a></td>
				<td>'.$app["title"].'</td>
				<td>'.$app["packageName"].'</td>
				<td>'.(isset($app["categoryLink"]) ? $app["categoryLink"] : "None").'</td>
				<td>'.($app["source"] == 1 ? "Cafe Bazzar" : "Google Play").'</td>
				<td>'.$app["date"].'</td>
			</tr>';
	}
	$result.=
		'</tbody>
	</table>
	<ul class="pagination">';
	$pages=floor($count/$pageItem);
	for($i=1;$i<=$pages;$i++) {
		$result.='<li';
		$result.=$i == $page ? ' class="active"' : '';
		$result.='><a href="?lang='.$lang.'&page='.$i.'">'.$i.'</a></li>';
	}
	$result.='</ul>
';
	return $result;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Panel</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<h1>Application</h1>
			<p>List of all application in diffrent tab for every language:</p>
			<ul class="nav nav-tabs">
				<?php foreach($translates as $code=>$translate) { ?>
				<li<?= $lang==$code ? ' class="active"' : ''?>>
					<!-- <a data-toggle="tab" href="#<?= $code ?>"> -->
					<a href="?lang=<?= $code ?>&page=<?= $lang==$code ? $page : 1 ?>">
						<?= $translate["name"] ?></a>
					</a>
				</li>
				<?php } ?>
			</ul>
			<div class="tab-content">
				<?= table($lang) ?>
			</div>
		</div>
	</body>
</html>
