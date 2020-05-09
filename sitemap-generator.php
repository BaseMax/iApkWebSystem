<?php
include "_core.php";
// function append($data) {
// 	global $result;
// 	$result.=$data;
// 	// file_put_contents('sitemap.xml', $data, FILE_$result.=);
// }
foreach($translatesCodes as $code) {
	print "Sitemap ".$code."\n";
	$result=("");
	$result.=('<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="sitemap-style.xml"?>');
	// $result.=('<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" mlns:xhtml="http://www.w3.org/1999/xhtml">');
	$result.=('<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
	$app=$db->select("application", ["lang"=>$code], "ORDER BY `id` DESC", "date");
	$cats=$db->selects("application_category");
	if($app != []) {
		$dates=explode(" ", $app["date"]);
		$date=$dates[0];
		$time=$dates[1];

		$translates[null]=[
			"enable"=>true,
			"inOther"=>false,
		];
		foreach($translates as $x=>$translate) {
			if(!$translate["enable"]) {
				continue;
			}
			if($x == null) {
				$x="";
			}
			$result.=('<url>');
			$result.=('<loc>'.$site.'/'.$x.'/</loc>');
			foreach($translates as $y=>$translate) {
				if(!$translate["enable"]) {
					continue;
				}
				if(isset($translate["inOther"]) and !$translate["inOther"]) {
					continue;
				}
				// foreach($translate["code"] as $countryCode) {
				// 	$result.=('<xhtml:link rel="alternate" hreflang="'.$countryCode.'" href="'.$site.'/'.$y.'/">');
				// }
			}
			$result.=('<lastmod>'.$date.'T'.$time.'+04:30</lastmod>');
			$result.=('</url>');
		}

		foreach($cats as $cat) {
			if($cat["name".strtoupper($code)]=="") {
				continue;
			}
			$app=$db->select("application", ["lang"=>$code, "categoryID"=>$cat["id"]], "ORDER BY `id` DESC", "date");
			$dates=explode(" ", $app["date"]);
			$date=$dates[0];
			$time=$dates[1];
			$result.=('<url>');
			$result.=('<loc>'.$site.'/'.$code.'/'.$cat["slug"].'/</loc>');
			$result.=('<lastmod>'.$date.'T'.$time.'+04:30</lastmod>');
			$result.=('</url>');
		}

		$apps=$db->selects("application", ["lang"=>$code], "ORDER BY `id` DESC", "id,categoryID,packageName,date,lang");
		foreach($apps as $app) {
			$found=null;
			$dates=explode(" ", $app["date"]);
			$date=$dates[0];
			$time=$dates[1];
			$cat=$db->select("application_category", ["id"=>$app["categoryID"]], "", "slug");
			if($cat != []) {
				$cat=$cat["slug"];
				$result.=('<url>');
				$result.=('<loc>'.$site.'/'.$app["lang"].'/'.$cat.'/'.$app["packageName"].'/</loc>');
				$result.=('<lastmod>'.$date.'T'.$time.'+04:30</lastmod>');
				$result.=('</url>');

				$tags=$db->selects("tag", ["appID"=>$app["id"]]);
				if($tags != []) {
					foreach($tags as $tag) {
						$result.=('<url>');
						$result.=('<loc>'.$site.'/'.$app["lang"].'/'.$cat.'/'.$tag["path"].'/</loc>');
						$result.=('<lastmod>'.$date.'T'.$time.'+04:30</lastmod>');
						$result.=('</url>');
					}
				}
			}
		}
	}
	$result.=('</urlset>');
	// $file="sitemap/".$code.".xml.gz";
	// unlink($file);
	// exec("rm -rf ".$file);
	$fileXML="sitemap/".$code.".xml";
	file_put_contents($fileXML, $result);
	// exec("gzip ".$fileXML);
}
