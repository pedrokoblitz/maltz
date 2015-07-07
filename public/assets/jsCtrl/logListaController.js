Ctrl('logLista',
{
	/**/
	defaults : {
	}
},
{
	/* date init */ 
	init : function(rawEl, rawOptions){
		this.traduzir();

	},

	/**/
	'.ativar click' : function(el) {
		var id = $(el).attr('id').split('-');
		this.ativar(el,this.options.ativarUrl+'/'+id[1]);
	},

	/**/
	'.desativar click' : function(el) {
		var id = $(el).attr('id').split('-');
		this.desativar(el,this.options.desativarUrl+'/'+id[1]);
	},

	/**/
	'.apagar click' : function(el) {
		var id = $(el).attr('id').split('-');
		this.apagar(this.options.apagarUrl+'/'+id[1]);
		var elemento = $(el).parents().eq(2).remove();
	}
});

