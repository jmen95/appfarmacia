var numlote = 1;
var numprincipio = 1;
$('#producto').click(function () {
  if(validate_form($("#producto_form"))){
    var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
            success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
            process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

    $('#ajax_producto').removeClass('alert-danger');
    $('#ajax_producto').removeClass('alert-warning');
    $('#ajax_producto').addClass('alert-warning');
    $("#ajax_producto").html(process_icon + 'Procesando por favor espere...');
    $('#ajax_producto').removeClass('hide');

    $.ajax({
        type: "POST",
        url: "api/producto/crear",
        data: $('#producto_form').serialize(),
        success: function (json) {
            var obj = jQuery.parseJSON(json);
            if (obj.success == 1) {
                $('#ajax_producto').html(success_icon + obj.message);
                $("#ajax_producto").removeClass('alert-warning');
                $("#ajax_producto").addClass('alert-success');
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else {
                $('#ajax_producto').html(error_icon + obj.message);
                $("#ajax_producto").removeClass('alert-warning');
                $("#ajax_producto").addClass('alert-danger');
            }
        },
        error: function () {
            window.alert('#producto ERORR');
        }
    });
  }
});

function rowlote() {
    return '<div class="row" id="rowlote' + numlote + '"><hr/><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">'
            + '<label class="cole">Código:</label>'
            + '<input type="text" class="form-control form-input" name="codlote[]" placeholder="Escriba el código..." />'
            + '</div>'
            + '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">'
            + '<label class="cole">Cantidad:</label>'
            + '<input type="text" class="form-control form-input numeric" name="cantidadlote[]" placeholder="Escriba la cantidad..." />'
            + '</div>'
            + '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">'
            + '<label class="cole">Fecha Vencimiento:</label>'
            + '<input type="text" class="form-control form-input date" name="fechavencimiento[]" placeholder="Escriba la fecha vencimiento del lote..." />'
            + '</div>'
            + '</div>';
}
$("#addLotes").click(function () {
    numlote++;
    $(".pnlLotes").append(rowlote());
    $("#numlote").val(numlote);
});

$("#remLotes").click(function () {
    if ($("#rowlote" + numlote).length > 0) {
        $("#rowlote" + numlote).remove("");
        numlote--;
        $("#numlote").val(numlote);
    }
});



function rowprincipio() {
    return '<div class="row" id="rowprincipio' + numprincipio + '"><hr/>'
            + '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group">'
            + '<label class="cole">Principios activo:</label>'
            + '<select name="principio[]" id="id_principio' + numprincipio + '" class="form-control combobox-no-clean customcombobox samename" style="display: none;"></select>'
            + '</div>'
            + '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">'
            + '<label class="cole">Cantidad:</label>'
            + '<input type="text" class="form-control form-input" name="cantidadprincipio' + numprincipio + '" placeholder="Escriba la cantidad..." />'
            + '</div>'
            + '</div>';
}

$("#addPrincipio").click(function () {
    numprincipio++;
    $(".pnlPrincipio").append(rowprincipio());
    $("#id_principio"+numprincipio).html($(".principioactivo").html());
    $("#id_principio"+numprincipio).combobox();
    $("#numprincipio").val(numprincipio);
});

$("#remPrincipio").click(function () {
    if ($("#rowprincipio" + numprincipio).length > 0) {
        $("#rowprincipio" + numprincipio).remove("");
        numprincipio--;
        $("#numprincipio").val(numprincipio);
    }
});