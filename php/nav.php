
<nav id="nav">
	<a class="logo" id="navlogo" href="http://saloia.tv"><img src="http://saloia.tv/files/logotipo.png"></a>
	<select onchange="window.location.href = this.value" id="mobilemenu">
		<option value="<?php echo $public_url; ?>">Home</option>
		<option id="opcaodesporto" value="<?php echo $public_url; ?>eventos">Eventos</option>
		<option id="opcaodesporto" value="<?php echo $public_url; ?>desporto">Desporto</option>
		<option id="opcaopolitica" value="<?php echo $public_url; ?>politica">Política</option>
		<option id="opcaoopiniao" value="<?php echo $public_url; ?>opiniao">Opinião</option>
		<option id="opcaosocial" value="<?php echo $public_url; ?>social">Social</option>
		<option id="opcaocultura" value="<?php echo $public_url; ?>cultura">Cultura</option>
		<option id="opcaohistoria" value="<?php echo $public_url; ?>historia">História</option>
		<option id="opcaoentrevistas" value="<?php echo $public_url; ?>entrevistas">Entrevistas</option>
		<option id="opcaoautarquias" value="<?php echo $public_url; ?>autarquias">Autarquias</option>
	</select>
	<ul>
		<li id="navgosto"><a href="http://facebook.com/255556074565169"><img src="/images/gosto.jpg"/></a></li>
		<li id="botaoeventos" ><a href="<?php echo $public_url; ?>eventos">Eventos</a></li>
		<li id="botaodesporto" ><a href="<?php echo $public_url; ?>desporto">Desporto</a></li>
		<li id="botaopolitica" ><a href="<?php echo $public_url; ?>politica">Política</a></li>
		<li id="botaoopiniao" ><a href="<?php echo $public_url; ?>opiniao">Opinião</a></li>
		<li id="botaosocial" ><a href="<?php echo $public_url; ?>social">Social</a></li>
		<li id="botaocultura" ><a href="<?php echo $public_url; ?>cultura">Cultura</a></li>
		<li id="botaohistoria" ><a href="<?php echo $public_url; ?>historia">História</a></li>
		<li id="botaoentrevistas" ><a href="<?php echo $public_url; ?>entrevistas">Entrevistas</a></li>			
		<li id="botaoautarquias" ><a href="<?php echo $public_url; ?>autarquias">Autarquias</a></li>	
	</ul>
	<?php if($navsearch){ ?>
	<a onclick="procurar();" class="search" href="javascript:;"><i class="icon-search"></i></a>
	<form id="actionsearch" onsubmit="return procurar();"><input type="text" placeholder="Procurar" value="" name="search" id="search" style="display:none;"></form>
	<?php } ?>
</nav>