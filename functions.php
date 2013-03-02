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



class Menu {

	# three private variables
	private $countries = array(); 	# an array of countries
	private $cities = array();		# an associative array of cities (aka hash)
	private $html_file;				# the HTML file we are parsing
	
	
	# constructor: When the object is made we should
	# parse the cities and countries and set the html_file variable
	# also calling a new DOMDocument
	 function __construct($clean_html) { 
	 	$this->html_file = new DOMDocument();
	 	@$this->html_file->loadHTML($clean_html);
	 	$this->parse_cities();
	 	$this->parse_countries();


        
     }
       
       
    # public function to access the countries array
	public function get_countries(){
		return $this->countries;
	}
	
	# public function to access the countries array
	public function get_cities(){
		return $this->cities;
	}
	
	
	# private function to parse the countires out of the menu
	private function parse_countries(){
	
		$divs = $this->html_file->getElementsByTagName('div');
		foreach($divs as $div)
		{
			if($div->getAttribute('class')=="mattblackmenu")
			{
				$lis = $div->getElementsByTagName('li');
				foreach ($lis as $li)
				{
					$eachCountry = $li->nodeValue;
					array_push($this->countries, $eachCountry);
				}
			}
		}
		
	}
	
	
	# private function to parse the cities out of the menu
	private function parse_cities() {
		
		$uls = $this->html_file->getElementsByTagName('ul');
		foreach($uls as $ul)
		{
			if($ul->getAttribute('class')=="ddsubmenustyle")
			{
				$lis = $ul->getElementsByTagName('li');
				foreach($lis as $li)
				{
					
						$as = $li->getElementsByTagName('a');
						foreach($as as $a)
						{
							if($a->hasAttribute('href')==true)
							{
										$url = $a->getAttribute('href');
										$urlArray = explode("=",$url);
										$idArray = explode("&",$urlArray[1]);
										$city = $urlArray[2];
										$countryID = $idArray[0];
										$city = str_replace ( '%20', ' ', $city);
										$temp_array = array("$city" => "$countryID");
										$this->cities = array_merge($this->cities, $temp_array);
							}	
						}
					
					
				}
				
			}	
		}
		
		
		
		
	}

}
	













