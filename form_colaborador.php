<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="js/ajax.js"></script>
		<link rel="stylesheet" type="text/css" href="css/global.css">
		<script language= 'javascript'>
		<!--
		function aviso(id,tela){
		if(confirm (' Deseja realmente apagar este registro? '))
		{
		location.href="excluir.php?idcampo=idano&id="+id+"&tela="+tela;
		}
		else
		{
		return false;
		}
		//window.location.reload();
		}
		//-->
		</script>
		
		<script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){	$("#responsavelcpf").mask("999.999.999-99");});
		$(document).ready(function(){	$("#cpf").mask("999.999.999-99");});
		</script>

		
		
<?php
/*
 *   Ofereço a Deus todos esses código que escrevi como fruto do 
 * meu trabalho e por intercessço de São Isodoro de Servilha e 
 * São Jose  Maria Escrivá esses sistema nunca seja usado para o mau 
 * ou desagrado do nosso senhor Jesus Cristo. Amém.  
 * 
 * Tiago Junior - 31/08/2014
*/

    require_once 'config/conexao.class.php';
    require_once 'config/crud.class.php';
	ini_set('default_charset','UTF-8');
    $con = new conexao(); 
    $con->connect(); 
    @$getId = $_GET['id']; 
	$anodata = date('Y');
    if(@$getId){
        $consulta = mysqli_query($con->connect(),"SELECT * FROM colaborador WHERE id = + $getId");
        $campo = mysqli_fetch_array($consulta);
    }
    
    if(isset ($_POST['cadastrar'])){    
        $nome = $_POST['nome']; 
        $idade = "0"; 
        $email = $_POST['email']; 
        $telefone = $_POST['telefone']; 
        $celular = $_POST['celular']; 
        $serie = $_POST['serie']; 
        $endereco = $_POST['endereco']; 
        $bairro = $_POST['bairro']; 
        $cidade = $_POST['cidade']; 
        $sexo = $_POST['sexo']; 
        $cache = $_POST['cache']; 
		$pai = $_POST['pai']; 
		$mae = $_POST['mae']; 
		$experiencia = $_POST['experiencia']; 
		$comentario = $_POST['comentario']; 
		$grupo = $_POST['grupo']; 
		$nascimento = $_POST['nascimento']; 
		$funcao = $_POST['funcao'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		$cep = $_POST['cep'];
		$responsavel = $_POST['responsavel'];
		$responsavelrg = $_POST['responsavelrg'];
		$responsavelcpf = $_POST['responsavelcpf'];
		$link_video = $_POST['link_video'];
		
				
        $crud = new crud('colaborador'); 
        $crud->inserir("nome,idade,email,telefone,celular,serie,endereco,bairro,cidade,sexo,cache,pai,mae,comentario,experiencia,grupo,nascimento,funcao,cpf,rg,responsavel,responsavelrg,responsavelcpf,link_video,cep",
		"'$nome','$idade','$email','$telefone','$celular','$serie','$endereco','$bairro','$cidade','$sexo','$cache','$pai','$mae','$comentario','$experiencia','$grupo','$nascimento','$funcao','$cpf','$rg','$responsavel','$responsavelrg','$responsavelcpf','$link_video','$cep'"); 

   }

   
   
    if(isset ($_POST['editar'])){
        $nome = utf8_decode($_POST['nome']); 
         
        $email = $_POST['email']; 
        $telefone = $_POST['telefone']; 
        $celular = $_POST['celular']; 
        $serie = $_POST['serie']; 
        $endereco = $_POST['endereco']; 
        $bairro = $_POST['bairro']; 
        $cidade = $_POST['cidade']; 
        $sexo = $_POST['sexo']; 
        $cache = $_POST['cache']; 
		$pai = $_POST['pai']; 
		$mae = $_POST['mae'];
		$experiencia = $_POST['experiencia']; 
		$comentario = $_POST['comentario']; 
		$grupo = $_POST['grupo']; 
		$nascimento = $_POST['nascimento']; 
		$funcao = $_POST['funcao'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		$cep = $_POST['cep'];
		$responsavel = $_POST['responsavel'];
		$responsavelrg = $_POST['responsavelrg'];
		$responsavelcpf = $_POST['responsavelcpf'];
		$link_video = $_POST['link_video'];
		
        $crud = new crud('colaborador'); 
        $crud->atualizar("nome='$nome',email='$email',telefone='$telefone',celular='$celular',serie='$serie',endereco='$endereco',bairro='$bairro',cidade='$cidade',sexo='$sexo',cache='$cache',pai='$pai',mae='$mae',experiencia='$experiencia',comentario='$comentario',grupo='$grupo',nascimento='$nascimento',funcao='$funcao',cpf='$cpf',rg='$rg',responsavel='$responsavel',responsavelrg='$responsavelrg',responsavelcpf='$responsavelcpf',link_video='$link_video',cep='$cep'      ", "id='$getId'"); // 
		
      }
	 
	  if(isset ($_POST['cadastrarfoto'])){
        $tipo = $_POST['tipo']; 
        $descricao = $_POST['descricao']; 
        $id_foto = $_POST['id_foto']; 
	
        $crud = new crud('foto_colaborador'); 
        $crud->atualizar(" tipo='$tipo', descricao='$descricao'      ", "id='$id_foto'"); // 
		
      }
	  
	  if(isset ($_POST['cadastrar']) ){
		$consulta2 = mysqli_query($con->connect(),"SELECT * FROM colaborador order by id desc limit 1"); // query que busca todos os dados da tabela PRODUTO
		$ano = $_POST['ano']; 
		$situacao = $_POST['situacao'];
		
		while ($campoColaborador = mysqli_fetch_assoc($consulta2)) { 
		$id = $campoColaborador['id'];
			$crud = new crud('ano_projeto'); 
			$crud->inserir("ano, situacao, id_colaborador, tipo",		"'$ano', '$situacao', '$id', 'C' "); 
		}
	  }
	  
	    if(isset ($_POST['editar']) ){
		$consulta2 = mysqli_query($con->connect(),"SELECT * FROM ano_projeto where id_colaborador = '".$getId."' order by idano desc limit 1"); // query que busca todos os dados da tabela PRODUTO
		$ano = $_POST['ano']; 
		$situacao = $_POST['situacao'];

		while ($campoAno = mysqli_fetch_assoc($consulta2)) { 
			$idano = $campoAno['idano'];
			$crud = new crud('ano_projeto'); 
			if($ano > $campoAno['ano']){
			$crud->inserir("ano,situacao, id_colaborador, tipo",		"'$ano','$situacao', '$getId', 'C' ");
			}else{
			$crud->atualizar("ano='$ano',situacao='$situacao' ", "id_colaborador='$getId' and idano='$idano'");
			}
		}
				echo "<script>location='index.php?id=".$_GET['id']."&form=colaborador';</script>";
	   }
	  

	
	function calc_idade($data_nasc) {
    list($dia, $mes, $ano) = explode('/', $data_nasc);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    return $idade;
	}
		  
	  
	  
	  /*
	 if(isset ($_POST['editar']) || isset ($_POST['cadastrar']) ){
	 	$ano = $_POST['ano']; 
		$situacao = $_POST['situacao'];
		
		$consulta2 = mysqli_query($con->connect(),"SELECT a.ano as ano FROM  ano_projeto a 
		where a.id_colaborador = '".$getId."' order by ANO desc limit 1"); // query que busca todos os dados da tabela PRODUTO
		$exibiranoatual = false;
		$anodata = date('Y');
		while ($campoano = mysqli_fetch_assoc($consulta2)) { 
			echo "<option value='".$campoano['ano']."'>".$campoano['ano']."</option>";
			if($campoano['ano'] == $anodata){
			$exibiranoatual = true;;
			}
		}

		//echo "<br> $anodata $exibiranoatual"; 

		if($exibiranoatual){
			$crud = new crud('ano_projeto'); 
			$crud->atualizar("ano='$ano',situacao='$situacao' ", "id_colaborador='$getId' and ano='$ano'"); // 
			//echo "<br><br>teste 1 - ano='$ano',situacao='$situacao'  id_colaborador='$getId'";
		}else{
			if(!empty($getId)){
				$crud = new crud('ano_projeto'); 
				$crud->inserir("ano,situacao, id_colaborador",		"'$ano','$situacao', '$getId'"); 
				echo "<br>teste 2 - ano,situacao, id_colaborador '$ano','$situacao', '$getId'";
			}else{
				$consulta3 = mysqli_query($con->connect(),"SELECT id  from colaborador order by id desc limit 1"); // query que busca todos os dados da tabela PRODUTO
				$id_colaborador = "";
				while ($campoid = mysqli_fetch_assoc($consulta3)) { 
					$id_colaborador= $campoid['id'];
				}
				$crud = new crud('ano_projeto'); 
				$crud->inserir("ano,situacao, id_colaborador",	"'$ano', '$situacao', '$id_colaborador' "); 
				echo "<br><br><br>teste 3 - ano,situacao, id_colaborador $ano', '$situacao', '$id_colaborador' ";
			}
      	}
	 }
	 
	 */
	 
	 
	 
	 

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form action="" method="post">
	<table border='0' bordercolor='#fff' cellspacing='10' cellpadding='0' width=600>
	<tr>
	<td>Nome</td><td><input type="text" name="nome" size="35" max="250" value="<?php echo @utf8_encode($campo['nome']);?>" style="text-transform:uppercase" /></td>   
	<td> </td>
	</tr>
	<tr>
	<td>CPF</td><td><input type="text" name="cpf" id="cpf" size="35" max="250" value="<?php echo @$campo['cpf'];?>" /></td>   
	<td>RG</td><td><input type="text" name="rg"  size="15" max="250" value="<?php echo @$campo['rg'];?>" /></td>
	</tr>
	<tr>
	<td>email</td><td><input type="text" name="email" size="35"  max="250" value="<?php echo @$campo['email'];?>" /></td>   
	<td>telefone</td><td><input type="text" name="telefone"  size="20" max="250" value="<?php echo @$campo['telefone'];?>" /></td>
	</tr>
	<tr>
	<td>celular</td><td><input type="text" name="celular"  size="20" max="250" value="<?php echo @$campo['celular'];?>" /></td>   
	<td>Escolaridade</td><td><input type="text" name="serie"  size="10" max="250" value="<?php echo @$campo['serie'];?>" /></td>
	</tr>
	<tr>
	<td>Endereço</td><td><input type="text" name="endereco"  size="40" max="250" value="<?php echo @$campo['endereco'];?>" /></td>   
	<td>bairro</td><td><input type="text" name="bairro"  size="20" max="250" value="<?php echo @$campo['bairro'];?>" /></td>
	</tr>
	<tr>
	<td>CEP</td><td><input type="text" name="cep"  size="20" max="250" value="<?php echo @$campo['cep'];?>" /></td>   
	<td>Idade</td><td><input type="text" name="cep"  size="20" max="250" value="<?php echo calc_idade(@$campo['nascimento']);?>" /></td>   
	</tr>
	<tr>
	<td>Nome do Pai</td><td><input type="text" name="pai"  size="20" max="250" value="<?php echo @$campo['pai'];?>" style="text-transform:uppercase"/></td>   
	<td>Nome da Mãe</td><td><input type="text" name="mae"  size="20" max="250" value="<?php echo @$campo['mae'];?>" style="text-transform:uppercase"/></td>
	</tr>
	<tr>
	<td>Responsavel</td><td><input type="text" name="responsavel"  size="20" max="250" value="<?php echo @$campo['responsavel'];?>" /></td>   
	<td>Responsavel RG</td><td><input type="text" name="responsavelrg"  size="20" max="250" value="<?php echo @$campo['responsavelrg'];?>" /></td>
	</tr>
	<tr>
	<td></td>
	
	<td>
	<br>
	
	
	</td>   
	<td>Responsavel CPF</td><td><input type="text" name="responsavelcpf" id="responsavelcpf"  size="20" max="250" value="<?php echo @$campo['responsavelcpf'];?>" /></td>
	</tr>
	<tr>
	<td>Data de Nascimento</td><td><input type="text" name="nascimento"  size="12" max="250" value="<?php echo @$campo['nascimento'];?>" /></td>   
	<td>Experiência</td><td><input type="text" name="experiencia"  size="20" max="250" value="<?php echo @$campo['experiencia'];?>" /></td>
	</tr>
	<tr>
	<td>Comentário</td><td><textarea type="text" name="comentario"  size="40" ><?php echo @$campo['comentario'];?></textarea></td>   
	<td>Grupo</td><td><input type="text" name="grupo"  size="20" max="250" value="<?php echo @$campo['grupo'];?>" /></td>
	</tr>
	<tr>
	<td>Link do Video</td><td><input type="text" name="link_video"  size="20" placeholder='https://www.youtube.com/watch?v=ARWnFepa4OI' value="<?php echo @$campo['link_video'];?>"></td>   
	<td></td><td></td>
	</tr>
	<tr>
	<td>Cidade</td><td><input type="text" name="cidade" size="20"  max="250" value="<?php echo @$campo['cidade'];?>" /></td>   
	<td>Sexo</td><td>
	<select name="sexo">
	<option value="<?php echo @$campo['sexo'];?>" selected><?php echo @$campo['sexo'];?></option>
	<option value="Masculino">Masculino</option>
	<option value="Feminino">Feminino</option>
	</select>
	</td>
	</tr>
	<tr>
	<td>cache</td><td><input type="text" name="cache"  size="10" max="250" value="<?php echo @$campo['cache'];?>" /></td>   
	<td>ano</td><td>
	<select name="ano">
	<?php
	$consulta2 = mysqli_query($con->connect(),"SELECT a.ano as ano FROM colaborador c, ano_projeto a 
	where c.id = a.id_colaborador and c.id = '".$campo['id']."' order by ANO desc limit 1"); // query que busca todos os dados da tabela PRODUTO
	$exibiranoatual = false;
	$anodata = date('Y');
	while ($campoano = mysqli_fetch_assoc($consulta2)) { 
		echo "<option value='".$campoano['ano']."'>".$campoano['ano']."</option>";
		if($campoano['ano'] != $anodata){
			$exibiranoatual = true;;
		}
	}
	echo "<option value=''></option>";
	echo "<option value='".$anodata."'>".$anodata."</option>";
	echo "<option value='2016'>2016</option>";
	echo "<option value='2018'>2018</option>";
	echo "<option value='2015'>2015</option>";
	echo "<option value='2014'>2014</option>";
	echo "<option value='2000'>2000</option>";

	?>
	
	</select>
	
	</td>
	</tr>
	<tr>
	<td>Função: </td><td>
	<select name="funcao">
	<option value="<?php echo @$campo['funcao'];?>" selected><?php echo @$campo['funcao'];?></option>
	<option value="Ator">Ator</option>
	<option value="Produção">Produção</option>
	<option value="Assistente de Produção">Assistente de Produção</option>
	<option value="Diretor">Diretor</option>
	<option value="Assistente de Direção">Assistente de Direção</option>
	<option value="Figurinista">Figurinista</option>
	<option value="Outro">Outro</option>
	</select>
	</td> 

	<td>Situacao/Ativo: </td><td>
	<select name="situacao">
	<?php
	$consulta2 = mysqli_query($con->connect(),"SELECT a.situacao as situacao, a.ano as ano FROM colaborador c, ano_projeto a 
	where c.id = a.id_colaborador and c.id = '".$campo['id']."' order by ano desc limit 1 "); // query que busca todos os dados da tabela PRODUTO
	$exibiranoatual = false;
	while ($camposituacao = mysqli_fetch_assoc($consulta2)) { 
		echo "<option value='".$camposituacao['situacao']."'>".$camposituacao['situacao']."</option>";
	}
	?>
	<option value="SIM">SIM</option>
	<option value="NAO">NAO</option>
	<option value="PENDENTE">PENDENTE</option>
	<option value="EXPULSO">EXPULSO</option>
	<option value="DESISTENTE">DESISTENTE</option>
	<option value="OUTRO">OUTRO</option>
	</select>
	</td> 
	
	</tr>
	
		
		
		
		</table>
		
		
		
            
            <br />
            <?php
                if(@!$campo['id']){
            ?>
                <input type="submit" name="cadastrar" value="SALVAR" />
            <?php }else{ ?>
                <input type="submit" name="editar" value="SALVAR" />    
            <?php } ?>
        </form>
        <br><br><br><br><br><br><br><br>


<h2>Impressão de Documentos</h2>
	<table border='1' bordercolor='blue' cellspacing='0' cellpadding='10'	width=600>
		<tr>
			<td><a href="print_colaborador_declaracao_voluntariado.php?id=<?php echo $campo['id']; ?>" target='main'> <img src="images/pdf.png" width="30" height="30"title='Mostrar a Ficha do colaborador'>    </a> </td>
			<td>Declaração de voluntariado</td>
		</tr>
		<tr>
			<td><a href="print_colaborador_declaracaoPDF.php?id=<?php echo $campo['id']; ?>" target='main'> <img src="images/pdf.png" width="30" height="30"title='Mostrar a Ficha do colaborador'>    </a> </td>
			<td>Ficha do colaborador</td>
		</tr>
		<tr>
			<td><a href="print_documentacao.php?id=<?php echo $campo['id']; ?>" target='main'> <img src="images/pdf.png" width="30" height="30"title='Mostrar a Ficha do colaborador'>    </a> </td>
			<td>Imprimir  Documentação</td>
		</tr>
		<tr>
			<td><a target='main' href='print_colaborador_reciboPDF.php?id=<?php echo $campo['id'];?>'> <img src="images/pdf.png" title='Declaração de comparecimento' width="30" height="30">    </a> </td>
			<td>Recibo de  Pagamento</td>
		</tr>
		<tr>
			<td><a target='main' href='print_autorizacao_menorPDF.php?id=<?php echo $campo['id'];?>'> <img src="images/pdf.png" title='Autorização para menor de idade' width="30" height="30">    </a> </td>
			<td>Autorização para menor de idade</td>
		</tr>
		

	</table>
<br><br>



<font size="3"><a href="form_foto_colaborador.php?id_colaborador=<?php echo $campo['id']; ?>&form=foto_colaborador"><br> Adicionar Foto de Perfi </a></font>
<font size="3"><a href="form_foto_colaborador_doc.php?id_colaborador=<?php echo $campo['id']; ?>&form=foto_colaborador"><br> Adicionar Documentação </a></font>

<?php

 $id_unic = "id_colaborador = ".$_GET['id'];
$consulta = mysqli_query($con->connect(),"SELECT * FROM foto_colaborador fo WHERE $id_unic and  id = id "); // query que busca todos os dados da tabela PRODUTO
while ($campoFoto = mysqli_fetch_array($consulta)) { // laço de repetiçao que vai trazer todos os resultados da consulta
$link = str_replace( "thumbnail","resize", $campoFoto['foto']);   

   ?> 

    <table border="1" bordercolor="#000"  width="700" cellspacing="0" cellpadding="30">
        <tr><td width=130> 
	        <center>
				<a target="main" href="upload_pic/<?php echo  $link;?>">	<img width=130 src="upload_pic/<?php echo $campoFoto['foto'];?>" width='70' align='right' ></a>
				</center>
                </td>

        <td>
			<form action="" method="post">
				<input type="hidden" name="id_foto" value="<?php echo $campoFoto['id']; ?>">
				<select name="tipo">
				<option value="<?php echo @$campoFoto['tipo'];?>" selected><?php echo @$campoFoto['tipo'];?></option>
				<option value="P">(P) Perfil</option>
				<option value="H">(H) Históriico</option>
				<option value="D">(D) Documentação</option>
				</select>
				<br><textarea type="text" name="descricao"  size="40" ><?php echo @$campoFoto['descricao'];?></textarea>
				<br>
			 <input type="submit" name="cadastrarfoto" value="salvar" />
			</form>
                
            </td>
       
            <td>
                 <center> <a href="javascript:aviso('<?php echo $campoFoto['id'] ?>','foto_colaborador');"> Excluir    </a> </center>
            </td>
       
    </table>

<?php } ?>
              
		
		
		
		
		<div class="dropzone" id="dropzone">Drop files here</div>

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
						formData.append('id_colaborador','<?php echo $getId;?>');
					}
					xhr.onload = function(){
						var data = JSON.parse(this.responseText);
						console.log(data);
						displayUploads(data);
					}
					xhr.open('post','upload.php');
					xhr.send(formData);
					alert('File Uploaded Successfully');
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
		
		
		
		
		
		
		
		
		

<br><br><br><br>





   <table border="1" bordercolor="#000" bgcolor="#FFFAFA" width="700" cellspacing="0" cellpadding="0">
	<tr>
	<td>Foto</td>
	<td>Nome</td>
	<td>Papeis</td>

	<td>Cache</td>
	<td>Ficha</td>
	<td>Status</td>
	<td>Recibo</td>
	
	</tr>
	
<?php
$anodata = date('Y');

$quant =0 ;  

	
	


$consulta = mysqli_query($con->connect(),"SELECT c.*, a.*, a.cache as cacheano FROM colaborador c, ano_projeto a where a.id_colaborador = ".$_GET['id']." and c.id = a.id_colaborador   ORDER BY  nome asc limit 150 "); // query que busca todos os dados da tabela PRODUTO
while ($campo = mysqli_fetch_array($consulta)) { // laço de repetiçao que vai trazer todos os resultados da consulta
$quant ++;
 ?> 

		<tr>
	<td rowspan=4 width=72>
	
	<?php
	
	
	
    $consulta3 = mysqli_query($con->connect(),"SELECT * FROM foto_colaborador where tipo = 'P' and id_colaborador='" . $campo['id'] . 
		"'ORDER BY id DESC LIMIT  1");
        if (mysqli_num_rows($consulta3) > 0) {
            while ($campo3 = mysqli_fetch_array($consulta3)) {
			
			echo" <a href='index.php?tela=foto_colaborador&id=" . $campo3['id'] . "". "'>
				<img src='upload_pic/" . $campo3['foto'] . "' width='70' ></a>";
				     }
        }
		echo "<center><font size=5 face=arial><b>".$campo['ano']."</b></font></center>";
		?>
		</td>
	<td rowspan=4 bgcolor="#FFE4E1"> <a href="index.php?id=<?php echo $campo['id'] ?>&form=colaborador"><font size=4 color=blue><b>
	<?php  echo "<font color='red'> $quant </font>";  
	echo $campo['nome'];
	?></b></font></a>
	
	</td>

	
	 
	
	
	
	<td>Tipo</td>
	<td> 
		<select name="papel1" onkeypress="return searchKeyPress(event,<?php echo $campo['idano'];?>);"  >
			<option value="<?php echo @$campo['papel1'];?>" selected><?php echo @$campo['papel1'];?></option>
			<option value=""></option>
			<option value="Direção">Direção</option>
			<option value="Produção">Produção</option>
			<option value="Protagonista">Protagonista</option>
			<option value="Coadjuvante">Coadjuvante</option>
			<option value="Secundário 1">Secundário 1</option>
			<option value="Secundário 2">Secundário 2</option>
			<option value="Figurante 1">Figurante 1</option>
			<option value="Figurante 2">Figurante 2</option>
		</select>	  
	</td>   
	
	
	
   	<td>Ficha</td> 
	<td> 
	<?php 	if($campo['documentacao'] == true){?>
	<a onclick="javascript:documentacao('ativar', <?php echo $campo['idano'];?>);"><img src="images/okver.jpeg" width=25></a>
	<?php	}else{	?>
	<a onclick="javascript:documentacao('desativar', <?php echo $campo['idano'];?>);"><img src="images/falsevermelho.png" width=25></a>
	<?php	} ?> 
	</td> 

	<td rowspan=3>
	<a href="javascript:aviso('<?php echo $campo['idano'] ?>','ano_projeto');"> <img src="images/bt_excluir.PNG" width="30" height="30">    </a>
	</td>
	
	
	
	<tr>
	<td>Papel Detalhado</td> 
	<td>
		<input type="text" id="papel_detalhe" onkeypress="return searchKeyPress4(event,<?php echo $campo['idano'];?>);" value="<?php echo $campo['papel_detalhe'];?>" size=8 />
	</td> 
		<td>Recibo</td> 
	<td> 
	<?php 	if($campo['recibo'] == true){?>
	<a onclick="javascript:recibo('ativar', <?php echo $campo['idano'];?>);"><img src="images/okver.jpeg" width=25></a>
	<?php	}else{	?>
	<a onclick="javascript:recibo('desativar', <?php echo $campo['idano'];?>);"><img src="images/falsevermelho.png" width=25></a>
	<?php	} ?>
    </td>
	</tr>
	

	
	
	<tr>
	<td>Papel 2</td> <td>
			<select name="papel2" onkeypress="return searchKeyPress2(event,<?php echo $campo['idano'];?>);"  >
			<option value="<?php echo @$campo['papel2'];?>" selected><?php echo @$campo['papel2'];?></option>
			<option value=""></option>
			<option value="Direção">Direção</option>
			<option value="Produção">Produção</option>
			<option value="Protagonista">Protagonista</option>
			<option value="Coadjuvante">Coadjuvante</option>
			<option value="Secundário 1">Secundário 1</option>
			<option value="Secundário 2">Secundário 2</option>
			<option value="Figurante 1">Figurante 1</option>
			<option value="Figurante 2">Figurante 2</option>
		</select>	</td> 
	<td>Documentação</td> 
	<td>
	<?php 	if($campo['ficha'] == true){?>
	<a onclick="javascript:ficha('ativar', <?php echo $campo['idano'];?>);"><img src="images/okver.jpeg" width=25></a>
	<?php	}else{	?>
	<a onclick="javascript:ficha('desativar', <?php echo $campo['idano'];?>);"><img src="images/falsevermelho.png" width=25></a>
	<?php	} ?> 
	</td> 
	</tr>
	
	
	<tr>
	<td>Papel 3</td> 
	<td> 
		<select name="papel3" onkeypress="return searchKeyPress3(event,<?php echo $campo['idano'];?>);"  >
			<option value="<?php echo @$campo['papel3'];?>" selected><?php echo @$campo['papel3'];?></option>
			<option value=""></option>
			<option value="Direção">Direção</option>
			<option value="Produção">Produção</option>
			<option value="Protagonista">Protagonista</option>
			<option value="Coadjuvante">Coadjuvante</option>
			<option value="Secundário 1">Secundário 1</option>
			<option value="Secundário 2">Secundário 2</option>
			<option value="Figurante 1">Figurante 1</option>
			<option value="Figurante 2">Figurante 2</option>
		</select>	
	<td>Cache</td> 
	<td>  <input type="text" id="cache" name="cache" class="cache" onkeypress="return searchKeyPressCache(event,<?php echo $campo['idano'];?>);" value="<?php echo $campo['cacheano'];?>" size=8 /> </td>
		
	</tr>

	
		
	



<?php } ?>
  </table>


		<center>
		<br><br><br>
			<?php
    $consulta3 = mysqli_query($con->connect(),"SELECT * FROM foto_colaborador where  id_colaborador='" . $getId . 
		"' and tipo = 'P' ORDER BY id DESC LIMIT  1");
        if (mysqli_num_rows($consulta3) > 0) {
            while ($campo3 = mysqli_fetch_array($consulta3)) {
			$foto = explode('_', $campo3['foto']);
			echo" <a href='index.php?tela=foto_colaborador&id=" . $getId . "". "'>
				<img src='upload_pic/resize_" . $foto[1] . "' width=700 ></a>";
            }
        }
		?>
		</center>
		
		
		
		
		
		
		
		
		
		
		<br><br><br><br><br>
    </body>
</html>
<?php $con->disconnect(); // fecha conexao com o banco ?>