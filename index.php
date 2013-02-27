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
	<article data-role="content">
		<ul data-role="listview">
			<li><a href="?p=programs"><h1>PROGRAMS</h1></a></li>
			<li><a href="?p=keertanSoon"><h1>KEERTAN</h1></a></li>
		</ul>
	</article>	
	';
}
?>


<? include ('footer.php'); ?>