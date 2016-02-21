<?php 	$playlist=playlistInfo($_SESSION["sltvtoken"],"PLFM2rShlvK9iuXValgZbK6dfeWbF_X2Sk"); 
	if($playlist['snippet']['description']!=""){
?>

<div id="alert" onclick="location.href='http://www.saloia.tv/'">
	
	<p><?php echo $playlist['snippet']['description']; ?></p>
	<img src="<?php  echo $playlist['snippet']['thumbnails']['medium']['url']; ?>">
	<i class="icon-play"></i>
</div>
<?php } ?>
<header>
	<a class="logo" href="<?php echo $public_url; ?>"><img src="<?php echo $public_url; ?>images/logotipo.png"></a>
	<p>Televisão da Região Saloia</p>
	<span>geral@saloia.tv</span>
	<div class="social">
		<a id="botaomapa" href="<?php echo $public_url; ?>mapa"><i class="icon-location"></i>Mapa</a>
		<a id="botaopessoas" href="<?php echo $public_url; ?>pessoas"><i class="icon-user"></i>Pessoas</a>
		<a id="botaoempresas" href="<?php echo $public_url; ?>empresas"><i class="icon-list"></i>Bons Vizinhos</a>					
	</div>
</header>