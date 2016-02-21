<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once("php/saloia-tv.php");
?>
<html>
<head>
	<meta charset="UTF-8">
	
	<title>Saloia TV | A televisão da região saloia</title>
	
	<meta property="og:title" content="Saloia TV"/>
	<meta property="og:url" content="http://saloia.tv"/>
	<meta property="og:image" content="http://saloia.tv/files/logotipo.png"/>
	<meta property="og:site_name" content="Saloia TV"/>
	<meta property="og:description" content="A Saloia TV é a televisão da região saloia, estando actualmente disponível ao publico através da Internet mas podendo a qualquer altura evoluir para outras formas de distribuição..."/>
	<meta property="og:type" content="website" />
	<meta name="google-site-verification" content="c6fY6GRR4drR1A6E1YFNFP-eZfqFVkBtn7PUb5KRNPI" />
	<meta name="description" content="A Saloia.TV pretende promover a região saloia, os seus produtos, as suas potencialidades, as suas belezas, as suas tradições, a sua história, a sua cultura, as suas gentes, as suas iniciativas, o seu empreendedorismo e a sua maneira de estar e de ser.">
	<meta property="twitter:card" content="summary" />
	<meta property="twitter:site" content="Saloia TV" />
	<meta property="twitter:title" content="Saloia TV" />
	<meta property="twitter:description" content="A Saloia.TV pretende promover a região saloia, os seus produtos, as suas potencialidades, as suas belezas, as suas tradições, a sua história, a sua cultura, as suas gentes, as suas iniciativas, o seu empreendedorismo e a sua maneira de estar e de ser." />
	<meta property="twitter:image" content="http://saloia.tv/files/logotipo.png" />
	<meta property="twitter:url" content="http://saloia.tv" />	
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/main.js"></script>

