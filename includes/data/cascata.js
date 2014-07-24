function cascata() {
	var leggeri = 0;
	var leggerissimi = 0;
	var medi = 0;
	var pesanti = 0;
	var burri = 0;
	var totale = [];
	var nomi = "";

	$("kbd li.ingrediente").each(function(i) {
	
		if ($(this).find(".nome").text().toLowerCase().indexOf("burro") != -1) {
			var quantita_burro = $(this).find(".quantita_singola").text();
			burri += 1*quantita_burro;
			nomi += $(this).find(".nome").text() + "; ";
		} else {
			var valore = assegna($(this).find(".nome").text().toLowerCase());
			var quantita = $(this).find(".quantita_singola").text();
			if(valore!=null) {
				nomi += $(this).find(".nome").text() + "; ";


				switch (valore) {
					case "leggerissimo":
						leggerissimi += 1*quantita;
						break;
					case "leggero":
						leggeri += 1*quantita;
						break;
					case "medio":
						medi += 1*quantita;
						break;
					case "pesante":
						pesanti += 1*quantita;
						break;
					default:
						console.log("sono in default di switch valore");
				}
				
			}
		}
	});

	totale.push(leggerissimi);
	totale.push(leggeri);
	totale.push(medi);
	totale.push(pesanti);
	totale.push(burri);


	if (leggerissimi+leggeri+medi+pesanti+burri > 0) {
		disegna(totale);
		$("#elenco_oli_considerati").show();
		$("#elenco_oli_considerati").text("Grassi considerati: " + nomi);
	}
	else {
		$("#canvas").hide();
		$("#info_canvas").hide();
		$("#elenco_oli_considerati").empty().hide();
	}
		    	
}


