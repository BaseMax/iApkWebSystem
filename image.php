<?php include "_core.php" ?>
<?php include "_begin.php" ?>
<?php
if(!isset($_GET['package'])) {
	exit();
}
$package=$_GET['package'];
$package=str_replace("%", "", $package);
$package=str_replace("'", "", $package);
$app=$db->select("application", ["packageName"=>$package], "", "id,icon");
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
	return [$content, $size2];

	// $curl = curl_init($remoteFile);
	// curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	// curl_setopt($curl, CURLOPT_HEADER, true);
	// curl_setopt($curl, CURLOPT_NOBODY, true);
	// curl_exec($curl);
	// $fileSize = curl_getinfo($curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
	// return $fileSize;

	// var_dump($fileSize);
	// $fileSizeKB = round($fileSize / 1024);
	// echo 'File is ' . $fileSizeKB . ' KB in size.';
	// $result = -1;
	// $curl = curl_init($url);
	// curl_setopt($curl, CURLOPT_NOBODY, true );
	// curl_setopt($curl, CURLOPT_HEADER, true );
	// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
	// curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true );
	// curl_setopt($curl, CURLOPT_USERAGENT, get_user_agent_string() );
	// $data = curl_exec($curl);
	// curl_close($curl);
	// if($data) {
	// 	$content_length = "unknown";
	// 	$status = "unknown";
	// 	if(preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
	// 		$status = (int)$matches[1];
	// 	}
	// 	if(preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
	// 		$content_length = (int)$matches[1];
	// 	}
	// 	// http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
	// 	if($status == 200 || ($status > 300 && $status <= 308)) {
	// 		$result = $content_length;
	// 	}
	// }
	// return $result;
}

if(isset($_GET['screenshot'])) {
	$screenshot=$_GET['screenshot'];
	$screenshot=str_replace("%", "", $screenshot);
	$screenshot=str_replace("'", "", $screenshot);
	$screenshot=$db->select("app_screenshot", ["appID"=>$app["id"], "id"=>$screenshot]);
	if($screenshot == null || !isset($screenshot["image"]) || $screenshot["image"] == "") {
		exit();
	}
	$file_name="screenshot-" . $package . "-" . $screenshot["id"] . ".jpg";
	$file_url='https://s.cafebazaar.ir/1/' . $screenshot["image"];
	header("Location: ". $file_url);
	exit();
	$data=curl_get_file_size($file_url);
	// print $file_url."\n". $size."\n"; exit();
	// header('Content-Description: File Transfer');
	// header('Content-Type: application/octet-stream');
	header('Content-Type: image/jpg');
	header('Content-Disposition: attachment; filename="'.$file_name.'"');
	// header('Content-Transfer-Encoding: binary');
	//header('Expires: 0');
	//header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . $data[1]);
	ob_clean();
	flush();
	print $data[0];
	// readfile($file_url);
	exit();
}
else if(isset($_GET['icon'])) {
	$file_name="icon-" . $package . ".jpg";
	$file_url=$app["icon"];
	header("Location: ". $file_url);
	exit();
	//$data=curl_get_file_size($file_url);
	// print $file_url."\n". $size."\n"; exit();
	// header('Content-Description: File Transfer');
	// header('Content-Type: application/octet-stream');
	header('Content-Type: image/webp');
	//header('Content-Disposition: attachment; filename="'.$file_name.'"');
	// header('Content-Transfer-Encoding: binary');
	//header('Expires: 0');
	//header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	//header('Pragma: public');
	//header('Content-Length: ' . $data[1]);
	//ob_clean();
	//flush();
	//print $data[0];
	print file_get_contents($file_url);
	// readfile($file_url);
	exit();
}
