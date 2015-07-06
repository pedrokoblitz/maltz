/*
 * controlador form galerias
 */ 
Ctrl('galeriasForm',
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

	},

	/**/ 
	salvarOrdem : function(form) {
		var dados = $(form).serialize();
		var resposta = this.boolPostReq('/index.php/api/galerias/ordem/salvar',dados);
		console.log(dados);
		if (resposta) {
			this.msg('galeria ordenada');
		}
	},



	/**/ 
	'#salvar click' : function(el) {
		this.salvar('#form');
	},

	/**/ 
	'#salvarOrdem click' : function(el) {
		this.salvarOrdem('#salvarOrdemForm');
	},	
});
