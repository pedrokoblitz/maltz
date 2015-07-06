/*
 * controlador lista log
 */ 
Ctrl('logLista',
{
	/*
	 * configuracoes padrao do controlador
 	 */ 
	defaults : {
	}
},
{
	/* construtor */ 
	init : function(rawEl, rawOptions){
		this.traduzir();

	},

	/* eventos da interface */
	'.ativar click' : function(el) {
		var id = $(el).attr('id').split('-');
		this.ativar(el,this.options.ativarUrl+'/'+id[1]);
	},

	'.desativar click' : function(el) {
		var id = $(el).attr('id').split('-');
		this.desativar(el,this.options.desativarUrl+'/'+id[1]);
	},

	'.apagar click' : function(el) {
		var id = $(el).attr('id').split('-');
		this.apagar(this.options.apagarUrl+'/'+id[1]);
		var elemento = $(el).parents().eq(2).remove();
	}
});

