<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>News HTML-5 Template </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

		<!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/ticker-style.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
   </head>

   <body>
       
<?php
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';
@session_start();

$con = new conexao();
$con->connect();?>
    <header>
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block">
                   <div class="container">
                       <div class="col-xl-12">
                            <div class="row d-flex">
                                <div class="header-info-left">
                                    <ul>     
                                        <li><img src="assets/img/icon/header_icon1.png" alt="">
										<?php   date_default_timezone_set('America/Sao_Paulo');
										$json_file = file_get_contents("https://api.hgbrasil.com/weather?woeid=457287");
										$json_str = json_decode($json_file, true);
										echo $json_str['results']['temp']."ºc"." - ".$json_str['results']['forecast'][0]['description'];
									 echo " - ".date('d/m/Y h:m');
										?>  </li>
                                    </ul>
                                </div>
								<div class="trending-animated" style="width:600px; margin-left:20px;height:10px; float:left">
									<ul id="js-news" class="js-hidden" style="width:450px;background-color:black; color:white">
									<?php
									$consulta = mysqli_query($con->connect(),"SELECT n.veracidade veracidade, n.estado estado, n.data data, n.id id, n.titulo titulo, n.alias alias, n.data data_noticia, (select sum(contador) as contador from noticia_visita v where v.id_noticia = n.id) as contador
																			FROM  noticia n
																			 order by data_noticia desc limit 5;");
									$id_destaque = "0";
									while ($lista = mysqli_fetch_assoc($consulta)) { 
										$id_destaque .= ",".$lista['id'];
										echo"<li class='news-item' style='width:400px;background-color:black; color:white'><a href='ler.php?noticia=".$lista['alias']."'>".$lista['titulo']."</a></li>";
									}?>
									</ul>
								</div>
								<a href="admin_noticia.php" style="float:right"><font color="white">Admin</font></a>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo">
                                    <a href="index.php"><img src="imagem/logoh.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right ">
                                    <img src="imagem/logoh.png" alt="">
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
				<div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                    <div class="sticky-logo">
                                        <a href="index.html"> <img src="imagem/logoh.png" alt=""></a>
                                    </div>
                            </div>             
                        </div>
                    </div>
               </div>
            </div>
       </div>
    </header>








		
  <style type="text/css">
    body {background-color: #fff; font-family: Tahoma,Arial;}
    .posicao {
        position: fixed;
        left: 50%; 
        top: 50%;
        width: 300px; 
        height: 250px;
        margin-left: -150px;
        margin-top: -125px;
        background-color: #FFF;
        color: #FFF;
        background-color: #ccc;
        text-align: center; 
        z-index: 1000;
		flex-direction: row;
        justify-content: center;
        align-items: center;
		display: none;
    }
	#fundo {
	  opacity: 0.8;
	  background-color: #000;
	  position: fixed;
	  width: 100%;
	  height: 100%;
	  z-index: 98;
	  top: 0;
	  left: 0;
	  display: none;
	}
    #fechar { margin: 5px; font-size: 12px; 
	}
	
	.arquivo {
	  display: none;
	}
	.file {
	  line-height: 30px;
	  height: 30px;
	  border: 1px solid #A7A7A7;
	  padding: 5px;
	  box-sizing: border-box;
	  font-size: 15px;
	  vertical-align: middle;
	  width: 300px;
	}
	.btn {
	  border: none;
	  box-sizing: border-box;
	  padding: 2px 10px;
	 /* background-color: #4493c7;*/
	  color: #FFF;
	  height: 32px;
	  font-size: 15px;
	  vertical-align: middle;
	}
	.btn2 {
	  border: none;
	  box-sizing: border-box;
	  padding: 2px 10px;
	  background-color: #4493c7;
	  color: #FFF;
	  height: 32px;
	  font-size: 15px;
	  vertical-align: middle;
	}
  </style>

 </head>

 <div id="fundo" class="fundo"></div>
 
 
<div id="autentica" class="posicao"> 
	<div id="fechar" align=right><a href="javascript:fechar();">FECHAR</a></div> 
	<font size="2" color="black">Autenticar Telefone
	<div id="divzap"  style="padding: 0px 0px 0px 65px; text-align: left;">
		Whatsapp: <br><input id="telefone" type="number" value="" placeholder="(81) 9 9999 9999" style="float:left;"><input type="button" id="idoknumero" value="Acessar" onClick="javascript:consultaNumero();" />
	</div>
	<div id="divsenha"  style="display:none;padding: 0px 0px 0px 65px; text-align: left;">
		<br><br>Senha: <br><input id="senha" type="password"  style="float:left;" value="" placeholder="" ><input type="button" id="idoksenha" value="Acessar" onClick="javascript:autenticaSenha();">
	</div>
	<br><font size="1" color="black"> Apenas os participantes dos grupos de Whatsapp podem puclicar uma noticiaou fazer um comentário.
