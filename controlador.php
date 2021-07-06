<?php
/*
 *   Ofereço a Deus todos esses código que escrevi como fruto do 
 * meu trabalho e por intercessão de São Isodoro de Servilha e 
 * São Jose  Maria Escrivá esses sistema nunca seja usado para o mau 
 * ou desagrado do nosso senhor Jesus Cristo. Amém.  
 * 
 * Tiago Junior - 31/08/2014
 */
//include 'restrict.php';
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';

$con = new conexao(); 
$con->connect(); 
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:m:s');



if($_GET['action'] == "autentica_numero"){
	@session_start();
	$numero = $_GET['telefone'];
	$consulta = mysqli_query($con->connect(),"select * from jornalista where telefone = ".$numero."");
	$campo = mysqli_fetch_array($consulta);
	
	if(empty($campo['telefone'])){
		echo"naocadastrado";
		exit;
	}
	if(!empty($campo['senha'])){
		echo"existesenha";
		exit;
	}
	if(!empty($campo['telefone'])){
        $_SESSION['telefone'] = $campo['telefone'];
        $_SESSION['situacao'] = $campo['situacao'];
		$_SESSION['id_autor'] = $campo['id'];
		echo"autenticadoTelefone";
		exit;
	}
}


if($_GET['action'] == "autentica_senha"){
	@session_start();
	$numero = $_GET['telefone'];
	$senha = $_GET['senha'];
	$consulta = mysqli_query($con->connect(),"select * from jornalista where telefone = ".$numero." and senha = '".$senha."' and situacao not in ('BK')");
	$campo = mysqli_fetch_array($consulta);
	if(!empty($campo['senha'])){
		$_SESSION['nome'] = $campo['nome'];
		$_SESSION['telefone'] = $campo['telefone'];
		$_SESSION['id_autor'] = $campo['id'];
        $_SESSION['situacao'] = $campo['situacao'];
		echo"autenticado";
	}else{
		echo"naoautenticado";
	}	
}

if($_GET['action'] == "login"){
	@session_start();
	if(!empty($_SESSION['nome'])){
		echo"loginok";
	}else{
		echo"loginfalse";
	}
}

if($_GET['action'] == "cadastrar_noticia"){
	@session_start();
	$texto = $_GET['texto'];
	$titulo = $_GET['titulo'];
	$id_autor = $_SESSION['id_autor'];
	$alias = sanitizeString($data."-".$titulo);
	$crud = new crud('noticia'); 
    $crud->inserir("titulo,texto,data,autor,alias,veracidade,estado", "'$titulo','$texto','$data','$id_autor','$alias','N','S'"); 
	echo"publicado";
}

if($_GET['action'] == "atualizar_status_noticia"){
	$id = $_GET['id_noticia'];
	$status = 'V';
	if($_GET['status'] == 'amarelo'){
		$status = 'N';
	}
	if($_GET['status'] == 'vermelho'){
		$status = 'F';
	}
		$crud = new crud('noticia'); 
		$crud->atualizar("veracidade='$status'", "id=$id"); 
	echo"publicado";
}


if($_GET['action'] == "atualizar_estado_noticia"){
	$id = $_GET['id_noticia'];
	$status = 'S';
	if($_GET['status'] == 'vermelho'){
		$status = 'N';
	}
		$crud = new crud('noticia'); 
		$crud->atualizar("estado='$status'", "id=$id"); 
	echo"publicado";
}

if($_GET['action'] == "atualizar_estado_imagem_noticia"){
	$id = $_GET['id_imagem'];
	$status = 'S';
	if($_GET['status'] == 'vermelho'){
		$status = 'N';
	}
		$crud = new crud('imagem'); 
		$crud->atualizar("exibir='$status'", "id=$id"); 
	echo"publicado";
}

