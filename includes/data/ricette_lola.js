function ricette_lola(ricetta) {
		
		$("#ricetta").empty();
		quantita_totale = 0.0;
		if (ricetta == "ricetta_rosa") {
			alert("La seguente ricetta è ad opera di Lola. Se la usi, ringrazia l'autrice");
			add_fase("Fase A");
			add_ingrediente("Acqua", "64.60");
			add_ingrediente("Carbopol ultrez 21", "0.30");
			add_ingrediente("Xanthana normale", "0.20");
			add_ingrediente("Glicerina", "0.45");
			add_ingrediente("E.G. Caffé verde", "1");
			add_ingrediente("E.G. Tè verde", "1");
			add_ingrediente("Allantoina", "0.35");
			add_ingrediente("Sodio Ialuronato sol. 1%", "5");
			add_ingrediente("Pantenolo", "0.5");
			add_ingrediente("Betaglucano sol. 2%", "5");
			add_riga();
			add_fase("Fase B");
			add_ingrediente("Dry flo", "0.35");
			add_ingrediente("Cetiol Sensoft", "1.5");
			add_ingrediente("Coco Caprylate", "2");
			add_ingrediente("Ethylhexyl Stearate", "3");
			add_ingrediente("Olio di Argan", "1");
			add_ingrediente("Olio di Macadamia", "2");
			add_ingrediente("Olio di Rosa mosqueta", "1");
			add_ingrediente("Squalano sintetico", "1");
			add_ingrediente("Tocomax", "1.5");
			add_ingrediente("Burro di Kokum", "0.75");
			add_ingrediente("Burro di Karitè", "1");
			add_ingrediente("Tinovis ADE", "1");
			add_ingrediente("Abil Care 85", "2");
			add_ingrediente("Phenonip", "0.5");
			add_riga();
			add_fase("Fase C");
			add_ingrediente("AquaShuttle", "2");
			add_ingrediente("Astraforce", "1");
			scrivi_osservazioni("La seguente ricetta è ad opera di Lola. Se la usi, ringrazia l'autrice");
		}

		if (ricetta == "ricetta_siero") {
			alert("La seguente ricetta è ad opera di Ludovica66. Se la usi, ringrazia l'autrice");
			add_fase('Fase A');
			add_ingrediente('Acqua', '45.10');
			add_ingrediente('Xantana', '0.40');
			add_ingrediente('Mg Al Silicate', '0.30');
			add_ingrediente('Betaglucano sol. 2%', '7.00');
			add_ingrediente('Trimetilglicina', '5.00');
			add_ingrediente('Glicerina', '4.00');
			add_ingrediente('Estratto glicolico Tè Verde', '3.00');
			add_ingrediente('Relax rides', '5.00');
			add_ingrediente('Peptide Botox Like', '2.00');
			add_ingrediente('GC-Soy lift', '5.00');
			add_ingrediente('Sodio Ialuronato sol.1.5%', '8.00');
			add_riga();
			add_fase('Fase B');
			add_ingrediente('Coco Caprylate', '1.50');
			add_ingrediente('Cetiol Sensoft', '1.00');
			add_ingrediente('Ethylhexyl Stearate', '0.50');
			add_ingrediente('Olio di Cacao', '0.50');
			add_ingrediente('Olio di Karitè', '0.50');
			add_ingrediente('Phenonip', '0.50');
			add_ingrediente('Abil Care 85', '2.00');
			add_ingrediente('PGE-10 Laurate al 50%', '0.70');
			add_riga();
			add_fase('Fase C');
			add_ingrediente('Liposomi acido jaluronico', '5.00');
			add_ingrediente('Polarsome 3D Hydra', '3.00');
			scrivi_osservazioni("La seguente ricetta è ad opera di Ludovica66. Se la usi, ringrazia l'autrice");

		}

		if (ricetta == "ricetta_iseree") {
			alert("La seguente ricetta è ad opera di Lola. Se la usi, ringrazia l'autrice");
			add_fase("Fase A");
			add_ingrediente("Acqua", "76");
			add_ingrediente("Glicerina", "5");
			add_ingrediente("Cocamidopropyl Betaine", "3");
			add_ingrediente("Sarcosinato", "12");
			add_ingrediente("Lauryl Glucoside", "2");
			add_ingrediente("Phenonip", "0.5");
			add_ingrediente("Polyquaternium-7", "1.5");
			scrivi_osservazioni("La seguente ricetta è ad opera di Lola. Se la usi, ringrazia l'autrice");
		}
		

}