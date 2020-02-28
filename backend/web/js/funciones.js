
function licenciaspersona(dato) {
    if (dato == "fisica") {
        document.getElementById("razonsocial").style.display = "none";
        document.getElementById("nombres").style.display = "block";
        document.getElementById("apellidopaterno").style.display = "block";
        document.getElementById("apellidomaterno").style.display = "block";
        document.getElementById("fechanacimiento").style.display = "block";
        document.getElementById("sexo").style.display = "block";
        document.getElementById("tipoidentificacion").style.display = "block";
        document.getElementById("noidentificacion").style.display = "block";
        document.getElementById("rfc").style.display = "block";

    }
    if (dato == "moral") {

        document.getElementById("razonsocial").style.display = "block";
        document.getElementById("nombres").style.display = "none";
        document.getElementById("apellidopaterno").style.display = "none";
        document.getElementById("apellidomaterno").style.display = "none";
        document.getElementById("fechanacimiento").style.display = "none";
        document.getElementById("sexo").style.display = "none";
        document.getElementById("tipoidentificacion").style.display = "none";
        document.getElementById("noidentificacion").style.display = "none";
        document.getElementById("rfc").style.display = "block";

    }
    if (dato == "") {
        document.getElementById("razonsocial").style.display = "none";
        document.getElementById("nombres").style.display = "none";
        document.getElementById("apellidopaterno").style.display = "none";
        document.getElementById("apellidomaterno").style.display = "none";
        document.getElementById("fechanacimiento").style.display = "none";
        document.getElementById("sexo").style.display = "none";
        document.getElementById("tipoidentificacion").style.display = "none";
        document.getElementById("noidentificacion").style.display = "none";
        document.getElementById("rfc").style.display = "none";
    }
    if (dato == '')
    {
        alert("Debe Seleccionar una Opción");
    }
}


$('#giros_id').change(function () {
    var id = $(this).val();
    $.get('/index.php/comerciales/licencias-comerciales/obtener-datos-giro', {id: id}, function (data) {
        var data = $.parseJSON(data);
        alert(data.costo);

        var costos = data.costo.toFixed(2);
        $('#licenciascomerciales-giro_descripcion').attr('value', data.descripcion);
        $('#licenciascomerciales-giro_tipo').attr('value', data.tipo);
        $('#licenciascomerciales-giro_codigo').attr('value', data.codigo);
        $('#licenciascomerciales-costo_expedicion').attr('value', costos);

    });
});


function habilitar_posicion_inmueble(dato) {
    if (dato == "propietario") {
        document.getElementById("causa_legal_otra").style.display = "none";
    }
    if (dato == "arrendatario") {
        document.getElementById("causa_legal_otra").style.display = "none";
    }
    if (dato == "comodatario") {
        document.getElementById("causa_legal_otra").style.display = "none";

    }
    if (dato == "otra") {
        document.getElementById("causa_legal_otra").style.display = "block";


    }
    if (dato == '')
    {
        document.getElementById("causa_legal_otra").style.display = "none";
        alert("Debe Seleccionar una Opción");
    }
}


function habilitar_distribucion_inmueble(dato) {
    if (dato == "vivienda") {
        document.getElementById("area_otro").style.display = "none";
    }
    if (dato == "oficina") {
        document.getElementById("area_otro").style.display = "none";
    }
    if (dato == "comercial") {
        document.getElementById("area_otro").style.display = "none";

    }
    if (dato == "industria") {
        document.getElementById("area_otro").style.display = "none";

    }
    if (dato == "bodega") {
        document.getElementById("area_otro").style.display = "none";

    }
    if (dato == "otro") {
        document.getElementById("area_otro").style.display = "block";


    }
    if (dato == "") {
        document.getElementById("area_otro").style.display = "none";

    }
    if (dato == '')
    {
        alert("Debe Seleccionar una Opción");
    }
}

