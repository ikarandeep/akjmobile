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


function parseMainAndCountry($clean_html)
{

$doc = new DOMDocument();
@$doc->loadHTML($clean_html);
$tables = $doc->getElementsByTagName('table');
foreach($tables as $table)
{
	if ($table->getAttribute('bgcolor') == "#ffcc66" && $table->getAttribute('cellpadding') == "2" && $table->getAttribute('cellspacing') == "0" && $table->getAttribute('width') == "100%")
	{
		echo "<li><div class='aSmagam'>";
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
					$date = explode("to", $date);
					$startDate = $date[0];
					$endDate = substr($date[1],4);
					#$str = "&nbsp;";
					#str_replace("\xc2\xa0",' ',$str);
					#echo "<div class='date'>$date</div>";
					echo "<div class='date'>$startDate to $endDate</div>";
			
				}
				
				elseif($tdItem->getAttribute('valign')=="top" && $tdItem->hasAttribute('width')==False)
				{
				echo "<div class='newboxes' id='$uniqueID'><p>";
						$smagamType = $tdItem->firstChild->nodeValue;
 						echo DOMinnerHTML($tdItem);
				echo "</p></div>";
				}
				
				elseif ($tdItem->getAttribute('valign')=="top" && $tdItem->getAttribute('width')=="150")		
				{
					#$contactInfo = $tdItem->nodeValue;
				echo "<div class='newboxes' id='$uniqueID'><p>";

					echo DOMinnerHTML($tdItem);
				#	echo "<br>";
				echo "</p></div>";

				}		
			}
			
		
		}

	#echo $table->nodeValue;
	echo "</div></li>";
	}
}
}

