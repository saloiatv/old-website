<?php
header('Content-Type: text/html; charset=utf-8');
include_once("../php/saloia-tv.php");

$vID=explode("?",$browser_url[2]);
$videoid=PublicKeytoID($vID[0]);
$video = video($token,$videoid);

if($video['snippet']['channelId']!="UCmILMcxRn4pDKSU0_1ADHkw"){ include("404.php"); }
?>
<html>
<head>
	<?php include_once("../php/head.php");
	
	$vidq=explode("@",$video['snippet']['description']);
	$vid_data=substr($video['snippet']['publishedAt'],0,10);
	
	?>
	<title>Saloia TV | <?php echo $video['snippet']['title']; ?></title>
	<meta property="og:title" content="<?php echo $video['snippet']['title']; ?>"/>
	<meta property="og:url" content="<?php echo $public_url; ?>v/<?php echo IDtoPublicKey($video['id']); ?>"/>
	<meta property="og:image" content="<?php  echo $video['snippet']['thumbnails']['medium']['url']; ?>"/>
	<meta property="og:site_name" content="Saloia TV"/>
	<meta property="og:description" content="<?php echo str_replace(array("\n","\t"), " ",$vidq[0]); ?>"/>
	<meta property="og:type" content="video.movie" />
	
	<meta name="description" content="<?php echo str_replace(array("\n","\t"), " ",$vidq[0]); ?>">

	<meta name="twitter:card" content="photo">
	<meta name="twitter:url" content="<?php echo $public_url; ?>v/<?php echo IDtoPublicKey($video['id']); ?>">
	<meta name="twitter:title" content="<?php echo $video['snippet']['title']; ?>">
	<meta name="twitter:description" content="<?php echo str_replace(array("\n","\t"), " ",$vidq[0]); ?>">
	<meta name="twitter:image" content="<?php echo $video['snippet']['thumbnails']['medium']['url']; ?>">
	
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/main.js"></script>

