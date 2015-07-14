	/*
 * controlador form projetos
 */ 
Ctrl('projetosForm',
{
	/**/
	defaults : {
		data : {"format":"dd/mm/yyyy"}
	}
},
{
	/* date init */ 
	init : function(rawEl, rawOptions){ 

		var gidEl = $('.galeriaSelecionado');
		if (gidEl.attr('id') !== undefined) {
			var gid = gidEl.attr('id').split('-')[1];
			}
		var galUrl = this.options.seletorCapaUrl+"/"+gid;
		var capaUrl = this.options.selecCapaUrl;
		var that = this;
		$.ajax({type: "GET", url: galUrl, success: function(d){
			$('#seletorCapa .modal-body').html(d);
			that.teste(capaUrl,that);
		}});

		this.traduzir();
		/* date picker */
		$('#data').datepicker(this.options.data);

		/* wysiwyg */ 
		$('#projetoCorpo').wysihtml5(this.options.wysiConfig);
		$('#projetoCorpoEn').wysihtml5(this.options.wysiConfig);


		$('.carousel').carousel('pause');

	},

	teste : function(capaUrl,that) {
			$('#seletorCapa .modal-body img').click(function(){
				$('#seletorCapa .modal-body img').removeClass('galeriaSelecionado');
				var fid = $(this).attr('class').split('-')[1];
				var pid = $('body').attr('id').split('-')[2];
				var url = capaUrl+"/"+pid+"/"+fid;
				var resposta = $.ajax({type: "GET", url: url, async: false});
				
				if (resposta.statusText == 'OK') {
					$('#seletorGaleria img').removeClass('galeriaSelecionado');
					$(this).addClass('galeriaSelecionado');
					that.msg('nova capa selecionada');
				}		
			});
	},
	

	/* selecionar nova galeria */ 
	'.galeria img click' : function(el) {
		var gid = $(el).attr('id').split('-')[1];
		var pid = $('body').attr('id').split('-')[2];
		var url = this.options.selecGalUrl+"/"+pid+"/"+gid;
		var dados = this.boolReq(url);
		var capaUrl = this.options.selecCapaUrl;

		if (dados == true) {
			$('.galeria img').removeClass('galeriaSelecionado');
			$(el).addClass('galeriaSelecionado');
			var galUrl = this.options.seletorCapaUrl+"/"+gid;
			$('#seletorCapaLink').attr('href', galUrl);
			var that = this;
			$.ajax({type: "GET", url: galUrl, success: function(d){
				$('#seletorCapa .modal-body').empty();
				$('#seletorCapa .modal-body').html(d);
				that.teste(capaUrl,that);
			}});
			this.msg('nova galeria selecionada');
		}
	},
	

});



