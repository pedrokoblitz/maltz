$.Controller('Ctrl',
{
	/**/ 
	defaults : {
		componenteId : "",
		ativarUrl : "",
		desativarUrl : "",
		elMsg : "",
		wysiConfig : {
			"font-styles": true, 
			"emphasis": true, 
			"lists": true, 
			"html": true, 
			"link": true, 
			"image": false, 
			"color": true, 
			"foto": false
		},
	}
},
{
	/**/ 
	traduzir : function() {
		$('.en-us').hide();

		$('#traduzir').toggle(
			function(){
				$('.en-us').show();
				$('.pt-br').hide();
			},
			function(){
				$('.en-us').hide();
				$('.pt-br').show();
			}
		);

		$('#traduzir').show();
	},

	/**/ 
	boolReq : function(url) {
		var resposta = $.ajax({type: "GET", url: url, async: false});
		if (resposta.statusText == 'OK') {
			return true;
		} else {
			return false;
		}
	},

	/**/ 
	boolPostReq : function(url,dados) {
		var resposta = $.ajax({type: "POST", data: dados, url: url, async: false});
		if (resposta.statusText == 'OK') {
			return true;
		} else {
			this.msg('algo deu errado');
			return false;
		}
	},

	/**/ 
	salvar : function(form) {
		var dados = $(form).serialize();
		var resposta = this.boolPostReq(this.options.salvarUrl,dados);
		if (resposta) {
			this.msg(this.options.apelido+' salvo');
		}
	},


	/**/ 
	msg : function(texto) {
		$(this.options.elMsg).text(texto);
	},

	/**/ 
	ativar : function(el,url,id) {
		var dados = this.boolReq(url);
		if (dados == true) {
			$(el).removeClass('btn-warning').addClass('btn-success');
			var html = '<div id="'+id+'" class="desativar btn btn-success">ativo</div>';
			var novo = $(html);
			$(el).replaceWith(novo);
			this.msg(this.options.apelido+' ativado');

		}
	},

	/**/ 
	desativar : function(el,url,id) {
		var dados = this.boolReq(url);

		if (dados == true) {
			$(el).removeClass('btn-success').addClass('btn-warning');
			var html = '<div id="'+id+'" class="ativar btn btn-warning">inativo</div>';
			var novo = $(html);
			$(el).replaceWith(novo);
			this.msg(this.options.apelido+' desativado');

		}
	},

	/**/ 
	apagar : function(url) {
		var dados = this.boolReq(url);

		if (dados == true) {
			this.msg(this.options.apelido+' apagado');

		}
	},

	/**/ 
	'#salvar click' : function(el) {
		this.salvar('form');
	},

	/**/ 
	'.ativar click' : function(el) {
		var id = $(el).attr('id').split('-')[1];
		this.ativar(el,this.options.ativarUrl+'/'+id,'desativar-'+id);
	},

	/**/ 
	'.desativar click' : function(el) {
		var id = $(el).attr('id').split('-')[1];
		this.desativar(el,this.options.desativarUrl+'/'+id,'ativar-'+id);
	},

	/**/ 
	'.apagar click' : function(el) {
		var id = $(el).attr('id').split('-')[1];
		this.apagar(this.options.apagarUrl+'/'+id);
		var elemento = $(el).parents().eq(2).remove();
	}
});



