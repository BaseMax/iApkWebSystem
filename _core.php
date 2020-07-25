<?php
/*
 * @Author: Max Base
 * @Repository: https://github.com/BaseMax/iApkWebSystem
 * @Website: https://iapk.org/
*/
define("LOAD", true);
include "netphp.php";
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
date_default_timezone_set('America/New_York');
date_default_timezone_set('Asia/Tehran');
/*
function ip_check($ip, $allow_private = false, $proxy_ip = [])
{
  if(!is_string($ip) || is_array($proxy_ip) && in_array($ip, $proxy_ip)) return false;
  $filter_flag = FILTER_FLAG_NO_RES_RANGE;

  if(!$allow_private)
  {
    //Disallow loopback IP range which doesn't get filtered via 'FILTER_FLAG_NO_PRIV_RANGE' [1]
    //[1] https://www.php.net/manual/en/filter.filters.validate.php
    if(preg_match('/^127\.$/', $ip)) return false;
    $filter_flag |= FILTER_FLAG_NO_PRIV_RANGE;
  }
  return filter_var($ip, FILTER_VALIDATE_IP, $filter_flag) !== fals
*/
// https://github.com/BaseMax/PHPJalaliDate
function jalaliDate() {
	$input=[
		"year"=>date("Y"),
		"month"=>date("m"),
		"day"=>date("d"),
	];
	$result=[];
	$array=[0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
	if($input["year"]<=1600) {
		$input["year"]-=621;
		$result["year"]=0;
	}
	else {
		$input["year"]-=1600;
		$result["year"]=979;
	}
	$temp=($input["year"]>2)?($input["year"]+1):$input["year"];
	$days=((int)(($temp+3)/4)) + (365*$input["year"]) - ((int)(($temp+99)/100)) - 80 + $array[$input["month"]-1] + ((int)(($temp+399)/400)) + $input["day"];
	$result["year"]+=33*((int)($days/12053)); 
	$days%=12053;
	$result["year"]+=4*((int)($days/1461));
	$days%=1461;
	if($days > 365){
		$result["year"]+=(int)(($days-1)/365);
		$days=($days-1)%365;
	}
	$result["month"]=($days < 186)?1+(int)($days/31):7+(int)(($days-186)/30);
	$result["day"]=1+(($days < 186)?($days%31):(($days-186)%30));
	if($result["month"] < 10) {
		$result["month"]="0".$result["month"];
	}
	if($result["day"] < 10) {
		$result["day"]="0".$result["day"];
	}
	return $result;
}
// print_r( jalaliDate() );
if(isset($argv[0])) {
	$_GET["log"]=true;
}
$default_image_info="width=\"350\" height=\"350\"";
$styleAmpFile="test.css";
$styleFile="style.css";
$translates=[];
$translates["de"]=[
	"flag"=>"de",
	"code"=>["de-DE"],
	"name"=>"German",
	"headerName"=>"iAPK",
	"title"=>"iAPK - Kostenloser Download Android Apk-Datei",
	"broad_title"=>"German - Laden Sie android apk",
	"description"=>"",
	"keyword"=>"",
	"slider_title"=>"iAPK - Kostenloser Download Android-Anwendung apk-Datei",
	"slider_subtitle"=>"Kostenloser Download der neuesten Version von Android Apps und Spielen",
	"search_field"=>"tippe um zu suchen",
	"download"=>"Herunterladen",
	"download_app"=>"Lade App herunter",
	"download_game"=>"Spiel herunterladen",
	"app"=>"Anwendung",
	"game"=>"Spiel",
	"title_app_category_for"=>"Android-Anwendung für ",
	"title_game_category_for"=>"Android-Spiel für ",
	"title_app_category"=>"Android-Anwendung ",
	"title_game_category"=>"Android-Spiel ",
	"relateds"=>"Verwandte Anwendungen",
	"title_single_app"=>"Laden Sie android apk ",
	"title_single_game"=>"Download Android-Spiel apk ",
	"index_category_title"=>"Beste Android-Anwendung",
	"index_h5_title"=>"Einfache Suchmaschine zum Herunterladen der Anwendung",
	"enable"=>true,
];
$translates["fr"]=[
	"flag"=>"fr",
	"code"=>["fr-FR"],
	"name"=>"French",
	"local_name"=>"Le français",
	"headerName"=>"iAPK",
	"title"=>"iAPK - Téléchargez gratuitement le fichier APK Android",
	"broad_title"=>"English - Télécharger apk android",
	"description"=>"",
	"keyword"=>"",
	"slider_title"=>"iAPK - Téléchargement gratuit du fichier apk de l'application Android",
	"slider_subtitle"=>"Téléchargez gratuitement la dernière version des applications et des jeux Android",
	"search_field"=>"tapez pour rechercher",
	"download"=>"Télécharger",
	"download_app"=>"Télécharger l'appli",
	"download_game"=>"Télécharger le jeu",
	"app"=>"Application",
	"game"=>"Jeu",
	"title_app_category_for"=>"Application Android pour ",
	"title_game_category_for"=>"Jeu Android pour ",
	"title_app_category"=>"Application Android ",
	"title_game_category"=>"Jeu Android ",
	"relateds"=>"Applications associées",
	"title_single_app"=>"Télécharger apk android ",
	"title_single_game"=>"Télécharger Android Game APK ",
	"index_category_title"=>"Meilleure application Android",
	"index_h5_title"=>"Moteur de recherche simple pour télécharger l'application",
	"enable"=>true,
];
$translates["sw"]=[
	"flag"=>"sw",
	"code"=>["sv-SE"],
	"name"=>"Swedish",
	"headerName"=>"iAPK",
	"title"=>"iAPK - Gratis nedladdning android apk fil",
	"broad_title"=>"English - Ladda ner android apk",
	"description"=>"",
	"keyword"=>"",
	"slider_title"=>"iAPK - Gratis nedladdning av apk-filen för Android-applikationer",
	"slider_subtitle"=>"Gratis nedladdning senaste versionen av Android-appar och spel",
	"search_field"=>"typ för att söka",
	"download"=>"Ladda ner",
	"download_app"=>"Ladda ner app",
	"download_game"=>"Ladda ner spel",
	"app"=>"Ansökan",
	"game"=>"Spel",
	"title_app_category_for"=>"Android-applikation för ",
	"title_game_category_for"=>"Android-spel för ",
	"title_app_category"=>"Android-applikation ",
	"title_game_category"=>"Android-spel ",
	"relateds"=>"Relaterade applikationer",
	"title_single_app"=>"Ladda ner android apk ",
	"title_single_game"=>"Ladda ner Android-spel apk ",
	"index_category_title"=>"Bästa Android-applikation",
	"index_h5_title"=>"Enkel sökmotor för att ladda ner applikationen",
	"enable"=>true,
];
$translates["pt"]=[
	"flag"=>"pt",
	"code"=>["pt-PT"],
	"name"=>"Portuguese",
	"headerName"=>"iAPK",
	"title"=>"iAPK - Baixar grátis android apk arquivo",
	"broad_title"=>"English - Baixar android apk",
	"description"=>"",
	"keyword"=>"",
	"slider_title"=>"iAPK - Baixar grátis aplicativo Android arquivo apk",
	"slider_subtitle"=>"Download grátis versão mais recente dos aplicativos e jogos para Android",
	"search_field"=>"escreva para pesquisar",
	"download"=>"Baixar",
	"download_app"=>"Baixar aplicativo",
	"download_game"=>"Baixar jogo",
	"app"=>"Inscrição",
	"game"=>"jogos",
	"title_app_category_for"=>"Aplicativo Android para ",
	"title_game_category_for"=>"Jogo Android para ",
	"title_app_category"=>"Aplicativo Android ",
	"title_game_category"=>"Jogo Android ",
	"relateds"=>"Aplicações relacionadas",
	"title_single_app"=>"Baixar android apk ",
	"title_single_game"=>"Baixar jogo android apk ",
	"index_category_title"=>"Melhor Aplicativo para Android",
	"index_h5_title"=>"Fácil mecanismo de pesquisa para baixar o aplicativo",
	"enable"=>true,
];
$translates["en"]=[
	"flag"=>"en",
	"code"=>["en-us", "en-gb"],
	"name"=>"English",
	"headerName"=>"iAPK",
	"title"=>"iAPK - Free download android apk file",
	"broad_title"=>"English - Download android apk",
	"description"=>"",
	"keyword"=>"",
	"slider_title"=>"iAPK - Free Download Android application apk file",
	"slider_subtitle"=>"Free Download latest version of android apps and games",
	"search_field"=>"type to search",
	"download"=>"Download",
	"download_app"=>"Download App",
	"download_game"=>"Download Game",
	"app"=>"Application",
	"game"=>"Game",
	"title_app_category_for"=>"Android application for ",
	"title_game_category_for"=>"Android game for ",
	"title_app_category"=>"Android application ",
	"title_game_category"=>"Android game ",
	"relateds"=>"Related Applications",
	"title_single_app"=>"Download android app apk ",
	"title_single_game"=>"Download android game apk ",
	"index_category_title"=>"Best Android Application",
	"index_h5_title"=>"Easy search engine to download the application",
	"enable"=>true,
];
$translates["fa"]=[
	"flag"=>"fa",
	"code"=>["fa-IR"],
	"name"=>"فارسی",
	"headerName"=>"iAPK",
	"title"=>"دانلود رایگان برنامه و اپلیکیشن اندروید - iapk",
	"broad_title"=>"فارسی - دانلود اندروید apk",
	"description"=>"",
	"keyword"=>"",
	"slider_title"=>"iAPK - دانلود برنامه و اپلیکیشن های اندروید",
	"slider_subtitle"=>"دانلود آخرین نسخه برنامه ها و بازی های اندرویدی",
	"search_field"=>"نام برنامه مورد نظر را جستجو کنید",
	"download"=>"دانلود",
	"download_app"=>"دانلود برنامه",
	"download_game"=>"دانلود بازی",
	"app"=>"برنامه",
	"game"=>"بازی",
	"title_app_category_for"=>"برنامه اندروید برای ",
	"title_game_category_for"=>"بازی اندروید برای ",
	"title_app_category"=>"برنامه اندروید ",
	"title_game_category"=>"بازی اندروید ",
	"relateds"=>"اپلیکیشن های مرتبط",
	"title_single_app"=>"دانلود برنامه اندروید ",
	"title_single_game"=>"دانلود بازی اندروید ",
	"index_category_title"=>"بهترین اپلیکیشن های اندروید",
	"index_h5_title"=>"موتور جستجو آسان برای دانلود اپلیکیشن و بازی های اندرویدی بصورت رایگان",
	"enable"=>true,
];
$translates["ar"]=[
	"flag"=>"ar",
	"code"=>["ar-sa", "ar-ae"],
	"name"=>"العربی",
	"headerName"=>"iAPK",
	"title"=>"قم بتنزيل تطبيق Android المجاني والتطبيق - iapk",
	"broad_title"=>"العربی - تنزيل التطبيق apk",
	"description"=>"",
	"keyword"=>"",
	"slider_title"=>"iAPK - تنزيل تطبيقات وتطبيقات Android",
	"slider_subtitle"=>"قم بتنزيل أحدث إصدار من تطبيقات وألعاب Android",
	"search_field"=>"ابحث عن اسم البرنامج",
	"download"=>"تنزيل",
	"download_app"=>"تنزيل التطبيق",
	"download_game"=>"قم بتنزيل اللعبة",
	"app"=>"البرنامج",
	"game"=>"العب",
	"title_app_category_for"=>"تطبيق Android ",
	"title_game_category_for"=>"لعبة اندرويد ",
	"title_app_category"=>"تطبيق Android ",
	"title_game_category"=>"لعبة اندرويد ",
	"relateds"=>"تطبيقات ذات صلة",
	"title_single_app"=>"قم بتنزيل لعبة Android ",
	"title_single_game"=>"قم بتنزيل تطبيق Android ",
	"index_category_title"=>"أفضل تطبيقات أندرويد",
	"index_h5_title"=>"محرك بحث سهل لتنزيل تطبيقات وألعاب Android مجانًا",
	"enable"=>true,
];
$translatesCodes=[];
foreach($translates as $code=>$translate) {
	$translatesCodes[]=$code;
}
////////////////////////////////////////////////
function appIcon($app, $local=false) {
	global $site;
	// if(!isset($app["source"])) {
	// 	print "Want source of: \n";
	// 	print_r($app);
	// 	print "\n";
	// }
	if($app["source"] == 1) {
		if(file_exists("image/".$app["id"]."/icon.webp")) {
			if($local) {
				return [true, "image/".$app["id"]."/icon.webp"];
			}
			return $site."/image/".$app["id"]."/icon.webp";
		}
	}
	if($local) {
		return [false, $app["icon"]];
	}
	return $app["icon"];
}
function appIconInfo($image) {
	// if($image[0] == false) {
	$temp="/tmp/".rand(1000,9999).rand(1000,9999).".jpg";
	$res=get($image);
	if(isset($_GET["log"])) {
		print $image."\n";
		print $temp."\n";
		print_r($res);
	}
	file_put_contents($temp, $res[0]);
	// }
	// else {
	// 	$temp=$image[1];
	// }
	if(file_exists($temp) && $info=getimagesize($temp)) {
		// unlink($temp);
		if($info and is_array($info) and isset($info[3])) {
			return $info[3];
		}
	}
	if(isset($_GET["log"])) {
		print_r($image);
		print_r($temp);
		print_r($info);
	}
	return "width=\"200\" height=\"400\"";
	return "";
}
function isRTL($lang) {
	if($lang == "fa" || $lang == "ar") {
		return true;
	}
	return false;
}
function changeLang($link, $newLang) {
	global $translatesCodes;
	global $ampLinkNormal;
	global $site;
	global $is404;
	if(isset($is404) and $is404 == true) {
		return $site."/".$newLang."/";
	}
	if($site."/" == $ampLinkNormal) {
		return $site."/".$newLang."/";
	}
	foreach($translatesCodes as $code) {
		$link=str_replace("//iapk.org/$code", "//iapk.org/$newLang", $link);
	}
	return $link;
}
$starttime = microtime(true);
include "phpedb.php";
if(!isset($_GET["lang"])) {
	$lang="en";
}
else {
	$lang=$_GET["lang"];
}
if($lang == "download") {
	$is404=true;
	$lang="en";
}
$db=new database();
$db->connect("localhost", "root", "********************");
$db->db="iapk";
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
$appModalFields="id,title,icon,categoryID,packageName,source";
$appSingleFields="*";
$categoryFields="id,slug,isGame,name".strtoupper($lang);
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
function startsWith($string, $startString) { 
	$len = strlen($startString);
	return (substr($string, 0, $len) === $startString);
}

function endsWith($haystack, $needle) {
	$length = strlen($needle);
	if ($length == 0) {
		return true;
	}
	return (substr($haystack, -$length) === $needle);
}

$site="https://iapk.org";
if(isset($_SERVER['HTTP_HOST'], $_SERVER['HTTPS'])) {
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
else {
	$CurPageURL="http://localhost/";
}
$amp=false;
$ampLink=$CurPageURL;
$ampLinkNormal=$CurPageURL;
if(isset($_GET['amp'])) {
	$amp=true;
	// print_r($_GET);
	// if(endsWith($CurPageURL, "?amp") && isset($_GET['amp'])) {
	if(endsWith($CurPageURL, "?amp")) {
		$ampLinkNormal=mb_substr($ampLink, 0, -4);
	}
}
else {
	$ampLink.="?amp";
}
function path($v) {
	$v=str_replace("-", " ", $v);
	$v=ucfirst($v);
	return $v;
}
function search($q) {
	global $db;
	global $lang;
	global $appModalFields;
	return $db->selects("application", ["lang"=>$lang,"title"=>["LIKE", "and", '%'.$q.'%'], "packageName"=>["LIKE", "or", '%'.$q.'%']], "", $appModalFields);
}
function modalApp($app, $lg=2, $md=4, $sm=6, $xs=6, $cat=null, $isGame=false) {
	global $default_image_info;
	global $site;
	global $amp;
	global $lang;
	global $translates;
	global $db;
	if($cat == null) {
		$cat=$db->select("application_category", ["id"=>$app["categoryID"]], "", "slug,isGame");
		if(!$cat || trim($cat["slug"])=="") {
			if(isset($_GET["log"])) {
				print_r($app);
				print_r($cat);
			}
			return;
		}
		$isGame=$cat["isGame"];
		$cat=$cat["slug"];
	}
	$image=appIcon($app);
	// $image=appIcon($app, true);
	// if($image[0] == false) {
	// 	$temp="/tmp/".rand(1000,9999).rand(1000,9999).".jpg";
	// 	file_put_contents($temp, get($image[1])[0]);
	// }
	// else {
	// 	$temp=$image[1];
	// }
	// $image_info=getimagesize($temp);
	?>
	<div class="col-lg-<?= $lg ?> col-xs-<?= $xs ?> col-sm-<?= $sm ?> col-md-<?= $md ?> card-item">
		<div class="card">
			<a href="<?= $site ?>/<?= $lang ?>/<?= $cat ?>/<?= $app["packageName"] ?>/">
			<?= $amp ? "<amp-img layout=\"responsive\" ".$default_image_info."" : "<img class=\"lazyload\" width=\"100%\" height=\"100%\""; ?> <?= $amp ? "" : "data-" ?>src="<?= $image ?>" class="card-img-top" alt="<?= $isGame ? $translates[$lang]["download_game"] : $translates[$lang]["download_app"] ?> <?= $app["title"] ?>"><?= $amp ? "</amp-img>" : ""; ?>
			</a>
			<?php if(!$amp) { ?>
			<noscript>
			<img src="<?= $image ?>" class="card-img-top" alt="<?= $isGame ? $translates[$lang]["download_game"] : $translates[$lang]["download_app"] ?> <?= $app["title"] ?>">
			</noscript>
			<?php } ?>
			<div class="card-body">
				<center><a href="<?= $site ?>/<?= $lang ?>/<?= $cat ?>/<?= $app["packageName"] ?>/"><h3 class="card-title"><?= $app["title"] ?></h3></a></center>
				<h4 style="display: none;" class="card-title"><?= $app["packageName"] ?></h4>
				<center>
					<a href="<?= $site ?>/<?= $lang ?>/<?= $cat ?>/<?= $app["packageName"] ?>/" class="btn btn-primary"><?= ($md == 4) ? $translates[$lang]["download_app"] : $translates[$lang]["download"] ?></a>
				</center>
			</div>
		</div>
	</div>
	<?php
}

function countt($text, $word, $count = 0) {
	$found = '';
	for($i=0; $i<strlen($word);$i++){
		for($j=0; $j<strlen($text);$j++){
			if($word[$i] === $text[$j]){
				$text = substr($text,0,$j).substr($text,$j+1);
				$found.= $word[$i];
				if($found === $word){
					$count++;
					return countt($text,$word,$count);
				}
				break;
			}
		}
	}
	return $count;
}

function parseKey($v, $id=-1) {
	// $v=str_replace("<br>", "", $v);
	// $v=str_replace("<br >", "", $v);
	// $v=str_replace("<br/>", "", $v);
	// $v=str_replace("<br />", "", $v);
	$v=str_replace("،", "", $v);
	$v=str_replace(",", "", $v);
	$words=explode(" ", $v);
	// print_r($words);
	// $words=array_filter($words);
	// print_r(array_filter($words));
	$words_count=count($words);
	$keywords=[];
	for($i=0;$i<$words_count;$i++) {
		$word=trim($words[$i]);
		// if(strlen($word) >= 3) {
		if(mb_strlen($word) >= 3) {
			$i_countt=substr_count($v, $word);
			if($i_countt >= 4) {
				$keywords[$word]=true;
			}
			// print $i_countt." - ";
			for($j=$i+1;$j<$words_count;$j++) {
				$words[$j]=trim($words[$j]);
				if($words[$j] != "") {
					$word=$words[$i]. " ". $words[$j];
					$ij_countt=substr_count($v, $word);
					if($ij_countt >= 3) {
						$keywords[$word]=true;
					}
					// print $ij_countt . " - ";
				}
			}
			// print "\n";
		}
	}
	// $words=array_unique($words);
	// print_r($keywords);
	return $keywords;
	return $v;
}

// print_r(parseKey("فال حافظ شیرازی
// معمولا فال حافظ توسط ریش سفید ها و در مراسم های مختلف گرفته می شود. اما گاهی علاقه مندیم که در خلوت خود تفالی به حافظ بزنیم ، ذکر این نکته بسیار مهم می باشد که اساسا تعبیر شعر حافظ به حالات روحی و موقعیتی فرد بستگی دارد و تعبیری که از شعر آن حضرت در این نرم افزار آورده شده جهت فهم بهتر فال می باشد. 

// برنامه ای کم حجم و زیبا با امکانات خوبی همچون
// -فال روزانه
// -آداب صحیح فال گرفتن
// -تعبیر فال
// -امکان وارد کردن شماره فال و مشاهده ی تعبیر آن
// -اشتراک گذاری از طریق تمامی برنامه های ارسال پیام
// -اشتراک گذاری از طریق اینستاگرام
// -مشاهده 10 فال اخیر
// -تهیه لیست علاقه مندی ها
// و...
// به همراه تکنوازی تار استاد جلیل شهناز
// ***************************************************
// تمامی فال ها و تعابیر آن ها به صورت کامل قرار گرفته شده است.
// در صورتی که قادر به دیدن کامل آن نیستید ، کافیست انگشت خود را 
// برروی شعر یا تعبیر مورد نظر قرار داده و بالا یا پایین ببرید(اسکرول کنید)
// ***************************************************
// تصویر تعبیر آخرین فال به اشتراک گذاشته ی شما در مسیر حافظه گوشی شما در فولدر Hafez می باشد

// فال حافظ شیرازیمعمولا فال حافظ توسط ریش سفید ها و در مراسم های مختلف گرفته می شود. اما گاهی علاقه مندیم که در خلوت خود تفالی به حافظ بزنیم ...
// "));
if(isset($is404) and $is404) {
	include "404.php";
	exit();
}
function ads($id, $amp) {
	// responsive-horinzontal
	if($id == 1) {
		print $amp ?
		'<amp-ad width="100vw" height="320" type="adsense" data-ad-client="ca-pub-7167798110775783" data-ad-slot="1058287141" data-auto-format="rspv" data-full-width=""><div overflow=""></div></amp-ad>'
		:
		'<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-7167798110775783" data-ad-slot="1058287141" data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
	}
	// insingle-post
	else if($id == 2) {
		print $amp ? ''
		:
		'<ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="ca-pub-7167798110775783" data-ad-slot="2371368811"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
	}
	// insingle-responsive-horinzontal
	else if($id == 3) {
		print $amp ?
		'<amp-ad width="100vw" height="320" type="adsense" data-ad-client="ca-pub-7167798110775783" data-ad-slot="3203737201" data-auto-format="rspv" data-full-width=""><div overflow=""></div></amp-ad>'
		:
		'<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-7167798110775783" data-ad-slot="3203737201" data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
	}
	else if($id == 4) {
		print $amp ?
		'<amp-ad width="100vw" height="320" type="adsense" data-ad-client="ca-pub-7167798110775783" data-ad-slot="4168554264" data-auto-format="rspv" data-full-width=""><div overflow=""></div></amp-ad>'
		:
		'<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><ins class="adsbygoogle"style="display:block" data-ad-client="ca-pub-7167798110775783" data-ad-slot="4168554264" data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
	}
}
