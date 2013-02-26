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
else
{
echo '
	<article data-role="content">
		<ul data-role="listview">
			<li><a href="?p=programs"><h1>PROGRAMS</h1></a></li>
			<li><a href="#"><h1>KEERTAN</h1></a></li>
		</ul>
	</article>	
	';
}
?>


<? include ('footer.php'); ?>