</div>
 			

<div id="cadastrarNoticia" class="posicao"> 
	<div id="fechar" align=right><a href="javascript:fechar();">FECHAR</a></div> 
	<div id=""  style="padding: 10px; text-align: left; margin-top: -25px;">
		<font size="2" color="black"><b>Publicar Noticia</b>
		<br>Titulo: <br><input id="titulo" type="texto" size=35 value="" placeholder="">
		<br>Texto: <br>
		<textarea id="texto" cols="40" rows="6" maxlength="1500"></textarea>
		<br><input type="button" id="" value="Publicar" onClick="javascript:salvarNovaNoticia();" style="background: red; color: white;"/>
	</div>
</div>


<div id="denuciarNoticia" class="posicao"> 
	<div id="fechar" align=right><a href="javascript:fecharDenunciaNoticia();">FECHAR</a></div> 
	<div id=""  style="padding: 10px; text-align: left; margin-top: -25px;">
		<font size="2" color="black"><b>Denunciar Noticia</b>
		<input id="idPublicacaoDenunciaNoticia"  type="hidden" >
		<br>Telefone: <br><input id="numeroDenunciaNoticia"  type="number" value="" placeholder="(81) 9 9999 9999" size=35 >
		<br>Texto: <br>
		<textarea id="textoDenunciaNoticia" cols="40" rows="6" maxlength="1500"></textarea>
		<br><input type="button" id="" value="Publicar" onClick="javascript:salvarDenunciaNoticia();" />
	</div>
</div>

<div id="denuciarComentario" class="posicao"> 
	<div id="fechar" align=right><a href="javascript:fecharDenunciaComentario();">FECHAR</a></div> 
	<div id=""  style="padding: 10px; text-align: left; margin-top: -25px;">
		<font size="2" color="black"><b>Denunciar Comentário</b>
		<input id="idPublicacaoDenunciaComentario"  type="hidden" >
		<br>Telefone: <br><input id="numeroDenunciaComentario"  type="number" value="" placeholder="(81) 9 9999 9999" size=35 >
		<br>Texto: <br>
		<textarea id="textoDenunciaComentario" cols="40" rows="6" maxlength="1500"></textarea>
		<br><input type="button" id="" value="Publicar" onClick="javascript:salvarDenunciaComentario();" style="background: red; color: white;" />
	</div>
