// List group persobnalizado con check
$(function () {
    $('.list-group.checked-list-box .list-group-item').each(function () {
        
        // Settings
        var $widget = $(this),
            $checkbox = $('<input type="checkbox" class="hidden" />'),
            color = ($widget.data('color') ? $widget.data('color') : "primary"),
            style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };
            
        $widget.css('cursor', 'pointer')
        $widget.append($checkbox);

        // Event Handlers
        $widget.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });
          

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $widget.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $widget.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$widget.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $widget.addClass(style + color + ' active');
            } else {
                $widget.removeClass(style + color + ' active');
            }
        }

        // Initialization
        function init() {
            
            if ($widget.data('checked') == true) {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
            }
            
            updateDisplay();

            // Inject the icon if applicable
            if ($widget.find('.state-icon').length == 0) {
                $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
            }
        }
        init();
    });
    
    
});







var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

function validate_form($form) {
    $('.inputdanger').removeClass('inputdanger');
    var isError=false;
  var msg="";
    $form.find('.required').each(function(){
        if($(this).val()==''){
            $(this).addClass('inputdanger');
            isError=true;
            msg+=$(this).data('requiredMessage')+"<br/>";

        }
    });
    if(isError){
        $(".inputdanger").first().select();
    mensaje(3,msg,'Error!');
        return false;
    }else{
        return true;
    }
}

function mensaje(tipo,msg,titulo="",tipomsg=1){

  if(tipomsg==2 || tipomsg==0){
    var clase=tipo==1?'success':(tipo==2?'warn':(tipo==3?'error':'info'));
    $.notify(msg, clase);
  }

  if(tipomsg==1 ||tipomsg==0){
    var clase=tipo==1?'alert-success':(tipo==2?'alert-warning':'alert-danger')
    var result='<div class="alert alert-dismissible '+clase+'">';
            result+='<button type="button" class="close" data-dismiss="alert">&times;</button>';
            result+=(titulo==""?"":'<strong>'+titulo+'</strong> <br/> ')+(tipo==1?success_icon:(tipo==2?process_icon:(tipo==3?error_icon:"")))+msg;
          result+='</div>';
            $(".message").html(result);
  }

  

}

function proximo_vacio($form){
  var bandera=false;
  $inputActual=$form.find(':focus');
  if($inputActual){
    bandera=true;
    if($inputActual.hasClass('custom-combobox-input')){
      $inputActual=$inputActual.parent().siblings('select');
    }
  }
  $form.find('input,select').each(function(){
    if(bandera && $inputActual[0].outerHTML==$(this)[0].outerHTML){
      bandera=false;
    }

    if($(this).val()=='' && !bandera){
      $(this).select();
      bandera=true;
    }
  });
}

function add_option(text,value=text){
  return "<option value='"+value+"'>"+text+"</option>";
}

$( function() {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" ).css("width","100%")
          .insertAfter( this.element );
        this.wrapper.css("width",this.wrapper.css("width").replace("px","")-26);
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .attr("name",this.element.hasClass("samename")?this.element.attr("name"):this.element.attr("name")+"2")
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });

          if(this.element.hasClass("samename")){
            this.element.attr("name",this.element.attr("name")+"2");
          }
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
            $(this.element).change();
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Mostrar todos" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: ""
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "ui-button ui-widget ui-button-icon-only custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          }).append('<span class="ui-button-icon ui-icon ui-icon-triangle-1-s"></span><span class="ui-button-icon-space"> </span>');
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid || this.element.hasClass('combobox-no-clean')) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    
    
  } );


$(document).ready(function(){

  
  var pathname = window.location.pathname;
  var $menu=$("a[href$='"+pathname+"']");
  $menu.parent().addClass('open');
  $menu.parent().parent().parent().addClass('open');

  $("form").keypress(function(event){
    if ( event.which == 13 ) {
      proximo_vacio($(this));
    }
  });

  if($(".customcombobox").length>0){
    $(".customcombobox").combobox();
  }

  if($(".numeric").length>0){
    $('.numeric').numeric();
  }

  if($(".money").length>0){
    $('.money').maskMoney({prefix:'$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false, precision:0});
  }

});