function assegna(nome) {
	var valore;
	switch(nome) {
		case "olio di abyssinica":
			valore="leggero";
			break;
		case "olio di akashamoni":
			valore="leggero";
			break;
		case "olio di albicocca":
			valore="medio";
			break;
		case "olio di alloro":
			valore="medio";
			break;
		case "olio di amaranto":
			valore="medio";
			break;
		case "olio di andiroba":
			valore="leggero";
			break;
		case "olio di anacardi":
			valore="pesante";
			break;
		case "olio di anguria":
			valore="leggero";
			break;
		case "olio di arachidi":
			valore="medio";
			break;
		case "olio di argan":
			valore="medio";
			break;
		case "olio di avena":
			valore="leggero";
			break;
		case "olio di avocado":
			valore="medio";
			break;
		case "olio di babassu":
			valore="medio";
			break;
		case "olio di baobab":
			valore="medio";
			break;
		case "olio di borragine":
			valore="medio";
			break;
		case "olio di broccoli":
			valore="medio";
			break;
		case "olio di buriti (frutto)":
			valore="medio";
			break;
		case "olio di buriti (seme)":
			valore="medio";
			break;
		case "olio di cacao":
			valore="medio";
			break;
		case "olio di camelia":
			valore="leggero";
			break;
		case "olio di camelina":
			valore="medio";
			break;
		case "olio di canapa":
			valore="medio";
			break;
		case "olio di cartamo":
			valore="medio";
			break;
		case "olio di cetriolo":
			valore="medio";
			break;
		case "olio di chaulmoogra":
			valore="pesante";
			break;
		case "olio di ciliegia":
			valore="medio";
			break;
		case "olio di cocco":
			valore="medio";
			break;
		case "olio di colza":
			valore="medio";
			break;
		case "olio di cotone":
			valore="medio";
			break;
		case "olio di cranberry (o mirtillo rosso)":
			valore="medio";
			break;
		case "olio di cumaru":
			valore="pesante";
			break;
		case "olio di dattero del deserto":
			valore="pesante";
			break;
		case "olio di enotera":
			valore="medio";
			break;
		case "olio di fico d'india":
			valore="medio";
			break;
		case "olio di fragola":
			valore="medio";
			break;
		case "olio di germe di grano":
			valore="medio";
			break;
		case "olio di girasole":
			valore="leggero";
			break;
		case "olio di guanabana (graviola)":
			valore="medio";
			break;
		case "olio di hoax nut":
			valore="medio";
			break;
		case "olio di inca inchi":
			valore="medio";
			break;
		case "olio di jatropha (noce delle barbados)":
			valore="medio";
			break;
		case "olio di jojoba":
			valore="leggero";
			break;
		case "olio di karanja":
			valore="medio";
			break;
		case "olio di karitè":
			valore="leggero";
			break;
		case "olio di kiwi":
			valore="leggero";
			break;
		case "olio di kukui":
			valore="medio";
			break;
		case "olio di lampone":
			valore="medio";
			break;
		case "olio di lino":
			valore="pesante";
			break;
		case "olio di macadamia":
			valore="medio";
			break;
		case "olio di mais":
			valore="medio";
			break;
		case "olio di mandorla di giava (canarium/galip nut)":
			valore="medio";
			break;
		case "olio di mandorla":
			valore="medio";
			break;
		case "olio di mandorle dolci":
			valore="medio";
			break;
		case "olio di mango":
			valore="leggero";
			break;
		case "olio di marula":
			valore="medio";
			break;
		case "olio di meadowfoam (fiore dell'oregon)":
			valore="leggero";
			break;
		case "olio di melograno":
			valore="medio";
			break;
		case "olio di mirtillo (bilberry-non americano)":
			valore="pesante";
			break;
		case "olio di mongongo":
			valore="leggero";
			break;
		case "olio di moringa":
			valore="leggero";
			break;
		case "olio di neem":
			valore="pesante";
			break;
		case "olio di nigella (o cumino nero)":
			valore="medio";
			break;
		case "olio di nocciola":
			valore="leggero";
			break;
		case "olio di nocciola cilena":
			valore="medio";
			break;
		case "olio di noce":
			valore="medio";
			break;
		case "olio di noce brasiliana":
			valore="medio";
			break;
		case "olio di noce pecan":
			valore="medio";
			break;
		case "olio di oliva":
			valore="medio";
			break;
		case "olio di olivello spinoso":
			valore="medio";
			break;
		case "olio di palma":
			valore="leggero";
			break;
		case "olio di palmisto":
			valore="leggero";
			break;
		case "olio di papavero":
			valore="medio";
			break;
		case "olio di papaya":
			valore="pesante";
			break;
		case "olio di passiflora (maracuja)":
			valore="pesante";
			break;
		case "olio di pataua":
			valore="pesante";
			break;
		case "olio di pequi":
			valore="pesante";
			break;
		case "olio di perilla":
			valore="pesante";
			break;
		case "olio di pesca":
			valore="leggero";
			break;
		case "olio di pistacchio":
			valore="leggero";
			break;
		case "olio di pomodoro":
			valore="medio";
			break;
		case "olio di pracaxi":
			valore="medio";
			break;
		case "olio di prugna":
			valore="pesante";
			break;
		case "olio di quinoa":
			valore="leggerissimo";
			break;
		case "olio di ribes nero":
			valore="medio";
			break;
		case "olio di ribes rosso":
			valore="medio";
			break;
		case "olio di ricino":
			valore="pesante";
			break;
		case "olio di riso":
			valore="medio";
			break;
		case "olio di rosa mosqueta":
			valore="pesante";
			break;
		case "olio di sapote":
			valore="medio";
			break;
		case "olio di sesamo":
			valore="medio";
			break;
		case "olio di soia":
			valore="medio";
			break;
		case "olio di tamanu":
			valore="pesante";
			break;
		case "olio di tung (legno cinese/giapponese)":
			valore="pesante";
			break;
		case "olio di vinaccioli":
			valore="medio";
			break;
		case "olio di ximenia":
			valore="medio";
			break;
		case "olio di yangu":
			valore="leggero";
			break;
		case "olio di zigolo dolce":
			valore="medio";
			break;
		case "olio di zucca":
			valore="medio";
			break;
		case "tocoferolo":
			valore="pesante";
			break;
		case "vitamina e":
			valore="pesante";
			break;
		case "2-propyl eptyl caprylate":
			valore="leggerissimo";
			break;
		case "cetearyl octanoate":
			valore="leggerissimo";
			break;
		case "cetiol sensoft":
			valore="leggerissimo";
			break;
		case "coco caprylate":
			valore="leggerissimo";
			break;
		case "coco caprylate/caprate":
			valore="leggerissimo";
			break;
		case "decyl cocoate":
			valore="leggerissimo";
			break;
		case "decyl oleate":
			valore="leggerissimo";
			break;
		case "dicapryl ether":
			valore="leggerissimo";
			break;
		case "dycapryl ether":
			valore="leggerissimo";
			break;
		case "dicaprylyl carbonate":
			valore="leggerissimo";
			break;
		case "dicaprylyl ether":
			valore="leggerissimo";
			break;
		case "dycaprylyl ether":
			valore="leggerissimo";
			break;
		case "ethylhexyl stearate":
			valore="leggero";
			break;
		case "isopropyl lsostearate":
			valore="leggerissimo";
			break;
		case "isopropyl linoleate":
			valore="leggerissimo";
			break;
		case "isopropyl myristate":
			valore="leggerissimo";
			break;
		case "isopropyl palmitate":
			valore="leggerissimo";
			break;
		case "octyl dodecanol":
			valore="leggerissimo";
			break;
		case "octyl dodecanol lactate":
			valore="leggero";
			break;
		case "octyl palmitate":
			valore="leggerissimo";
			break;
		case "oleyl erucate":
			valore="leggerissimo";
			break;
		case "oleyl oleate":
			valore="leggerissimo";
			break;
		case "propylheptyl caprylate":
			valore="leggerissimo";
			break;
		case "trietil citrato":
			valore="pesante";
			break;
		case "triethyl citrate":
			valore="pesante";
			break;
		case "squalene":
			valore="pesante";
			break;
		case "squalano":
			valore="pesante";
			break;
		case "squalano sintetico":
			valore="pesante";
			break;
		case "tocomax":
			valore="pesante";
			break;
		default:
			valore = null;
	}
	return valore;
}

