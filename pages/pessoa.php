<?
header('Content-Type: text/html; charset=utf-8');
include_once("../php/saloia-tv.php");
?>
<html>
<head>
	<?php 

	include_once("../php/head.php");

	$pessoaid=$browser_url[2];
	
	?>
	<title>Saloia TV | <? echo $pessoaid; ?> </title>
	<script> selected("pessoas"); </script>
</head>
<body>
	
	<?php include_once("../php/header.php"); ?>
	
	<?php $navsearch=false; include_once("../php/nav.php"); ?>
	
<div class="main_wrap">
	
	<section class="breadcrumb">
		<a href="<? echo $public_url."pessoas"; ?>">Pessoas</a>
			<i class="divider">/</i>
		<a href="#"><?php echo $pessoaid; ?></a>
			<i class="divider">/</i>
		<a href="#">Todos os videos</a>
	</section>
	
<?php 

		$videos=search1($token,"&online  facebook.com/".$pessoaid,30);



?>
	
	<section class="titulo videospessoas">
			<img id="pimagem" src="">
			<h2 id="pnome"></h2>
			<p id="faceid">&nbsp;<?php echo $pessoaid; ?></p>
			<h4 style="margin: 10px 0px 0px 0px;" class="icon-video"><?php echo $num; ?> video(s)</h4>

			<script>

				var pessoa = document.getElementById("faceid").innerHTML;
				var nRequest = new Array();
				var resposta = new Array();

				for (var i=1; i<2; i++){
					(function(i) {
				    	nRequest[i] = new XMLHttpRequest();
				      	nRequest[i].open("GET", "http://graph.facebook.com/"+pessoa.substr(6), true);
				      	nRequest[i].onreadystatechange = function (oEvent) {
				        	if (nRequest[i].readyState == 4 && nRequest[i].status == 200) {
				            	
				            	resposta[i] = JSON.parse(nRequest[i].responseText);
				            	document.getElementById("pnome").innerHTML = resposta[i].name;
				   				document.title="Saloia TV | "+resposta[i].name;
				   				document.getElementById("pimagem").setAttribute("src", "http://graph.facebook.com/"+resposta[i].id+"/picture/?type=large");
				        	}
				    	};
				    	nRequest[i].send(null);
					})(i);
				}

			</script>
		
		<a onclick="procurar()" class="search" href="#"><i class="icon-search"></i></a>
		<form id="actionsearch" action="<?php echo $public_url; ?>search" method="post"><input type="text" placeholder="Procurar" value="" name="search" id="search" style="display:block;"></form>
	</section>

	<div id="ppessoas" class="main list" style="min-height:1300px; ">
	
<?php	
		foreach ($videos as $item) {
			$desc=explode("@",$item['snippet']['description']);
			$vid_autor=$desc[1];
			$descricao=$desc[0];
		?>
	
		<div class="item" style="min-height:420px;">
			<a href="<? echo $public_url."v/".IDtoPublicKey($item['id']['videoId']); ?>">
				<img alt="<?php echo limitarTexto($descricao,100); ?>" src="<?php if($item['snippet']['thumbnails']['maxres']['url']){ echo $item['snippet']['thumbnails']['maxres']['url']; }else{ echo $item['snippet']['thumbnails']['medium']['url']; } ?>">
				<i class="entry"></i>
				<i class="icon-play"></i>	
			</a>
			<h2><a href="<?php echo $public_url."v/".IDtoPublicKey($item['snippet']['resourceId']['videoId']); ?>"><? echo $item['snippet']['title']; ?></a></h2> 
			<span><i class="icon-calendar"></i><? echo substr($item['snippet']['publishedAt'],0,10); ?></span>
			<span><i class="icon-user"></i><? if($vid_autor){ echo $vid_autor; } else{ echo "(não disponível)"; } ?></span>
			<p><?php echo limitarTexto($descricao,180); ?></p>		
		</div>
		
<? } ?>
		
	</div>
	
</div>
	
	
<?php include_once("../php/footer.php"); ?>

	

</body>
</html>