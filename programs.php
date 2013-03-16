<script>
    $(function() {
        $('#item').change(function() {
            $.mobile.changePage('?p=programs', {
                type: 'get',
                data: $('form#myForm').serialize()
            });
        });
    });
</script>

<article data-role="content" data-theme="a">
<div class="programs">
<?php
require_once 'htmlpurifier/library/HTMLPurifier.auto.php';
require_once 'functions.php';

$city = false;

if(!(empty($_GET['city'])))
{
	$city = true;
}


#$clean_html = get_html($target_url,$home);
$menu_html = new GetHtml("menu");
$dirty_menu_html = $menu_html->get_html();
$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'UTF-8');
$config->set('HTML.Doctype', 'HTML 4.01 Transitional');
$config->set('Core.EscapeNonASCIICharacters', 'true');
$purifier = new HTMLPurifier($config);
$clean_menu_html = $purifier->purify($dirty_menu_html);
		
$program_menu = new Menu($clean_menu_html);
$cities = $program_menu->get_cities();
$countries = $program_menu->get_countries();



$html = new GetHtml("main");
$dirty_html = $html->get_html();
$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'UTF-8');
$config->set('HTML.Doctype', 'HTML 4.01 Transitional');
$config->set('Core.EscapeNonASCIICharacters', 'true');
$purifier = new HTMLPurifier($config);
$clean_html = $purifier->purify($dirty_html);

$countryid = $html->get_country_id();
$cityid = $html->get_city_id();

$counter = 1;


echo "<form method='get' id='myForm'>"; #window.location='ban.php?product='+this.value"
echo '<select id="item" name="item" onChange="window.open(this.options[this.selectedIndex].value,\'_top\')">';
echo '<option value="?p=programs" selected>International</option>';
$selected = false;
foreach ($countries as $countryItem)
{
	if($countryid == $counter && $city==false && $selected == false)
	{
		echo "<option value=\"?p=programs&countryid=$counter\" selected>$countryItem</option>";
		$selected = true;
	}
	else
	{
		echo "<option value=\"?p=programs&countryid=$counter\">$countryItem</option>";
	}
	
	foreach($cities as $cityItem => $countryNumber)
	{
		if($countryNumber == $counter)
		{
			if($city == true && "$cityid" == "$cityItem" && "$countryid" == "$counter" && $selected == false)
			{
				echo "<option value=\"?p=programs&countryid=$counter&city=$cityItem\" selected>--$cityItem</option>";
				$selected = true;
			}
			else
			{
				echo "<option value=\"?p=programs&countryid=$counter&city=$cityItem\">--$cityItem</option>";	
			}
		}	
			
	}
		
	$counter = $counter + 1;
		
}
echo "</select></form>";






echo '<ul data-role="listview" data-filter="true">';
if($city)
{
	echo '<div class="programs_city">';
	parseCity($clean_html);
	echo '</div>';
}
else
{
	echo '<div class="programs_other">';
	parseMainAndCountry($clean_html);
	echo '</div>';

}
echo '</ul>';




?>



</div>
</article>
