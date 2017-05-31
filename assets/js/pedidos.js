	// Caches
	_productos = {};
	_adicionales = {};
	_meseros = [];
	ID_mesa = 0;
	total_xy = 0;
	_total_adicionales = 0;
	_precio_adicional = 0;
	_existencias = 0;


	// Volatiles
	_orden = [];
	_b_orden = [];
	ingredientes = [[],[]];
	buffer_ingredientes1 =[];
	buffer_ingredientes2 =[];
	buffer_ingredientes3 =[];

	ID_mesero_busqueda = '';
	ID_mesero = 0;
	Id_Sucursal = 0;
	estado=0;	

	$(document).ready(function(){

		$("#search").focus();	
		Id_Sucursal = $("#Id_Sucursal").val();
		
		// Borrar Contenido de la Orden
		/*
		$("#borrar_orden").click(function(){
	        if (confirm('¿Desea borrar esta orden?')) 
	        {
            	reiniciarInterfaz();
        	}
	    });*/

		// Ver El Resumen De La orden
	    $('#ver_resumen').click(function(event){
        	ResumenOrden();
    	});

    	// Cerrar Vista Resumen
    	$('#cerrarResumen').click(function(){
    		alert("Cerrar");
        	//$("#resumen").hidden();
    	});

	

	});

	function reiniciarInterfaz() {
	    _orden = [];
	    _b_orden = [];
	    ID_mesero_busqueda = '';
	    miniResumenOrden();
	    ResumenOrden();
	}

	$(document).on('keydown', '.agregar_producto', function(event){
        event.preventDefault();
        var keyCode = event.keyCode || event.which;

        var ID_producto = $(this).attr('producto');
        //alert(ID_producto);
        //alert($(this).attr('nombre'));
        var _b_orden = {ID: ID_producto, precio: $(this).attr('precio'), detalle: $(this).attr('nombre'),llevar:[],adicionales:[], ingredientes: [[],[]]};

        if (keyCode > 48 && keyCode < 58) {
            convertirProductoEnPedido(_b_orden, parseInt(keyCode) - 48);
        }

        
        if (keyCode > 96 && keyCode < 106) {
        	//alert("[0-9]");
            convertirProductoEnPedido(_b_orden, parseInt(keyCode) - 96);
        }
        
        if (keyCode == 13) {
        	//alert("enter"); 
        	ValidarExistenciaItemsProducto(Id_Sucursal,ID_producto);
        		convertirProductoEnPedido(_b_orden);
        }
        
        if (keyCode == 32) {
        	//alert("espacio");
            intentarProductoEnPedido(ID_producto, $(this).attr('nombre'), $(this).attr('precio'));
        }
        
        if (keyCode == 37) {
        	//alert("Left arrow");
            var tab = parseInt($(this).attr('tabindex'));
            $(".agregar_producto[tabindex='"+(tab-1)+"']").focus();
        }
        
        if (keyCode == 39) {
        	//alert("Right arrow");
            var tab = parseInt($(this).attr('tabindex'));
            $(".agregar_producto[tabindex='"+(tab+1)+"']").focus();
        }
        
        event.stopPropagation();
    });

    function agregar_producto_accion_directa(objeto){        
        var ID_producto = $(objeto).attr('producto');

        ValidarExistenciaItemsProducto(Id_Sucursal,ID_producto);
        var _b_orden = {ID: ID_producto, precio: $(objeto).attr('precio'), detalle: $(objeto).attr('nombre'),llevar:[], adicionales: [], ingredientes: []};
        _b_orden.llevar.push({abc : "0"});
        convertirProductoEnPedido(_b_orden);        	        
    }

    function agregar_producto_accion_indirecta(objeto){
        var ID_producto = $(objeto).attr('producto');
        var xyz=123;
        intentarProductoEnPedido(ID_producto, $(objeto).attr('nombre'), $(objeto).attr('precio'));
    }

    // Agregar Producto modo Tactil
    $(document).on('click', '.agregar_producto', function(){
        if ($("#modo_tactil").is(':checked')) {
            agregar_producto_accion_directa(this);
        } else {
            agregar_producto_accion_indirecta(this);
        }        
    });

    // Agregar Producto, con el click derecho.
    $(document).on('contextmenu', '.agregar_producto', function(event){
        event.preventDefault();
        if ($("#modo_tactil").is(':checked')) {
            agregar_producto_accion_indirecta(this);
        } else {
            agregar_producto_accion_directa(this);
        }
    });//end 

    

	// Cuando se Preciona Enter Agrega el producto en foco a la orden
    function convertirProductoEnPedido(buffer_de_orden, cantidad)
	{	
	    cantidad = cantidad || 1;
	    for (var i=0; i < cantidad; i++) {
	        _orden.push(buffer_de_orden);
	    }
	    miniResumenOrden();
	    $("#search").focus();
	}//end

	function miniResumenOrden()
	{
	    var ordenador = {};
	    var buffer = '';
	    
	    if (_orden.length == 0)
	    {
	        $('#info_principal').html(buffer);
	        return;
	    }
	    
	    for (x in _orden)
	    {

	        if (_orden[x].ID in ordenador)
	        {
	            ordenador[_orden[x].ID].contador++;
	        } else {
	            ordenador[_orden[x].ID] = {};
	            ordenador[_orden[x].ID].producto = _orden[x].detalle;
	            ordenador[_orden[x].ID].contador = 1;
	        }
	    }
	    
	    buffer += '<ul>';
	    for (x in ordenador)
	    {
	        buffer += '<li>' + ordenador[x].contador + ' x ' + ordenador[x].producto+ '</li>';
	    }
	    buffer += '</ul>';
	    $('#info_principal').html(buffer);
	}

	

    // Funcion Resumen / 1.2
    function ResumenOrden()
	{
	    var buffer = '';
	    
	    if (_orden.length == 0)
	    {
	    	$("#search").focus();
	    }
	    
	    buffer += '<h1 class="titulo_resumen">Resumen de la orden</h1>';
	    
	    
	    buffer += '<table class="table" id="seleccion_producto">';
	    var contadorMonto=0;
	    var SimboloMoneda = $("#Moneda").val();
	    _total_adicionales=0;
	    for (x in _orden)
	    {
	    	
	        var adicionales = '';
	        if (_orden[x].adicionales.length > 0) {
	        	
	            adicionales += '<b>Agregar:</b>';
	            
	            adicionales += '<ul>';	            
	            for (y in _orden[x].adicionales) {
	            	
	            	adicionales += "<li>" + _orden[x].adicionales[y].item + " "+SimboloMoneda +" "+ _orden[x].adicionales[y].precio+"</li>";
	            	_total_adicionales += parseFloat(_orden[x].adicionales[y].precio);
	            }	            
	            adicionales += '</ul>';

	        }
	        
	        var quitar = '';	        
	        if (_orden[x].ingredientes.length > 0) {
	            quitar += '<b>Quitar:</b>';
	            quitar += '<ul>';
	            
	            for (y in _orden[x].ingredientes) {
	                quitar += '<li>' + _orden[x].ingredientes[y].nombre_m + '</li>';
	            }	            
	            quitar += '</ul>';	            
	        }

	        var nota = '';	        
	        if (_orden[x].llevar.abc=="1") {	        	
	            nota += '<b>Nota:</b>';
	            nota += '<ul>';
	            
	            for (y in _orden[x].llevar) {
	                nota += '<li>Para Llevar</li>';
	            }	            
	            nota += '</ul>';	            
	        }
	        
	        contadorMonto += parseFloat(_orden[x].precio);
	        buffer += '<tr ID_orden="' + x + '">';
	        buffer += '<td>' + (parseInt(x)+1) + '</td>';
	        buffer += '<td><div style="color:blue;font-weight:bold;">' + _orden[x].detalle + '</div><div>' + adicionales + '</div><div>' + quitar + nota+ '</div></td>';
	        buffer += '<td>' +SimboloMoneda +' '+ _orden[x].precio + '</td>';
	        buffer += '<td><button class="btn_eliminar_pedido">Eliminar</button></td>';
	        buffer += '</tr>';
	        
	    }	    
	    buffer += '<tr><td>#</td><td></td><td>Total = '+ SimboloMoneda+' '+ (contadorMonto+_total_adicionales)+'</td><td></td></tr>';
	    buffer += '</table>';
	    
	    
	    //_orden[x].precio;

	    if($("#resumen").html() != ""){
	    	$("#scroller").show();
	    	$("#resumen").empty();
	    }else{
	    	$("#resumen").html(buffer);
	    	$("#scroller").hide();
	    }	    
	}



	//Eliminar Items del Resumen
	$(document).on('click', '.btn_eliminar_pedido', function(){
        
        if (!confirm('¿Desea eliminar este producto?')) return;
        
        _orden.splice($(this).closest('tr').attr('ID_orden'),1);
        miniResumenOrden();
        ResumenOrden();
    });


	// Flecha Abajo
    $(document).on('keydown', '#search', function(event){
        var keyCode = event.keyCode || event.which;
        
        if (keyCode == 13 || keyCode == 40) {
            $('.agregar_producto:visible').first().focus();
            $("#search").val('');
        }        
    }); 
    // End 

	$(function(){ 
		// Carga El tooltips de el input de busqueda
	    $('#search').qtip({
	        content: {
	            text: 'Presione [ENTER] o flecha [ABAJO] para pasar a los resultados.'
	        }
	    });

	    $(document).on('focus mouseover', '.agregar_producto', function(event) {
	        $(this).qtip({
	            overwrite: true,
	            content: '[ENTER] para agregar el producto.<br />[ESPACIO] para personalizar<br />[1] a [9] para agregar x cantidad de veces',
	            show: {
	                solo: true,
	                event: event.type,
	                ready: true 
	            }
	        }, event);
    	});

	    $(document).on('mouseover', '#busqueda_adicionales', function(event) {
	        $(this).qtip({
	            overwrite: true,
	            content: 'Presione [ENTER] o flecha [ABAJO] para pasar a los resultados.',
	            show: {
	                solo: true,
	                event: event.type,
	                ready: true 
	            }
	        }, event);
	    });


	});


	function intentarProductoEnPedido(str_producto, str_detalle, str_precio)
	{		
	    _b_orden = {timestamp: Math.floor(+new Date() / 1000), ID: str_producto, precio: str_precio, detalle: str_detalle,llevar:[], adicionales: [], ingredientes: []};
	    _b_orden.llevar.push({abc : "0"});
	    var buffer = '';
	        
	    buffer += '<div style="clear:both;height:45px;text-align:center;border-bottom: 4px solid black;margin-bottom:4px;" class="botones_grandes">';
	    buffer += '<div style="float:left;"><button id="agregar_producto_aceptar" class="key" key="65">[Ctrl+Alt+a] Aceptar</button> x <input id="agregar_producto_cantidad" style="width:3em" type="number" value="1" /> Producto Para Llevar :<input type="checkbox" id="producto_llevar" checked:disabled></div>';
	    buffer += '<span style="font-size:1.3em;font-weight:bold;margin:0;padding:0;">' + str_detalle + '</span>';
	    buffer += '<button style="float:right;" class="facebox_cerrar key" key="67">[Ctrl+Alt+c] Cerrar</button>';
	    buffer += '</div>';
	    buffer += '<div id="bloque" style="bottom:0;top: 60px;left:0;right:0;overflow-y: auto;padding: 0 5px;position: absolute;">';
	    	buffer += '<div id="ingredientes"></div>';
	    	buffer += '<div id="adicionales"></div>';
	    	buffer += '<div id="cpep_adicionables"></div>';
	    buffer += '</div>';
	    
	    //$.modal(buffer, {opacity: 0, focus: false} );
	    
	    //$("#scroller").hide();	    
	    $(".data").html(buffer);    
	    $(".data").modal();	    	    
	    $("#busqueda_adicionales").focus();
		cargar_ingredientes(Id_Sucursal,str_producto);
	    
	    //personalizar_producto_ingredientes_y_adicionales(str_producto);
	}


	// Llamar Ingredientes del producto y accion de remover
	function cargar_ingredientes(Id_Sucursal,id_producto){		
		$.ajax({
		url: "../getProductoIngredientes/"+Id_Sucursal+"/"+id_producto,
		type:"post", 
		contentType: "application/json; charset=utf-8",
		dataType: "json",

		success: function(data){ 
				ValidarExistenciaItemsProducto2(Id_Sucursal,id_producto);	
				buffer_ingredientes1 = [];
				buffer_ingredientes2 = [];
				buffer_ingredientes3 = [];
				buffer_ingredientes4 = []; // Total Existencia por Item en inventario
				buffer_ingredientes5 = []; // Unidad medida
			for (index = 0; index < data.length; ++index) 
			{							
				buffer_ingredientes1[index] = data[index]['name_detalle'];
				buffer_ingredientes2[index] = data[index]['Ingredientes'];	
				buffer_ingredientes4[index] = data[index]['total_existencia'];
				buffer_ingredientes5[index] = data[index]['NombreUnidad2'];

    		}
    		cargar_adicionales(Id_Sucursal);
			dibujar_ingredientes();
		},
		error:function()
		{
		  	alert("Error. En Carga de Ingredientes");
		}	
		}); 
	}

	// buscar adicionales por sucursal
	function cargar_adicionales(Id_Sucursal){
		$.ajax({
		url: "../getAdicionalesBySucursal/"+Id_Sucursal,
		type:"post", 
		contentType: "application/json; charset=utf-8",
		dataType: "json",

		success: function(data){ 
			var buffer1="";
			buffer1 += '<div class="adi">';
			
			
			
			buffer1 += '<table class="table contenedor_adicionales">';
			buffer1 += '<thead class="titulo2"><td colspan="4">ADICIONALES</td></thead>';
			buffer1 += '<thead class="cabecera_table"><td colspan="4"><input type="search" placeholder="Buscar" class="form-control" id="busqueda_adicionales"></td></thead>';
			buffer1 += '<tr class="cabecera_table2"><td>Ingrediente</td><td>Codigo</td><td>Precio</td><td>Accion</td></tr>';
			buffer1 += '<tbody>';			
			
			
			for (index = 0; index < data.length; ++index) 
			{   				
					//buffer_ingredientes[index] = data[index]['name_detalle'];
	                buffer1 += '<tr class="items2" nombre="'+data[index]['nombre_matarial']+'">';
	                buffer1 += '<td>'+data[index]['codigo_material']+'</td>';         
	                buffer1 += '<td>'+data[index]['nombre_matarial']+'</td>';               
	                buffer1 += '<td>'+data[index]['precio_adicional']+'</td>';   
	                buffer1 += '<td><button class="btn btn-default remover_ingrediente" onclick=agregar_adicional("'+data[index]["codigo_material"]+'")>Agregar</button></td>';  
	                buffer1 += '</tr>';
    		}    	    			
    		buffer1 += '</tbody>';
    		buffer1 += '<table>';
    		buffer1 += '</div>';
  
			$("#adicionales").html(buffer1);
			dibujar_ingredientes();
		},
		error:function()
		{
		  	alert("Error. En Carga de Ingredientes");
		}	
		}); 
	}



	function dibujar_ingredientes(){
		var buffer1="";

			buffer1 += '<table class="table">';
			//buffer1 += '<tbody>';		
			buffer1 += '<thead class="titulo2"><td colspan="5">INGREDIENTES</td></thead>';	
			
			buffer1 += '<tr class="cabecera_table"><td>Codigo</td><td>Ingrediente</td><td>Precio</td><td>Cantidad Inventario</td><td>Accion</td></tr>';
			for (index = 0; index < buffer_ingredientes1.length; ++index) 
			{   							
					//buffer_ingredientes[index] = data[index]['name_detalle'];
	                buffer1 += '<tr>';
	                buffer1 += '<td>'+buffer_ingredientes1[index]+'</td>';         
	                buffer1 += '<td>'+buffer_ingredientes2[index]+'</td>';
	                buffer1 += '<td>'+buffer_ingredientes3[index]+'</td>';  
	                buffer1 += '<td>'+buffer_ingredientes4[index]+" "+buffer_ingredientes5[index]+'</td>';	                
	                buffer1 += '<td><button class="btn btn-default remover_ingrediente" onclick=myFunction("'+buffer_ingredientes1[index]+'")>Remover</button></td>';  
	                buffer1 += '</tr>';	
    		}    		
    		//buffer1 += '</tbody>';
    		buffer1 += '<table>';  	
			$("#ingredientes").html(buffer1);
	}
	// quitar elementos del la matris
	function myFunction(codigo){
		// Remover Los Ingredientes del Array
        for (index = 0; index < buffer_ingredientes1.length; ++index)
        {
        	if(buffer_ingredientes1[index] == codigo){        		
        		buffer_ingredientes1.splice(index,1);        		
        		buffer_ingredientes2.splice(index,1);  
        		buffer_ingredientes3.splice(index,1);
				getAdicionalByCodigo(codigo);
        	}        	
        }   

        dibujar_ingredientes();
	}
	// Agregar Adicionales a la matris
	function agregar_adicional(data){  
    	var codigo = data;
    	//var l = _b_orden.adicionales.length;
    	$.ajax({
		url: "../getAdicionalesByCodigo/"+codigo,
		type:"post", 
		contentType: "application/json; charset=utf-8",
		dataType: "json",

		success: function(data){ 
			var uno = buffer_ingredientes1.length; 
			
			for (index = 0; index < data.length; ++index) 
			{

				buffer_ingredientes1[uno] =data[index]['codigo_material'];      	        
	        	buffer_ingredientes2[uno] =data[index]['nombre_matarial'];      	        
	        	buffer_ingredientes3[uno] =data[index]['precio_adicional'];
	        	
	        	//_b_orden.adicionales[l] = data[index]['codigo_material'];
	        	_b_orden.adicionales.push(
	        			{item :data[index]['nombre_matarial'],
	        			precio:data[index]['precio_adicional'],
	        			codigo:data[index]['codigo_material']}
	        		);
	        	
    		}	
    		dibujar_ingredientes();		
		},
		error:function()
		{
		  	alert("Error. En Carga de Ingredientes");
		}	
		});        
	}

	// Quitar Ingrediente en el elemento de la orden
	function getAdicionalByCodigo(codigo){
		log = _b_orden.ingredientes.length;
    	$.ajax({
		url: "../getIngredienteByCodigo/"+codigo,
		type:"post", 
		contentType: "application/json; charset=utf-8",
		dataType: "json",

		success: function(data){ 			
			for (index = 0; index < data.length; ++index) 
			{
				//alert(data[index]['nombre_matarial']);
	        	_b_orden.ingredientes.push(
	        		{nombre_m:data[index]['nombre_matarial'],
	        		codigo_m:data[index]['codigo_material']});	
    		}
    		total_xy = log+1;    		
		},
		error:function()
		{
		  	alert("Error. Quitar Ingrediente");
		}	
		});
	}

	function personalizar_producto_ingredientes_y_adicionales(str_producto)
	{
	    rsv_solicitar('producto_ingredientes_y_adicionales',{producto: str_producto}, function(datos){
	        var buffer = '';      
	        buffer = '<table class="contenedor_adicionales ancha delgada estandar zebra">';
	        
	        buffer += '<tbody>';
	        for (x in datos.aux.adicionables)
	        {
	            if (datos.aux.adicionables[x].disponible == 1) { 
	                buffer += '<tr rel="'+datos.aux.adicionables[x].afinidad+'">';
	                buffer += '<td style="text-align:center;"><input title="Agregar ( x1 )" type="checkbox" class="agregar_adicionable ppia_adicional" grupo="G_'+datos.aux.adicionables[x].ID_adicional+'" value="' + datos.aux.adicionables[x].ID_adicional + '" /></td>';
	                buffer += '<td style="text-align:center;"><input title="Agregar doble ( x2 )" type="checkbox" grupo="G_'+datos.aux.adicionables[x].ID_adicional+'" class="agregar_doble_adicionable ppia_adicional" value="' + datos.aux.adicionables[x].ID_adicional + '" /></td>';
	                buffer += '<td style="text-align:center;">$' + datos.aux.adicionables[x].precio + '</td>';
	                buffer += '<td>' + datos.aux.adicionables[x].nombre + '</td>';
	                buffer += '<td style="text-align:center;"><input title="quitar" grupo="G_'+datos.aux.adicionables[x].ID_adicional+'" type="checkbox" class="quitar_adicionable ppia_adicional" value="' + datos.aux.adicionables[x].ID_adicional + '" /></td>';
	                buffer += '</tr>';
	            }
	        }
	        buffer += '</tbody>';
	        
	        buffer += '<thead>';
	        buffer += '<tr><th style="width:60px;">Añadir</th><th style="width:60px;">Doble</th><th style="width:80px;">Precio</th><th>Descripción</th><th style="width:40px;">Quitar</th></tr>';
	        buffer += '</thead>';
	        buffer += '</table>';
	        
	        $("#cpep_adicionables").html(buffer);
	    }, true);
	}

	function mostrar_producto_ingredientes_y_adicionales(str_producto)
	{
	    rsv_solicitar('producto_ingredientes_y_adicionales',{producto: str_producto}, function(datos){
	        var buffer = '';
	        
	        buffer += '<ul>';
	        for (x in datos.aux.ingredientes)
	        {
	            buffer += '<li>' + datos.aux.ingredientes[x].nombre + '</li>';
	        }
	        buffer += '</ul>';
	        
	        $("#cpep_ignredientes").html(buffer);
	        buffer = '<ul>';
	        for (x in datos.aux.adicionables)
	        {
	            buffer += '<li>' + datos.aux.adicionables[x].nombre + '</li>';
	        }
	        buffer += '</ul>';
	        
	        $("#cpep_adicionables").html(buffer);
	    }, true);
	}

	function mostrar_grupo_productos(ID_grupo)
	{    
	    rsv_solicitar('producto_buscar', {grupo: ID_grupo}, MostrarRejillaProductos, true);
	}

	function obtener_lista_meseros()
	{
	    rsv_solicitar('extra_meseros', {}, function(datos){
	        for (x in datos.aux)
	        {
	            _meseros[datos.aux[x].ID_usuarios] = datos.aux[x];
	        }        
	    }, true);
	}

	$(document).on('keyup', '#busqueda_adicionales', function(event){
	       event.stopPropagation();
	       
	        var keyCode = event.keyCode || event.which;
	        if ( event.altKey == true  || event.ctrlKey == true){
	            return false;
	        }

	       var busqueda = $(this).val();

	       if (busqueda == '') {
	        	$('.contenedor_adicionales tbody tr').show();
	        	return true;
	       }
	       
	       $('.contenedor_adicionales tbody tr').hide();       
	       //$('.contenedor_adicionales tbody tr:icontains("'+busqueda+'")').show();
	       $('.contenedor_adicionales tbody tr').filter(function () {
	            return $(this).text().match(new RegExp(busqueda, 'i'));
	        }).show();
	       
	       
	       
	       return true;
	});

	$(function(){  
	    
	    $("#borrar_orden").click(function(){
	        if (confirm('¿Desea borrar por completo esta orden?')) {
	            reiniciarInterfaz();
	        }
	    });

	    $('#enviar_orden_a_cocina').click(function(){
	        
	        if (_orden.length == 0)
	        {
	        	$("#info_principal").html("No hay pedidos en la orden.");
	            //alert('No hay pedidos en la orden.');
	            return;
	        }                
	        ValidarMesa();       
	               
	        getMeseros(Id_Sucursal);
	        
	    });
	});

	function enviar_orden(Mesa,ID_mesero,Id_Sucursal){
		 	//output += property + ': ' + _orden[property]['ID']+'; ';
		 	//console.log(_orden);
		 	//var d = _orden.serialize;
		 	contador1=0;
		 	contador2=0;

		 	$.ajax({
				url: "../GuardarOrden/"+Mesa+"/"+ID_mesero+"/"+Id_Sucursal,
			    type:"post", 
			    data: {info:_orden },
				async: true,
    			cache: false,

			    success: function(data){     // Envia Datos a Detalle	              
			    		
					alert("Orden Enviada a Cocina");
					reiniciarInterfaz();
					//enviarDetalle(Mesa,ID_mesero,Id_Sucursal,data);
					
			    },
			    error:function(){
			        alert("Error. Al Guardar Pedido");
			    }
			});	
	}



	function ValidarMesa(){	

		var Cantidad_mesas = $("#mesasas").val();
	    var CM = parseInt(Cantidad_mesas); 
		ID_mesa = window.prompt('1. Número de Mesa');

		var temp = parseInt(ID_mesa);
	    	if (!ID_mesa) {
	            alert ('Cancelando envío');   
	            ID_mesa = 0;         
	            return;
	        }
	        if(temp >= CM || temp ==0){
				alert ('No Existe Mesa. Intentarlo de Nuevo');			
				ID_mesa = 0;     
				ValidarMesa();       
	            return;
	        } 
	}

	function getMeseros(Id_Sucursal){	
		$.ajax({
		            url: "../UsuariosSucursal/"+Id_Sucursal,
		            type:"post", 

		            success: function(data){     	              
		            	ID_mesero = window.prompt('2. Número de Mesero.' + "\n" + data, 0 );
				    	validarMesero(Id_Sucursal,ID_mesero);
		            },
		            error:function(){
		                
		                alert("Error");
		            }
		        }); 
		return ID_mesero;
	}

	function validarMesero(Id_Sucursal,mesero){
		$.ajax({
		    url: "../validarMesero/"+Id_Sucursal+"/"+mesero,
		    type:"post", 

		    success: function(data){     
			    //$("body").load("../ordenes/"+id);      
			    if(data==1){
			    	enviar_orden(ID_mesa, ID_mesero,Id_Sucursal);
				}
				else
				{
					alert("Mesero No Existe");
					getMeseros(Id_Sucursal);
				}
		    },
		    error:function(){            
		        alert("Error");
		    }
		}); 
	}

	//Validar items si Existe Para ser ordenado
	function ValidarExistenciaItemsProducto(Id_Sucursal,id_producto){
		$.ajax({
			url: "../getProductoItems/"+Id_Sucursal+"/"+id_producto,
			type:"post", 

			success: function(data){  	
					
				var longitud = data.length;
				for (index = 0; index < data.length; ++index) {    	
					
	    			if(data[index]==1){//alert("Todo Bien");
	    				estado=1;    				
	    			}
	    			if(data[index]==0){
	    				//alert("No Se Puede Calcular Elemento. Unidades de Medida No Configuradas");
	    				console.log("No Se Puede Calcular Elemnto. Unidades de Medida No Configuradas");
	    				//reiniciarInterfaz();
	    			}
	    			if(data[index]==2){
	    				//alert("Cantidad Menor En Inventario Para Un Elemento De Este Producto...");
	    				console.log("Cantidad Menor En Inventario Para Un Elemento De Este Producto - XD");
	    				//reiniciarInterfaz();    
	    				//console.log(_orden)	;
	    				var leng = _orden.length;
	    				var eliminar = leng-1;
	    				_orden.splice(eliminar,1);
	    				miniResumenOrden();
	    			}
				}
		    	//var abc = window.prompt('Existencias' + "\n" + data, 0 );
		    },
		    error:function()
		    {
		    	alert("Error. En Validacion de Inventario");
		    }	
		}); 	
	}
	function ValidarExistenciaItemsProducto2(Id_Sucursal,id_producto){
		
		$.ajax({
			url: "../getProductoItems/"+Id_Sucursal+"/"+id_producto,
			type:"post", 

			success: function(data){  	
					
				var longitud = data.length;
				for (index = 0; index < data.length; ++index) {    			
	    			if(data[index]==1){//alert("Todo Bien");
	    				estado=1;    				
	    			}
	    			if(data[index]==0){
	    				//alert("No Se Puede Calcular Elemnto. Unidades de Medida No Configuradas");
	    				console.log("No Se Puede Calcular Elemnto. Unidades de Medida No Configuradas");
	    				//reiniciarInterfaz();
	    			}
	    			if(data[index]==2){
	    				//alert("Cantidad Menor En Inventario Para Un Elemento De Este Producto");
	    				console.log("Cantidad Menor En Inventario Para Un Elemento De Este Producto -");
	    				
	    				$.modal.close();
	    				//reiniciarInterfaz();
	    			}
				}
		    	//var abc = window.prompt('Existencias' + "\n" + data, 0 );
		    },
		    error:function()
		    {
		    	alert("Error. En Validacion de Inventario");
		    }	
		}); 	
	}


	$(document).on('click', '#agregar_producto_aceptar', function(){

	        //_b_orden.ingredientes = [];
	        //_b_orden.adicionales = [];

	        
	        if($('input#producto_llevar[type="checkbox"]:checked:enabled').val())
	        {
	        	_b_orden.llevar = ({abc : "1"});
	        }
	        else{
	        	_b_orden.llevar = ({abc : "0"});
	        }
	        /*
	        if(llevar == 'enabled'){
	        	alert(1);
	        	_b_orden.llevar.push(1);
	        } */   
	        /*
	        $('#cpep_adicionables input.agregar_adicionable[type="checkbox"]:checked:enabled').each(function(){
	            _b_orden.adicionales.push($(this).val());
	        });

	        $('#cpep_adicionables input.agregar_doble_adicionable[type="checkbox"]:checked:enabled').each(function(){
	            _b_orden.adicionales.push($(this).val());
	            _b_orden.adicionales.push($(this).val());
	        });

	        
	        $('#cpep_adicionables input.quitar_adicionable[type="checkbox"]:checked:enabled').each(function(){
	            _b_orden.ingredientes.push($(this).val());
	        });
	        */

	        convertirProductoEnPedido(_b_orden, $("#agregar_producto_cantidad").val());
	        $.modal.close();
	});