function parseKeertanMenu($clean_html)
{
	$doc = new DOMDocument();
	@$doc->loadHTML($clean_html);
	$uls = $doc->getElementsByTagName('ul');
	echo "<div class='keertanMenu'>";
	echo "<ul data-role='listview' data-filter='true'>";
	$i = 0;
	
	$smagamNameYearMonth = array();
	

	foreach($uls as $ul)
	{
		
		
		if($ul->getAttribute('class')=="ddsubmenustyle")
		{
			#echo DOMinnerHTML($ul);
			#lets get each LI now 
			$lis = $ul->getElementsByTagName('li');
			foreach ($lis as $li)
			{
			
				#echo "<li>print start</li>";
				$string = $li->nodeValue;
				$as = $li->getElementsByTagName('a');
			
				
				
				$array = preg_split('/\n/',trim($string));
				$item = $array[0];
				$months = array("January","February","March","April","May","June","July","August","September","October","November","December","Unknown");
				if(is_numeric($item) && strlen($item)==4)
				{
					$year = $item;
				}
				elseif(in_array($item,$months))
				{
					$month = $item;
					foreach($as as $a)
					{
						if($a->hasAttribute('href')==true)
						{
							$url = $a->getAttribute('href');
							$urlArray = explode("=",$url);
							$idNumber = $urlArray[1];
							$url_set = true;
						}
					}
					$smagamInfo = "$city $year $month";
					echo "<li><a href=\"?p=keertan&id=$idNumber\">$smagamInfo</a>";
					echo "<div class='hidden'>$year $city $year $month $city $year $month $month $year $month $city</div></li>";
				}
				else
				{
					$city = $item;
					
				}


				# in first li: first item will be city
				# in second li first item should be year
				# in third li first item should month
				# in fourth li first item should be month
				# in fifth li first item will be city
				# in sixth li first item will be year
				# in seventh li first item will be month
				# in 8th li first item will be city
				# 9 = year
				# 10 = month
				# 11 = month
				# 12 = month
				# 13 = year
				# 14 = month
				# 15 = month
				# 16 = city
				
				# patterns: City will always come after a month
				# a month will always come after a year
				# a year can come after month or city but its always a date....
				
				

				

/*				foreach($as as $a)
				{
					if($a->hasAttribute('href')==true)
					{
						$url = $a->getAttribute('href');
						$urlArray = explode("=",$url);
						$idNumber = $urlArray[1];
						#echo "$idNumber";
						$url_set = true;
					}
					
				
				
					foreach($array as $item)
					{
						# if a 4 digit number -> year & prevCity == true
						#prevMonth = false;
						#prevCity = false;
						#prevYear = true;
						#$i = 0;
						$months = array("January","February","March","April","May","June","July","August","September","October","November","December","Unknown");
						if(is_numeric($item) && strlen($item)==4)
						{
						
							$prevMonth = false;
							$prevCity = false;
							$prevYear = true;
							$year = $item;
							$i = $i + 1;
							echo "<!--setting year $year $i<br>-->";
						
						}
										
						# if a month -> month && prevYear == True
						#prevYear == false;
						#prevCity = false;
						#prevMonth = true
						
						elseif(in_array($item,$months))
						{
							
							$prevMonth = true;
							$prevCity = false;
							$prevYear = false;
							$month = $item;
							$i = $i + 1;
							$smagamInfo = "$city $year $month";
							if($url_set)
							{
								if(!(in_array($smagamInfo,$smagamNameYearMonth)))
								{
									array_push($smagamNameYearMonth,$smagamInfo);
									echo "<li>$idNumber</li>";
									echo "<li><a href=\"?p=keertan&id=$idNumber\">$smagamInfo</a></li>";
									$url_set = false;
								}
							}
	
						}
						
					# else must be city & prevCity = false & prevMonth = true;
					# prevCity = true;
					# prevMonth = false;
	
						
						elseif($prevMonth == true)
						{
							$prevMonth = false;
							$prevCity = true;
							$prevYear = false;	
							$city = $item;	
							$i = $i + 1;
							if($city == "")
							{
								$city = $currentCity;

							}
							$currentCity = $city;
							echo "<!--setting city $city $currentCity $i<br>-->";
							
						}

					}
								echo "<!--<br>print end<br>-->";
				}*/
			}
			
			
		$counter = $counter + 1;
			
		}
	
	}

	echo "</ul>";
	echo "</div>";
#<div id="ddtopmenubar" class="mattblackmenu">

#</div>	
#<ul style="z-index: 2000; left: 0px; top: 0px; visibility: hidden;" id="s0" class="ddsubmenustyle">	
#	<li><a href="#">Atlanta<img class="rightarrowpointer" style="width: 12px; height: 12px;" src="ddlevelsfiles/arrow-right.gif"></a>
#		<ul style="left: 0px; top: 0px; visibility: hidden;">
#			<li><a href="#">2012<img class="rightarrowpointer" style="width: 12px; height: 12px;" src="ddlevelsfiles/arrow-right.gif"></a>
#				<ul style="left: 0px; top: 0px; visibility: hidden;">
#					<li><a href="keertan.php?id=379">June</a></li>
#				</ul>
#			</li>
#			<li><a href="#">2010<img class="rightarrowpointer" style="width: 12px; height: 12px;" src="ddlevelsfiles/arrow-right.gif"></a>
#				<ul style="left: 0px; top: 0px; visibility: hidden;">
#					<li><a href="keertan.php?id=248">January</a></li>
#				</ul>
#			</li>
#			<li><a href="#">2008<img class="rightarrowpointer" style="width: 12px; height: 12px;" src="ddlevelsfiles/arrow-right.gif"></a>
#				<ul style="left: 0px; top: 0px; visibility: hidden;">
#					<li><a href="keertan.php?id=170">June</a></li>
#				</ul>
#			</li>
#		</ul>
#	</li>

#<ul>
#<li rel="s0"><a href="#">Canada<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s1"><a href="#">India<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s2"><a class="" href="#">Europe<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s3"><a class="" href="#">U.K.<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s4"><a class="" href="#">U.S.A.<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s5"><a href="#">Australia<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s6"><a href="#">N.Z.<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li rel="s7"><a href="#">Other<img class="downarrowpointer" style="width: 11px; height: 7px;" src="ddlevelsfiles/arrow-down.gif"></a></li>
#<li><a href="search.php">Search</a></li>
#<li><a href="shabadSearch.php">Shabad Search</a></li>
#</ul>


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
			echo "<div class='pageTitle'>$smagamName</div>";
			
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
							echo "<div class='program_day'>$programDay</div>";
						}
						elseif($font->getAttribute('class')=="subtitle")
						{
							$programType = $font->nodeValue;
							echo "<div class='program_type'>$programType</div>";
								
						}
					}
				}
				elseif($td->getAttribute('class')=="DateTime")
				{
						$time = $td->nodeValue;
						$counter = 1;
						
				}
				elseif($td->getAttribute('class')=="Secondary")
				{
					
					if ($td->hasAttribute('align')==False && $td->hasAttribute('width')==False)
					{
						$keertani = $td->nodeValue;
						$mp3counter = 0;
					}
					else
					{
						# strip url
						$as = $td->getElementsByTagName('a');
						foreach($as as $a)
						{	
							if ($mp3counter == 1)
							{
								$url = $a->getAttribute('href');
								echo "<div class='keertanUrl'><div class='time'>$time</div><div class='track'><a href=\"$url\">$keertani</a></div></div>";
							}
						}
							$mp3counter = $mp3counter + 1;

					}	
			
				}

			
				
				
				
				
			}
		}
	}
}




