Ctrl('blocosForm',
{
	/**/
	defaults : {
		
	}
},
{
	/* date init */
	init : function(rawEl, rawOptions){ 

		this.traduzir();

		/* wysiwyg */
		$('#blocoCorpo').wysihtml5(this.options.wysiConfig);
		$('#blocoCorpoEn').wysihtml5(this.options.wysiConfig);

	},



});