</head>
<body>

	<?php include_once("php/header.php"); ?>
	<?php include_once("php/nav.php"); ?>
	
	<div class="main_wrap">
	
	
		<section>

		<iframe id="emissao" src="https://www.youtube.com/embed?listType=playlist&list=PLFM2rShlvK9iuXValgZbK6dfeWbF_X2Sk&rel=0&autoplay=0&controls=1&showinfo=0&autohide=0&color=white&fs=0&iv_load_policy=1&cc_load_policy=0&modestbranding=1&theme=light&origin=http://saloia.tv" frameborder="0" allowfullscreen></iframe>
	
	<!--	<iframe id="emissao" src="https://www.youtube.com/embed/cerSbnoHu6I" frameborder="0" allowfullscreen></iframe>-->
			
      
      <?php 		
				$playlist=playlist($_SESSION["sltvtoken"],"PLFM2rShlvK9gF83YTlrovS9UvqpOLPv_k",3);
				foreach ($playlist as $item) {
			?>

			<div class="item" onclick="location.href='<?php echo $public_url."v/".IDtoPublicKey($item['snippet']['resourceId']['videoId']); ?>'">
				<a class="thumbnail" href="<?php echo $public_url."v/".IDtoPublicKey($item['snippet']['resourceId']['videoId']); ?>">
					<img src="<?php echo $item['snippet']['thumbnails']['medium']['url']; ?>">		
					<i class="entry"></i>
					<i class="icon-play"></i>
				</a>
				<h2><a href="<?php echo $public_url."v/".IDtoPublicKey($item['snippet']['resourceId']['videoId']); ?>"><?php echo $item['snippet']['title']; ?></a></h2>
				<p><?php $desc=explode("@",$item['snippet']['description']); echo limitarTexto($desc[0],100); ?></p>
				<span><i class="icon-calendar"></i><?php echo substr($item['snippet']['publishedAt'],0,10); ?></span>
				<span><i class="icon-tags"></i>destaques</span>
			</div>
		
			<?php } ?>

		</section>
	
		<div class="topo">
			<iframe scrolling="no" style="overflow-y:hidden; height:60px; width:800px" width="800px" height="60px" src="banners/topo.php" frameborder="0"></iframe>
		</div>
	
		<div class="main">
	
	<?php 
	$playlist=playlist($_SESSION["sltvtoken"],"PLFM2rShlvK9g5SK40oZEA7CWQtDw79hUK",10);
	foreach ($playlist as $video) {
		$vidq=explode("@",$video['snippet']['description']);
	?>

		<div class="item" onclick="location.href='<?php echo $public_url."v/".IDtoPublicKey($video['snippet']['resourceId']['videoId']); ?>'">
			<a href="<?php echo $public_url."v/".IDtoPublicKey($video['snippet']['resourceId']['videoId']); ?>">
				<img alt="<?php echo limitarTexto($vidq[0],166); ?>" src="<?php /* if($video['snippet']['thumbnails']['maxres']['url']){ echo $video['snippet']['thumbnails']['maxres']['url']; }else{*/ echo $video['snippet']['thumbnails']['medium']['url']; /*}*/ ?>">
				<i class="entry"></i>
				<i class="icon-play"></i>	
			</a>
			<h2><a href="<?php echo $public_url."v/".IDtoPublicKey($video['snippet']['resourceId']['videoId']); ?>"><?php echo $video['snippet']['title']; ?></a></h2>
			<div id="fbvlike"><div class="fb-like" data-href="<?php echo $public_url."v/".IDtoPublicKey($video['snippet']['resourceId']['videoId']); ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div></div>
			<span><i class="icon-calendar"></i><?php echo substr($video['snippet']['publishedAt'],0,10); ?></span>
			<span><i class="icon-user"></i><?php if(sizeof($vidq)>1){ echo end($vidq); } else{ echo "(não disponível)"; } ?></span>
			<span><i class="icon-tags"></i>recentes</span>
			<p><?php echo limitarTexto($vidq[0],166); ?></p>		
		</div>

	<?php } ?>	
		
		<div class="rectangulo">
			<a href="#"></a>
		</div>
		
		<div class="last">
			<a href="http://saloia.tv/eventos">Ver mais videos...</a>
		</div>
	
	</div>
	
	
	<aside class="index">
	
		<div class="facebook">
			<h2>Siga-nos no facebook</h2>
			<iframe id="sgstvfb" frameborder="0" src="https://www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FSaloia-TV%2F255556074565169&width=300&height=310&colorscheme=light&show_faces=true&header=false&stream=false&show_border=false&appId=138129496384440"></iframe>
		</div>

		<div class="mrec">	
			<h2>Publicidade</h2>
			<iframe scrolling="no" style="overflow-y:hidden; height:800px;" width="300px" height="800px" src="banners/mrec.php" frameborder="0"></iframe>
		</div>
		
		<div class="destaques">
			<h2>Empresas</h2>
			
		<?php 
		$empresas=playlist($_SESSION["sltvtoken"],"PLFM2rShlvK9hwIn7QTvqGfkm7VvhY04uM",8);
		foreach ($empresas as $item) {
		?>

			<a href="<?php echo $public_url."v/".IDtoPublicKey($item['snippet']['resourceId']['videoId']); ?>"><div class="item">
				<img src="<?php echo $item['snippet']['thumbnails']['medium']['url']; ?>"><i class="entry"></i>
				<h2><?php echo $item['snippet']['title']; ?></h2>
				<p><?php $desc=explode("@",$item['snippet']['description']); echo limitarTexto($desc[0],70); ?></p>	
			</div></a>

		<?php } ?>		
		</div>
		
		<div class="destaques">
			<h2>Desporto</h2>
			
		<?php 
		$desporto=search1($_SESSION["sltvtoken"],"&online &desporto",8);
		foreach ($desporto as $item) {
		?>

			<a href="<?php echo $public_url."v/".IDtoPublicKey($item['id']['videoId']); ?>"><div class="item">
				<img src="<?php echo $item['snippet']['thumbnails']['medium']['url']; ?>"><i class="entry"></i>
				<h2><?php echo $item['snippet']['title']; ?></h2>
				<p><?php $desc=explode("@",$item['snippet']['description']); echo limitarTexto($desc[0],70); ?></p>	
			</div></a>

		<?php } ?>		
		</div>
			
		<div class="Actividade">
			<h2>Actividade</h2>
			<iframe style="margin-top:-70px;" id="fbactiv" scrolling="no" style="overflow-y:hidden; height:900px;" width="300px" height="900px" src="https://www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2Fsaloiatv%2F367219143428556&width=300&height=900&colorscheme=light&show_faces=false&header=false&stream=true&show_border=false&appId=721428254550739" frameborder="0"></iframe>
		</div>
		
		<?php include("php/social.php"); ?>
		
		<?php /*<div class="enviarvideo">
			<h2>Enviar video</h2>
			<p>Ajude a Saloia TV, envie-nos o seu vídeo! Pode fazer videos sobre a região saloia: acontecimentos, memórias, opinião, festas, cultura, desporto, etc... A Saloia TV agradece. </p>
			<iframe id="enviarvideo" scrolling="no" style="overflow-y:hidden; height:414px;" width="300px" height="414px" src="about:blank" frameborder="0"></iframe>
		</div> */ ?>
		

	</aside>
	
</div>
	
<?php include_once("php/footer.php"); ?>

</div>
</body>
</html>
