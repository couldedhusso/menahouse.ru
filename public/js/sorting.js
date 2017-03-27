$(document).ready(function()
{
  $("#sorting").change(function(evt){
      evt.preventDefault();
      paramsearch = $('#formdata').serialize();
      $.ajax({
          url: $('property/catalogue'),
          type: POST,
          data:paramsearch
          success : function(data){
            console.log(data);
          }
      });
  });
});
