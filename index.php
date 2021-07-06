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
    #fechar { margin: 5px; font-size: 12px; }
  </style>

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
		<br>Texto: <br>
		<textarea id="texto" cols="40" rows="6"></textarea>
		<br><input type="button" id="" value="Publicar" onClick="javascript:salvarNovaNoticia();" />
	</div>
</div>


    <main>
	<input type="hidden" value="<?php echo (!empty($_SESSION['telefone']))? $_SESSION['telefone'] :"off"; ?>" id="loginNumeroTelefoneSessao"/>
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="trending-top mb-30">
								<?php
								$consulta = mysqli_query($con->connect(),"SELECT distinct v.contador contador, n.id id, n.titulo titulo, n.alias alias, n.data data,
								(SELECT nome_arquivo arquivo FROM imagem i where i.id_noticia = n.id and i.tipo = 'N'
                and exibir = 'S'  order by i.id desc limit 1) as arquivo,
								(select j.nome from jornalista j where j.id = n.autor) as nome
								FROM noticia_visita v, noticia n, imagem i
								where n.id = v.id_noticia and i.id_noticia = n.id order by v.contador desc limit 1");
								$id_destaque = "0";
								while ($lista = mysqli_fetch_assoc($consulta)) { 
									$id_destaque .= ",".$lista['id'];
								echo"	
								   <div class='trend-top-img'>
										<img src='upload_pic/resize_".$lista['arquivo']."' alt='' width=700 height=400 >
										<div class='trend-top-cap'>
											<span>".date('h:m d/m/Y', strtotime($lista['data']))." ".$lista['nome']."</span>
											<h2><a href='ler.php?noticia=".$lista['alias']."'>".$lista['titulo']."</a></h2>
										</div>
									</div>";
								}?>

                        </div>
                        <div class="trending-bottom">
                            <div class="row">
								<?php

								$consulta = mysqli_query($con->connect(),"select t.*, (SELECT sum(v.contador) contador
								FROM noticia_visita v, noticia n
								where n.id = t.id and n.id = v.id_noticia) as contador, (select nome_arquivo
								from imagem i where i.id_noticia = t.id  and exibir = 'S'  order by id desc limit 1) arquivo
								FROM  noticia t  where t.id not in(".$id_destaque.")  order by contador desc limit 50");
								$i = 0;
								while ($lista = mysqli_fetch_assoc($consulta)) {
									if(!empty($lista['arquivo'])){
											if($i < 3){
											$id_destaque .= ",".$lista['id'];
											echo"	<div class='col-lg-4'>
											<div class='single-bottom mb-35'>
												<div class='trend-bottom-img mb-30'>
													<img src='upload_pic/thumbnail_".$lista['arquivo']."' width=250 height=180>
												</div>
												<div class='trend-bottom-cap'>
												   <h4><a href='ler.php?noticia=".$lista['alias']."'>".$lista['titulo']."</a></h4>
												</div>
											</div>
										</div>";
										$i++;
											}
										}
										
									}
								?>
                            </div>
                        </div>

						<div >
						
					
						
						<?php
								$consulta = mysqli_query($con->connect(),"select n.*, 
								(SELECT nome_arquivo arquivo FROM imagem i where i.id_noticia = n.id and i.tipo = 'N'  and exibir = 'S'  order by id desc limit 1) as arquivo,
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
                    <!-- Lado Esquerdo tela - Jornalistas -->
                    <div class="col-lg-4">
						<div id="sombra1" style="display:block">					
							<img class="sombra1" src="imagem/button_nova-noticia.png" onClick="javascript:cadastrarNovaNoticia();" width="280" height="60"/>
						</div>
						<br>
                        <?php
								$consulta = mysqli_query($con->connect(),"select j.*, (SELECT sum(v.contador) contador
								FROM noticia_visita v, noticia n
								where n.id = v.id_noticia
								and autor = j.id ) as contador,
								(SELECT nome_arquivo arquivo FROM imagem i where i.id_noticia = j.id and i.tipo = 'U' and exibir = 'S' order by i.id desc limit 1) as arquivo
								from jornalista j ORDER BY  contador desc");
								while ($lista = mysqli_fetch_assoc($consulta)) { 
									if($lista['arquivo'] != ""){
										echo"<div class='trand-right-single d-flex'>
										<div class='trand-right-img'>
											<a href='jornalista.php?jornalista=".$lista['id']."'><img src='upload_pic/thumbnail_".$lista['arquivo']."' alt='' width=100 height=80></a>
										</div>
										<div class='trand-right-cap'>
											<span class='color1'>".$lista['contador']." vizualizações</span>
											<h4><a href='jornalista.php?jornalista=".$lista['id']."'>".$lista['nome']."</a></h4>
										</div>
									</div>";
									}
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