<?php if(sizeof($video)>2){ ?>
	<script async src="http://maps.googleapis.com/maps/api/js?sensor=false&language=pt-PT"></script>
	<style>
	#mapavideo{width:580px;height:420px;}
	</style>
	<script>
	function initialize() {
  var myLatlng = new google.maps.LatLng(<?php echo $video['recordingDetails']['location']['latitude']; echo ","; echo $video['recordingDetails']['location']['longitude']; ?>);
  var mapOptions = {
    zoom: 15,
    scrollwheel: false,
    center: myLatlng
  };

  var map = new google.maps.Map(document.getElementById('mapavideo'), mapOptions);
  var activeWindow;
  
  
  //videokey --------------
  var location0 = new google.maps.LatLng(<?php echo $video['recordingDetails']['location']['latitude']; echo ","; echo $video['recordingDetails']['location']['longitude']; ?>);
  var info0 = new google.maps.InfoWindow({
      content: '<div class="infovideo" style="overflow-x:hidden; overflow-y:hidden;"><a class="thumbnail" href="#"><i class="icon-video"></i><img src="<?php if($video['snippet']['thumbnails']['maxres']['url']){ echo $video['snippet']['thumbnails']['maxres']['url']; }else{ echo $video['snippet']['thumbnails']['medium']['url']; } ?>"><i class="entry"></i></a><h2><a href="#"><?php echo $video['snippet']['title']; ?></a></h2><p>Local onde este video foi gravado</p><span></span><span class="right"></span></div>'
  });
  var marker0 = new google.maps.Marker({
      position: location0, map: map, title: 'Estúdio Saloia TV'
  });
  info0.open(map,marker0);
  google.maps.event.addListener(marker0, 'click', function() {
  	if(activeWindow!=null){ activeWindow.close(); }
    info0.open(map,marker0);
    activeWindow=info0;
  });
  //------------------------ 
  
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <?php } ?>


</head>
<body>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pt_PT/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	<?php include_once("../php/header.php"); ?>
	
	<?php include_once("../php/nav.php"); ?>
	
<div class="main_wrap">	
	
	<section class="breadcrumb">
		<a href="#">Saloia TV</a>
			<i class="divider">/</i>
		<a href="#">Videos</a>
			<i class="divider">/</i>
		<a href="#"><?php echo $video['snippet']['title']; ?></a>
	</section>
	
	<article itemprop="video" itemscope itemtype="http://schema.org/VideoObject">
  		<meta itemprop="thumbnailUrl" content="<?php echo $video['snippet']['thumbnails']['medium']['url']; ?>" />
  		<meta itemprop="contentUrl" content="<?php echo $public_url; ?>v/<?php echo $browser_url[2]; ?>" />
  		<meta itemprop="embedUrl" content="<?php echo $public_url; ?>embed/<?php echo $browser_url[2]; ?>" />
  		<meta itemprop="uploadDate" content="<?php echo $video['snippet']['publishedAt']; ?>" />
		
		<?php /*<span class="video"><i class="shadow"></i><i class="icon-video"></i><i class="data"><?php echo substr($video['snippet']['publishedAt'],0,10); ?></i></span>*/ ?>
		<?php /*<iframe class="player" <?php if($iOS){ echo 'style="height:350px;"'; } ?> src="<?php echo $public_url; ?>embed/<?php echo $browser_url[2]; ?>" scrolling="no" frameborder="0"></iframe>*/ ?>
		<div id="saloiaplayer">
			<div class="videoplayer">
				<div id="slytplyr"></div>
			</div>

		</div>
		<?php /* <i class="entry"></i>*/ ?>
		
		<h2 itemprop="name"><a href="#"><?php echo $video['snippet']['title']; ?></a></h2>
		<div id="fbvideolike" class="fb-like" data-href="<?php echo $public_url."v/".$browser_url[2]; ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div>
		<span><i class="icon-calendar"></i><?php echo $vid_data; ?></span>
<?php

$tags=array();
$pessoas=array();
$locais=array();
$preroll="";

foreach($video['snippet']['tags'] as $tag){
	if (strpos($tag,'facebook.com') !== false) {//procurar por pessoas
		
		$aux1=explode("facebook.com/",$tag);
		if(substr($aux1[1],0,11)=="profile.php"){ $aux2=explode("id=",$aux1[1]); $aux3=explode("&",$aux2[1]); }
		else{ $aux3=explode("?",$aux1[1]); }
		$tag="facebook.com/".$aux3[0];
		
  		if(!in_array($tag, $pessoas, true)){ //se ainda nao foi adicionado
			array_push($pessoas, $tag); //adicionar pessoa a lista
		}
		continue; //passar para a proxima tag
	}
	if(substr($tag, 0,1)=="#"){ //procurar por locais
  		if(!in_array($tag, $locais, true)){ //se ainda nao foi adicionado
			array_push($locais, $tag); //adcionar locais a lista
		}
		continue; //passar para a proxima tag
	}
	if(substr($tag, 0,1)=="&"){ //procurar por categorias
		if($tag!="&online"){ $categoria=substr($tag, 1); } //excluir &online
		continue; //passar para a proxima tag
	}
	if(substr($tag, 0,16)=="http://youtu.be/"){ //procurar por prerolls
  		$preroll=substr($tag, 16);
		continue; //passar para a proxima tag
	}
	else{ //procurar tags de tema
  		if(!in_array($tag, $tags, true)){ //se ainda nao foi adicionada
			array_push($tags, $tag); //adcionar à lista
		}
	}	
}
if($categoria=="empresas"){ 
	$vidq[0]=$video['snippet']['description']; 
	$vidq[1]="(não disponível)"; 
}
?>
		<span><i class="icon-user"></i><?php if(sizeof($vidq)>1){ echo '<a href="https://plus.google.com/108513907361792088427?rel=author">'.$vidq[1].'</a>'; } else{ echo "(não disponível)"; } ?></span>	
		<span><i class="icon-tags"></i><a href="<?php echo $public_url.$categoria; ?>"><?php echo $categoria; ?></a></span>
		<p itemprop="description"><?php echo nl2br($vidq[0]) ?></p>
		
		<div class="tags">
			<a class="main">Tags:</a>
			
				<?php foreach($tags as $tag){
					echo '<a href="'.$public_url.$categoria.'/'.$tag.'">'.$tag.'</a>';
				} ?>
				<div style="clear: both;"></div>
		</div>
		
		<div class="videopessoas" id="vpessoas">
			<a class="pessoa main">Pessoas:</a>
				<?php if($pessoas){ foreach($pessoas as $pessoa){ ?>
  					<a class="pessoa" href="<?php echo $pessoa; ?>" style="background:url(''); background-size150px; background-size:120px; background-repeat: no-repeat; background-position:top; background-position-y: 40%; background-position-x: 40%;"><span></span></a>			
				<?php } ?>
				
				<p id="identificar_texto" class="sugestao" style="clear: both; margin: 0px 0px 0px 4px;">Não está identificado neste video? <a href="javascript:identificar('<?php echo $browser_url[2]; ?>');">Clique aqui</a> para ser identificado.</p>
				<?php }else{ ?>
				<p class="sugestao" style="padding-top: 29px; margin-bottom: -10px; display:block;">Nenhuma pessoa identificada</p>
				<p id="identificar_texto" class="sugestao" style="margin: -55px 0px 0px 4px;">Não está identificado neste video? <a href="javascript:identificar('<?php echo $browser_url[2]; ?>');">Clique aqui</a> para ser identificado.</p>
				<?php } ?>
				<div id="identificar"></div>
				<div style="clear: both; height:30px;"></div>
		</div>

		<script>

			var pessoas = document.getElementById("vpessoas").getElementsByTagName("a");
			var nRequest = new Array();
			var resposta = new Array();

			for (var i=1; i<pessoas.length-1; i++){
				(function(i) {
			    	nRequest[i] = new XMLHttpRequest();
			      	nRequest[i].open("GET", "http://graph."+pessoas[i].getAttribute("href"), true);
			      	nRequest[i].onreadystatechange = function (oEvent) {
			        	if (nRequest[i].readyState == 4 && nRequest[i].status == 200) {
			            	
			            	resposta[i] = JSON.parse(nRequest[i].responseText);
			            	pessoas[i].innerHTML = "<span>"+resposta[i].name+"</span>";
			   				pessoas[i].setAttribute("style", "background:url(http://graph.facebook.com/"+resposta[i].id+"/picture/?type=large); background-size150px; background-size:120px; background-repeat: no-repeat; background-position:top; background-position-y: 40%; background-position-x: 40%;");
			   				pessoas[i].setAttribute("href", "http://www.saloia.tv/pessoa/"+resposta[i].username);
			        	}
			    	};
			    	nRequest[i].send(null);
				})(i);
			}

		</script>

		<a id="comentar"></a>
		<?php if(sizeof($video)>2){ ?>
		<div class="mapa" id="mapavideo"></div>
		<?php } ?>
		
		<div class="fb-comments" data-href="<?php echo $public_url."v/".$videoid; ?>" data-width="580" order_by="reverse_time" data-mobile="1" data-numposts="10" data-colorscheme="light"></div>
	
	</article>	

	<aside style="margin-top:0px;">
	
		<div class="destaques" id="vrels">
			<h2>Videos relacionados</h2>
			<p class="sugestao">A carregar...</p>
			<div style="clear: both; height:30px;"></div>			
		</div>
		
		<?php /*include("../php/mrec.php"); */ ?>

		<div class="mrec">
			
			<h2>Publicidade</h2>

			<iframe id="mrec234" scrolling="no" style="overflow-y:hidden; height:800px;" width="300px" height="800px" src="../banners/mrec.php" frameborder="0"></iframe>

		</div>
	
		<div class="facebook">
			<h2>Siga-nos no facebook</h2>
			<iframe id="sgstvfb" frameborder="0" src="https://www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FSaloia-TV%2F255556074565169&width=300&height=310&colorscheme=light&show_faces=true&header=false&stream=false&show_border=false&appId=138129496384440"></iframe>
		</div>
		
		<div class="contactar">
			<h2>Contacte-nos</h2>
			<p>Pode contactar a saloia tv através do formulário em baixo ou pode optar pelo o contacto por email através do endereço: <a href="mailto:geral@saloia.tv">geral@saloia.tv</a></p>
			<form action="<?php echo $public_url; ?>search">
				<input type="text" name="Nome" placeholder="Nome">
				<input type="text" name="Email" placeholder="Email">
				<textarea name="mensagem" placeholder="Mensagem"></textarea>
				<input type="submit" value="Enviar">			
			</form>
		</div>
	
	</aside>
	
</div>
<?php include_once("../php/footer.php"); ?>


<?php
	$tags=urlencode(serialize($tags));
	$locais=urlencode(serialize($locais));
	$pessoas=urlencode(serialize($pessoas));
	$videoid=urlencode($videoid);
?>
<script type="text/javascript">
	window.onload=function(){setTimeout('vRelacionados("<?php echo $tags; ?>","<?php echo $locais; ?>","<?php echo $pessoas; ?>","<?php echo $videoid; ?>");',2000);loadDeferredIframe();};	


    var seenPreroll=<?php if($preroll==""){ echo "true";} else{ echo "false"; } ?>;
    var preroll='<?php echo $preroll; ?>';
    var mainfeature='<?php echo $videoid; ?>';
    var playingId='';
    var tag = document.createElement('script');
    tag.src = "http://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player("slytplyr", {
            height: '100%',
            width: '100%',
            playerVars: { 'rel':0, 'autoplay':1, 'controls':1, 'showinfo':0, 'autohide':0, 'color':'white', 'fs':0, 'iv_load_policy':1, 'cc_load_policy':0, 'modestbranding':1, 'theme':'light' },
            videoId: mainfeature,
            events: {
                'onStateChange': function(event) {
                    if (event.data==1&&seenPreroll==false) {
                        player.pauseVideo();
                        player.loadVideoById(preroll);
                        playingId=preroll;
                        seenPreroll=true;
                        player.playVideo();

                        var sltvplyralert = document.createElement("p");
                        sltvplyralert.setAttribute("id", "sltvplyralert");
                        sltvplyralert.setAttribute("style","padding-top:4px; text-align: center; background:#ccc;z-index:999; height:24px; position:relative; width:100%; margin:-27px 0px 0px 0px;");
                        document.getElementById("saloiaplayer").appendChild(sltvplyralert);

                        function updateTime() {
                            var tempo=player.getDuration()-player.getCurrentTime();
                            if(tempo<=0){tempo=0;}
                            document.getElementById("sltvplyralert").innerHTML="O video vai comecar dentro de "+tempo.toFixed(0)+" segundos";
                        }
                        timeupdater = setInterval(updateTime, 100);
                        
                    }
                    else if (event.data==0&&playingId==preroll) {
                        var url=player.getIframe().src;
                        player.loadVideoById(mainfeature);
                        playingId=mainfeature;
                        player.playVideo();
                        
                        var el = document.getElementById( 'sltvplyralert' );
                        el.parentNode.removeChild( el );

                    }
                }
            }
        });

    }
</script>

</body>
</html>