</div>







    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <div class="row">
                    <div class="col-lg-8">
						<?php
							$url = explode("noticia=",$_SERVER["REQUEST_URI"] );
								$consulta = mysqli_query($con->connect(),"SELECT n.id as id, n.texto as texto, n.titulo as titulo, n.alias as alias, n.autor as autor, n.data as data,
								n.veracidade as veracidade, n.estado as estado, n.positivo as positivo, n.negativo as negativo, j.nome as nome, j.telefone as telefone
								FROM noticia n, jornalista j where j.id = n.autor and  alias='".$url[1]."' order by data");
								$id_noticia = 0;
								while ($lista = mysqli_fetch_assoc($consulta)) { 
								$positivo = $lista['positivo'];
								$negativo = $lista['negativo'];
								$jornalista = $lista['nome'];
								$telefone = $lista['telefone'];
								$data_noticia = $lista['data'];
								$id_noticia = $lista['id'];
									echo"<div class='trand-right-single d-flex'>
									<div class='trand-right-cap'>
										<span class='color1'>".date('h:m d/m/Y', strtotime($lista['data']))."</span>
										<h4>".$lista['titulo']."</h4>
										<br><font color='black' size=2>".$lista['texto']."</font>
									</div>
								</div>";
								}?>
							<center>
							<?php
								$consulta = mysqli_query($con->connect(),"
								select * from imagem i where i.id_noticia = ".$id_noticia." and tipo = 'N' and exibir = 'S' order by i.id desc limit 10
								");
								while ($lista = mysqli_fetch_assoc($consulta)) { 
							echo"<div class='trand-right-single d-flex'>
									<div class='trand-right-cap'>
										<img src='upload_pic/resize_".$lista['nome_arquivo']."' alt='' width=600>
									</div>
								</div>";
								}?>
								</center>
								<?php 
							$consultaCont = mysqli_query($con->connect(),"select * from noticia_visita where id_noticia = ".$id_noticia." and data = '".date('Y/m/d')."' order by data");
							$consultaContador = mysqli_fetch_assoc($consultaCont);
							if(empty($consultaContador)){
								$crud = new crud('noticia_visita'); 
								$crud->inserir("id_noticia,data,contador",
								"$id_noticia,'".date('Y/m/d')."',1"); 
							}else{
								$contador = $consultaContador['contador'] + 1;
								$id = $consultaContador['id'];
								$crud = new crud('noticia_visita'); 
								$crud->atualizar(" contador='$contador'     ", "id='$id'"); // 
							}
							?>
								
<div class='trand-right-single d-flex'>
	<div class='trand-right-cap'>
	 <?php echo date('h:m d/m/Y', strtotime($data_noticia)) ;?>,  Jornalista: <?php echo $jornalista;?>, <?php echo $consultaContador['contador']." vizualizações.";?> <a href="#" onClick="javascript:denunciarNoticia( <?php echo $id_noticia;?>)"><img src="imagem/sirene.png"  width="22" title="DENUNCIAR NOTÍCIA"></a>
		<div style="border: 0px solid;width:120px;">
		<font color="green"><div id="resultadoPositivo" style="float:left"><?php echo $positivo;?></div></font>
			<div style="float:left;">
				<a href="#" id='cliquePositivo' onClick="javascript:contarVotoNoticia('positivo',<?php echo $id_noticia;?>)" ><img src="imagem/positivo.jpg" title="CONCORDO" width="25"></a>
				<a href="#" id='cliqueNegativo' onClick="javascript:contarVotoNoticia('negativo',<?php echo $id_noticia;?>)" ><img src="imagem/negativo.jpg" title="DISCORDO" width="25"></a>
			</div>
		<font color="red"><div id="resultadoNegativo" style="float:left"><?php echo $negativo;?></div></font>
		</div>								
	</div>									
</div>									
								
<div class='trand-right-single d-flex'>
	<div class='trand-right-cap'>
		<div style="border: 0px solid;width:350px;">
		<h5>Comentários</h5>
		<input type="hidden" value="<?php echo (!empty($_SESSION['telefone']))? $_SESSION['telefone'] :"off"; ?>" id="loginNumeroTelefoneSessao"/>

		<?php
			$consulta = mysqli_query($con->connect(),"select c.texto as texto, c.positivo as positivo, 
			c.negativo as negativo, c.id as id, j.nome as nome, j.telefone as telefone, c.data as data
			from comentario c, jornalista j
			 where c.id_publicacao = ".$id_noticia." and j.id = c.id_autor and c.tipo = 'N' and c.exibir = 'S' 
			 order by c.id asc limit 10");
			$i = 0;
			while ($lista = mysqli_fetch_assoc($consulta)) { 
			$positivo = $lista['positivo'];
			$negativo = $lista['negativo'];
			$telefone = $lista['telefone'];
			$data_comentario = $lista['data'];
			$nome = $lista['nome'];
			$id_comentario = $lista['id'];
			echo"<br><b>".$lista['texto']."</b><br>";?>
			<div style="border: 0px solid;width:420px;">
			<font color="green"><div id="resultadoPositivo<?php echo $i;?>" style="float:left"><?php echo $positivo;?></div></font>
				<div style="float:left;">
					<a href="#" id='cliquePositivo<?php echo $i;?>' onClick="javascript:contarVotoComentario('positivo',<?php echo $id_comentario;?>, <?php echo $i;?>)" ><img src="imagem/positivo.jpg" title="CONCORDO" width="15"></a>
					<a href="#" id='cliqueNegativo<?php echo $i;?>' onClick="javascript:contarVotoComentario('negativo',<?php echo $id_comentario;?>, <?php echo $i;?>)" ><img src="imagem/negativo.jpg" title="DISCORDO" width="15"></a>
				</div>
			<font color="red"><div id="resultadoNegativo<?php echo $i;?>" style="float:left"><?php echo $negativo;?></div></font>
			     &nbsp;&nbsp;&nbsp;&nbsp; XX XXXX <?php echo substr($telefone, -4); ?>, <?php echo date('h:m d/m/Y', strtotime($data_comentario)) ;?>
			<a href="#" onClick="javascript:denunciarComentario(<?php echo $id_comentario;?>)"><img src="imagem/sirene.png"  width="15" title="DENUNCIAR COMENTÁRIO"></a>
			</div>	
		<br>	
		<?php	$i++; 
		}?>
		<br>
		<div id="textoComentarioDiv"> </div>
		<input value="<?php echo $id_noticia;?>" type="hidden"  id="id_noticia">
		<input type="text" size="40" placeholder="Escreva até 250 letras" maxlength="254" id="textoComentario">
		<input type="submit" value="enviar" onClick="javascript:textoComentarioNoticia();" id="">
		</div>	
	</div>
</div>



						

						
						
<div class='trand-right-single d-flex'>
	<div class='trand-right-cap'>					
	<link rel="stylesheet" type="text/css" href="css/global.css">	
	<?php 
		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
		$symbian = strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
		$windowsphone = strpos($_SERVER['HTTP_USER_AGENT'],"Windows Phone");

	if (!($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian || $windowsphone == true)) { ?>

	<div style="border: 0px solid;width:250px;">
	<div class="dropzone" id="dropzone">Arraste uma foto aqui para adicionar a notícia.</div>
	</div>
	 
	<?php }else { ?>
	 <div style="border: 0px solid;width:250px;">
	 Adicione uma foto a noticia
			<form action="upload.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="file" class="btn">
			<input type="hidden" name="id_noticia_user" value="<?php echo $id_noticia;?>">
			<input type="hidden" name="action" value="fomularioImagem">
			<br><input type="submit" value="Enviar"  class="btn">
			</form>
		</div>
	<?php } ?>
	</div>
</div>	
		


		<script>
			(function(){
				var dropzone = document.getElementById('dropzone');
				var displayUploads = function(data){
					var uploads = document.getElementById('uploads'),
					anchor,
					x;
					for(x = 0; x < data.length; x++){
						anchor=document.createElement('a');
						anchor.href = data[x].file;
						anchor.innerText = data[x].name;
						uploads.appendChild(anchor);
					}
				}
				var upload = function(files){
					var formData = new FormData(),
					xhr = new XMLHttpRequest(),
					x;

					for(x = 0; x<files.length; x++){
						formData.append('file[]',files[x]);
						formData.append('file[]',files[x].naturalWidth);
						formData.append('id_noticia_user','<?php echo $id_noticia;?>');
					}
					xhr.onload = function(){
						var data = JSON.parse(this.responseText);
						console.log(data);
						displayUploads(data);
					}
					xhr.open('post','upload.php');
					xhr.send(formData);
					alert('A imagem subiu com sucesso!');
				}
				dropzone.ondrop = function(e){
					e.preventDefault();
					this.className ="dropzone";
					upload(e.dataTransfer.files);
				}
				dropzone.ondragover = function(){
					this.className = 'dropzone dragover';
					return false;
				}
				dropzone.ondragleave = function(){
					this.className = 'dropzone';
					return false;
				}
			}());
		</script>

	
	
	
	


                    </div>


                    <div class="col-lg-4">
						<div id="sombra1" style="display:block;text-align: center;">					
							<img class="sombra1" src="imagem/button_nova-noticia.png" onClick="javascript:cadastrarNovaNoticia();" width="280" height="60"/>
						</div>
						<br>
						<?php
								$consulta = mysqli_query($con->connect(),"select n.*, 
								(SELECT nome_arquivo arquivo FROM imagem i where i.id_noticia = n.id and i.tipo = 'N' and exibir='S' order by id desc limit 1) as arquivo,
								(select j.nome from jornalista j where j.id = n.autor) as nome
								from noticia n where id not in (".$id_destaque.")order by data desc limit 20 ");
								while ($lista = mysqli_fetch_assoc($consulta)) { 
									$img = "";
									if(!empty($lista['arquivo'])){
									$img = "<div class='trand-right-img'>
										<img src='upload_pic/thumbnail_".$lista['arquivo']."' alt='' width=100 height=80>
									</div>";
									}
									echo"<div class='trand-right-single d-flex'>
									".$img."
									<div class='trand-right-cap'>
										<h4><a href='ler.php?noticia=".$lista['alias']."'>".strtoupper($lista['titulo'])."</a></h4>
										<span class='color1'>".date('h:m d/m/Y', strtotime($lista['data']))." - ".$lista['nome']."</span>
									</div>
								</div>";
								}
							?>
						
						
                    </div>
                </div>
            </div>
        </div>
    </div>
   
   
   
   
<footer>
 <div class="footer-bottom-area">
           <div class="container">
               <div class="footer-border">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-lg-6">
                            <div class="footer-copy-right">
                                <p>CNI - Central de Noticias de Igarassu</p>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
       </div>
   </footer>

		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/jquery.slicknav.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>
        <script src="./assets/js/gijgo.min.js"></script>
        <script src="./assets/js/main.js"></script>
        <script src="./assets/js/custom.js"></script>
        <script src="./assets/js/jquery.ticker.js"></script>
        <script src="./assets/js/site.js"></script>
		</body>
</html>