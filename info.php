<!doctype html>

<?php 
	include 'includes/head.php'; 
?>
<style>
	.lead {
		margin-bottom: 10px;
	}

	#faqs{
		text-align: left;
	}

	.panel img {
		max-width: 100%;
		border: 2px solid #1EA288;
		border-radius: 10px;
		display: block;
		margin: 10px auto;
	}

	.panel-body p {
		font-weight: 200;
	}

	.panel-body a {
		font-weight: 400;
	}

	.panel:nth-of-type(even) .panel-heading{
		background-color: #16A085 !important;
		color: white;
	}

	.panel:nth-of-type(odd) .panel-heading{
		background-color: #136B5A !important;
		color: white;
	}

	.panel-title a:hover {
		color: #dddddd;
	}

	li {
		text-align: left;
		font-weight: 200;
	}

	ul li ul li {
		margin-bottom: 50px;
	}
</style>


	<div class="container">
		<div class="row">
			<div class="col-md-12" style="text-align:center">
				<h1>Informazioni</h1>
				<p class="lead">Creato da <strong><a href="http://lola.mondoweb.net/memberlist.php?mode=viewprofile&u=31791" target="_blank">Augusten</a></strong> per l'<strong><a href="http://lola.mondoweb.net/index.php" target="_blank">Angolo di Lola</a></strong></p>

				<h1> WORK IN PROGRESS (aggiornato ad ottobre 2014) </p>
				
				<button class="btn btn-block btn-primary" id="btn-info-generali">Cos'è questo programma?</button>
				<button class="btn btn-block btn-primary" id="btn-caratteristiche">Caratteristiche e Funzionalità</button>
				
				<div class="separatore"></div>

				<div class="panel panel-default" id="info-generali">
					<div class="panel-heading">
						<h3 class="panel-title">Cos'è questo programma?</h3>
					</div>
					<div class="panel-body">
						<p>ARC (Augusten's Recipe Creator) è un applicativo web sviluppato in collaborazione con gli utenti del <a href="http://lola.mondoweb.net/index.php" target="_blank">Forum di Lola</a>.</p>
				        <p>Questo strumento permette la <u>creazione di ricette cosmetiche</u> seguendo quella che è la teoria cosmetica di auto-produzione più utilizzata.</p>
				        <img src="includes/data/images/faqs/1.jpg" alt="schermata di creazione ricetta"/>
					</div>
				</div>

				<div class="panel panel-default" id="caratteristiche">
					<div class="panel-heading">
						<h3 class="panel-title">Cos'è questo programma?</h3>
					</div>
					<div class="panel-body">
						<p>Con questo applicativo potrai creare e gestire le tue ricette cosmetiche utilizzando diverse funzionalità di controllo e gestione.</p>
				        <ul>
				        	<li>
				        		<b>Creazione ricette:</b>
				        		<ul>
					        		<li>Inserimento ingredienti con nome (autocompletato) e quantità - Fasi - Righe di testo - Righe vuote:
					        			<img src="includes/data/images/faqs/2.jpg" alt="caratteristiche ingredienti-fasi-righe"/>
					        		</li>
					        		<li>Ordina la tua ricetta semplicemente cliccando e trascinando un ingrediente (compatibile con dispositivi touch):
					        			<img src="includes/data/images/faqs/3.jpg" alt="caratteristiche ricetta"/>
					        		</li>
					        		<li>Modifica/Cancella un ingrediente:
					        			<img src="includes/data/images/faqs/4.jpg" alt="caratteristiche ricetta"/>
					        		</li>
					        		<li>Conteggio automatico dell'acqua restante:
					        			<img src="includes/data/images/faqs/5.jpg" alt="caratteristiche ricetta"/>
					        		</li>
					        		<li>Grafico della Cascata di Grassi automatico:
					        			<img src="includes/data/images/faqs/0.jpg" alt="caratteristiche ricetta"/>
					        		</li>
					        		<li>Converti la tua ricetta in quantità diverse da 100g:
					        			<img src="includes/data/images/faqs/6.jpg" alt="caratteristiche ricetta"/>
					        		</li>
					        		<li>Crea un PDF della tua ricetta:
					        			<img src="includes/data/images/faqs/7.jpg" alt="caratteristiche ricetta"/>
					        		</li>
					        		<li>Salva e Carica le tue ricette:
					        			<img src="includes/data/images/faqs/8.jpg" alt="caratteristiche ricetta"/>
					        		</li>
					        		<li>Inserisci direttamente in ricetta gli ingredienti del tuo inventario personale:
					        			<img src="includes/data/images/faqs/9.jpg" alt="caratteristiche ricetta"/>
					        		</li>
					        	</ul>
				        	</li>
				        </ul>

				        <ul>
				        	<li>
				        		<b>Il tuo Profilo:</b>
				        		<ul>
					        		<li>All'interno del tuo profilo trovi le tue ricette salvate e il tuo inventario:
					        			<img src="includes/data/images/faqs/10.jpg" alt="caratteristiche profilo"/>
					        		</li>
					        	</ul>
				        	</li>
				        </ul>

				        <ul>
				        	<li>
				        		<b>Le tue Ricette:</b>
				        		<ul>
					        		<li>Guarda, modifica, gestisci, condividi e ordina in cartelle le tue ricette salvate:
					        			<img src="includes/data/images/faqs/11.jpg" alt="caratteristiche ricette"/>
					        		</li>
					        		<li>Condividi una ricetta e permetti agli utenti di crearne una loro versione basata su quella da te condivisa:
					        			<img src="includes/data/images/faqs/12.jpg" alt="caratteristiche ricette"/>
					        		</li>
					        	</ul>
				        	</li>
				        </ul>

				        <ul>
				        	<li>
				        		<b>Il tuo Inventario:</b>
				        		<ul>
					        		<li>Aggiungi, guarda, modifica, e gestisci gli ingredienti del tuo inventario all'interno di categorie, ognuno con una propria nota. Gli ingredienti aggiunti all'inventario potranno essere comodamente inseriti in ricetta direttamente dalla pagina di creazione:
					        			<img src="includes/data/images/faqs/13.jpg" alt="caratteristiche inventario"/>
					        		</li>
					        	</ul>
				        	</li>
				        </ul>
					</div>
				</div>
				


				<p style="font-size:10px"><a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Licenza Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" /></a><br />Quest'opera è distribuita con Licenza <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Attribuzione - Non commerciale - Non opere derivate 4.0 Internazionale</a>.</p>

			</div>			
		</div>
	</div>

<?php include 'includes/footer.php' ?>


<script type="text/javascript">
$.fn.scrollTo = function( target, options, callback ){
  if(typeof options == 'function' && arguments.length == 2){ callback = options; options = target; }
  var settings = $.extend({
    scrollTarget  : target,
    offsetTop     : 70,
    duration      : 500,
    easing        : 'swing'
  }, options);
  return this.each(function(){
    var scrollPane = $(this);
    var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
    var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop);
    scrollPane.animate({scrollTop : scrollY }, parseInt(settings.duration), settings.easing, function(){
      if (typeof callback == 'function') { callback.call(this); }
    });
  });
}

	var url = document.location.toString();
	if (url.match('#')) {
	    $("body").scrollTo($("#"+url.split('#')[1]));
	} 

	$("#btn-info-generali").click(function() { $("body").scrollTo($("#info-generali")); });
	$("#btn-caratteristiche").click(function() { $("body").scrollTo($("#caratteristiche")); });

</script>