function disegna(dati) {
	$("#canvas").show();
	$("#info_canvas").show();

	var data = dati;
	

	Highcharts.createElement('link', {
   href: 'http://fonts.googleapis.com/css?family=Open+Sans',
   rel: 'stylesheet',
   type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);

Highcharts.theme = {
   colors: ["#2b908f", "#90ee7e", "#f45b5b", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
      "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
   chart: {
      backgroundColor: "transparent",
      style: {
         fontFamily: "'Unica One', sans-serif"
      },
      plotBorderColor: '#606063'
   },
   title: {
      style: {
         color: 'black',
         textTransform: 'uppercase',
         fontSize: '20px'
      }
   },
   subtitle: {
      style: {
         color: 'black',
         textTransform: 'uppercase'
      }
   },
   xAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: 'black'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      title: {
         style: {
            color: '#A0A0A3'

         }
      }
   },
   yAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: 'black'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      tickWidth: 1,
      title: {
         style: {
            color: 'black'
         }
      }
   },
   tooltip: {
      backgroundColor: 'rgba(0, 0, 0, 0.85)',
      style: {
         color: '#F0F0F0'
      }
   },
   plotOptions: {
      series: {
         dataLabels: {
            color: '#B0B0B3'
         },
         marker: {
            lineColor: '#333'
         }
      },
      boxplot: {
         fillColor: '#505053'
      },
      candlestick: {
         lineColor: 'white'
      },
      errorbar: {
         color: 'white'
      }
   },
   legend: {
      itemStyle: {
         color: 'black'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#606063'
      }
   },
   credits: {
      style: {
         color: "transparent"
      }
   },
   labels: {
      style: {
         color: 'black'
      }
   },

   drilldown: {
      activeAxisLabelStyle: {
         color: '#F0F0F3'
      },
      activeDataLabelStyle: {
         color: '#F0F0F3'
      }
   },

   navigation: {
      buttonOptions: {
         symbolStroke: '#DDDDDD',
         theme: {
            fill: '#505053'
         }
      }
   },

   // scroll charts
   rangeSelector: {
      buttonTheme: {
         fill: '#505053',
         stroke: '#000000',
         style: {
            color: '#CCC'
         },
         states: {
            hover: {
               fill: '#707073',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            },
            select: {
               fill: '#000003',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            }
         }
      },
      inputBoxBorderColor: '#505053',
      inputStyle: {
         backgroundColor: '#333',
         color: 'silver'
      },
      labelStyle: {
         color: 'black'
      }
   },

   navigator: {
      handles: {
         backgroundColor: '#666',
         borderColor: '#AAA'
      },
      outlineColor: '#CCC',
      maskFill: 'rgba(255,255,255,0.1)',
      series: {
         color: '#7798BF',
         lineColor: '#A6C7ED'
      },
      xAxis: {
         gridLineColor: '#505053'
      }
   },

   scrollbar: {
      barBackgroundColor: '#808083',
      barBorderColor: '#808083',
      buttonArrowColor: '#CCC',
      buttonBackgroundColor: '#606063',
      buttonBorderColor: '#606063',
      rifleColor: '#FFF',
      trackBackgroundColor: '#404043',
      trackBorderColor: '#404043'
   },

   // special colors for some of the
   legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
   background2: '#505053',
   dataLabelsColor: '#B0B0B3',
   textColor: '#C0C0C0',
   contrastTextColor: '#F0F0F3',
   maskColor: 'rgba(255,255,255,0.3)'
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);

	$('#canvas').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Cascata di Grassi'
            },
            xAxis: {
                categories: ["Leggerissimi", "Leggeri", "Medi", "Pesanti", "Burri"]
            },
            yAxis: {
                title: {
                    text: 'Quantità'
                },
                labels: {
                    formatter: function() {
                        return this.value +'gr'
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            legend: {
            	enabled: false
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Quantità',
                marker: {
                    symbol: 'circle'
                },
                data: data,
                lineWidth: 3
    
            }]
        });

	

}