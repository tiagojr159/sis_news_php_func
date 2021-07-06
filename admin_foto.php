<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>IGARASSU NOTICIAS</title>
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
			<link rel="stylesheet" href="css/global.css">
   </head>

   <body>
       
<?php
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';
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







 </head>
 <div id="fundo" class="fundo"></div>
 
<div id="autentica" class="posicao"> 
	<div id="fechar" align=right><a href="javascript:fechar();">FECHAR</a></div> 
	<font size="2" color="black">Autenticar Telefone
	<div id="divzap"  style="padding: 0px 0px 0px 65px; text-align: left;">
		Whatsapp: <br><input id="telefone" type="number" value="81991942138" placeholder="(81) 9 9999 9999" style="float:left;"><input type="button" id="idoknumero" value="OK" onClick="javascript:consultaNumero();" />
	</div>
	<div id="divsenha"  style="display:none;padding: 0px 0px 0px 65px; text-align: left;">
		<br>Senha: <br><input id="senha" type="password"  style="float:left;" value="" placeholder="" ><input type="button" id="idoksenha" value="OK" onClick="javascript:autenticaSenha();">
	</div>
	<br><font size="1" color="black"> Apenas os participantes dos grupos de Whatsapp podem puclicar uma noticia.
</div>

<div id="cadastrarNoticia" class="posicao"> 
	<div id="fechar" align=right><a href="javascript:fechar();">FECHAR</a></div> 
	<div id=""  style="padding: 10px; text-align: left; margin-top: -25px;">
		<font size="2" color="black"><b>Publicar Noticia</b>
		<br>Titulo: <br><input id="titulo" type="texto" size=35 value="" placeholder="">
		<br>Texto: <br><input id="id_noticia" type="hidden" value=''>
		<textarea id="texto" cols="40" rows="6"></textarea>
		<br><input type="button" id="novaNoticia" value="Publicar" onClick="javascript:salvarNovaNoticia();" />
		<input type="button" id="editarNoticia" value="Editar" onClick="javascript:editarNovaNoticia();" />
	</div>
</div>


    <main>
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <div class="row">
                    <div class="col-lg-8">
<div onClick="javascript:cadastrarNovaNoticia();"><b><font color='blue'>Clique aqui para Cadastrar Nova Noticia</font></b></div><br>
					<div style="border: 0px solid;float:left ">
						<?php
							$url = explode("noticia=",$_SERVER["REQUEST_URI"] );
								$consulta = mysqli_query($con->connect(),"select i.*, i.id id, i.exibir exibir, i.nome_arquivo nome_arquivo,
								(select titulo from noticia n where n.id = i.id_noticia) as titulo,
							(select alias from noticia n where n.id = i.id_noticia) alias  
							from imagem i order by id desc limit 50");
								echo"<div style='border: 0px solid;  padding:4px'>
										<div style='border: 1px solid;float:left;width: 480px;background-color: beige;'> Publicação</div>
										<div style='border: 1px solid;float:left; width:38px;background-color: beige;'>Exibir</div>
										</div>";
								while ($lista = mysqli_fetch_assoc($consulta)) { 
								
									echo"<div style='border: 0px solid; float:left; padding:4px'>
										<div style='border: 0px solid;float:left; width:62px'><img src='upload_pic/thumbnail_".$lista['nome_arquivo']."' alt='' width=60> </div>
										<div style='border: 0px solid;float:left; width:120px'>".date('h:m d/m/Y', strtotime($lista['data']))."</div>
										<div style='border: 0px solid;float:left; width:300px'><a href='ler.php?noticia=".$lista['alias']."'><font color='black' size=2>".$lista['titulo'].".</font></a></div>
										
									
										
										<div style='border: 0px solid;float:left; width:40px'> ";
										if($lista['exibir'] == "S"){
											echo "<img src='imagem/status_verde.png' width='16' onClick=\"javascript:estadoImagemNoticia('verde=".$lista['id']."');\"'>";
											
										}else{
											echo"<img src='imagem/status_cinza.png' width='16' onClick=\"javascript:estadoImagemNoticia('verde=".$lista['id']."');\"'>";
										}
										
										if($lista['exibir'] == "N"){
											echo "<img src='imagem/status_vermelho.png' width='16' onClick=\"javascript:estadoImagemNoticia('vermelho=".$lista['id']."');\"'>";
											
										}else{
											echo"<img src='imagem/status_cinza.png' width='16' onClick=\"javascript:estadoImagemNoticia('vermelho=".$lista['id']."');\"'>";
										}
										echo"</div>";
										
										


										echo"
										</div>
										";
										}?>
						  </div>
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