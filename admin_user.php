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


	
	
	
	
	
	
	
	
	
	
	
 <div id="fundo" class="fundo"></div>
 
<div id="autentica" class="posicao"> 
	<div id="fechar" align=right><a href="javascript:fechar();">FECHAR</a></div> 
	<font size="2" color="black">Autenticar Telefone
	<div id="divzap"  style="padding: 0px 0px 0px 65px; text-align: left;">
		Whatsapp: <br><input id="telefone" type="number" value="" placeholder="(81) 9 9999 9999" style="float:left;"><input type="button" id="idoknumero" value="OK" onClick="javascript:consultaNumero();" />
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







<div id="dadosNumero" class="posicao"> 
	<div id="fechar" align=right><a href="javascript:fechar();">FECHAR</a></div> 
	<div id="dadosNumeroResultado"></div>
</div>


<div id="dadosNumeroFoto" class="posicao"> 
	<div id="fechar" align=right><a href="javascript:fechar();">FECHAR</a></div> 
	<div style="border: 0px solid;width:250px; text-align:left, padding:20px">
	<font color=black>
	<b>Adicionar Foto</b>
	<br>
	<br>Pode procurar o arquivo no celular ou no Computador
		<form action="upload.php" method="POST" enctype="multipart/form-data">
		<br><input type="file" name="file">
		<input type="hidden" name="action2"  value="user">
		<input type="hi-dden" name="id_noticia_user"  id="id_noticia_user">
		<input type="hidden" name="action" value="fomularioImagem">
		<br><br><input type="submit" value="Adicionar">
		</form>
		</font>
	</div>
		

</div>

<a href="javascript:exibirCadastrarNumero();"><font color='black'>Novo Cadastro<font></a></div>























<style type="text/css">

a.tooltip
	 {
	 border-bottom: 1px dashed #ff5e2f;
	 text-decoration: none;
	 position: relative;
	 color: #ff5e2f;
	 z-index: 24
	 }
  a.tooltip:hover
	 {
	 border-bottom: 1px dashed #7a7a7a;
	 text-decoration: none;
	 color: #7a7a7a;
	 z-index: 25
	 }
  a.tooltip span
	 {
	 display: none
	 }
  a.tooltip:hover span
	 {
	 border: 1px solid #f0d070;
	 background-color: #ffffe4;
	 position: absolute;
	 color: #d0a010;
	 display: block;
	 padding: 3px;
	 width: 245px;
	 top:2em;
	 left:0em;
	 }

</style>


    
    
        <script type="text/javascript" src="table/jquery.min.js"></script>
        <script type="text/javascript">
            ddsmoothmenu.init({
                mainmenuid: "templatemo_menu", 
                orientation: 'h',
                classname: 'ddsmoothmenu',

                contentsource: "markup" 
            })
        </script> 
        
        <style type="text/css" title="currentStyle">
            @import "table/css/demo_page.css";
            @import "table/css/demo_table.css";
        </style>


        <script type="text/javascript" charset="utf-8" src="table/js/jquery.dataTables.min.js"></script> 
        <style type="text/css" title="currentStyle">
            @import "table/css/demo_page.css";
            @import "table/css/demo_table.css";

        </style>
        <script type="text/javascript" charset="utf-8">
            $(document).ready( function () {
                $('#example').dataTable( {
                    "sDom": 'C<"clear">lfrtip'
                } );
            } );
        </script>

    </head>

	
	


		 <script language= 'javascript'>
		<!--
		function aviso(id,tela){
		if(confirm (' Deseja realmente excluir? '))
		{
		window.alert(' Continuando.. ');
		location.href="excluir.php?id="+id+"&tela="+tela;
		}
		else
		{
		return false;
		}
		}
		//-->
		</script>






<div style='border: 0px solid; padding:20px'>
            <table cellpadding="0" width="80%" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                      <th>Numero</th>
                      <th>Nome</th>
                      <th>Opção</th>
                    </tr>
                </thead>
                <tbody>
 			<?php
				$consulta = mysqli_query($con->connect(),"SELECT j.*, 
				(SELECT nome_arquivo arquivo FROM imagem i where i.id_noticia = j.id and i.tipo = 'U' limit 1) as arquivo 
				FROM jornalista j"); 
				while ($campo = mysqli_fetch_array($consulta)) { 
					echo"		
						<tr>
                        <th><div style='color:black;' class='estiloLink' onClick=\"javascript:exibirDadosNumero('".$campo['id']."');\" >".$campo['telefone']."</div></th>
						<th>".$campo['nome']."</th>
                        <th>";
						if(empty($campo['arquivo'])){
							echo"<img src='imagem/icone_camara.jpg'  onClick=\"javascript:exibirAdicionarFoto('".$campo['id']."');\" title='Adicionar foto' width=20>";
						}else{
							echo"<img src='imagem/icone_camara_verde.jpg'  onClick=\"javascript:exibirAdicionarFoto('".$campo['id']."');\" title='Adicionar foto' width=20>";
						}
					echo "<img src='imagem/botao_editar.png'  onClick=\"javascript:exibirDadosNumero('".$campo['id']."');\" title='Editar Cadastro' width=35>
						</th>
                       </tr>";
					} ?>							
                </tbody>
            </table>
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