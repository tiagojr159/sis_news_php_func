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
date_default_timezone_set('America/Sao_Paulo');

$con = new conexao(); 
$con->connect(); 
header('Content-Type: application/json');
$uploaded = array();

$date = date('YmdHis');	
$ano = date('Y');
$data = date('Y-m-d h:m:s');

$tipoImagem = "N";
if($_POST['action2'] == "user"){
	$tipoImagem = "U";
}

var_dump($_POST);

if($_POST['action'] == "fomularioImagem"){
	if(!empty($_FILES['file']['name'])){
		$nomeArquivo    = $date.'.jpg';
		$jpeg_quality   = 60;
		$src = $_FILES['file']['tmp_name'];
		$lista = array();
		$lista = getimagesize($src);
		
		if(strpos($_FILES['file']['name'], 'jpg') || strpos($_FILES['file']['name'], 'jpeg')){
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor($lista[0]/5, $lista[1]/5);
			$imagem = imagecopyresampled($dst_r,$img_r,0,0,0,0,$lista[0]/5, $lista[1]/5,$lista[0], $lista[1]);
			imagejpeg($dst_r, "upload_pic/thumbnail_".$nomeArquivo ,50);

			$img_r2 = imagecreatefromjpeg($src);
			$dst_r2 = ImageCreateTrueColor($lista[0]/2, $lista[1]/2);
			$imagem = imagecopyresampled($dst_r2,$img_r2,0,0,0,0,$lista[0]/2, $lista[1]/2,$lista[0], $lista[1]);
			imagejpeg($dst_r2, "upload_pic/resize_".$nomeArquivo ,100);
		}else{
			$img_r = imagecreatefrompng($src);
			$dst_r = ImageCreateTrueColor($lista[0]/5, $lista[1]/5 );
			$imagem = imagecopyresampled($dst_r,$img_r,0,0,0,0,$lista[0]/5, $lista[1]/5,$lista[0], $lista[1]);
			imagejpeg($dst_r, "upload_pic/thumbnail_".$nomeArquivo );

			$img_r2 = imagecreatefrompng($src);
			$dst_r2 = ImageCreateTrueColor($lista[0]/2, $lista[1]/2 );
			$imagem = imagecopyresampled($dst_r2,$img_r2,0,0,0,0,$lista[0]/2, $lista[1]/2,$lista[0], $lista[1]);
			imagejpeg($dst_r2, "upload_pic/resize_".$nomeArquivo);
		}
		
	@session_start();
	$id_autor = $_SESSION['id_autor'];
	$id_noticia_user = $_POST['id_noticia_user'];
	$crud = new crud('imagem'); 
    $crud->inserir("id_autor,id_noticia,tipo,data,nome_arquivo,exibir", 	"'$id_autor','$id_noticia_user','$tipoImagem','$data','$nomeArquivo','S'"); 
	header("Location: index.php");
	}
}else{
	if(!empty($_FILES['file']['name'][0])){
	$i = 0;	
		foreach($_FILES['file']['name'] as $position => $name){

		$nomeArquivo    = $date.$i.'.jpg';
		$jpeg_quality   = 60;
		$src = $_FILES['file']['tmp_name'][$position];
		$lista = array();
		$lista = getimagesize($src);
		
		if(strpos($_FILES['file']['name'][$position], 'jpg')){
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor($lista[0]/5, $lista[1]/5);
			$imagem = imagecopyresampled($dst_r,$img_r,0,0,0,0,$lista[0]/5, $lista[1]/5,$lista[0], $lista[1]);
			imagejpeg($dst_r, "upload_pic/thumbnail_".$nomeArquivo ,50);

			$img_r2 = imagecreatefromjpeg($src);
			$dst_r2 = ImageCreateTrueColor($lista[0]/2, $lista[1]/2 );
			$imagem = imagecopyresampled($dst_r2,$img_r2,0,0,0,0,$lista[0]/2, $lista[1]/2,$lista[0], $lista[1]);
			imagejpeg($dst_r2, "upload_pic/resize_".$nomeArquivo ,100);
		}else{
			$img_r = imagecreatefrompng($src);
			$dst_r = ImageCreateTrueColor($lista[0]/5, $lista[1]/5 );
			$imagem = imagecopyresampled($dst_r,$img_r,0,0,0,0,$lista[0]/5, $lista[1]/5,$lista[0], $lista[1]);
			imagejpeg($dst_r, "upload_pic/thumbnail_".$nomeArquivo );

			$img_r2 = imagecreatefrompng($src);
			$dst_r2 = ImageCreateTrueColor($lista[0]/2, $lista[1]/2 );
			$imagem = imagecopyresampled($dst_r2,$img_r2,0,0,0,0,$lista[0]/2, $lista[1]/2,$lista[0], $lista[1]);
			imagejpeg($dst_r2, "upload_pic/resize_".$nomeArquivo);
		}
		@session_start();
		$id_autor = $_SESSION['id_autor'];
		$id_noticia_user = $_POST['id_noticia_user'];
		$crud = new crud('imagem'); 
		$crud->inserir("id_autor,id_noticia,tipo,data,nome_arquivo,exibir", 	"'$id_autor','$id_noticia_user','$tipoImagem','$data','$nomeArquivo','S'"); 
		$i++;
		}
	}
}


echo json_encode($uploaded);

?>