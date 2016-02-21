<?php
header('Content-Type: text/html; charset=utf-8');
include_once("../php/saloia-tv.php");
?>
<html>
<head>
	<?php include_once("../php/head.php"); ?>
	<title>Saloia TV | Protagonistas dos nossos videos</title>
	
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script type="text/javascript" src="../js/main.js"></script>

</head>
<body onload="selected('pessoas');">
	
	<?php include_once("../php/header.php"); ?>
	
<div class="main_wrap">

	
	
	<section class="breadcrumb" style="margin-top:20px;">
		<a href="#">Pessoas</a>
			<i class="divider">/</i>
		<a href="#">Todas as pessoas</a>
	</section>
	
	<section class="titulo">
		<h2 style="margin-top:-8px;">Pessoas</h2>
		<p>Estes são os protagonistas dos nossos videos</p>
		
		<a style="margin-top:-35px;" onclick="procurar()" class="search" href="#"><i class="icon-search"></i></a>
		<form id="actionsearch" action="<?php echo $public_url; ?>search" method="post"><input type="text" placeholder="Procurar" value="" name="search" id="search" style="display:none;"></form>
	</section>
	
	<div id="ppessoas" class="pessoas">
		<?php
		$xmlstring=file_get_contents("https://docs.google.com/uc?export=download&id=0B3QQaCdTY2LkUVJjeDRQeWl3NEU");
		$xml = simplexml_load_string($xmlstring);
		$json = json_encode($xml);
		$pessoas = json_decode($json,TRUE);
		$pessoas=$pessoas['pessoa'];


		foreach($pessoas as $pessoa){ ?>
		<a href="<?php echo $public_url."pessoa/".$pessoa['facebook']; ?>" style="background: url(''); background-size:320px; background-position-y:-50px;" href="<?php echo $public_url."pessoas/".$pessoa['facebook']; ?>"><div class="item">
			<img src="<?php echo $pessoa['imagem']; ?>">
			<h3><?php echo $pessoa['nome']; ?></h3>
			<p><?php echo $pessoa['facebook']; ?></p>
			<i class="icon-video"><?php echo $pessoa['videos']; ?> video(s)</i>
		</div></a>
		<?php } ?>
			
	</div>

	<script>

			var pessoas = document.getElementById("ppessoas").getElementsByTagName("div");
			var nRequest = new Array();
			var resposta = new Array();

			for (var i=0; i<pessoas.length; i++){
				(function(i) {
			    	nRequest[i] = new XMLHttpRequest();
			      	nRequest[i].open("GET", "http://graph.facebook.com/"+pessoas[i].getElementsByTagName("p")[0].innerHTML, true);
			      	nRequest[i].onreadystatechange = function (oEvent) {
			        	if (nRequest[i].readyState == 4 && nRequest[i].status == 200) {
			            	
			            	resposta[i] = JSON.parse(nRequest[i].responseText);
			            	pessoas[i].getElementsByTagName("h3")[0].innerHTML = resposta[i].name;
			   				pessoas[i].getElementsByTagName("img")[0].setAttribute("src", "http://graph.facebook.com/"+resposta[i].id+"/picture/?type=large");
			   				/*pessoas[i].setAttribute("href", "http://www.saloia.tv/pessoa/"+resposta[i].username);*/
			        	}
			    	};
			    	nRequest[i].send(null);
				})(i);
			}

		</script>


	<div class="topo">

		<iframe scrolling="no" style="overflow-y:hidden; height:90px;" width="728px" height="90px" src="/files/cabecalho1.html" frameborder="0"></iframe>

	</div>
	
</div>
	
	
<?php include_once("../php/footer.php"); ?>

	

</body>
</html>