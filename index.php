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

<?php 
function DOMinnerHTML($element) 
{ 
    $innerHTML = ""; 
    $children = $element->childNodes; 
    foreach ($children as $child) 
    { 
        $tmp_dom = new DOMDocument(); 
        $tmp_dom->appendChild($tmp_dom->importNode($child, true)); 
        $innerHTML.=trim($tmp_dom->saveHTML()); 
    } 
    return $innerHTML; 
} 
?> 
<div class="programs">
<div class="pageTitle">AKJ International Programs</div>
<?php
require_once 'htmlpurifier/library/HTMLPurifier.auto.php';

$file = "akj.html";
$fp = fopen($file, 'w');
$ch = curl_init();
#$target_url = "http://ikarandeep.com/akj/programs.html";
$target_url = "http://akj.org/skins/one/programs.php";
#curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
curl_setopt($ch, CURLOPT_URL,$target_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
#curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_FILE, $fp);
$html = curl_exec($ch);
if (!$html) {
	echo "<br />cURL error number:" .curl_errno($ch);
	echo "<br />cURL error:" . curl_error($ch);
	exit;
}
else{
	curl_close($ch);
	fclose($fp);
}

#var_dump(html_entity_decode($html, ENT_COMPAT, 'UTF-8'));
$htmlTwo = file_get_contents($file);
$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'UTF-8'); // replace with your encoding
$config->set('HTML.Doctype', 'HTML 4.01 Transitional'); // replace with your doctype
$config->set('Core.EscapeNonASCIICharacters', 'true');
$purifier = new HTMLPurifier($config);
$clean_html = $purifier->purify($htmlTwo);
#$new = html_entity_decode("&nbsp;",$clean_html);

$doc = new DOMDocument();
@$doc->loadHTML($clean_html);
$tables = $doc->getElementsByTagName('table');

#$td = $doc->getElementsByTagName('td');

foreach($tables as $table)
{
	if ($table->getAttribute('bgcolor') == "#ffcc66" && $table->getAttribute('cellpadding') == "2" && $table->getAttribute('cellspacing') == "0" && $table->getAttribute('width') == "100%")
	{
		echo "<div class='aSmagam'>";
		$td = $table->getElementsByTagName('td');
		foreach ($td as $tdItem)
		{
			if($tdItem->getAttribute('class') == "Chapter")
				{
					$smagamName = $tdItem->nodeValue;
					#$smagamName = $str_replace(' ', '', $smagamName);
					$uniqueID = rand();
					
					echo "<div class='smagam'><a href='javascript:showonlyone(\"$uniqueID\");'>$smagamName</a></div>";

				}
			if($tdItem->getAttribute('bgcolor')=="#EEEEEE" || $tdItem->getAttribute('bgcolor')=="#DDDDDD")
			{
				if ($tdItem->getAttribute('valign')=="top" && $tdItem->getAttribute('width')=="100")
				{
#<a href="#" class="servicesLink">SERVICES</a>
#<div class="servicesPanel">

				
					$date = substr($tdItem->nodeValue,3);
					#$date = explode("to", $date);
					#$startDate = $date[0];
					#$endDate = substr($date[1],4);
					#$str = "&nbsp;";
					#str_replace("\xc2\xa0",' ',$str);
					echo "<div class='date'>$date</div>";
					#echo "<div class='date'>$startDate to $endDate</div>";
			
				}
				
				elseif($tdItem->getAttribute('valign')=="top" && $tdItem->hasAttribute('width')==False)
				{
				echo "<div class='newboxes' id='$uniqueID'>";
						#$b = $tdItem->getElementsByTagName('b');
						$smagamType = $tdItem->firstChild->nodeValue;
						#$children = $tdItem->childNodes;
 						echo DOMinnerHTML($tdItem);
 						#foreach ($children as $childs)
						#{
						#	echo $childs->nodeValue;
						#	echo "<br>";
						#}
						#echo $smagamType;
				#		echo "<br><br>";
				echo "</div>";
				}
				
				elseif ($tdItem->getAttribute('valign')=="top" && $tdItem->getAttribute('width')=="150")		
				{
					#$contactInfo = $tdItem->nodeValue;
				echo "<div class='newboxes' id='$uniqueID'>";

					echo DOMinnerHTML($tdItem);
				#	echo "<br>";
				echo "</div>";

				}		
			}
			
		
		}

	#echo $table->nodeValue;
	echo "</div>";
	}






}
?>
</div>
