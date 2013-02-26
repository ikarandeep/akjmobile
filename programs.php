<article data-role="content">
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
	#$target_url = "http://ikarandeep.com/akj/programs.html";
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
echo '<ul data-role="listview" data-filter="true">';
if($city)
{
	parseCity($clean_html);
}
else
{
	parseMainAndCountry($clean_html);
}
echo '</ul>';
?>

</div>
</article>
