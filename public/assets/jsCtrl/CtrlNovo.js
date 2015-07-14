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
			"foto": true,
			"fotosUrl": "index.php/api/fotos/listar/100/1/nome/desc",
			"fotosCaminho":"/assets/media/"
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


	/* */ 
	salvar : function(form) {
			var dados = $(form).serialize();
			$.post(this.options.salvarUrl,dados,function(resposta){
		});
		this.msg(this.options.apelido+' salvo');
	},


	/* */ 
	msg : function(texto) {
		$(this.options.elMsg).text(texto);
	},

	/* */ 
	ativar : function(el,url,id) {
		$.get(url,function(){
			
		});
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
		$.get(url,function(){
			
		});

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
		$.get(url,function(){
			
		});

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



