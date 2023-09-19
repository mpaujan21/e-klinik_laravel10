jQuery(function(){

	function drawDiente(svg, parentGroup, diente){
		if(!diente) throw new Error('Error no se ha especificado el diente.');
            
		var x = diente.x || 0,
			y = diente.y || 0;

		// console.log(diente.id);
			
		// Default layout
		var color = 'white';
		var colorI = 'white';
		var colorS = 'white';
		var colorZ = 'white';
		var colorD = 'white';
		var colorC = 'white';
		var stroke = 'navy';
		var strokeWidth = 0.5;

		// Berdasarkan kondisi gigi
		if (diente.id=="mis") {
			color = 'red';
			colorC = 'red';
			colorS ='red';
			colorI = 'red';
			colorZ = 'red';
			colorD = 'red';
		}else  if (diente.id=="amf") {
			colorC = 'black';
		}else  if (diente.id=="gif") {
			colorC = 'green';
		}else  if (diente.id=="fis") {
			colorC = 'red';
		}
		else  if (diente.id=="car") {
		   stroke = 'black';
		   strokeWidth = 1.5;
		}else  if (diente.id=="nvt") {
			colorS = 'black';
		}
		else  if (diente.id=="cfr") {
		  colorC = 'black';
		  colorS = 'black';
		  colorI = 'black';
		}else  if (diente.id=="amf") {
			colorC = 'black';
			colorS = 'black';
		}
		else  if (diente.id=="poc") {
			colorC = 'green';
			color = 'green';
			colorC = 'green';
			colorS ='green';
			colorI = 'green';
			colorZ = 'green';
			colorD = 'green';
			stroke = 'black';
		}
		else  if (diente.id=="fmc") {
			colorC = 'black';
			color = 'black';
			colorC = 'black';
			colorS ='black';
			colorI = 'black';
			colorZ = 'black';
			colorD = 'black';
			stroke = 'black';
			strokeWidth = 0.7;
		}
		else  if (diente.id=="abu") {
			colorC = 'grey';
			color = 'grey';
			colorC = 'grey';
			colorS ='grey';
			colorI = 'grey';
			colorZ = 'grey';
			colorD = 'grey';
		}
		
		var iPoloygon = {fill: colorI, stroke: stroke, strokeWidth: strokeWidth};
		var sPoloygon = {fill: colorS, stroke: stroke, strokeWidth: strokeWidth};
		var dPoloygon = {fill: colorD, stroke: stroke, strokeWidth: strokeWidth};
		var zPoloygon = {fill: colorZ, stroke: stroke, strokeWidth: strokeWidth};
		var cPoloygon = {fill: colorC, stroke: stroke, strokeWidth: strokeWidth};

		// Elemen2 polygon
		var dienteGroup = svg.group(parentGroup, {transform: 'translate(' + x + ',' + y + ')'});

		var caraSuperior = svg.polygon(dienteGroup,
			[[0,0],[20,0],[15,5],[5,5]],  
		    sPoloygon);
	    caraSuperior = $(caraSuperior).data('cara', 'S');
		
		var caraInferior =  svg.polygon(dienteGroup,
			[[5,15],[15,15],[20,20],[0,20]],  
		    iPoloygon);			
		caraInferior = $(caraInferior).data('cara', 'I');

		var caraDerecha = svg.polygon(dienteGroup,
			[[15,5],[20,0],[20,20],[15,15]],  
		    dPoloygon);
	    caraDerecha = $(caraDerecha).data('cara', 'D');
		
		var caraIzquierda = svg.polygon(dienteGroup,
			[[0,0],[5,5],[5,15],[0,20]],  
		    zPoloygon);
		caraIzquierda = $(caraIzquierda).data('cara', 'Z');		    
		
		var caraCentral = svg.polygon(dienteGroup,
			[[5,5],[15,5],[15,15],[5,15]],  
		    cPoloygon);	
		caraCentral = $(caraCentral).data('cara', 'C');		 

	    // TODO center text in svg
		var caraCompleto = svg.text(dienteGroup, 4, 30, diente.id.toString(), 
	    	{fill: 'navy', stroke: 'navy', strokeWidth: 0.1, style: 'font-size: 6pt;font-weight:normal;text-align: center;'});
    	caraCompleto = $(caraCompleto).data('cara', 'X');
		// End of Elemen2 polygon
    	
		var tratamientosAplicadosAlDiente = ko.utils.arrayFilter(vm.tratamientosAplicados(), function(t){
			return t.diente.id == diente.id;
		});

		var caras = [];
		caras['S'] = caraSuperior;
		caras['C'] = caraCentral;
		caras['X'] = caraCompleto;
		caras['Z'] = caraIzquierda;
		caras['D'] = caraDerecha;

		for (var i = tratamientosAplicadosAlDiente.length - 1; i >= 0; i--) {
			var t = tratamientosAplicadosAlDiente[i];
			caras[t.cara].attr('fill', 'red');
		};
	};
	
	$("#updateSVG").click(function() {
		// Elemen dan kondisi gigi yang dipilih di form
		var elemen_gigi = $("#elemen_gigi").val();
		var kondisi_gigi = $("#kondisi_gigi").val();

		var elemen_gigis = $("#elemen_gigis").val();
		var pemeriksaan_gigis = $("#pemeriksaan_gigis").val();

		var itemElemenGigi = JSON.parse(elemen_gigis);
		var itemPemeriksaan = JSON.parse(pemeriksaan_gigis);

		// Dua array ke dict
		var dict = {}
		for (var i = 0; i < itemElemenGigi.length; i++)
			dict[itemElemenGigi[i]] = itemPemeriksaan[i];

		// Update dict berdasarkan form
		dict[elemen_gigi] = kondisi_gigi;

		// Dict ke dua array lagi
		itemElemenGigi = [];
		itemPemeriksaan = [];
		for (const key in dict) {
			itemElemenGigi.push(key);
			itemPemeriksaan.push(dict[key]);
		}

		elemen_gigis = JSON.stringify(itemElemenGigi);
		pemeriksaan_gigis = JSON.stringify(itemPemeriksaan);

		document.getElementById('elemen_gigis').value = elemen_gigis;
		document.getElementById('pemeriksaan_gigis').value = pemeriksaan_gigis;

		// Update SVG
		vm = new ViewModel();
		ko.applyBindings(vm);
		renderSvg();
	});

	function renderSvg(){
		console.log('update render');

		var svg = $('#odontograma').svg('get').clear();
		var parentGroup = svg.group({transform: 'scale(2.0)'});
		var dientes = vm.dientes();
		for (var i =  dientes.length - 1; i >= 0; i--) {
			var diente =  dientes[i];
			var dienteUnwrapped = ko.utils.unwrapObservable(diente); 
			drawDiente(svg, parentGroup, dienteUnwrapped);
		};
	}

	function DienteModel(id, x, y, itemPemeriksaan){
		var self = this;
		var lbl = id;

		if (itemPemeriksaan != null){
			if (itemPemeriksaan != "sou") {
				lbl = itemPemeriksaan;
			}
		}

		self.id = lbl;	
		self.x = x;
		self.y = y;		
	};

	function ViewModel(){
		var self = this;

		self.tratamientosPosibles = ko.observableArray([]);
		self.tratamientoSeleccionado = ko.observable(null);
		self.tratamientosAplicados = ko.observableArray([]);

		self.quitarTratamiento = function(tratamiento){
			self.tratamientosAplicados.remove(tratamiento);
			renderSvg();
		}

		var elemen_gigis = $("#elemen_gigis").val();
		var pemeriksaan_gigis = $("#pemeriksaan_gigis").val();
		console.log(elemen_gigis);
		console.log(pemeriksaan_gigis);

		var itemElemenGigi = JSON.parse(elemen_gigis);
		var itemPemeriksaan = JSON.parse(pemeriksaan_gigis);

		var dientes = [];
		
		// 18 to 11
		for(var i = 0; i < 8; i++){
			var resultPemeriksaan = "";
			itemElemenGigi.find((value, index) => {
				if (value == 18 - i) {
					resultPemeriksaan = itemPemeriksaan[index];
				}
				
			});

			dientes.push(new DienteModel(18 - i, i * 25, 0, resultPemeriksaan));	
		}

		// 55 to 51
		for(var i = 3; i < 8; i++){
			var resultPemeriksaan = "";
			itemElemenGigi.find((value, index) => {
				if (value == 58 - i) {
					resultPemeriksaan = itemPemeriksaan[index];
				}
				
			});

			dientes.push(new DienteModel(58 - i, i * 25, 1 * 40,resultPemeriksaan));	
		}

		// 85 to 81
		for(var i = 3; i < 8; i++){
			var resultPemeriksaan = "";
			itemElemenGigi.find((value, index) => {
				if (value == 88 - i) {
					resultPemeriksaan= itemPemeriksaan[index];
				}
				
			});
			dientes.push(new DienteModel(88 - i, i * 25, 2 * 40,resultPemeriksaan));	
		}

		// 48 to 41
		for(var i = 0; i < 8; i++){
			var resultPemeriksaan = "";
			itemElemenGigi.find((value, index) => {
				if (value == 48 - i) {
					resultPemeriksaan= itemPemeriksaan[index];
				}
				
			});
			dientes.push(new DienteModel(48 - i, i * 25, 3 * 40,resultPemeriksaan));	
		}

		// 21 to 28
		for(var i = 0; i < 8; i++){
			var resultPemeriksaan = "";
			itemElemenGigi.find((value, index) => {
				if (value == 21 + i) {
					resultPemeriksaan= itemPemeriksaan[index];
				}
				
			});
			dientes.push(new DienteModel(21 + i, i * 25 + 210, 0,resultPemeriksaan));	
		}

		// 61 to 65
		for(var i = 0; i < 5; i++){
			var resultPemeriksaan = "";
			itemElemenGigi.find((value, index) => {
				if (value == 61 + i) {
					resultPemeriksaan= itemPemeriksaan[index];
				}
				
			});
			dientes.push(new DienteModel(61 + i, i * 25 + 210, 1 * 40,resultPemeriksaan));	
		}

		// 71 to 75
		for(var i = 0; i < 5; i++){
			var resultPemeriksaan = "";
			itemElemenGigi.find((value, index) => {
				if (value == 71 + i) {
					// console.log("True ", itemPemeriksaan[index]);
					resultPemeriksaan= itemPemeriksaan[index];
				}
				
			});
			dientes.push(new DienteModel(71 + i, i * 25 + 210, 2 * 40,resultPemeriksaan));	
		}

		// 31 to 38
		for(var i = 0; i < 8; i++){
			var resultPemeriksaan = "";
			itemElemenGigi.find((value, index) => {
				if (value == 31 + i) {
					// console.log("True ", itemPemeriksaan[index]);
					resultPemeriksaan= itemPemeriksaan[index];
				}
				
			});

			dientes.push(new DienteModel(31 + i, i * 25 + 210, 3 * 40,resultPemeriksaan));	
		}

		self.dientes = ko.observableArray(dientes);
	};

	vm = new ViewModel();
    $('#odontograma').svg({
        settings:{ width: '900px', height: '310px' }
    });

	ko.applyBindings(vm);
	renderSvg();

});