/*
 * controlador form blocos
 */ 
Ctrl('blocosForm',
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

		/* wysiwyg */
		$('#blocoCorpo').wysihtml5(this.options.wysiConfig);
		$('#blocoCorpoEn').wysihtml5(this.options.wysiConfig);

	},



});



