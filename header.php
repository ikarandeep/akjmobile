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
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png" />
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
</script>
<!--jquery mobile-->
  <link rel="stylesheet" href="themes/Akj_v1.min.css" />
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.0/jquery.mobile.structure-1.3.0.min.css" /> 
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script> 
  <script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script> 
<!--end jquery mobile-->
<link rel="stylesheet" type="text/css" href="styles.css">
<link href='http://fonts.googleapis.com/css?family=Fjalla+One|Roboto|Titillium+Web' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="styles.css">
<title>AKJ Mobile</title>
</head>
<body>
<div data-role="page">
	<div data-role="header">
		<div class="top_bar">AKJ Mobile</div>
</div>