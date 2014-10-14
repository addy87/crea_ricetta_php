<!doctype html>

<?php 
	include 'includes/head.php'; 
	if (logged_in() === true) {
		header("Location: profile.php");
		exit();
	}
?>


	<div class="container animated flipInY">

		<div class="row">
			<div class="col-md-12" style="text-align:center">
				<img src="includes/data/images/arc2.png" width="30%"/>
				<h3>Benvenuto</h3>

				<p style="font-weight: 200">Questa applicazione ti permette di elaborare ricette cosmetiche con tanti strumenti di controllo e gestione. <br>Salva la tua ricetta all'interno del tuo account e modificala come vuoi!</p>

				<p style="font-weight: 200; margin-top:40px">Puoi comunque usare lo strumento <b>anche senza registrarti (cliccando <a href="ricetta.php" style="font-weight:bold">qui</a>)</b>, <span style="text-decoration:underline">ma non potrai salvare la tua ricetta!</span></p>


				<div class="intro">
					<div class="row">
						<div class="col-md-3">
							<a href="register.php"><img src="includes/data/images/registrati.png" width="100"/></a>
						</div>
						<div class="col-md-9">
							<p class="lead "><a href="register.php" style="font-weight:600; font-size:40px">REGISTRA</a> gratuitamente il tuo account ed unisciti a noi! <br>Siamo già in <?php echo user_count();?>!</p>
						</div>
					</div>
				</div>				
			</div>			
		</div>

		
		<div class="intro intro_small">
			<div class="row" style="text-align:center">
				<div class="col-md-3">
					<a href="login_form.php"><img src="includes/data/images/login.png" width="30"/></a>
				</div>
				<div class="col-md-9">
					<p style="margin-bottom:0">Oppure <a href="login_form.php" style="font-weight:600">LOGIN</a>.</p>
				</div>				
			</div>
		</div>
		
	</div>

	<img src="includes/data/images/bubble-sprite.png" id="bubble" class="animated rubberBand"/>



<?php include 'includes/footer.php' ?>

	<div id="facebook-div" style="width: 100%; text-align:center">
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<div class="addthis_native_toolbox"></div>
	<p style="text-align:center;margin-bottom:50px;" class="small">Aiuta questa pagina condividendo l'indirizzo con i tuoi amici :-) grazie!</p>
	</div>
	<p style="font-size:10px; text-align:center"><a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Licenza Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" /></a><br />Quest'opera è distribuita con Licenza <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Attribuzione - Non commerciale - Non opere derivate 4.0 Internazionale</a>.</p>


<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53d1846a1efb1356"></script>

<style>
.addthis_native_toolbox {
	width: 300px;
	margin: 0 auto;
	margin-top:150px;
}
.fb-share-button > span {
	vertical-align: top !important;
}

</style>

<style>
.intro {
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
	border-bottom-right-radius: 5px;
	border-bottom-left-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
	background-color: whitesmoke;	
	padding: 10px 30px 10px 30px;
	border: 1px solid transparent;
	border-bottom: 5px solid transparent;
	border-bottom-color: #34495e;
	border-left-color: #B2C3D5;
	border-right-color: #B2C3D5;
	border-top-color: #B2C3D5;
	margin-top: 50px;

}

.intro_small {
	width: 255px;
	margin:auto;
	margin-top: 70px;
}


.lead {
	margin-bottom: 0;
}

#bubble {
	width: 98px;
	position: fixed;
	right: 36px;
	top: 43px;
	z-index: 999999; 
	-webkit-animation-delay: 2s;
	-webkit-animation-iteration-count: 3;
	-moz-animation-delay: 2s;
	-moz-animation-iteration-count: 3;
	-ms-animation-delay: 2s;
	-ms-animation-iteration-count: 3;
	-o-animation-delay: 2s;
	-o-animation-iteration-count: 3;
	animation-delay: 2s;
	animation-iteration-count: 3;
}

</style>

<script>
$("#bubble").click(function() { $("#bubble").fadeOut(400);});
$(".navbar-toggle").click(function() { $("#bubble").fadeOut(400);});

</script>














