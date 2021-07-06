<html >
    <head>
        <meta charset="utf-8">
        <title>Igarassu Noticias - Agência </title>
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/style.css">
   </head>
<?php
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';
$con = new conexao();
$con->connect();
include_once 'restrict.php';
?>
   <body>
    <header>
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block">
                   <div class="container">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                <font color="white">Administrador de Noticias</font>
                                </div>
                                <div class="header-info-right"><font color="white"> 
								    <font color="red"><?php echo $_SESSION['nome'];?></font> | 
                                    <a href="admin_noticia.php" class="estiloLink"><font color="white">Notícia</font></a> | 
									<a href="admin_user.php"><font color="white">Números</font></a> |  
									<a href="admin_logs.php"><font color="white">Logs</font></a> | 
									<a href="admin_denuncia.php"><font color="white">Denúncias</font></a> |
									<a href="admin_foto.php"><font color="white">Fotos</font></a> |
									<a href="logoout.php"><font color="white">Sair</font></a> 

									</font>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo">
                                    <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right ">
                                    <img src="assets/img/hero/header_card.jpg" alt="">
                                </div>
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
	
	
	estiloLink:hover, h1:hover, a:hover {
	  background-color: red;
	  estiloLink
	}
	
	
	.div_sem_css{ border: block;     height: 18px;    line-height: 16px; }
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
								$consulta = mysqli_query($con->connect(),"SELECT n.veracidade veracidade, n.estado estado, n.data data, n.id id, n.titulo titulo, n.alias alias, n.data data_noticia, (select sum(contador) as contador from noticia_visita v where v.id_noticia = n.id) as contador
																			FROM  noticia n
																			 order by data_noticia desc limit 50;");
								echo"<div style='border: 0px solid;  padding:4px'>
										<div style='border: 1px solid;float:left;width: 420px;background-color: beige;'> Publicação</div>
										<div style='border: 1px solid;float:left; width:55px;background-color: beige;'>Verdade</div>
										<div style='border: 1px solid;float:left; width:38px;background-color: beige;'>Exibir</div>
										<div style='border: 1px solid;float:left; width:38px;background-color: beige;'>Visitas</div>
										</div>";
								while ($lista = mysqli_fetch_assoc($consulta)) { 
								
									echo"<div style='border: 0px solid; float:left; padding:4px'>
										<div style='border: 0px solid;float:left; width:120px'>".date('h:m d/m/Y', strtotime($lista['data']))."</div>
										<div style='border: 0px solid;float:left; width:300px'><a href='ler.php?noticia=".$lista['alias']."'><font color='black' size=2>".$lista['titulo']."</font></a></div>
										
										<div style='border: 0px solid;float:left; width:55px'> ";
										if($lista['veracidade'] == "V"){
											echo "<img src='imagem/status_verde.png' width='16' onClick=\"javascript:statusNoticia('verde=".$lista['id']."');\"'>";
											
										}else{
											echo"<img src='imagem/status_cinza.png' width='16' onClick=\"javascript:statusNoticia('verde=".$lista['id']."');\"'>";
										}
										
										if($lista['veracidade'] == "N"){
											echo "<img src='imagem/status_amarelo.png' width='16' onClick=\"javascript:statusNoticia('verde=".$lista['id']."');\"'>";
											
										}else{
											echo"<img src='imagem/status_cinza.png' width='16' onClick=\"javascript:statusNoticia('amarelo=".$lista['id']."');\"'>";
										}
										
										if($lista['veracidade'] == "F"){
											echo "<img src='imagem/status_vermelho.png' width='16' onClick=\"javascript:statusNoticia('verde=".$lista['id']."');\"'>";
											
										}else{
											echo"<img src='imagem/status_cinza.png' width='16' onClick=\"javascript:statusNoticia('vermelho=".$lista['id']."');\"'>";
										}
										echo"</div>
										
										<div style='border: 0px solid;float:left; width:40px'> ";
										if($lista['estado'] == "S"){
											echo "<img src='imagem/status_verde.png' width='16' onClick=\"javascript:estadoNoticia('verde=".$lista['id']."');\"'>";
											
										}else{
											echo"<img src='imagem/status_cinza.png' width='16' onClick=\"javascript:estadoNoticia('verde=".$lista['id']."');\"'>";
										}
										
										if($lista['estado'] == "N"){
											echo "<img src='imagem/status_vermelho.png' width='16' onClick=\"javascript:estadoNoticia('vermelho=".$lista['id']."');\"'>";
											
										}else{
											echo"<img src='imagem/status_cinza.png' width='16' onClick=\"javascript:estadoNoticia('vermelho=".$lista['id']."');\"'>";
										}
										echo"</div>";
										echo"<div style='border: 0px solid;float:left; width:35px'><font color='black' size=2>".($lista['contador']+0)."</font></div>";
										echo"<div style='border: 0px solid;float:left; width:40px'> ";
										echo"<img src='imagem/botao_editar.png' width='40' onClick=\"javascript:editarNoticia('".$lista['id']."');\"'>";
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
        <script src="./assets/js/main.js"></script>
        <script src="./assets/js/custom.js"></script>
        
    </body>
</html>