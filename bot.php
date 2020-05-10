<?php
include "netphp.php";
include "/site/iapk.org/root/_core.php";
$token="1202498088:AAF0C3Y03fmHV-QBW_rSxvN72mhKs2cHxNc";
$uri="https://api.telegram.org/bot".$token."/";
$fileuri="https://api.telegram.org/file/bot".$token."/";
$input=file_get_contents("php://input");
$json=json_decode($input, true);
if($input == "") {
	exit("Error!\n");
}
function sendMessage($chatID, $message, $replyID=null, $html=false, $preview=false) {
	global $token, $uri;
	$param=[];
	$param["text"]=$message;
	$param["chat_id"]=$chatID;
	if($replyID != null) {
		$param["reply_to_message_id"]=$replyID;
	}
	if($html == true) {
		$param["parse_mode"]="HTML";
	}
	$param["disable_web_page_preview"]=$preview;
	return post($uri."sendMessage", $param)[0];
}
function getFile($fileID) {
	global $token, $uri;
	$param=[];
	$param["file_id"]=$fileID;
	return post($uri."getFile", $param)[0];
}
function sendPhoto($chatID, $photo, $caption="", $replyID=null) {
	global $token, $uri;
	$param=[];
	$param["chat_id"]=$chatID;
	$param["photo"]=new CURLFile($photo);
	$param["caption"]=$caption;
	if($replyID != null) {
		$param["reply_to_message_id"]=$replyID;
	}
	return post($uri."sendPhoto", $param)[0];
}
function sendDocument($chatID, $document, $caption="", $replyID=null) {
	global $token, $uri;
	$param=[];
	$param["chat_id"]=$chatID;
	$param["document"]=new CURLFile($document);
	$param["caption"]=$caption;
	if($replyID != null) {
		$param["reply_to_message_id"]=$replyID;
	}
	return post($uri."sendDocument", $param)[0];
}
/////////////////////////////////////////////////////
$command="tesseract -l eng+fas ";
$json["message"]["text"].="\n0:".print_r($json, true);
if(isset($json["message"]["photo"])) {
	$image=$json["message"]["photo"];
	$image=json_decode(getFile($image[count($image)-1]["file_id"]), true)["result"]["file_path"];
	$filename=rand(100,9899) . ".jpg";
	file_put_contents($filename, get($fileuri.$image)[0]);
	sendPhoto($json["message"]["chat"]["id"], "img.jpg", "3");
	sendPhoto($json["message"]["chat"]["id"], $filename, "3");
	sendDocument($json["message"]["chat"]["id"], "NetPHP.php", "PHP net library" . "\n" . $fileuri.$image);
}
else if(isset($json["message"]["document"])) {
}
// $json["message"]["text"].="\n<img src=\"\">";
sendMessage($json["message"]["chat"]["id"], $json["message"]["text"], $json["message"]["message_id"]);