if($_GET['action'] == "consultar_noticia"){
	$id_noticia = $_GET['id_noticia'];
	$consulta = mysqli_query($con->connect(),"select * from noticia where id = ".$id_noticia."");
	$campo = mysqli_fetch_array($consulta);
	if(!empty($campo['titulo'])){
		echo $campo['titulo']."===".$campo['texto'];
	}
}
if($_GET['action'] == "editar_noticia"){
	@session_start();
	$texto = $_GET['texto'];
	$titulo = $_GET['titulo'];
	$id_autor = $_SESSION['id_autor'];
	$id_noticia = $_GET['id_noticia'];
	$alias = sanitizeString($data."-".$titulo);
	
	$crud = new crud('noticia'); 
	$crud->atualizar("titulo='$titulo', texto='$texto' ", "id=$id_noticia"); 

	echo"publicado";
}


if($_GET['action'] == "consultar_dados_numero"){
	$id = $_GET['id'];
	$consulta = mysqli_query($con->connect(),"select j.*,  
	(select nome_arquivo from imagem i where i.id_noticia = j.id and tipo = 'U' order by i.id desc limit 1) as arquivo 
	from jornalista j where j.id = ".$id."");
	$campo = mysqli_fetch_array($consulta);
	$situacao = "";
	if($campo['situacao'] == "JA"){
		$situacao = "JORNALISTA";
	}
	if($campo['situacao'] == "BK"){
		$situacao = "BLOQUEADO";
	}
	if($campo['situacao'] == "OT"){
		$situacao = "OUTRO";
	}
	if($campo['situacao'] == "PG"){
		$situacao = "PARTICIPANTE DO GRUPO";
	}
	
	
	echo"<div style='color:black; text-align: left;padding:10px; margin-top:-30px' id='editarTelefoneUser'>";
	echo "<img style='float: right;margin-top: 5px;' src='upload_pic/thumbnail_".$campo['arquivo']."' alt='' width=100 height=100 >";
	echo "<input type='hidden' value='".$campo['id']."' id='id_numero'>";
	echo "Nome:<br><input type='text' value='".$campo['nome']."' id='nome'>";
	echo "<br>Telefone:<br><input type='number'  value='".$campo['telefone']."' id='telefoneUser'>";
	echo "<br>Senha: <br><input type='password'  value='".$campo['senha']."' id='senha'>";
	echo "<br>E-mail:<br><input type='text'  value='".$campo['email']."' id='email'>";
	echo "<br>Situação:
	<br>
	<select id='situacaoUser' onChange=\"javascrip:situacaoUsuario();\">
	<option value='".$campo['situacao']."'>".$situacao."</option>
	<option value='JA'>JORNALISTA</option>
	<option value='PG'>PARTICIPANTE DO GRUPO</option>
	<option value='BK'>BLOQUEADO</option>
	<option value='OT'>OUTRO</option>
	</select>
	";
	
	echo "<div style='display:none' id='comentarioSituacao'>Comentario<br><textarea id='comentarioSituacaoText' rows=1></textarea></div>";
	echo "<input type='button' style='float: right;margin-top: -44px;' onClick=\"javascript:editarJornalista();\" value='Editar'>";
	echo"</div>";
}


if($_GET['action'] == "cadastrar_dados_numero"){

	echo"<div style='color:black; text-align: left;padding:10px; margin-top:-30px' id='cadastrarTelefoneUser'>";
	echo "Nome:<br><input type='text' value='' id='nome'>";
	echo "<br>Telefone:<br><input type='number' placeholder='(81) 9 9999 9999' value='' id='telefoneUser'>";
	echo "<br>Senha: <br><input type='password'  value='' id='senha'>";
	echo "<br>E-mail:<br><input type='text'  value='' id='email'>";
	echo "<br>Situação:
	<br>
	<select id='situacaoUser' onChange=\"javascrip:situacaoUsuario();\">
	<option value='JA'>JORNALISTA</option>
	<option value='PG' selected>PARTICIPANTE DO GRUPO</option>
	<option value='BK'>BLOQUEADO</option>
	<option value='OT'>OUTRO</option>
	</select>
	";
	echo "<div style='display:none' id='comentarioSituacao'>Comentario<br><textarea id='comentarioSituacaoText' rows=1></textarea></div>";
	echo "<input type='button' style='float: right;margin-top: -44px;' onClick=\"javascript:cadastrarJornalista();\" value='Cadastrar'>";
	echo"</div>";
}

if($_GET['action'] == "editar_jornalista"){
	@session_start();
	$telefone = $_GET['telefone'];
	$email = $_GET['email'];
	$senha = $_GET['senha'];
	$situacao = $_GET['situacao'];
	$nome = $_GET['nome'];
	$id = $_GET['id_numero'];
	$comentario = $_GET['comentario'];

	$crud = new crud('jornalista'); 
	$crud->atualizar(" telefone='$telefone', email='$email', senha='$senha', situacao='$situacao', comentario='$comentario', nome='$nome' ", "id=$id"); 
	echo"editado";
}

if($_GET['action'] == "cadastrar_jornalista"){
	@session_start();
	$telefone = $_GET['telefone'];
	$email = $_GET['email'];
	$senha = $_GET['senha'];
	$situacao = $_GET['situacao'];
	$nome = $_GET['nome'];
	$comentario = $_GET['comentario'];
	
	$crud = new crud('jornalista'); 
    $crud->inserir("telefone,email,senha,situacao,comentario,nome", 	"'$telefone','$email','$senha','$situacao','$comentario','$nome'"); 
	echo"publicado";
}


if($_GET['action'] == "salvar_texto_comentario_noticia"){
	@session_start();
	$id_noticia = $_GET['id_noticia'];
	$textoComentario = $_GET['textoComentario'];
	$id_autor = $_SESSION['id_autor'];
	
	$crud = new crud('comentario'); 
    $crud->inserir("texto,id_autor,tipo,exibir,data,id_publicacao", 	"'$textoComentario','$id_autor','N','S','$data','$id_noticia'"); 
	echo"publicado";
}


if($_GET['action'] == "salvarDenunciaNoticia"){
	$id_publicacao = $_GET['id_publicacao'];
	$telefone = $_GET['numero'];
	$comentario = $_GET['texto'];
	$crud = new crud('denuncia'); 
    $crud->inserir("comentario,id_publicacao,tipo,estado,data,telefone", 	"'$comentario','$id_publicacao','NOTICIA','S','$data','$telefone'"); 
	echo"publicado";
}

if($_GET['action'] == "salvarDenunciaComentario"){
	$id_publicacao = $_GET['id_publicacao'];
	$telefone = $_GET['numero'];
	$comentario = $_GET['texto'];
	$crud = new crud('denuncia'); 
    $crud->inserir("comentario,id_publicacao,tipo,estado,data,telefone", 	"'$comentario','$id_publicacao','COMENTARIO','S','$data','$telefone'"); 
	echo"publicado";
}

if($_GET['action'] == "contarVotoNoticia"){
	@session_start();
	$voto = $_GET['voto'];
	$id = $_GET['id'];
	
	$consulta = mysqli_query($con->connect(),"select * from noticia where id = ".$id."");
	$campo = mysqli_fetch_array($consulta);
	$campoPositivo = $campo['positivo'];
	$campoNegativo = $campo['negativo'];
	
	if($voto =="positivo"){
		$campoPositivo++;
		$crud = new crud('noticia'); 
		$crud->atualizar("positivo=$campoPositivo", "id=$id"); 
	}else{
		$campoNegativo++;
		$crud = new crud('noticia'); 
		$crud->atualizar("negativo=$campoNegativo", "id=$id"); 
	}
	echo"$campoPositivo===$campoNegativo";
}

if($_GET['action'] == "contarVotoComentario"){
	@session_start();
	$voto = $_GET['voto'];
	$id = $_GET['id'];
	
	$consulta = mysqli_query($con->connect(),"select * from comentario where id = ".$id."");
	$campo = mysqli_fetch_array($consulta);
	$campoPositivo = $campo['positivo'];
	$campoNegativo = $campo['negativo'];
	
	if($voto =="positivo"){
		$campoPositivo++;
		$crud = new crud('comentario'); 
		$crud->atualizar("positivo=$campoPositivo", "id=$id"); 
	}else{
		$campoNegativo++;
		$crud = new crud('comentario'); 
		$crud->atualizar("negativo=$campoNegativo", "id=$id"); 
	}
	echo"$campoPositivo===$campoNegativo";
}


function sanitizeString($string) {
    $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );
    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_' );
    return str_replace($what, $by, $string);
}



?>