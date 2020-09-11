function removeDiv(id) {
	$(id).remove();
}
$(document).ready(function() {
	$('.buscarCliente').each(function(index, el) {
		buscarCliente($(this) ); 
	});
	$('.buscarMedico').each(function(index, el) {
		buscarMedico($(this) ); 
	});
	$('.buscarExecutante').each(function(index, el) {
		buscarExecutante($(this) ); 
	});
});
function limparCampos(classe) {
	$('.'+classe).val(null);

	$('.'+classe).each(function(index, el) {
		if( $(el).attr('type') == 'radio' )
			$(el).prop('checked',false);
	});
}
function salvarDescricao($this) {

	$.ajax({
		method: "GET",
		url: "/prontuarios/salvarDescricao/"+$($this).attr('data-id')+'?descricao='+$($this).val(),
		dataType: "json",
		success: function( data ) {
			alertify.success('Texto salvo');
		},
		error: function(data) {
		}
	});

}
function importarGuia(select) {
	formExportar = '.formguia'+$(select).val();
	formImportar = '.formguia';

	$(formExportar+" input, "+formExportar+" textarea").each(function(index, el) {
		valorName = $(el).attr('name');
		if ( $(el).attr('type') == 'radio' ) {
			if ($(el).is(':checked')) {
			$(formImportar+" input[name='"+valorName+"']").each(function(index, elradio) {
				if ($(elradio).val() == $(el).val() ) {
					console.log("Valor atribuido: "+$(el).val());
					console.log(el);
					$(elradio).prop('checked',true);
				}
			});

			}
		}else{
			$(formImportar+" input[name='"+valorName+"']").val($(el).val());
			$(formImportar+" textarea[name='"+valorName+"']").val($(el).val());
		}
//console.log(el);

	});

	alert('importado');
	//$(select).val(null);
}
var prontuario = 0;
function buscarMedico($this) {
	$this.autocomplete({
		minLength: 0,
		source: function(request, response) {
			$.ajax({
				method: "GET",
				url: '/buscaRapida/medico?valor='+request.term,
				dataType: "json",
				data: {},
				success: function(data) {
					response(data);
				}
			});
		},
		focus: function(event, ui) {
			$($this).val(ui.item.medicoSolicitante);
			return false;
		},
		select: function(event, ui) {
			$(this).val(ui.item.medicoSolicitante);
			return false;
		}
	}).autocomplete("instance")._renderItem = function(ul, item) {
		return $("<li>")
		.append("<div>" + item.medicoSolicitante + "</div>")
		.appendTo(ul);
	};
}
function buscarExecutante($this) {
	$this.autocomplete({
		minLength: 0,
		source: function(request, response) {
			$.ajax({
				method: "GET",
				url: '/buscaRapida/profissionalexecutante?valor='+request.term,
				dataType: "json",
				data: {},
				success: function(data) {
					response(data);
				}
			});
		},
		focus: function(event, ui) {
			$($this).val(ui.item.nomeProfissional);
			return false;
		},
		select: function(event, ui) {
			$(this).val(ui.item.nomeProfissional);
			$('#documento'+$(this).attr('data-id')).val(ui.item.documentoProfissional);
			if (ui.item.tipodocumentoProfissional=='CPF') {
				$('#tipodocumento'+$(this).attr('data-id')+'CPF').prop('checked',true);
			}else{
				$('#tipodocumento'+$(this).attr('data-id')+'CNS').prop('checked',true);
			}
			return false;
		}
	}).autocomplete("instance")._renderItem = function(ul, item) {
		return $("<li>")
		.append("<div>" + item.nomeProfissional + ", Tipo Doc. "+item.tipodocumentoProfissional+", nº "+item.documentoProfissional+"</div>")
		.appendTo(ul);
	};
}
var prontuario = 0;
function limparDatas(id) {
	prontuario = 0;
	$(".listaDatas"+id).html('');
}
function addProntuario(id) {
	const data =  moment($('#dataInicio'+id).val());

	data.subtract(1, "d");
	diaSorte = 1+Math.floor(Math.random()*5);
	mesVirgente = null;
	for (var i = 0; i < $('#qtddatas'+id).val(); i++) {

		prontuario++;
		if (i%7==0) {
			diaSorte = Math.floor(Math.random()*5);
		}
		diainValido = false;

		while (!diainValido) {
			
			data.add(1, "d");
			if ((data.day() != 0 && data.day() != 6 && data.day()!= diaSorte) || (data.day() != 0 && data.day() != 6 && data.format("DD") > 16 )  ) {
				diainValido = true;
			}
			
		}
		if(mesVirgente==null) mesVirgente = data.month();
		if(mesVirgente != data.month()) break;

		var variaveis = [];
		variaveis.push({nome:'VCOUNT',valor:''+prontuario});
		variaveis.push({nome:'VDATA',valor:''+data.format("YYYY-MM-DD")});
		variaveis.push({nome:'modeloName',valor:'prontuarioDatas'});
		variaveis.push({nome:'obrigatorio',valor:'required=""'});
		html = $("#prontuariodatasMod").html();
		variaveis.forEach( function(element, index) {
			html = html.split(element.nome).join(""+element.valor);
		});

		$(".listaDatas"+id).append(html);
	}
	alert('Datas Geradas');
}
function calculaNovaData(data, dias, direcao) {
	if (dias == 0) {
		return data;
	}
	isSabadoUtil = false;
	var isFimDeSemana;

    // adiciona/subtrai um dia 
    data.setDate(data.getDate() + direcao);
    //Verifica se o dia é util
    if (isSabadoUtil) {
    	isFimDeSemana = data.getDay() in { 0: 'Sunday' };
    }
    else {
    	isFimDeSemana = data.getDay() in { 0: 'Sunday', 6: 'Saturday' };
    }
    //Se for util remove um dia 
    if (!isFimDeSemana) { dias--; }

    return calculaNovaData(data, dias, direcao);
}
var selectCount = 0;
function idAleatorio($this) {
	id = 'undefined';
	modal = $this.closest(".modal-body");
	if(modal!=null && modal != "undefined"){
		if( typeof $(modal).attr('id') == "undefined" ){
			$(modal).attr('id', 'select'+selectCount);
		}
		id = $(modal).attr('id');
	}
	selectCount++;
	return id;
}
function buscarCliente($this) {
	if(typeof $($this).attr('data-select2-id') != "undefined") return false;
	var parente =  idAleatorio($this);

	if(typeof $($this).attr('title') == "undefined") $($this).attr('title','Buscar paciente...');

	if(typeof parente == "undefined"){
		parente = "";
	}else{
		parente = $("#"+parente);
	}
    //console.log($this);
    $this.select2({
    	placeholder: $($this).attr('title'),
    	allowClear: true,
    	language: {
    		"noResults": function(){
    			return  'Buscar...';
    		}
    	},
    	ajax: {
    		dataType: 'json',
    		url: function (params) {
    			return '/buscaRapida/cliente?valor='+params.term;
    		},
    		processResults: function (data) {
    			return {
    				results:  jQuery.map(data, function (item) {
    					return {
    						text: item.nome+", CPF "+item.CPF,
    						id: item.id
    					}
    				})
    			};
    		}

    	},
    	dropdownParent: parente,
    });
}