function parseCity($clean_html)
{

	$doc = new DOMDocument();
	@$doc->loadHTML($clean_html);
	$tables = $doc->getElementsByTagName('table');
	$tdsForTitle = $doc->getElementsByTagName('td');
	$i = 0;
	foreach($tdsForTitle as $titleTd)
	{
		if($titleTd->getAttribute('class') == "Chapter")
		{
			$smagamName = $titleTd->nodeValue;
			echo "<li><div class='pageTitle'>$smagamName</a></div>";
			
		}
	}		

	foreach($tables as $table)
	{
	
		
		if ($table->getAttribute('bgcolor') == "#ffcc66" && $table->getAttribute('cellpadding') == "2" && $table->getAttribute('cellspacing') == "0" && $table->getAttribute('width') == "100%")
		{
			$td = $table->getElementsByTagName('td');
				foreach ($td as $tdItem)
				{
					
					if($tdItem->getAttribute('bgcolor')=="#EEEEEE" || $tdItem->getAttribute('bgcolor')=="#DDDDDD")
					{
						if ($tdItem->getAttribute('valign')=="top" && $tdItem->getAttribute('width')=="100")
						{	
							$date = substr($tdItem->nodeValue,3);
							$date = explode("to", $date);
							$startDate = $date[0];
							$endDate = substr($date[1],4);
							$uniqueID = rand();
							echo "<div class='smagam'><div class='date'><a href='javascript:showonlyone(\"$uniqueID\");'>$startDate to $endDate</a></div></div>";
					
						}
						
						elseif($tdItem->getAttribute('valign')=="top" && $tdItem->hasAttribute('width')==False)
						{
							echo "<div class='newboxes' id='$uniqueID'>";
							$smagamType = $tdItem->firstChild->nodeValue;
							echo DOMinnerHTML($tdItem);
							echo "</div>";
						}
						
						elseif ($tdItem->getAttribute('valign')=="top" && $tdItem->getAttribute('width')=="150")		
						{
							echo "<div class='newboxes' id='$uniqueID'>";
							echo DOMinnerHTML($tdItem);
							echo "</div>";
		
						}		
					}
				}	
		}
		elseif ($table->getAttribute('bgcolor') == "#ffcc66" && $table->getAttribute('cellpadding') == "1" && $table->getAttribute('cellspacing') == "0" && $table->getAttribute('width') == "100%")
		{
		
			if ($i == 0)
			{
				$i = 1;
			}		
			else
			{
		
				echo "<div class='aSmagam'>";
				
				# check to see if it has a child table with cellpadding2
				
				$td = $table->getElementsByTagName('td');
				foreach ($td as $tdItem)
				{
					
					if($tdItem->getAttribute('bgcolor')=="#EEEEEE" || $tdItem->getAttribute('bgcolor')=="#DDDDDD")
					{
						if ($tdItem->getAttribute('valign')=="top" && $tdItem->getAttribute('width')=="100")
						{	
							$date = substr($tdItem->nodeValue,3);
							$date = explode("to", $date);
							$startDate = $date[0];
							$endDate = substr($date[1],4);
							$uniqueID = rand();
							echo "<div class='smagam'><div class='date'><a href='javascript:showonlyone(\"$uniqueID\");'>$startDate to $endDate</a></div></div>";
					
						}
						
						elseif($tdItem->getAttribute('valign')=="top" && $tdItem->hasAttribute('width')==False)
						{
							echo "<div class='newboxes' id='$uniqueID'><p>";
							$smagamType = $tdItem->firstChild->nodeValue;
							echo DOMinnerHTML($tdItem);
							echo "</p></div>";
						}
						
						elseif ($tdItem->getAttribute('valign')=="top" && $tdItem->getAttribute('width')=="150")		
						{
							echo "<div class='newboxes' id='$uniqueID'><p>";
							echo DOMinnerHTML($tdItem);
							echo "</p></div>";
		
						}		
					}
				}
				echo "</div></li>";
			}
		}
	}
}
#<div id="ddtopmenubar" class="mattblackmenu">
#<ul>
#<li rel="s1"><a class="" href="programs.php?countryid=1">Canada<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s2"><a href="programs.php?countryid=2">India<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s3"><a class="" href="programs.php?countryid=3">Singapore<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s4"><a href="programs.php?countryid=4">U.K.<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s5"><a href="programs.php?countryid=5">U.S.A<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s6"><a href="programs.php?countryid=6">Australia<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s7"><a href="programs.php?countryid=7">New Zealand<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s8"><a href="programs.php?countryid=8">Other<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#</ul>
/*<ul style="z-index: 2000; left: 0px; top: -1000px; visibility: hidden;" id="s1" class="ddsubmenustyle">
<li><a href="programs.php?countryid=1&amp;city=Surrey">Surrey</a></li>
<li><a href="programs.php?countryid=1&amp;city=Toronto">Toronto</a></li>
<li><a href="programs.php?countryid=1&amp;city=Vancouver">Vancouver</a></li>
</ul>
<ul style="z-index: 2000; left: 0px; top: 0px; visibility: hidden;" id="s2" class="ddsubmenustyle">
<li><a href="programs.php?countryid=2&amp;city=Ahemdabad">Ahemdabad</a></li>
<li><a href="programs.php?countryid=2&amp;city=Anandpur Sahib">Anandpur Sahib</a></li>
<li><a href="programs.php?countryid=2&amp;city=Nagpur">Nagpur</a></li>
<li><a href="programs.php?countryid=2&amp;city=Ropar">Ropar</a></li>
</ul>
<ul style="z-index: 2000; left: 0px; top: -1000px; visibility: hidden;" id="s3" class="ddsubmenustyle">
<li><a href="programs.php?countryid=3&amp;city=Singapore">Singapore</a></li>
</ul>
<ul style="z-index: 2000; left: 0px; top: 0px; visibility: hidden;" id="s4" class="ddsubmenustyle">
<li><a href="programs.php?countryid=4&amp;city=Midlands">Midlands</a></li>
<li><a href="programs.php?countryid=4&amp;city=North">North</a></li>
<li><a href="programs.php?countryid=4&amp;city=South">South</a></li>
</ul>
<ul style="z-index: 2000; left: 0px; top: 0px; visibility: hidden;" id="s5" class="ddsubmenustyle">
<li><a href="programs.php?countryid=5&amp;city=Connecticut">Connecticut</a></li>
<li><a href="programs.php?countryid=5&amp;city=NY/NJ">NY/NJ</a></li>
</ul>
<ul style="z-index: 2000; left: 0px; top: 0px; visibility: hidden;" id="s6" class="ddsubmenustyle">
<li><a href="programs.php?countryid=6&amp;city=Melbourne">Melbourne</a></li>
</ul>
<ul style="z-index: 2000; left: 0px; top: 0px; visibility: hidden;" id="s7" class="ddsubmenustyle">
</ul>
<ul style="z-index: 2000; left: 0px; top: 0px; visibility: hidden;" id="s8" class="ddsubmenustyle">
<li><a href="programs.php?countryid=8&amp;city=Amsterdam">Amsterdam</a></li>
<li><a href="programs.php?countryid=8&amp;city=France">France</a></li>
<li><a href="programs.php?countryid=8&amp;city=Germany">Germany</a></li>
<li><a href="programs.php?countryid=8&amp;city=Italy">Italy</a></li>
<li><a href="programs.php?countryid=8&amp;city=Stockholm">Stockholm</a></li>
</ul>
<ul id="s9" class="ddsubmenustyle">
</ul>*/


