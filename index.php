<? include ('header.php'); ?>


<?
$p = $_GET['p'];
if ($p == "programs")
{
	include('programs.php');

}
elseif($p == "keertan")
{
	include('keertan.php');
}
elseif($p == "keertanSoon")
{
	echo "<h2>All Keertan from AKJ.org will be here soon</h2>";
}
else
{
echo '
	<article data-role="content" data-theme="a">
		<center>
		<img src="home_2.jpg">
		<h3>Welcome to AKJMobile.org</h3>
		<p>Get easy access to AKJ.org via this mobile enabled site<p>
		<p>iOS Users: Save as a bookmark for easy access from your home screen</p>
		<p>For issues please tweet <a href="http://twitter.com/AKJMobile" target="_blank">@AKJMobile</a></p>
		</center>
		<!--<ul data-role="listview">
			<li><a href="?p=programs"><h1>PROGRAMS</h1></a></li>
			<li><a href="?p=keertan"><h1>KEERTAN</h1></a></li>
		</ul>-->
	</article>	
	';
}
?>


<? include ('footer.php'); ?>