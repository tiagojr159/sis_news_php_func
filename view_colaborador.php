<?php
/*
 *   Ofereço a Deus todos esses código que escrevi como fruto do 
 * meu trabalho e por intercessão de São Isodoro de Servilha e 
 * São Jose  Maria Escrivá esses sistema nunca seja usado para o mau 
 * ou desagrado do nosso senhor Jesus Cristo. Amém.  
 * 
 * Tiago Junior - 31/08/2014
 */
include 'restrict.php';
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';

$con = new conexao(); // instancia classe de conxao
$con->connect(); // abre conexao com o banco
?>

<font size="3"><a href="index.php?form=colaborador"> Novo </a></font>


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






            <br></br>
            <table cellpadding="0" width="700" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Foto</th>
                         <th>Dados</th>
                        <th>Opção</th>
                    </tr>
                </thead>
                <tbody>
 			<?php
$consulta = mysqli_query($con->connect(),"SELECT * FROM colaborador c, ano_projeto a where c.id = a.id_colaborador    $id_unic group by id  ORDER BY  nome ASC LIMIT  1220"); // query que busca todos os dados da tabela PRODUTO
while ($campo = mysqli_fetch_array($consulta)) { // laço de repetiçao que vai trazer todos os resultados da consulta
  
    /*if($campo['play'] =="s"){
        $play = "<img src='images/green.jpg'>";
    }else{
        $play = "<img src='images/red.jpg'>";
    } */   ?> 
   			 <tr class='even_gradeC'>
                            <td>
							
								<?php
  
    $consulta3 = mysqli_query($con->connect(),"SELECT * FROM foto_colaborador where  id_colaborador='" . $campo['id'] . 
		"' and tipo = 'P' ORDER BY id DESC LIMIT  1");
        if (mysqli_num_rows($consulta3) > 0) {
            while ($campo3 = mysqli_fetch_array($consulta3)) {
			
			echo" <a href='index.php?tela=foto_colaborador&id=" . $campo3['id'] . "". "'>
				<img src='upload_pic/" . $campo3['foto'] . "' width='70' ></a>";
            }
        }
		?>
							
							
							</td> 

							
							
                            <td>
							<b><?php echo $campo['nome']; ?></b> - <?php echo $campo['id']; ?>
							<br>[ <?php echo $campo['ano']; ?> ] <?php echo $campo['idade']; ?>, <?php echo $campo['telefone']; ?> , <?php echo $campo['celular']; ?>, <?php echo $campo['comentario']; ?>, <?php echo $campo['nascimento']; ?>, <?php echo $campo['endereco']; ?>
							
							</td>       
                            <td>
			<a href="form_foto_colaborador.php?id_colaborador=<?php echo $campo['id']; ?>&form=foto_colaborador"> <img src="images/128128.png" width="30" height="30" title='Adicionar a foto do Colaborador'>  </a>
            <a href="index.php?id=<?php echo $campo['id'] ?>&form=colaborador"> <img src="images/botao43.png" width="30" height="30" title='Editar o Cadastro'> </a> 
            <a href="print_colaborador.php?id=<?php echo $campo['id']; ?>"> <img src="images/imprimir.gif" width="30" height="30" title='Imprimir a Ficha do Colaborador'>    </a> 
	    <!--<a href="print_colaborador_reciboPDF.php?id=<?php echo $campo['id']; ?>"> <img src="images/pdf.png" width="30" height="30">    </a> -->
            <a href="print_colaborador_declaracaoPDF.php?id=<?php echo $campo['id']; ?>"> <img src="images/pdf.png" width="30" height="30"title='Mostrar a Ficha do colaborador'>    </a> 
            <a href="print_colaborador_fichaPDF.php?id=<?php echo $campo['id']; ?>"> <img src="images/pdf.png" title='Declaração de comparecimento' width="30" height="30">    </a> 
            <a href="javascript:aviso('<?php echo $campo['id'] ?>','colaborador');"> <img src="images/bt_excluir.PNG" width="30" height="30" title='Excluir o cadasro'>    </a>

							</td> 
                           

                            </td>
                           </tr> 
<?php } ?>							
							
                </tbody>
            </table>

    


















	