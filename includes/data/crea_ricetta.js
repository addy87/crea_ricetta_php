

		String.prototype.replaceAll = function(search, replace)
			{
			    //if replace is null, return original string otherwise it will
			    //replace search string with 'undefined'.
			    if(!replace) 
			        return this;

			    return this.replace(new RegExp('[' + search + ']', 'g'), replace);
			};
		$.fn.pulse = function(options) {

		    var options = $.extend({
		        times: 3,
		        duration: 1000
		    }, options);

		    var period = function(callback) {
		        $(this).animate({opacity: 0}, options.duration, function() {
		            $(this).animate({opacity: 1}, options.duration, callback);
		        });
		    };
		    return this.each(function() {
		        var i = +options.times, self = this,
		        repeat = function() { --i && period.call(self, repeat) };
		        period.call(this, repeat);
		    });
		};

		$(document).ready(main);
		$("body").on("mousedown", function() { controllo_modifiche_ricetta(); });

		$(window).unload(controllo_fine);

		window.onunload = window.onbeforeunload = (function(){
		controllo_fine();
		});

		var mancano = 0.0;
		var quantita_totale;

		function controllo_modifiche_ricetta() {
			$("#ricetta li, #ricetta a").mousedown(function() {console.log("click");$("#output").fadeOut(); $("body").focus(); });
			$(".controller button").mousedown(function() {$("#output").fadeOut("slow");});
			$("body").css("height", "auto");
			$("body").css("height", "100%");
		}

		function controllo_inizio() {

				if(localStorage.getItem("backup").length > 10) {

					/*$("#ricetta").html(localStorage.getItem("backup"));
					$("#container1").fadeIn();
					$("#ricetta").fadeIn();
					check();

					$(".modifica").each(function() {
						$(this).unbind("click").click(modifica_ingrediente);
					});*/

					var elenco_funzioni = localStorage.getItem("backup").split("\n");


			    	for (var i in elenco_funzioni) {
			    		var ret = eval(elenco_funzioni[i]);
			    	}
					
				}

				var spuntati = JSON.parse(localStorage.getItem("spuntati"));

				for (var j in spuntati) {


					$("#ricetta li").each(function(){

						if ($(this).find(".nome").text() == spuntati[j]) {

							$(this).addClass("spuntato");
							$(this).find(".lipide").prop('checked', true);
						}
						
					});


					
				}

				
			
		}

		function controllo_fine() {
			var funzioni = "";
			var spuntati = [];
			

			$("#ricetta li").each(function() {
						if(!$(this).hasClass("riga") && !$(this).hasClass("fase") && !$(this).hasClass("testo")){
							var nome = String($(this).find(".nome").text().replaceAll("'", '\\\''));

							var qt = $(this).find(".quantita_singola").text();

							funzioni += "add_ingrediente('"+nome+"','"+parseFloat(qt).toFixed(2)+"')\n";
						} else if($(this).hasClass("fase")) {
							var nome = String($(this).text()).replaceAll("'", '\\\'');
							funzioni += "add_fase('"+nome+"')\n";
						}
					else if ($(this).hasClass("riga")){
						funzioni += "add_riga();\n";
					}
					else {
						var nome = String($(this).find(".contenuto_testo").text()).replaceAll("'", '\\\'');
						funzioni += "add_testo('"+nome+"')\n";
					}
			});

			$("#ricetta li").each(function(){
				if($(this).hasClass("spuntato")) {
					spuntati.push($(this).find(".nome").text());
					
				}
			});

			localStorage.setItem("backup", funzioni);
			localStorage.setItem("spuntati", JSON.stringify(spuntati));
		}

		function main() {

			
			

			autocomplete();

			carica_ricette();

			$("#add_fase").click(add_fase);
			$("#add_ingrediente").click(function() {add_ingrediente(); $("#nome_ingrediente").typeahead('val', ''); });		
			$("#add_riga").click(add_riga);		
			$("#add_testo").click(add_testo);		
			$("#reset").click(reset);


			$(".btn_inventario").click(aggiungi_da_inventario);


			$("#converti").click(converti);

			$("#stampa_semplice").click(stampa_semplice);

			$("#salva_file").click(salva_file);

			$("#print_pdf").click(print_pdf);


			$("#ricetta_rosa").click(function() { ricette_lola("ricetta_rosa"); });
			$("#ricetta_siero").click(function() { ricette_lola("ricetta_siero"); });
			$("#ricetta_iseree").click(function() { ricette_lola("ricetta_iseree"); });

			$("#container1").hide();
			$("#container2").hide();

			$("#container0").removeClass("col-md-4").addClass("col-md-12");

			$("#output").hide();
			$("#canvas").hide();
			$("#info_canvas").hide();

			$("#ricetta").hide();
			$("#ricetta").sortable();
			$("#ricetta").disableSelection();

			$("#convertitore").hide();
			$("#info_convertitore").hide();
			check();

			$("#formo").submit(function(evt) {
								evt.preventDefault();
								$("#nome_ingrediente").val("");
								$("#quantita_ingrediente").val("");
								$("#nome_ingrediente").focus();
							});
			$("#form_convert").submit(function(evt) {
								evt.preventDefault();
								converti();
							});

			

			

			controllo_inizio();
			
		}

		function add_fase(par_nome) {
			if(typeof arguments[0] != "string" || par_nome == null)
				var nome = prompt("Nome della fase? (es. A1 - B - ...)");

			if(typeof arguments[0] == "string" && par_nome != null) {
				nome = par_nome;
				$("#ricetta").fadeIn("slow");
				$("#ricetta").append("<li class='fase'><div class='contenuto_testo'>" + nome + "</div><a href='' style='float:right; color:#d9534f' onClick='$(this).parent().remove(); check(); return false'><span class='glyphicon glyphicon-remove'></span></a></li>");
				check();
				return;
			}else if (nome != "" && nome != null) {
				$("#ricetta").fadeIn("slow");
				$("#ricetta").append("<li class='fase'><div class='contenuto_testo'>Fase " + nome.toUpperCase() + "</div><a href='' style='float:right; color:#d9534f' onClick='$(this).parent().remove(); check(); return false'><span class='glyphicon glyphicon-remove'></span></a></li>");
				check();
			}
		}

		function add_ingrediente(par_nome, par_qt, part_posizione) {


			var nome = $("#nome_ingrediente").val();



			if(typeof arguments[0] == "string" && par_nome != null)
				nome = par_nome;


			if(nome=="")
				return;

			if(nome.indexOf("\\") != -1) {
				alert("Per favore, non usare il carattere '\\'. Al suo posto usa '/' ");
				return;
			}

			var quantita = $("#quantita_ingrediente").val();
			quantita = parseFloat(quantita.replace(',', '.'));


			if(typeof arguments[1] == "string" && par_qt != null)
				quantita = parseFloat(par_qt);


			if(!isNaN(parseFloat(quantita))) {
				$("#ricetta").fadeIn("slow");

				var testo = "<li class='ingrediente'><div class='nome'>"+nome + "</div> <span class='quantita_singola'>" + parseFloat(quantita).toFixed(2) + "</span><div class='controller_elemento'><a href='' style='color:#d9534f' onClick='$(this).parent().parent().remove(); cancella_ingrediente("+quantita+"); return false'><span class='glyphicon glyphicon-remove'></span></a><a href='' style='color:#2887FF;' class='modifica'><span class='glyphicon glyphicon-pencil'></span></a><label class='lipide_caption'>Lipide? <input type='checkbox' name='lipide' class='lipide' style=''/></caption></div></li>";

				if(part_posizione != null && part_posizione != 0) {
					$("#ricetta li:eq("+parseInt(part_posizione-1)+")").after(testo);
				} else {
					$("#ricetta").append(testo);
				}


				$(".modifica").unbind("click").click(modifica_ingrediente);
				
				$(".rimuovi").click(cancella_ingrediente);
				$(".lipide").click(lipide);

				
			}

			check();
		}

		function aggiungi_da_inventario() {
			var nome = $(this).attr("nome");
			console.log(nome);
			var quantita = parseFloat(prompt("Quantità per l'ingrediente " + nome + "?")).toFixed(2);

			if(!isNaN(parseFloat(quantita))) {
				add_ingrediente(nome, quantita);
			}

			$(this).parent().parent().parent().children(".nome-ingrediente-panel").children(".nome-ingrediente-a").click();


		}

		function lipide(e) {
			if ($(this).is(":checked")) {
				$(this).parent().addClass("spuntato");
			} else
				$(this).parent().removeClass("spuntato");

			

			
		}

		function crea_lipide(nome) {

			if(typeof arguments[0] == "string") {
				$("#ricetta li").each(function(){

						if ($(this).find(".nome").text() == nome) {

							$(this).addClass("spuntato");
							$(this).find(".lipide").prop('checked', true);
						}
						
					});
			}
		}

		function cancella_ingrediente(q) {


			check();
		}

		function modifica_ingrediente(e) {
			try{
				e.preventDefault();
			}
			catch(err) {
				console.log(err);
			}

			var posizione = $(this).parent().parent().index();
			var vecchio_nome = $(this).parent().parent()[0]["children"][0]["textContent"];
			var vecchia_quantita = parseFloat($(this).parent().parent()[0]["children"][1]["textContent"]);


			var nuovo_nome = prompt("Nuovo nome dell'ingrediente?", vecchio_nome);
			if (nuovo_nome == '' || nuovo_nome == null)
				return false;

			var nuova_quantita = prompt("Nuova quantita dell'ingrediente?", vecchia_quantita);

			nuova_quantita = parseFloat(nuova_quantita.replace(',', '.'));


			if (nuova_quantita == '' || isNaN(nuova_quantita))
				return false;

			/*var nuovo_html = '<span class="nome">'+nuovo_nome+'</span> <span class="quantita_singola">'+nuova_quantita.toFixed(2)+'</span><a href="" style="float:right; color:#d9534f" onclick="$(this).parent().remove(); cancella_ingrediente('+nuova_quantita+'); return false"><span class="glyphicon glyphicon-remove"></span></a><a href="" style="float:right; color:#2887FF; margin-right:5px" class="modifica2"><span class="glyphicon glyphicon-pencil"></span></a>';
			$(this).parent().html(nuovo_html);

			$(".modifica").click(modifica_ingrediente);

			quantita_totale -= parseFloat(vecchia_quantita);
			quantita_totale += parseFloat(nuova_quantita);*/
			$(this).parent().parent().remove();

			cancella_ingrediente(vecchia_quantita);
			add_ingrediente(nuovo_nome, String(nuova_quantita), posizione);
			check();


			return false;

		}

		function add_riga() {
			$("#ricetta").fadeIn("slow");
			var li = $("<li class='riga'>");
			li.html("<a href='' style='float:right; color:#d9534f' onClick='$(this).parent().remove();check(); return false'><span class='glyphicon glyphicon-remove'></span></a>");
			li.css("height", "38px");
			$("#ricetta").append(li);
			check();
		}

		function add_testo(pre_testo) {
			var testo = "";
			$("#ricetta").fadeIn("slow");
			var li = $("<li class='testo'>");
			
			if(typeof arguments[0] == "string")
				testo = pre_testo;
			else
				testo = prompt("Digita il testo da inserire nella riga (es. OE Limone 6gtt)");

			if (testo != "" && testo != null) {
				li.html("<div class='contenuto_testo'>" +testo +"</div>" + "<a href='' style='color:#d9534f; margin-right: 19px' onClick='$(this).parent().remove();check(); return false'><span class='glyphicon glyphicon-remove'></span></a><a href='' style='color:#2887FF;' class='modifica_testo' ><span class='glyphicon glyphicon-pencil'></span></a>");
				$("#ricetta").append(li);
				$(".modifica_testo").click(modifica_testo);
			}
			check();
		}

		function modifica_testo(e) {
			
			var vecchio_testo = $(this).parent().find(".contenuto_testo").text();

			var nuovo_testo = prompt("Inserisci il nuovo testo:", vecchio_testo);
			if (nuovo_testo != "" && nuovo_testo != null) {
				$(this).parent().find(".contenuto_testo").text(nuovo_testo)
			}

			
			return false;
		}

		function add_acqua(q) {

			q = parseFloat(q);

			add_ingrediente("Acqua", q);
			
			check();
		}

		function check() {

			quantita_totale = 0.0;

			if($("#ricetta").find("li").length > 0) {
				$("#reset").show();
				$("#totale").fadeIn("slow");
				$("#container0").removeClass("col-md-12").addClass("col-md-4");
				$("#container1").fadeIn("slow");
				$("#container2").fadeIn("slow");
			} else {
				$("#reset").hide();
				$("#totale").fadeOut("slow");
				$("#container1").fadeOut("slow");
				$("#container2").fadeOut("slow");
				$("#container0").removeClass("col-md-4").addClass("col-md-12");
			}


			$("#ricetta li").each(function() {
				if($(this).hasClass("ingrediente")){
					quantita_totale += parseFloat($(this)[0]["children"][1]["textContent"]);
				}
			} );

			var mancano = parseFloat(100-quantita_totale);
			

			if (mancano.toFixed(2) == 0 && quantita_totale.toFixed(2) == 100)
				$("#totale").html("<p style='font-weight:bold'>Totale: " + quantita_totale.toFixed(2) + "g</p>");
			else if (mancano.toFixed(2) > 0 && quantita_totale.toFixed(2)>0) {
				$("#totale").html("<p style='font-weight:bold'>Totale: " + quantita_totale.toFixed(2) + "</p><p>Mancano " + mancano.toFixed(2) + "g per arrivare a 100g. <a onClick='add_ingrediente("+"\"Acqua\",\""+mancano.toFixed(2)+"\"); return false' href=''>Vuoi aggiungerli in acqua? <img src='includes/data/images/water.png' width='24' /></a></p>");
			} else if (quantita_totale < 0 ) {
				$("#totale").html("<p class='antimateria animated tada' style='font-weight:bold; color:red; font-size:20px'>Totale: " + quantita_totale.toFixed(2) + "g. MATERIA A MASSA NEGATIVA creata <br> DISTRUZIONE UNIVERSO IN CORSO....</p>");

				setTimeout(function() {$(".antimateria").removeClass("tada");$(".antimateria").addClass("hinge");}, 4000);

			} else if (mancano.toFixed(2) == 100 && quantita_totale.toFixed(2) == 0) {
				$("#totale").html("<p style='font-weight:bold'>Totale: " + quantita_totale.toFixed(2) + "g</p>");
			} else if (mancano.toFixed(2) < 0) {
				$("#totale").html("<p style='font-weight:bold'>Totale: " + quantita_totale.toFixed(2) + "</p><p>Devi togliere " + (mancano.toFixed(2)*-1) + "g per arrivare a 100g.</p>");
			}

			

			$("body").css("height", $(document).height());
			
			
			return quantita_totale.toFixed(2);

		}

		function reset() {
			var ok = confirm("Sei sicuro di voler eliminare la ricetta a schermo?");

			if (ok) {
				$("#reset").fadeOut(300);
				$("#totale").fadeOut(300);
				$("#output").fadeOut(300);
				$("#ricetta").fadeOut(300, function() { $(this).empty(); $("#totale").empty(); $("#output kbd").empty(); check();});

				quantita_totale = 0;

				$("#files").val("");
				window.scrollTo(0,0);
				$("body").css("height", "auto");
				$("body").css("height", "100%");
			}


		}

		function stampa_semplice() {
			check();
			$("#output").fadeIn("slow");
			$("#output kbd").html($("#ricetta").html());
			$("#output kbd a").replaceWith("");
			localStorage.setItem('ricetta', $("kbd").html());
			var quantita_totale = check();

			if (quantita_totale != 100.00) {
				$(".convertitore").hide();
				$(".info_convertitore").show();
			} else {
				$(".convertitore").show();
				$(".info_convertitore").hide();
			}
			$("#totale_kbd").text("Totale: " + parseFloat(quantita_totale).toFixed(2));
			$("kbd li .lipide").remove();
		  	$("kbd li .lipide_caption").remove();
		  	$("#canvas").attr("width", $(".well").width());
		  	$("kbd li.ingrediente .nome").css("width", "auto");
			inci();
			cascata();

    		$('html, body').animate({
        		scrollTop: $("#stampa_semplice").offset().top-80
    		}, 1000);

		}

		function converti() {
			var totale_kbd = 0.0;
			var quantita_scelta = parseFloat($("#quantita_ricetta").val()).toFixed(2);
			var quantita_totale = check();	

			if (!isNaN(quantita_scelta)) {		
				var ricetta = $(localStorage.getItem('ricetta'));
				var ricette = ricetta.find(".quantita_singola");

				var fattore = parseFloat(quantita_scelta/quantita_totale).toFixed(2);

				$("kbd li .quantita_singola").each(function(j) {
					$(this).text(parseFloat(ricette[j]["innerHTML"]*fattore).toFixed(2));
					totale_kbd += ricette[j]["innerHTML"]*fattore;
				});

				$("#totale_kbd").text("Totale: " + parseFloat(totale_kbd).toFixed(2));
				
				$("#quantita_ricetta").focus();
			}
			
		}

		function print_pdf() {
			var nome = prompt("Dai un titolo alla tua ricetta");

			if (nome == "" || nome == null)
				return;

			var elementi = [];
			elementi.push(nome);
			$(".well kbd li").each(function () {
				elementi.push($(this).text());
			})

			elementi.push($("#totale_kbd").text());
			var elementi2 = elementi.join("@@@@");
			

			var form = document.createElement('form');
			form.style.display = "none";
			form.action = "http://augusten.altervista.org/crea-ricetta/includes/data/mpdf/create_pdf.php";
			form.method = "get";
			// for each of your input variables:
			var input = document.createElement('input');
			input.name = "html_ricetta";
			input.value = elementi2;
			form.appendChild(input);
			// After the last input:
			document.body.appendChild(form);
			form.submit(); 
		}

		
		function inci() {
		  	var grassi = 0;
		  	

		  	$("#ricetta li").each(function(){
		  		if($(this).find(".lipide").prop('checked')) {
		  			grassi += parseFloat($(this).find(".quantita_singola").text());
		  		}

		  	});
		  	if (grassi != 0) {
		  		$("#grassi").show();
		  		$("#grassi").text("Grassi: " + grassi + "%");
		  	} else {
		  		$("#grassi").empty().hide();
		  	}
		  	
		}


		function carica_ricette() {
			$.get( "core/functions/ricette_functions.php", { carica_ricette: "" } )
			.done(function(data) {
				$("#caricatore_ricette").remove();
				$("#aggiornatore_ricette").remove();
				if(data.length > 0) {
					$("#aggiorna").show();
					$("#avanzate").append('<span id="caricatore_ricette"><div class="separatore"></div><div class="controller controller_load"><p>Carica una ricetta salvata:</p><select id="ricette_salvate" class="form-control">'+data+"</select><button class='btn btn-sm btn-success' id='carica_ricetta' onclick='carica_ricetta()'>Carica</button></div></span>");
					$("#aggiorna_ricetta").append('<span id="aggiornatore_ricette"><div class="col-md-9"><select id="ricette_aggiorna" class="form-control">'+data+'</select></span></div><div class="col-md-3"><button class="btn btn-block btn-info" id="aggiorna_ricetta_btn" onclick="aggiorna_ricetta()">Aggiorna</button></div></span>');
				} else {
					$("#aggiorna").hide();
					$("#avanzate").append("<div class='separatore'></div><p>Gli utenti registrati possono caricare da qui le loro ricette salvete.<br><a href='register.php'>Registrati</a> anche tu :-)</p>")
				}
				
			});
		}

		function carica_ricetta() {
			var id = $("#ricette_salvate").val();
			$.get( "core/functions/ricette_functions.php", { carica_ricetta: id } )
			.done(function(data) {
				$("#ricetta").empty();
				eval(data);
			});
		}

		function aggiorna_ricetta() {
			var id = $("#ricette_aggiorna").val();
			var elenco_funzioni = "";

			$("#ricetta li").each(function(i) {

				if($(this).hasClass("fase") || $(this).hasClass("riga") || $(this).hasClass("testo")) {

					if($(this).hasClass("fase")) {
						var nome = String($("#ricetta li")[i].textContent).replaceAll("'", '\\\'');;

						elenco_funzioni += "add_fase('" + nome + "');\n";

					}else if ($(this).hasClass("testo")){
						var nome = String($(this)[0]["children"][0].textContent).replaceAll("'", '\\\'');
						elenco_funzioni += "add_testo('"+nome+"');\n";
					}else {
						elenco_funzioni += "add_riga();\n";
					}

				

				} else {
					var nome = String($(this)[0]["children"][0]["textContent"]).replaceAll("'", '\\\'');

					elenco_funzioni += "add_ingrediente('"+nome+"', '"+$(this)[0]["children"][1]["textContent"]+"');\n";

				}
			} );

			$("#ricetta li").each(function() {
				if($(this).hasClass("spuntato")) {
					var nome = $(this).find(".nome").text().replaceAll("'", '\\\'');
					elenco_funzioni += "crea_lipide('"+nome+"');\n";
				}
			});
			$.get( "core/functions/ricette_functions.php", { aggiorna_ricetta: id, code_ricetta: elenco_funzioni } )
			.done(function(data) {
				alert("Ricetta aggiornata!");
				$("#aggiorna").click();
			});
		}

		function salva_file() {

			var nome = prompt("Dai un nome alla ricetta. Evita i caratteri speciali come ! o @");


			if (nome == "" || nome == null || nome.length == 0 || nome == " ") {
				return;
			}


			var elenco_funzioni = "";

			$("#ricetta li").each(function(i) {

				if($(this).hasClass("fase") || $(this).hasClass("riga") || $(this).hasClass("testo")) {

					if($(this).hasClass("fase")) {
						var nome = String($("#ricetta li")[i].textContent).replaceAll("'", '\\\'');;

						elenco_funzioni += "add_fase('" + nome + "');\n";

					}else if ($(this).hasClass("testo")){
						var nome = String($(this)[0]["children"][0].textContent).replaceAll("'", '\\\'');
						elenco_funzioni += "add_testo('"+nome+"');\n";
					}else {
						elenco_funzioni += "add_riga();\n";
					}

				

				} else {
					var nome = String($(this)[0]["children"][0]["textContent"]).replaceAll("'", '\\\'');

					elenco_funzioni += "add_ingrediente('"+nome+"', '"+$(this)[0]["children"][1]["textContent"]+"');\n";

				}
			} );

			$("#ricetta li").each(function() {
				if($(this).hasClass("spuntato")) {
					var nome = $(this).find(".nome").text().replaceAll("'", '\\\'');
					elenco_funzioni += "crea_lipide('"+nome+"');\n";
				}
			});


			$.post( "core/functions/ricette_functions.php", { salva_ricetta: elenco_funzioni, titolo_ricetta: nome } )
			.done(function(data) {
				alert(data);
				carica_ricette();			
			});

		}


		function eval_funzioni(funzioni) {
			setTimeout(function() { 
				$("#ricetta li").remove();
				$("#ricetta").show();
				eval(funzioni);

			 } , 100);
			
		}










