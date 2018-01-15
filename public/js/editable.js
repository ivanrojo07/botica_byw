
$(document).ready(function() {

  $.fn.editable.defaults.mode = 'inline';
  $.fn.editable.defaults.ajaxOptions = {type: "PUT"};

    $('.set-guide-number').editable();
    $('.select-status').editable({
      source: [
        {value:"creado", text:"Creado"},
        {value:"enviado", text:"Enviado"},
        {value:"Recibido", text:"recibido"}
      ]
    });
});
