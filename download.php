<?php
include "_core.php";
include "_begin.php";
$noindex=true;
$cli=false;
if(isset($argv[1])) {
	$cli=true;
	$package=$argv[1];
	if(isset($argv[2])) {
		$lang=$argv[2];
	}
}
else if(isset($_GET['package'])) {
	$package=$_GET['package'];
}
else {
	include "404.php";
	exit();
}
$package=str_replace("%", "", $package);
$package=str_replace("'", "", $package);
$app=$db->select("application", ["packageName"=>$package, "lang"=>$lang], "", $appModalFields);
if($app == null || !isset($app["title"]) || $app["title"] == "") {
	include "404.php";
	exit();
}
if($cli) {
	print_r($app);
}
$ID=$app["id"];
$db->insert("app_download", ["appID"=>$ID]);
function curl_get_file_size($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
	curl_setopt($ch, CURLOPT_ENCODING,"");
	$content = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$totalsize = strlen($httpCode);
	$stats = curl_getinfo($ch);
	$size1 = $stats['size_download'];
	$size2 = $stats['download_content_length'];
	return $size2;
}
if(isset($_GET['download']) or $cli) {
	if($app["source"] == 1) {
		
		$file_name=$package;
		$file_name=str_replace(".", "-", $file_name);
		$file_name=$file_name.".apk";
		$file_url="https://maxbase.org?q=link of download .apk file"; // need to get from other back-end service::Private
		header("Location: ".$file_url);
		$size=curl_get_file_size($file_url);
		$db->update("application", ["id"=>$ID], ["filesize"=>$size]);

		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.$file_name.'"');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . $size);

		if($cli) {
			print $file_url."\n";
			file_put_contents("test.apk", file_get_contents($file_url));
		}
		// ob_clean();
		// flush();
		// readfile($file_url);
	}
	else if($app["source"] == 2) {
		$url="https://maxbase.org?q=link of download .apk file"; // need to get from other back-end service
		$res=get($url);
		$json=json_decode($res[0], true);
		if($cli) {
			print $url."\n";
			print_r($json);
		}
		if(isset($json["files"]["file"])) {
			$file_url=$json["files"]["file"];
			if($cli) {
				print $file_url."\n";
				file_put_contents("test.apk", file_get_contents($file_url));
			}
			header("Location: ".$file_url);
		}
		else {
			$error="Cannot download this .apk file!";
			if(isset($json["error"])) {
				$error=$json["error"];
			}
			exit("<h1>".$error."</h1>");
		}
	}
	exit();
	return;
}
?>
<?php include "_header.php" ?>
		<div class="container mt-3">
			<div class="row">
				<div class="col-sm-3">
					<center>
						<img src="<?= $app["icon"] ?>" width="90%">
					</center>
				</div>
				<div class="col-sm-9">
					<br>
					<h2>Downloading <?= $app["title"] ?>...</h2>
					<br>
					<h5>Please wait 1 seconds...</h5>
					<meta http-equiv = "refresh" content = "1;url=<?= $site?>/<?= $lang ?>/download/<?= $package ?>/?download">
					<br>
				</div>
				<br><br>
				<div class="col-sm-12">
					<br>
					<center>
						<h3><a target="_blank" href="https://t.me/iapk_bot">دانلود بازی و برنامه اندروید با ربات تگرام @iapk_bot</a></h3>
					</center>
				</div>
				<div class="col-sm-6">
					<?php
					ads(4, $amp);
					?>
				</div>
				<div class="col-sm-6">
					<?php
					ads(4, $amp);
					?>
				</div>
			</div>
		</div>
<?php include "_close.php" ?>
