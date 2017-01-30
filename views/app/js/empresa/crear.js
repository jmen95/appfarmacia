$('#empresa').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_empresa').removeClass('alert-danger');
  $('#ajax_empresa').removeClass('alert-warning');
  $('#ajax_empresa').addClass('alert-warning');
  $("#ajax_empresa").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_empresa').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/empresa/crear",
    data : $('#empresa_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_empresa').html(success_icon + obj.message);
        $("#ajax_empresa").removeClass('alert-warning');
        $("#ajax_empresa").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_empresa').html(error_icon  + obj.message);
        $("#ajax_empresa").removeClass('alert-warning');
        $("#ajax_empresa").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#empresa ERORR');
    }
  });
});
