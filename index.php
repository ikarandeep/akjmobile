<? header('Content-Type:text/html; charset=UTF-8'); ?>
<!--
Script written by Karandeep Singh
contact: ikarandeep @ gmail . com
last modified: Sunday, February 23, 2013
www.ikarandeep.com
-->
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png" />
<title>AKJ Programs Mobile</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
function showonlyone(thechosenone) {
     $('.newboxes').each(function(index) {
          if ($(this).attr("id") == thechosenone) {
               $(this).toggle(600);          }
          else {
               $(this).hide(600);
          }
     });
}

/*function showonlyone(item)
{
	$('.newboxes').each(function(index)
	{
		$((this).attr("id") == item ){
		$(this).slideToggle("fast");
		});
	});
}*/
</script>
<link href='http://fonts.googleapis.com/css?family=Fjalla+One|Roboto|Titillium+Web' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

<div class="programs">



<?php
require_once 'htmlpurifier/library/HTMLPurifier.auto.php';
require_once 'functions.php';
#$file = "akj.html";
#$fp = fopen($file, 'w');
$ch = curl_init();
#$target_url = "http://ikarandeep.com/akj/programs.html";

$country = false;
$city = false;

if(!empty($_GET['countryid']))
{
	$country = true;
	$countryid = $_GET['countryid'];

}
if(!empty($_GET['city']))
{
	$city = true;
	$cityid = $_GET['city'];

}

if($countryid == 0)
{
	$country = false;
}


if (($country) && ($city))
{
	$target_url = "http://akj.org/skins/one/programs.php?countryid=$countryid&city=$cityid";
	#$pageTitle="$city Programs"

}
elseif(($country) && !($city))
{	
	$target_url = "http://akj.org/skins/one/programs.php?countryid=$countryid";
}
else
{
	#get international programs only:
	#echo '<div class="pageTitle">AKJ International Programs</div>';
	$target_url = "http://akj.org/skins/one/programs.php";
}

#echo "target url is $target_url";
$target_url = str_replace ( ' ', '%20', $target_url);
#echo "target url is $target_url";

#http://www.akj.org/skins/one/programs.php?countryid=5&city=Connecticut
#curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
curl_setopt($ch, CURLOPT_URL,$target_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
#curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
#curl_setopt($ch, CURLOPT_FILE, $fp);
$html = curl_exec($ch);
if (!$html) {
	echo "<br />cURL error number:" .curl_errno($ch);
	echo "<br />cURL error:" . curl_error($ch);
	exit;
}
else{
	curl_close($ch);
#	fclose($fp);
}

#var_dump(html_entity_decode($html, ENT_COMPAT, 'UTF-8'));
#$htmlTwo = file_get_contents($html);
$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'UTF-8'); // replace with your encoding
$config->set('HTML.Doctype', 'HTML 4.01 Transitional'); // replace with your doctype
$config->set('Core.EscapeNonASCIICharacters', 'true');
$purifier = new HTMLPurifier($config);
$clean_html = $purifier->purify($html);
#$new = html_entity_decode("&nbsp;",$clean_html);


#menu will go here
parseMenu($clean_html);


if($city)
{
	parseCity($clean_html);
}
else
{
	parseMainAndCountry($clean_html);
}
?>
</div>
