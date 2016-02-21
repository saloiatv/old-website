<?php

require_once 'google/appengine/api/mail/Message.php';
use google\appengine\api\mail\Message;

include("../php/urlfunctions.php");

?>
<html>
<head>
<link rel="stylesheet" href="<?php echo $public_url; ?>files/style.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo $public_url; ?>files/fonts.css" type="text/css" media="all">

<meta charset="UTF-8">
<style>
html,body{ background: none; padding:0; margin:0; height:400px; }
</style>
</head>
<body>
<div class="contactar">
	<?php if($_POST['facebook']){

		$mail_options = [
		    "sender" => 'contactorapidosaloiatv@gmail.com',
		    "to" => "tvsaloia@gmail.com",
		    "subject" => $_POST['nome']." pediu para ser identificado num video",
		    "textBody" => $_POST['nome']." pediu para ser identificado neste video: https://www.youtube.com/edit?o=U&video_id=".PublicKeytoID($browser_url[3])."\nLink do facebook da pessoa: ".$_POST['facebook']."\n\nNOTAS ADICIONAIS:\n".$_POST['mensagem']."\n",
		];

		try{
			$message = new Message($mail_options);
			$message->send();
			echo "<p>Pedido enviado com sucesso!</p>";
		} 
		catch (InvalidArgumentException $e){ 
			echo '<p>Erro ao enviar o pedido, por favor preencha todos os campos do formulário. Se o erro persistir, pode enviar um email para <a href="mailto:geral@saloia.tv">geral@saloia.tv</a></p>';
		}
	}else{ ?>

	<p style="margin-bottom:10px;">Preencha este formulário para ser identificado neste video.</p>
	<form action="./" method="post">
		<input style="width:30%; float:left; margin-right:4%;" type="text" name="nome" placeholder="O seu nome">
		<input style="width:65%; float:left;" type="text" name="facebook" placeholder="Link do seu facebook">
		<input style="width:99%;" type="text" name="mensagem" placeholder="Notas adicionais">
		<input style="margin-top:0px; width:114px; padding-left:0px;" type="submit" value="Enviar pedido">			
	</form>

	<?php } ?>
</div>
</body>
</html>