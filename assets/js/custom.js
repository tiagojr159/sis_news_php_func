
	
  
  
  
  function consultaNumero() {
    var telefone =  document.getElementById('telefone').value;
	  $.get('controlador.php?action=autentica_numero&telefone='+telefone, function(retorno) {

	  if(retorno.trim() == 'naocadastrado'){
		alert('Este numero não esta cadastrado. Entre em algum grupo de whatsapp e solicite o cadastro.');
	  }
	  if(retorno.trim() == 'autenticadoTelefone'){
		alert('O numero foi autenticado com sucesso.');
		document.getElementById('fundo').style.display = 'none'; 
        document.getElementById('autentica').style.display = 'none'; 
		window.location.reload();
	  }
	  if(retorno.trim() == 'existesenha'){
		document.getElementById("divsenha").style.display = 'block'; 
		document.getElementById("idoknumero").style.display = 'none'; 
		document.getElementById("idoksenha").style.display = 'block'; 
	  }
	});
  }
  
   function exibirConsultaNumero() {
		document.getElementById("autentica").style.display = 'block';
		document.getElementById('divsenha').style.display = 'none'; 
		document.getElementById('idoknumero').style.display = 'block'; 
		document.getElementById('fundo').style.display = 'block'; 

  }
  
 function autenticaSenha() {
    var telefone =  document.getElementById('telefone').value;
	var senha =  document.getElementById('senha').value;
	  $.get('controlador.php?action=autentica_senha&telefone='+telefone+'&senha='+senha, function(retorno) {
	  if(retorno.trim() == 'autenticado'){
		document.getElementById("autentica").style.display = 'none';
		document.getElementById('fundo').style.display = 'none'; 
		window.location.reload();
	  }
	  if(retorno.trim() == 'naoautenticado'){
		alert('A senha não corresponde ao telefone.');
	  }
	  
	});
  } 
  
   function login() {

	$.get('controlador.php?action=login', function(retorno) {
	  if(retorno.trim() == 'loginok'){
		return true;
	  }else{
		exibirConsultaNumero();
		return false;
	  }
	}).fail(function(){
		alert("erro ao consultar os dados do processo ");
	});
  } 
  
  
    function cadastrarNovaNoticia() {
		this.login();
		document.getElementById('fundo').style.display = 'block'; 
		document.getElementById("cadastrarNoticia").style.display = 'block'; 
		document.getElementById('editarNoticia').style.display = 'none'; 
		document.getElementById('novaNoticia').style.display = 'block'; 
  }
  
  
   function textoComentarioNoticia() {
		var textoComentario =  document.getElementById('textoComentario').value;
		var loginNumeroTelefoneSessao =  document.getElementById('loginNumeroTelefoneSessao').value;
		if(textoComentario == ''){
			alert('Preencha um comentário.');
			return false;
		}
		if(loginNumeroTelefoneSessao != 'off'){
			this.salvarTextoComentarioNoticia();
		}else{
			this.login();
		}
		
		
		
  }
  
  
    function salvarTextoComentarioNoticia() {
	var textoComentario =  document.getElementById('textoComentario').value;
	var textoComentarioDiv =  document.getElementById('textoComentarioDiv');
	var id_noticia =  document.getElementById('id_noticia').value;
	$.get('controlador.php?action=salvar_texto_comentario_noticia&textoComentario='+textoComentario+'&id_noticia='+id_noticia, function(retorno) {
	  if(retorno.trim() == 'publicado'){
			document.getElementById('textoComentarioDiv').innerHTML = textoComentarioDiv.innerHTML + textoComentario +'<br><br>';
			document.getElementById('textoComentario').value = "";
	  }
	});
  }
  
  
  
    function salvarNovaNoticia() {
	var titulo =  document.getElementById('titulo').value;
	var texto =  document.getElementById('texto').value;
	$.get('controlador.php?action=cadastrar_noticia&titulo='+titulo+'&texto='+texto, function(retorno) {
	  if(retorno.trim() == 'publicado'){
		alert('A noticia foi pulicada com sucesso');
		document.getElementById('cadastrarNoticia').style.display = 'none'; 
		document.getElementById('fundo').style.display = 'none'; 

	  }
	});
  }
  
  function editarNoticia(id) {
		this.login();
		document.getElementById('fundo').style.display = 'block'; 
		document.getElementById("cadastrarNoticia").style.display = 'block'; 
		document.getElementById('id_noticia').value=id;
		$.get('controlador.php?action=consultar_noticia&id_noticia='+id, function(retorno) {
			var ret = retorno.split('===');
			document.getElementById('titulo').value =  ret[0];
			document.getElementById('texto').value = ret[1];
			document.getElementById('editarNoticia').style.display = 'block'; 
			document.getElementById('novaNoticia').style.display = 'none'; 
		});
		
  }
  
  function editarNovaNoticia() {
	var titulo =  document.getElementById('titulo').value;
	var texto =  document.getElementById('texto').value;
	var id_noticia =  document.getElementById('id_noticia').value;
	$.get('controlador.php?action=editar_noticia&titulo='+titulo+'&texto='+texto+'&id_noticia='+id_noticia, function(retorno) {
	  if(retorno.trim() == 'publicado'){
		alert('A noticia foi pulicada com sucesso');
		document.getElementById('cadastrarNoticia').style.display = 'none'; 
		document.getElementById('fundo').style.display = 'none'; 
		window.location.reload();
	  }
	});
  }
  
   function fechar() { 
        document.getElementById('fundo').style.display = 'none'; 
        document.getElementById('autentica').style.display = 'none'; 
        document.getElementById('cadastrarNoticia').style.display = 'none'; 
        document.getElementById('dadosNumero').style.display = 'none'; 
		document.getElementById('dadosNumeroFoto').style.display = 'none';
    }
     function fecharDenunciaNoticia() { 
        document.getElementById('denuciarNoticia').style.display = 'none'; 
		document.getElementById('fundo').style.display = 'none'; 
    }
	
	function fecharDenunciaComentario() { 
        document.getElementById('denuciarComentario').style.display = 'none'; 
		document.getElementById('fundo').style.display = 'none'; 
    }
	
    function logoff() { 
        $.get('logoout.php', function(retorno) {
	  if(retorno.trim() == 'logoffok'){
		alert('voce saiu!');
	  }
	});
	}	
	
	function statusNoticia(e) { 
	var retorno = e.split('=')
	$.get('controlador.php?action=atualizar_status_noticia&status='+retorno[0]+'&id_noticia='+retorno[1], function(retorno) {
	  if(retorno.trim() == 'publicado'){
		window.location.reload();
	  }
	});
    }
	
  	function estadoNoticia(e) { 
	var retorno = e.split('=')
	$.get('controlador.php?action=atualizar_estado_noticia&status='+retorno[0]+'&id_noticia='+retorno[1], function(retorno) {
	  if(retorno.trim() == 'publicado'){
		window.location.reload();
	  }
	});
    }
	
	function estadoImagemNoticia(e) { 
	var retorno = e.split('=')
	$.get('controlador.php?action=atualizar_estado_imagem_noticia&status='+retorno[0]+'&id_imagem='+retorno[1], function(retorno) {
	  if(retorno.trim() == 'publicado'){
		window.location.reload();
	  }
	});
    }
	
	function exibirDadosNumero(id) { 
		document.getElementById('dadosNumero').style.display = 'block'; 
		document.getElementById('fundo').style.display = 'block'; 
		
		$.get('controlador.php?action=consultar_dados_numero&id='+id, function(retorno) {
			document.getElementById('dadosNumeroResultado').innerHTML = retorno;
		  
		}); 
    }
	
	function exibirAdicionarFoto(id) { 
		document.getElementById('dadosNumeroFoto').style.display = 'block'; 
		document.getElementById('fundo').style.display = 'block'; 
		document.getElementById('id_noticia_user').value = id;
		
    }
	function exibirCadastrarNumero(id) { 
		document.getElementById('dadosNumero').style.display = 'block'; 
		document.getElementById('fundo').style.display = 'block'; 
		
		$.get('controlador.php?action=cadastrar_dados_numero', function(retorno) {
			document.getElementById('dadosNumeroResultado').innerHTML = retorno;
		  
		}); 
    }
	
	function editarJornalista() {
	var telefone =  document.getElementById('telefoneUser').value;
	var email =  document.getElementById('email').value;
	var senha =  document.getElementById('senha').value;
	var situacao =  document.getElementById('situacaoUser').value;
	var nome =  document.getElementById('nome').value;
	var id_numero =  document.getElementById('id_numero').value;
	var comentario =  document.getElementById('comentarioSituacaoText').value;
		
	if(telefone.length < 11){
		alert('Por favor, preencha o numero seguindo o formato: (00) 0 0000 0000.');
		return false;
	}
	
	$.get('controlador.php?action=editar_jornalista&telefone='+telefone+'&comentario='+comentario+'&email='+email+'&senha='+senha+'&situacao='+situacao+'&situacao='+situacao+'&nome='+nome+'&id_numero='+id_numero, function(retorno) {
	  if(retorno.trim() == 'editado'){
		alert('A dados foram alterados com sucesso');
		document.getElementById('dadosNumeroResultado').style.display = 'none'; 
		document.getElementById('fundo').style.display = 'none'; 
		window.location.reload();
	  }
	});
  }
  
  	
   function cadastrarJornalista() {
	var telefone =  document.getElementById('telefoneUser').value;
	var email =  document.getElementById('email').value;
	var senha =  document.getElementById('senha').value;
	var situacao =  document.getElementById('situacaoUser').value;
	var nome =  document.getElementById('nome').value;
	var comentario =  document.getElementById('comentarioSituacaoText').value;
	
	if(telefone.length < 11){
		alert('Por favor, preencha o numero seguindo o formato: (00) 0 0000 0000.');
		return false;
	}

	$.get('controlador.php?action=cadastrar_jornalista&telefone='+telefone+'&comentario='+comentario+'&email='+email+'&senha='+senha+'&situacao='+situacao+'&situacao='+situacao+'&nome='+nome, function(retorno) {
	  if(retorno.trim() == 'publicado'){
		alert('A dados foram inseridos com sucesso');
		document.getElementById('dadosNumeroResultado').style.display = 'none'; 
		document.getElementById('fundo').style.display = 'none'; 
		window.location.reload();
	  }else{
		alert('Houve algum erro, verifique se esse numero já esteja cadastrado');
	  }
	});
  }
	
	function situacaoUsuario() {
		alert('Para mudar a situação do usuario é necessário preencher uma justificativa.')
		document.getElementById('comentarioSituacao').style.display = 'block'; 
		
	var telefone =  document.getElementById('telefoneUser').value;
	

  }
	
	
	
	function contarVotoNoticia(voto,id) { 
		$.get('controlador.php?action=contarVotoNoticia&voto='+voto+'&id='+id, function(retorno) {
		  	var ret = retorno.split('===');
			 $("#cliquePositivo").prop('onclick',null).off('click');
			 $("#cliqueNegativo").prop('onclick',null).off('click');
			document.getElementById('resultadoPositivo').innerHTML = ret[0];
			document.getElementById('resultadoNegativo').innerHTML = ret[1];
		}); 
    }
	
	function contarVotoComentario(voto,id,i) { 
		$.get('controlador.php?action=contarVotoComentario&voto='+voto+'&id='+id, function(retorno) {
			var ret = retorno.split('===');
			 $('#cliquePositivo'+i).prop('onclick',null).off('click');
			 $('#cliqueNegativo'+i).prop('onclick',null).off('click');
			document.getElementById('resultadoPositivo'+i).innerHTML = ret[0];
			document.getElementById('resultadoNegativo'+i).innerHTML = ret[1];
		}); 
    }
	
	function denunciarNoticia(id) {
		document.getElementById('idPublicacaoDenunciaNoticia').value = id;
		document.getElementById('denuciarNoticia').style.display = 'block'; 
		document.getElementById('fundo').style.display = 'block'; 
	}


	function denunciarComentario(id) {
		document.getElementById('idPublicacaoDenunciaComentario').value = id;
		document.getElementById('denuciarComentario').style.display = 'block'; 
		document.getElementById('fundo').style.display = 'block'; 
	}
	
	function salvarDenunciaNoticia() { 
		var numero =  document.getElementById('numeroDenunciaNoticia').value;
		var id_publicacao =  document.getElementById('idPublicacaoDenunciaNoticia').value;
		var texto =  document.getElementById('textoDenunciaNoticia').value;
		$.get('controlador.php?action=salvarDenunciaNoticia&numero='+numero+'&id_publicacao='+id_publicacao+'&texto='+texto, function(retorno) {
		
		if(retorno.trim() == 'publicado'){
			alert('Denuncia realizada com sucesso');
			fecharDenunciaNoticia();
		}
		}); 
    }
	
	function salvarDenunciaComentario() { 
		var numero =  document.getElementById('numeroDenunciaComentario').value;
		var id_publicacao =  document.getElementById('idPublicacaoDenunciaComentario').value;
		var texto =  document.getElementById('textoDenunciaComentario').value;
		$.get('controlador.php?action=salvarDenunciaComentario&numero='+numero+'&id_publicacao='+id_publicacao+'&texto='+texto, function(retorno) {
		
		if(retorno.trim() == 'publicado'){
			alert('Denuncia realizada com sucesso');
			fecharDenunciaComentario();
		}
		}); 
    }
	