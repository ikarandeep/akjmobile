<article data-role="content">
<div class="keertanPage">
<?php
require_once 'htmlpurifier/library/HTMLPurifier.auto.php';
require_once 'functions.php';
$ch = curl_init();

if(!empty($_GET['id']))
{
	$id = $_GET['id'];
	$target_url = "http://akj.org/skins/one/keertan.php?id=$id";
}
else
{
	$home = true;
	$target_url = "http://akj.org/skins/one/keertan.php";
	#$target_url = "http://localhost/~karandeep/akj_mobile/keertan.html";
}
curl_setopt($ch, CURLOPT_URL,$target_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$html = curl_exec($ch);
if (!$html) {
	echo "<br />Unable to connect to AKJ.org";
	echo "<br />Please visit the link below to access the keertan";
	echo "<br /><a href=\"$target_url\">$target_url</a>";
	echo "<br />cURL error number:" .curl_errno($ch);
	echo "<br />cURL error:" . curl_error($ch);
	exit;
}
else{
	curl_close($ch);
}

#var_dump(html_entity_decode($html, ENT_COMPAT, 'UTF-8'));
#$htmlTwo = file_get_contents($html);
$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'UTF-8'); // replace with your encoding
$config->set('HTML.Doctype', 'HTML 4.01 Transitional'); // replace with your doctype
$config->set('Core.EscapeNonASCIICharacters', 'true');
$purifier = new HTMLPurifier($config);
$clean_html = $purifier->purify($html);
if($home)
{
	#echo "<div class='issues'>see issues?</div>
	parseKeertanMenu($clean_html);
}
else
{
	parseKeertan($clean_html);
}
?>
</div>
</article>