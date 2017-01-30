$('#users').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_users').removeClass('alert-danger');
  $('#ajax_users').removeClass('alert-warning');
  $('#ajax_users').addClass('alert-warning');
  $("#ajax_users").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_users').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/users/editar",
    data : $('#users_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_users').html(success_icon + obj.message);
        $("#ajax_users").removeClass('alert-warning');
        $("#ajax_users").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_users').html(error_icon  + obj.message);
        $("#ajax_users").removeClass('alert-warning');
        $("#ajax_users").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#users ERORR');
    }
  });
});


$(document).ready(function(){

  $("#editpass").click(function(){
    if($(this).is(':checked')) {  
      $(".txtpass").removeAttr('disabled');
    } else {  
      $(".txtpass").attr('disabled',true);
    } 
  });

});