<?php
//if(isset($_GET["log"])) {
$d=jalaliDate();
$visit=[
        "date"=>$d["year"].$d["month"].$d["day"],
	"time"=>date("H:i:s"),
        "ip"=>isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : "cli",
	//"ip"=>ip_get(),
	//"ip"=>getRealIpAddr(),
        "link"=>isset($_SERVER['HTTP_HOST']) ? 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] : "cli",
	"reffer"=>isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : null,
];
$db->insert("visit", $visit);
//}
if(!isset($noindex)) {
	$noindex=false;
}
if(!isset($title)) {
	$title=$translates[$lang]["title"];
}
if(!isset($description)) {
	$description=$translates[$lang]["description"];
}
if(!isset($keyword)) {
	$keyword=$translates[$lang]["keyword"];
}
foreach($translatesCodes as $i) {
	if($i == "en") {
		if($ampLinkNormal == $site."/".$i."/" || $ampLinkNormal == $site."/".$i) {
			// $ampLinkNormal="https://iapk.org/";
			$ampLinkNormal=$site."/";
		}
	}
}
////////////////////////////////////////////////
$hasTranslates=[];
if(isset($isSingle) and $isSingle) {
	foreach($translates as $code=>$translate) {
		if(!$translate["enable"]) {
			continue;
		}
		$app_lang=$db->select("application", ["packageName"=>$package,"lang"=>$code]);
		if($app_lang==[]) {
			continue;
		}
		$hasTranslates[$code]=["name"=>$translate["name"], "code"=>$translate["code"]];
	}
}
else {
	foreach($translates as $code=>$translate) {
		if(!$translate["enable"]) {
			continue;
		}
		$hasTranslates[$code]=["name"=>$translate["name"], "code"=>$translate["code"]];
	}
}
?>
<!DOCTYPE html>
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie10 lt-ie9" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js lt-ie10" lang="en"><![endif]-->
<!--[if gt IE 9]><!-->
<html <?= $amp ? "amp " : "" ?>class="no-js" lang="en"<?= isset($schema) ? " itemscope=\"itemscope\" itemtype=\"".$schema."\"" : "" ?>>
	<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<?php if($amp) { ?>
		<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
		<script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
		<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
		<script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
		<script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
		<script async custom-element="amp-audio" src="https://cdn.ampproject.org/v0/amp-audio-0.1.js"></script>
		<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
		<script async src="https://cdn.ampproject.org/v0.js"></script>
		<script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
		<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
		<script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
		<script async custom-element="amp-selector" src="https://cdn.ampproject.org/v0/amp-selector-0.1.js"></script>
		<script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
		<script async custom-element="amp-lightbox-gallery" src="https://cdn.ampproject.org/v0/amp-lightbox-gallery-0.1.js"></script>
		<script async custom-element="amp-image-lightbox" src="https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js"></script>
		<?php } else { ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php } ?>
		<title><?= $title ?></title>
		<meta name="description" content="<?= $description ?>">
		<meta name="author" content="">
		<meta name="keyword" content="<?= $keyword ?>">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<link rel="icon" href="<?= $site ?>/favicon.ico">
		<?php if(!$amp) { ?>
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="amphtml" href="<?= $ampLink ?>">
		<?php } ?>
		<link rel="canonical" href="<?= $ampLinkNormal ?>">
		<?php if(isset($isMain) and $isMain) { ?>
		<link rel="alternate" href="<?= $site ?>/en/" hreflang="en-gb">
		<link rel="alternate" href="<?= $site ?>/fa/" hreflang="fa-ir">
		<link rel="alternate" href="<?= $site ?>/ar/" hreflang="ar-sa">
		<link rel="alternate" href="<?= $site ?>/ar/" hreflang="ar-ae">
		<link rel="alternate" href="<?= $site ?>/en/" hreflang="en-us">
		<?php } ?>
		<?php if($noindex) { ?>
		<meta name="robots" content="noindex">
		<meta name="googlebot" content="noindex">
		<?php } ?>
		<?php if(isset($thumbnail)) { ?>
		<meta name="thumbnail" content="<?= $thumbnail ?>">
		<?php } ?>
		<!--[if (IE 8)&!(IEMobile)]><script src="https://ganlanyuan.github.io/tiny-slider/dist/tiny-slider.helper.ie8.js"></script><![endif]-->
		<?php if($amp) { ?>
		<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
		<style amp-custom>
		<?php
		// print str_replace("!important", "", file_get_contents(getcwd() . "/".$styleAmpFile));
		print file_get_contents(getcwd() . "/".$styleAmpFile);
		?>
		</style>
		<?php } else { ?>
		<link rel="stylesheet" rel=preload href="<?= $site ?>/<?= $styleFile ?>">
		<?php } ?>
		<?php if($amp) {if(1==2){ ?>
		<amp-script layout="container" src="<?= $site ?>/script.js" sandbox="allow-forms"></amp-script>
		<amp-script layout="container" src="https://www.googletagmanager.com/gtag/js?id=UA-134042147-2" sandbox="allow-forms"></amp-script>
		<amp-script layout="container" sandbox="allow-forms">
		window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-134042147-2');
		</amp-script>
		<?php }?>
		<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
		<script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script>
		<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
		<?php } else { ?>
				<script src="<?= $site ?>/script.js"></script>
				<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134042147-2"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-134042147-2');
		</script>
		<script data-ad-client="ca-pub-7167798110775783" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-P3479QL');</script>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<?php } ?>
		<meta property="og:title" content="<?= $title ?>">
		<meta property="og:description" content="<?= $description ?>">
		<meta property="og:site_name" content="<?= $translates[$lang]["title"] ?>">
		<meta property="og:url" content="<?= $CurPageURL ?>">
		<?php if(isset($isSingle) and $isSingle) { ?>
			<?php if($app["source"] == 1) { ?>
			<meta property="og:image:type" content="image/webp">
			<?php } else { ?>
			<meta property="og:image:type" content="image/png">
			<?php } ?>
			<!-- <meta property="og:type" content="article"> -->
			<meta property="og:type" content="product">

			<meta property="og:locale" content="<?= $translates[$lang]["code"][0] ?>">
			<?php foreach($hasTranslates as $code=>$item) { ?>
				<?php foreach($item["code"] as $countryCode) { ?>
				<meta property="og:locale:alternate" content="<?= $countryCode ?>">
				<?php } ?>
			<?php } ?>

			<?php foreach($hasTranslates as $code=>$item) { ?>
				<?php foreach($item["code"] as $countryCode) { ?>
				<link rel="alternate" href="<?= changeLang($CurPageURL, $code) ?>" hreflang="<?= $countryCode ?>">
				<?php } ?>
			<?php } ?>
		<?php } ?>
		<?php if(isset($image) and $image!="") { ?>
		<meta property="og:image" content="<?= $image ?>">
		<meta property="og:image:secure_url" content="<?= $image ?>">
		<meta property="og:image:alt" content="<?= $title ?>">
		<meta property="og:image:width" content="158">
		<meta property="og:image:height" content="158">
		<?php } ?>
	</head>
	<body>
		<?php if($amp) { ?>
		<amp-auto-ads type="adsense" data-ad-client="ca-pub-7167798110775783"></amp-auto-ads>
		<?php } ?>
		<!--<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">-->
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<?php
			$cats_app=$db->selects("application_category", ["isGame"=>0, "name".strtoupper($lang)=>["!=", "and", ""]], "", $categoryFields);
			$cats_game=$db->selects("application_category", ["isGame"=>1, "name".strtoupper($lang)=>["!=", "and", ""]], "", $categoryFields);
			if(!$amp) {
			?>
			<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">
							<?= $translates[$lang]["app"] ?>
						</a>
						<div class="pre-scrollable dropdown-menu">
							<?php
							foreach($cats_app as $cat) { ?>
								<a class="dropdown-item" href="<?= $site ?>/<?= $lang ?>/<?= $cat["slug"] ?>/"><?= $cat["name".strtoupper($lang)] ?></a>
							<?php } ?>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">
							<?= $translates[$lang]["game"] ?>
						</a>
						<div class="pre-scrollable dropdown-menu">
							<?php
							foreach($cats_game as $cat) { ?>
								<a class="dropdown-item" href="<?= $site ?>/<?= $lang ?>/<?= $cat["slug"] ?>/"><?= $cat["name".strtoupper($lang)] ?></a>
							<?php } ?>
						</div>
					</li>
				</ul>
			</div>
			<?php } ?>
			<div class="mx-auto order-0">
				<a class="navbar-brand mx-auto" href="/<?= $lang ?>/"><?= $translates[$lang]["headerName"] ?></a>
				<?php if(!$amp) { ?>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
						<span class="navbar-toggler-icon"></span>
					</button>
				<?php } ?>
			</div>
			<?php if(!$amp) { ?>
				<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
					<ul class="navbar-nav ml-auto">
						<?php foreach($hasTranslates as $code=>$item) { ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= changeLang($CurPageURL, $code); ?>"><?= $item["name"] ?></a>
						</li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
		</nav>
