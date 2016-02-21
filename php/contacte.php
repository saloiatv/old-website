<?php include_once("saloia-tv.php"); ?>
<html>
<head>
	<link rel="stylesheet" href="<?php echo $public_url; ?>css/style.css" type="text/css" media="all">
	<meta charset="UTF-8">
	<style>
		html,body{ background: none; padding:0; margin:0; height:400px; }
	</style>
</head>
<body>
<div class="contactar">
	<h2>Contacte-nos</h2>
	<?php if($_POST['mensagem'] AND $_POST['email']){

	}else{ ?>

	<p>Pode contactar a saloia tv através do formulário em baixo ou pode optar pelo o contacto por email através do endereço: <a href="mailto:geral@saloia.tv">geral@saloia.tv</a></p>
	<form action="./" method="post">
		<input type="text" name="nome" placeholder="Nome">
		<input type="text" name="email" placeholder="Email">
		<textarea name="mensagem" placeholder="Mensagem"></textarea>
		<input type="submit" value="Enviar">			
	</form>

	<?php } ?>
</div>
</body>
</html>