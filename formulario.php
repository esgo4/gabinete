<div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                SECCIÓN 1. DATOS DE IDENTIFICACIÓN DEL POLICÍA QUE TUVO CONOCIMIENTO DE LA PROBABLE INFRACCIÓN ADMINISTRATIVA <span class="fw-300"></span>
            </h2>
            <div class="panel-toolbar">
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <div class="panel-tag">
                    You can mix and match any color styles, below is what we were found to be an interesting match. Please note the colors will not be compatible with the modifier <code>.mod-panel-clean</code>
                </div>
                <div class="form-row">
                    <div class="col-xs-12 col-sm-4 col-lg-4">
                        <label class="form-label" for="validationServer01">First name</label>
                        <input type="text" class="form-control is-valid" id="validationServer01" placeholder="First name" value="Mark" required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-4">
                        <label class="form-label" for="validationServer02">Last name</label>
                        <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="Otto" required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-lg-4">
                        <label class="form-label" for="validationServerUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">@</span>
                            </div>
                            <input type="text" class="form-control is-invalid" id="validationServerUsername" placeholder="Username" aria-describedby="inputGroupPrepend3" required="">
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
$('#remitente').change(function() {
    
    
    
	var id = $(this).val();
	$.get('/index.php/correspondencia/obtener-datos-remitente', {
		id: id
	}, function(data) {
		var data = $.parseJSON(data);
		//alert(data.costo);




		//var costos = data.costo.toFixed(2);
		$('#dependenciasorganizaciones-nombres').attr('value', data.nombres);
		$('#dependenciasorganizaciones-apellido_paterno').attr('value', data.apellido_paterno);
		$('#dependenciasorganizaciones-apellido_materno').attr('value', data.apellido_materno);
		$('#dependenciasorganizaciones-nombre').attr('value', data.nombre);
		$('#dependenciasorganizaciones-representante').attr('value', data.representante);
		$('#dependenciasorganizaciones-secretarias_id').attr('value', data.secretarias_id);
		$('#dependenciasorganizaciones-direcciones_id').attr('value', data.direcciones_id);
                $('#dependenciasorganizaciones-jefaturas_departamento').attr('value', data.jefaturas_departamento);
                $('#dependenciasorganizaciones-colonia').attr('value', data.colonia);
                $('#dependenciasorganizaciones-tipo_vialidad').attr('value', data.tipo_vialidad);
                $('#dependenciasorganizaciones-calle').attr('value', data.calle);
                $('#dependenciasorganizaciones-num_ext').attr('value', data.num_ext);
                $('#dependenciasorganizaciones-num_int').attr('value', data.num_int);
                $('#dependenciasorganizaciones-codigo_postal').attr('value', data.codigo_postal);
                $('#dependenciasorganizaciones-telefono_fijo').attr('value', data.telefono_fijo);
                $('#dependenciasorganizaciones-telefono_movil').attr('value', data.telefono_movil);
                $('#dependenciasorganizaciones-email').attr('value', data.email);
        
        
                //buscardependencia
                if(data.tipo == 'ciudadano'){
                $('#correspondencia-dependenciaorganizacion').attr('value', 'CIUDADANO');
                $('#correspondencia-remitente').attr('value', data.nombres+' '+data.apellido_paterno+' '+data.apellido_materno);
                }
        
                if(data.tipo == 'asociacion civil'){
                $('#correspondencia-dependenciaorganizacion').attr('value', data.nombre);
                $('#correspondencia-remitente').attr('value', data.representante);
                }
        
//                if(data.tipo == 'ciudadano'){
//                }
        
//                if(data.tipo == 'ciudadano'){
//                }
        
//                if(data.tipo == 'ciudadano'){
//                }
        
                
        
        
        

		//Buscar Tipo Vialidad
		

	});
        
        
});
</script>