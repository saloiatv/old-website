var isIE = (navigator.userAgent.indexOf("MSIE") != -1);

function replaceAll(find, replace, str) {
  return str.replace(new RegExp(find, 'g'), replace);
}

//Animacoes do botao de procura
function procurar(){
	var search = document.getElementById("search");
	var form = document.getElementById("actionsearch");
	var menu = document.getElementById("nav").getElementsByTagName("li");
	var menuitem=menu[menu.length-1];	
  var mobilemenu= document.getElementById("mobilemenu");
	
	if(search.style.display==="none"){
		search.style.display="block";
		search.focus();
		menuitem.style.opacity="0.1";
    mobilemenu.style.opacity="0";
		
	}
	else{
		if(search.value===""){ search.style.display="none"; menuitem.style.opacity="1"; mobilemenu.style.opacity="1"; }
		else{
			var qres=search.value;
			var url="/procurar/" + replaceAll(" ", "+",qres);
  			location.href=url;
  			return false;
		}
	}
}

//Identificar pessoa num video
function identificar(videoid){
  var formulario=document.getElementById("identificar");
  var texto=document.getElementById("identificar_texto");
  texto.style.display="none";
  formulario.innerHTML='<iframe src="/iframe/identificar/'+videoid+'/" width="100%" height="180px" frameborder="0" scrolling="no"></iframe>';
}

//Mudar posicao .nav conforme scroll
window.onscroll = changePos;
function changePos() {
    var header = document.getElementById("nav");
    var logo = document.getElementById("navlogo");
    var gosto = document.getElementById("gosto");
    if (window.pageYOffset > 100) {
        header.style.position = "fixed";
        header.style.top = "0";
        logo.style.display="block";
        gosto.style.display="none";
        
    } else {
        header.style.position = "";
        header.style.top = "";
        logo.style.display="none";
        gosto.style.display="block";
    }
}

function isIE () {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}
if((isIE()<11)&&(isIE()>1)){
  alert(isIE());
  alert("Actualize o seu navegador de internet.");
  window.location.href="http://windows.microsoft.com/pt-pt/internet-explorer/download-ie";
}

function vRelacionados(tags,locais,pessoas,videoid) {
    var videos;

    var xmlhttp;
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){ if(xmlhttp.readyState == 4 ){
         if(xmlhttp.status == 200){
             videos='<h2>Videos relacionados</h2>' + xmlhttp.responseText;
             document.getElementById("vrels").innerHTML = videos;
         }
         else{
            videos='<h2>Vi­deos relacionados</h2><p class="sugestao">Não foi possivel obter os videos relacionados</p>';
            document.getElementById("vrels").innerHTML = videos;
         }
    }}

    xmlhttp.open("POST", "/cronjobs/relacionados/", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("tag="+tags+"&locais="+locais+"&pessoas="+pessoas+"&videoid="+videoid);
}