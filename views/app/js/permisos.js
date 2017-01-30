$('#permisos').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_permisos').removeClass('alert-danger');
  $('#ajax_permisos').removeClass('alert-warning');
  $('#ajax_permisos').addClass('alert-warning');
  $("#ajax_permisos").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_permisos').removeClass('hide');

  var checkedItems = {}, counter = 0;
    $("#check-list-box li.active").each(function(idx, li) {
        checkedItems[counter] = {"id":$(li).data('id'),'permiso':$(li).find('select').val()};
        counter++;
    });
    // $('#display-json').html(JSON.stringify(checkedItems, null, '\t'));

  var datos = {
      "paginas": checkedItems
    };
    datos = $('#permisos_form').serialize() + "&" + $.param(datos);
  

  $.ajax({
    type : "POST",
    url : "api/permisos",
    data : datos,
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_permisos').html(success_icon + obj.message);
        $("#ajax_permisos").removeClass('alert-warning');
        $("#ajax_permisos").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_permisos').html(error_icon  + obj.message);
        $("#ajax_permisos").removeClass('alert-warning');
        $("#ajax_permisos").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#permisos ERORR');
    }
  });
});

$(".list-group-item select").change(function(){
  $checkbox=$(this).parent().find('.hidden');
  $checkbox.prop('checked', false);
});

$(".rol").change(function(){
  $.ajax({
    type : "GET",
    url : "api/permisos",
    data : {rol:$(this).val()},
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      $(".list-group-item").find('.hidden').prop('checked', true);
      $(".list-group-item").click();
      if(obj!=null) {
        for (var i = 0; i < obj.length; i++) {
          var $pag=$("[data-id='"+obj[i].perpag+"']");
          console.log($pag.html());
          $pag.find('.hidden').prop('checked', false);
          $pag.click();
          var permiso="";
          if (obj[i].peredita=="S" && obj[i].perelimina=="S") {
            permiso="edyel";
          }else if (obj[i].peredita=="S") {
            permiso="edita";
          }else if (obj[i].perelimina=="S") {
            permiso="elimina";
          }
          $pag.find("select").val(permiso);
        }
      }
    },
    error : function() {
      window.alert('#permisos ERORR');
    }
  });
});