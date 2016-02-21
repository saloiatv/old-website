<?php include_once("../php/saloia-tv.php"); ?>


<style>
*{ margin:0; padding:0;}
a{ margin: 0px 0px 20px 0px; display:block;}
a img{ width:800px; height:60px; }
</style>

<?php
$dr_results = pedidoGET("https://www.googleapis.com/drive/v2/files/0Bx12o6TFFnSffkZnRHdReEctTl9vWm13OEw0dnZpSlR0M1Rrdk9WWm5hRFVBTERGVzMta2M/children",$_SESSION['sltvtoken'],"q=trashed%3Dfalse");

foreach ($dr_results['items'] as $item) {
	$src="https://docs.google.com/uc?export=download&id=".$item['id'];
	/*if($link==""){ $link="#"; }*/
	echo "<a href='#'><img src='".$src."'></a>\n";
}
?>
