<?php include_once("../php/saloia-tv.php"); ?>


<style>
*{ margin:0; padding:0;}
a{ margin: 10px 0px 10px 0px; display:block;}
a img{ width:300px; height:250px; }
</style>

<?php
$dr_results = pedidoGET("https://www.googleapis.com/drive/v2/files/0Bx12o6TFFnSffkMwWGhqcl8zbmppSTZYOWY2TG5aUlVFcXJGbXJXeVlNbVdvX0ZtVkFlRk0/children",$_SESSION['sltvtoken'],"q=trashed%3Dfalse");

foreach ($dr_results['items'] as $item) {
	$src="https://docs.google.com/uc?export=download&id=".$item['id'];
	echo "<a href='#'><img src='".$src."'></a>\n";
}
?>