function parseMenu($clean_html)
{
	$doc = new DOMDocument();
	@$doc->loadHTML($clean_html);
	$divs = $doc->getElementsByTagName('div');
	echo "<div class='mainMenu'>";
	echo "<ul>";
	echo "<li><a href='?p=programs&countryid=0'>ALL INTERNATIONAL</a></li>";
	echo "<br>";
	foreach($divs as $div)
	{
		if($div->getAttribute('class')=="mattblackmenu")
		{
			$lis = $div->getElementsByTagName('li');
			$i = 1;
			foreach ($lis as $li)
			{
	
				$eachCountry = $li->nodeValue;
				echo "<li><a href='?p=programs&countryid=$i'>$eachCountry</a></li>";
				if ($i == 5)
				{
				echo "<br>";
				}
				
				$i = $i + 1;

			}
		
		}
	
	}

	echo "</ul>";
	echo "</div>";
	
	
	
	#$uls = $doc->getElementsByTagName('ul');
	#<div id="ddtopmenubar" class="mattblackmenu">
	#echo count($uls);
	#foreach($uls as $ul)
	#{
	#	#echo $div->nodeValue;
	#	$children = $ul->childNodes;
	#	foreach ($children as $child)
	#	{
	#		echo $child->nodeValue;
	#	
	#	}
	#}



}
function parseKeertan($clean_html)
{

	$doc = new DOMDocument();
	@$doc->loadHTML($clean_html);
	$tables = $doc->getElementsByTagName('table');
	$tdsForTitle = $doc->getElementsByTagName('td');
	$i = 0;
	foreach($tdsForTitle as $titleTd)
	{
		if($titleTd->getAttribute('class') == "Header")
		{
			$smagamName = $titleTd->nodeValue;
			echo "<div class='pageTitle'>$smagamName</a></div>";
			
		}
	}		

	foreach($tables as $table)
	{
	#table bgcolor="#ffcc66" border="0" cellpadding="3" cellspacing="1" width="100%
		
		if ($table->getAttribute('bgcolor') == "#ffcc66" && $table->getAttribute('border')=="0" && $table->getAttribute('cellpadding') == "3" && $table->getAttribute('cellspacing') == "1" && $table->getAttribute('width') == "100%")
		{
			$tds = $table->getElementsByTagName('td');
			foreach ($tds as $td)
			{
				if ($td->getAttribute('colspan')=="6" && $td->getAttribute('align')=="center")
				{
					$fonts = $table->getElementsByTagName('font');
					foreach ($fonts as $font)
					{
						if($font->getAttribute('class')=="title")
						{
							$programDay = $font->nodeValue;
							echo "$programDay<br>";
						}
						elseif($font->getAttribute('class')=="subtitle")
						{
							$programType = $font->nodeValue;
							echo "$programType<br>";
								
						}
					}
				}
				elseif($td->getAttribute('class')=="DateTime")
				{
						$time = $td->nodeValue;
						$counter = 1;
						echo "$time | ";
						
				}
				elseif($td->getAttribute('class')=="Secondary")
				{
						if($counter == 1 || $counter == 3)
						{
							echo DOMinnerHTML($td);
						}
						$counter = $counter + 1;
						if ($counter == 4)
						{
						echo "<br>";
						
						}
				}

			
				
				
				
				
			}
		}
		elseif ($table->getAttribute('bgcolor') == "#ffcc66" && $table->getAttribute('cellpadding') == "1" && $table->getAttribute('cellspacing') == "0" && $table->getAttribute('width') == "100%")
		{
		
			if ($i == 0)
			{
				$i = 1;
			}		
			else
			{
		
				echo "<div class='aSmagam'>";
				
				# check to see if it has a child table with cellpadding2
				
				$td = $table->getElementsByTagName('td');
				foreach ($td as $tdItem)
				{
					
					if($tdItem->getAttribute('bgcolor')=="#EEEEEE" || $tdItem->getAttribute('bgcolor')=="#DDDDDD")
					{
						if ($tdItem->getAttribute('valign')=="top" && $tdItem->getAttribute('width')=="100")
						{	
							$date = substr($tdItem->nodeValue,3);
							$date = explode("to", $date);
							$startDate = $date[0];
							$endDate = substr($date[1],4);
							$uniqueID = rand();
							echo "<div class='smagam'><div class='date'><a href='javascript:showonlyone(\"$uniqueID\");'>$startDate to $endDate</a></div></div>";
					
						}
						
						elseif($tdItem->getAttribute('valign')=="top" && $tdItem->hasAttribute('width')==False)
						{
							echo "<div class='newboxes' id='$uniqueID'><p>";
							$smagamType = $tdItem->firstChild->nodeValue;
							echo DOMinnerHTML($tdItem);
							echo "</p></div>";
						}
						
						elseif ($tdItem->getAttribute('valign')=="top" && $tdItem->getAttribute('width')=="150")		
						{
							echo "<div class='newboxes' id='$uniqueID'><p>";
							echo DOMinnerHTML($tdItem);
							echo "</p></div>";
		
						}		
					}
				}
				echo "</div>";
			}
		}
	}
}



?> 