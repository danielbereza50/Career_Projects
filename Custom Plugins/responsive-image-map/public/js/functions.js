jQuery(document).ready(function($){
	console.log('Hello World!');
	
	const el = (sel, par) => (par||document).querySelector(sel);
	const elArea  = el("#area");
	
	const elPopupArgentina = el("#popup-argentina");
	const elPopupAChilie = el("#popup-chilie");
	const elPopupAustralia = el("#popup-australia");
	const elPopupNewZealand = el("#popup-new-zealand");
	const elPopupSouthAfrica = el("#popup-south-africa");
	const elPopupPortugal = el("#popup-portugal");
	const elPopupSpain = el("#popup-spain");
	const elPopupFrance = el("#popup-france");
	const elPopupGermany = el("#popup-germany");
	const elPopupItaly = el("#popup-italy");
	const elPopupArmenia = el("#popup-armenia");
	const elPopupGreece = el("#popup-greece");
	const elPopupNorthMacedonia = el("#popup-north-macedonia");
	const elPopupCyrpus = el("#popup-cyprus");
	const elPopupLebanon = el("#popup-lebanon");
	const elPopupAustria = el("#popup-austria");
	
	// USA
	const elPopupWashington = el("#popup-washington-united-states");
	const elPopupMichigan = el("#popup-michigan-united-states");
	const elPopupCalifornia = el("#popup-california-united-states");
	const elPopupOregon = el("#popup-oregon-united-states");
	
	// USA
	const showPopupWashington = (evt) => {	
	  Object.assign(elPopupWashington.style, 
	  {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  }
	 );
	};
	const showPopupMichigan = (evt) => {
	  Object.assign(elPopupMichigan.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupCalifornia = (evt) => {
	  Object.assign(elPopupCalifornia.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupOregon = (evt) => {
	  Object.assign(elPopupOregon.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	// Other
	const showPopupArgentina = (evt) => {
	  Object.assign(elPopupArgentina.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupChilie = (evt) => {
	  Object.assign(elPopupAChilie.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupAustralia = (evt) => {
		if ($(window).width() < 980) {
			Object.assign(elPopupAustralia.style, {
			left: `calc(${evt.clientX}px - 50px)`,
			top: `calc(${evt.clientY}px - 100px)`,
			display: `block`,
		  });
		}else {
			Object.assign(elPopupAustralia.style, {
			left: `calc(${evt.clientX}px + 20px)`,
			top: `calc(${evt.clientY}px - 100px)`,
			display: `block`,
		  });
		}
	}
	const showPopupNewZealand = (evt) => {
		if ($(window).width() < 980) {
			Object.assign(elPopupNewZealand.style, {
			left: `calc(${evt.clientX}px - 55px)`,
			top: `calc(${evt.clientY}px - 80px)`,
			display: `block`,
		  });
		}else {
			Object.assign(elPopupNewZealand.style, {
			left: `calc(${evt.clientX}px - 30px)`,
			top: `calc(${evt.clientY}px - 80px)`,
			display: `block`,
		  });
		}
	}
	const showPopupSouthAfrica = (evt) => {
	  Object.assign(elPopupSouthAfrica.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupPortugal = (evt) => {
	  Object.assign(elPopupPortugal.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupSpain = (evt) => {
	  Object.assign(elPopupSpain.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupFrance = (evt) => {
	  Object.assign(elPopupFrance.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupGermany = (evt) => {
	  Object.assign(elPopupGermany.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupItaly = (evt) => {
	  Object.assign(elPopupItaly.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupArmenia = (evt) => {
	  Object.assign(elPopupArmenia.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupGreece = (evt) => {
	  Object.assign(elPopupGreece.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupNorthMacedonia = (evt) => {
	  Object.assign(elPopupNorthMacedonia.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupCyprus = (evt) => {
	  Object.assign(elPopupCyrpus.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupLebanon = (evt) => {
	  Object.assign(elPopupLebanon.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	const showPopupAustria = (evt) => {
	  Object.assign(elPopupAustria.style, {
		left: `calc(${evt.clientX}px + 25px)`,
		top: `calc(${evt.clientY}px - 50px)`,
		display: `block`,
	  });
	};
	// Washington
	jQuery("#Washington").hover(
		function(e){
			$("#Washington-2").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupWashington);
			$("#popup-washington-united-states").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Washington-2").css({ fill: '' }); 
			$("#popup-washington-united-states").css({ opacity: '0' }); 
		}  // out
	);
	// Michigan
	jQuery("#Michigan").hover(
		function(e){
			$("#michigan polygon, #michigan path").css({ fill: '#a3006a' });
			elArea.addEventListener("mouseover", showPopupMichigan);
			$("#popup-michigan-united-states").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#michigan polygon, #michigan path").css({ fill: '' });
			$("#popup-michigan-united-states").css({ opacity: '0' }); 
		}  // out
	);
	// North Macedonia
	jQuery("#Macedonia").hover(
		function(e){
			$("#Macedonia path").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupNorthMacedonia);
			$("#popup-north-macedonia").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Macedonia path").css({ fill: '' }); 
			$("#popup-north-macedonia").css({ opacity: '0' }); 
		}  // out
	);
	// Argentina
	jQuery("#Argentina").hover(
		function(e){
			$("#Argentina-2").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupArgentina);
			$("#popup-argentina").css({ opacity: '1' }); 
		}, // over
		function(e){ 
			$("#Argentina-2").css({ fill: '' }); 
			$("#popup-argentina").css({ opacity: '0' }); 
		}  // out
	);
	// Chilie
	jQuery("#Chile").hover(
		function(e){
			$("#Chile-2").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupChilie);
			$("#popup-chilie").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Chile-2").css({ fill: '' }); 
			$("#popup-chilie").css({ opacity: '0' }); 
		}  // out
	);
	// New Zealand
	jQuery("#New_Zeland").hover(
		function(e){
			$("#New_Zeland path").css({ fill: '#a3006a' });
			elArea.addEventListener("mouseover", showPopupNewZealand);
			$("#popup-new-zealand").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#New_Zeland path").css({ fill: '' });
			$("#popup-new-zealand ").css({ opacity: '0' }); 
		}  // out
	);
	// Australia
	jQuery("#Australia").hover(
		function(e){
			$("#Australia path").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupAustralia);
			$("#popup-australia").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Australia path").css({ fill: '' }); 
			$("#popup-australia").css({ opacity: '0' }); 
		}  // out
	);	
	// Austria
	jQuery("#Austria").hover(
		function(e){
			$("#Austria path").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupAustria);
			$("#popup-austria").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Austria path").css({ fill: '' }); 
			$("#popup-austria").css({ opacity: '0' }); 
		}  // out
	);	
	// South Africa
	jQuery("#South_Africa").hover(
		function(e){
			$("#South_Africa path").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupSouthAfrica);
			$("#popup-south-africa").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#South_Africa path").css({ fill: '' }); 
			$("#popup-south-africa").css({ opacity: '0' }); 
		}  // out
	);
	// Portugal
	jQuery("#Portugal").hover(
		function(e){
			$("#Portugal path").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupPortugal);
			$("#popup-portugal").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Portugal path").css({ fill: '' }); 
			$("#popup-portugal").css({ opacity: '0' }); 
		}  // out
	);
	// Spain
	jQuery("#Spain").hover(
		function(e){
			$("#Spain path").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupSpain);
			$("#popup-spain").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Spain path").css({ fill: '' }); 
			$("#popup-spain").css({ opacity: '0' }); 
		}  // out
	);
	// California
	jQuery("#California").hover(
		function(e){
			$("#california  path").css({ fill: '#a3006a' });
			elArea.addEventListener("mouseover", showPopupCalifornia);
			$("#popup-california-united-states").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#california  path").css({ fill: '' });
			$("#popup-california-united-states").css({ opacity: '0' }); 
		}  // out
	);
	// Oregon
	jQuery("#Oregon").hover(
		function(e){
			$("#Oregon-2 path").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupOregon);
			$("#popup-oregon-united-states").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Oregon-2 path").css({ fill: '' }); 
			$("#popup-oregon-united-states").css({ opacity: '0' }); 
		}  // out
	);
	// France
	jQuery("#France").hover(
		function(e){
			$("#France path").css({ fill: '#a3006a' });
			elArea.addEventListener("mouseover", showPopupFrance);
			$("#popup-france").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#France path").css({ fill: '' });
			$("#popup-france").css({ opacity: '0' }); 
		}  // out
	);
	// Italy
	jQuery("#Italy").hover(
		function(e){
			$("#Italy path").css({ fill: '#a3006a' });
			elArea.addEventListener("mouseover", showPopupItaly);
			$("#popup-italy").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Italy path").css({ fill: '' });
			$("#popup-italy").css({ opacity: '0' }); 
		}  // out
	);
	// Germany
	jQuery("#Germany").hover(
		function(e){
			$("#Germany path").css({ fill: '#a3006a' });
			elArea.addEventListener("mouseover", showPopupGermany);
			$("#popup-germany").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Germany path").css({ fill: '' });
			$("#popup-germany").css({ opacity: '0' }); 
		}  // out
	);
	// Armenia
	jQuery("#Armenia").hover(
		function(e){
			$("#Armenia path").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupArmenia);
			$("#popup-armenia").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Armenia path").css({ fill: '' }); 
			$("#popup-armenia").css({ opacity: '0' }); 
		}  // out
	);
	// Greece 
	jQuery("#Greece").hover(
		function(e){
			$("#Greece path").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupGreece);
			$("#popup-greece").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Greece path").css({ fill: '' }); 
			$("#popup-greece").css({ opacity: '0' }); 
		}  // out
	);	
	// Lebanon
	jQuery("#Lebanon").hover(
		function(e){
			$("#Lebanon path").css({ fill: '#a3006a' }); 
			elArea.addEventListener("mouseover", showPopupLebanon);
			$("#popup-lebanon").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Lebanon path").css({ fill: '' }); 
			$("#popup-lebanon").css({ opacity: '0' }); 
		}  // out
	);
	// Cyprus
	jQuery("#Cyprus").hover(
		function(e){
			$("#Cyprus path").css({ fill: '#a3006a' });
			elArea.addEventListener("mouseover", showPopupCyprus);
			$("#popup-cyprus").css({ opacity: '1' }); 
		}, // over
		function(e){
			$("#Cyprus path").css({ fill: '' });
			$("#popup-cyprus").css({ opacity: '0' }); 
		}  // out
	);
	
	
	
	
	
	
	
	

	
	


});	