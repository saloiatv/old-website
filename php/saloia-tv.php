<?php
	
/*
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/

//------------------------------------------ 
//---------------  OAuth2.0  --------------- 
//------------------------------------------ 

function accessToken($fileRefreshToken,$urlToken,$clientID,$clientSecret){

	$refresh_token=file_get_contents($fileRefreshToken);
	$token=pedidoPOST($urlToken,"","grant_type=refresh_token&refresh_token=".$refresh_token."&client_id=".$clientID."&client_secret=".$clientSecret);
	//$token=pedidoPOST($urlToken,"",array("grant_type"=>"refresh_token","refresh_token"=>$refresh_token,"client_id"=>$clientID,"client_secret"=>$clientSecret));
	//$file = fopen($fileRefreshToken, "w") or die("Unable to open file!");
	//fwrite($file,$token['refresh_token']);
	//fclose($file);

	return $token['access_token'];
}

function pedidoGET($url,$access_token,$data){

	$result=file_get_contents($url."?access_token=".$access_token."&".$data);
	return json_decode($result,true);
}

function pedidoPOST($url,$access_token,$data){

	$params = array('http' => array('method'=>'POST','content'=>$data ));
  	$ctx = stream_context_create($params);

	$result=file_get_contents($url."?access_token=".$access_token."&".$data,false,$ctx);
	return json_decode($result,true);
}




//------------------------------------------ 
//------------  Youtube API v3  ------------ 
//------------------------------------------ 

function videos($token,$IDs){

	$videos = pedidoGET("https://www.googleapis.com/youtube/v3/videos",$token,"part=snippet&fields=items(id,snippet(title,description,channelId,thumbnails(medium,default),tags,publishedAt),recordingDetails(location(latitude,longitude)))&id=".$IDs);
	return $videos['items'];
}

function video($token,$ID){
	$videos=videos($token,$ID);
	return $videos[0];
}

function search0($token,$query,$maxResults){

	$search = pedidoGET("https://www.googleapis.com/youtube/v3/search",$token,"part=snippet&forMine=true&maxResults=".$maxResults."&fields=items(id(videoId))&type=video&q=".urlencode($query));
	return $search['items'];
}

function search1($token,$query,$maxResults){

	$search = pedidoGET("https://www.googleapis.com/youtube/v3/search",$token,"part=snippet&forMine=true&maxResults=".$maxResults."&fields=items(id(videoId),snippet(title,description,thumbnails(medium(url),default(url)),publishedAt))&type=video&q=".urlencode($query));
	return $search['items'];
}

function search2($token,$query,$maxResults){

	$list = search0($token,$query,$maxResults);

	$videoIDs = ""; // String com IDs dos videos
	foreach($list as $entry){ $videoIDs.=$entry['id']['videoId'].","; }
	$videoIDs = substr($videoIDs, 0,-1); // apagar ultima virgula

	return videos($token,$videoIDs);
}

function playlist($token,$query,$maxResults){

	$list = pedidoGET("https://www.googleapis.com/youtube/v3/playlistItems",$token,"part=snippet&maxResults=".$maxResults."&fields=items(snippet(title,description,resourceId(videoId),thumbnails(medium,default),publishedAt))&playlistId=".$query);
	return $list['items'];
}

function playlistInfo($token,$ID){
	$list = pedidoGET("https://www.googleapis.com/youtube/v3/playlists",$token,"part=snippet&maxResults=1&fields=items(snippet(title,description,thumbnails(medium,default),publishedAt))&id=".$ID);
	return $list['items'][0];
}




//------------------------------------------ 
//---------------  Saloia TV  --------------
//------------------------------------------ 

session_start();

if($_SERVER['HTTP_HOST']=="server1.saloia.tv"){
	$uri = $_SERVER['REQUEST_URI'];
	Header( "HTTP/1.1 301 Moved Permanently" );
	Header( "Location: http://saloia.tv$uri" );	
}

if( !isset($_SESSION["sltvtoken"]) OR (date("YmdHis")-$_SESSION["sltvdate"]>10000) ){
	$_SESSION["sltvtoken"]=accessToken("/google.json","https://accounts.google.com/o/oauth2/token","client_id","client_secret");
	$_SESSION["sltvdate"]=date("YmdHis");
}

$public_url="http://saloia.tv/";
$browser_url=explode("/",$_SERVER['REQUEST_URI']);
$navsearch=TRUE;
$token=$_SESSION["sltvtoken"];

$KeyIdEnconde=array('a'=>'q','b'=>'w','c'=>'e','d'=>'r','e'=>'t','f'=>'y','g'=>'u','h'=>'i','i'=>'o','j'=>'p','k'=>'a','l'=>'s','m'=>'d','n'=>'f','o'=>'g','p'=>'h','q'=>'j','r'=>'k','s'=>'l','t'=>'z','u'=>'x','v'=>'c','w'=>'v','x'=>'b','y'=>'n','z'=>'m','A'=>'M','B'=>'N','C'=>'B','D'=>'V','E'=>'C','F'=>'X','G'=>'Z','H'=>'L','I'=>'K','J'=>'J','K'=>'H','L'=>'G','M'=>'F','N'=>'D','O'=>'S','P'=>'A','Q'=>'P','R'=>'O','S'=>'I','T'=>'U','U'=>'Y','V'=>'T','W'=>'R','X'=>'E','Y'=>'W','Z'=>'Q','0'=>'8','1'=>'9','2'=>'0','3'=>'1','4'=>'2','5'=>'3','6'=>'4','7'=>'5','8'=>'6','9'=>'7','-'=>'_','_'=>'-');
$IdKeyEnconde=array_flip($KeyIdEnconde);

function IDtoPublicKey($id){
	global $KeyIdEnconde; $publicKey="";

	for($k=0; $k<strlen($id); $k++)
		$publicKey.=$KeyIdEnconde[$id[$k]];
	
	return $publicKey;
}

function PublicKeytoID($publicKey){
	global $IdKeyEnconde; $id="";

	for($k=0; $k<strlen($publicKey); $k++)
		$id.=$IdKeyEnconde[$publicKey[$k]];
	
	return $id;
}

function limitarTexto($texto,$limite){

	if (strlen($texto) > $limite) {
	    $stringCut = substr($texto, 0, $limite);
	    $texto = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
	}
	return $texto;
}

?>