class GetHtml{
	
	private $target_url;
	private $p;
	private $countryID;
	private $cityID;
	private $city = false;
	private $country = false;
	private $clean_html;
	private $expire_time = 7200; #seconds
	private $current_time;
	private $file_time;
	private $cached_file;
	private $type;
	
	
	function __construct($arg_one) { 
		$this->type = $arg_one;
	 	$this->set_time();
	}
	
	public function set_time()
	{
		$this->current_time = time();
	}
	public function set_page($item){
		$this->p = $item;		
	}
	
	public function set_country_id($item){
		$this->countryID = $item;		
	}
	
	public function set_city_id($item){
		$this->cityID = $item;		
	}
	
	public function set_file_time($cached_file){
		$this->file_time = filemtime($this->cached_file);
	}
	
	
	
	public function get_country_id(){
		return $this->countryID;
	}
	
	public function get_page(){
		return $this->p;
	}
	public function get_city_id(){
		return $this->cityID;
	}
	public function get_file_time(){
		return $this->file_time;
	}
	
	
	
	
	
	
	public function get_html()
	{
		$this->parse_current_url();
		$this->create_target_url();
		
		if(!($this->check_if_cached()))
		{
			$html = $this->request_html();
		}
			
			return $this->get_content_of_file();
		
	}
	
	private function get_content_of_file(){
		$html = file_get_contents($this->cached_file);
		return $html;
	}
	
		
	private function parse_current_url(){
	
		if(!empty($_GET['p'])){
			$p = $_GET['p'];	
			$this->set_page($p);
		}
		
		if(!empty($_GET['countryid'])){
			$this->country = true;
			$this->set_country_id($_GET['countryid']);
		}
		
		if(!empty($_GET['city'])){
			$this->city = true;
			$this->set_city_id($_GET['city']);
		}
	}
	
	private function create_target_url(){
			
		$countryid = $this->get_country_id();
		$cityid = $this->get_city_id();
		
		if (($this->country) && ($this->city) && ($this->type !="menu")){
			$this->target_url = "http://akj.org/skins/one/programs.php?countryid=$countryid&city=$cityid";
		}
		elseif(($this->country) && !($this->city) && ($this->type !="menu")){	
			$this->target_url = "http://akj.org/skins/one/programs.php?countryid=$countryid";
		}
		else
		{
			$this->target_url = "http://akj.org/skins/one/programs.php";
			$countryid = "programs";
			$cityid = "menu";
		}	
		
		$this->target_url = str_replace ( ' ', '%20', $this->target_url);
		$this->set_cached_file_name($countryid,$cityid);
	
	
	}
	
	private function set_cached_file_name($countryid, $cityid){
		$cityid = preg_replace("/[^A-Za-z0-9]/","",$cityid);  
		$this->cached_file = "CACHE-$countryid$cityid.cache";
		
	}
	
	
	
	private function check_if_cached(){
			

		if(file_exists($this->cached_file)){
			$this->set_file_time($this->cached_file);
			if ($this->current_time - $this->expire_time < $this->file_time){
				return true;
			}
		}
		else{
			return false;
		}
	}
	
	private function request_html(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$this->target_url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 180);
		$html = curl_exec($ch);
		if (!$html) {
			echo "<br />cURL error number:" .curl_errno($ch);
			echo "<br />cURL error:" . curl_error($ch);
			exit;
		}
		else{
			curl_close($ch);
		}
		
		file_put_contents($this->cached_file, $html);	
	}
	

	
	






}


function clean_up_the_html($dirty_html){
		$dirty_html = $dirty_html;
		$config = HTMLPurifier_Config::createDefault();
		$config->set('Core.Encoding', 'UTF-8');
		$config->set('HTML.Doctype', 'HTML 4.01 Transitional');
		$config->set('Core.EscapeNonASCIICharacters', 'true');
		$purifier = new HTMLPurifier($config);
		$clean_html = $purifier->purify($dirty_html);
		
		return $clean_html;
}

?> 