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
			echo "<div class='pageTitle'>$smagamName</a></div>";
			
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
				echo "</div>";
			}
		}
	}
}









?> 