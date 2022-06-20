jQuery(document).ready(function($){ 
    $('input[type="checkbox"]').click(function(){
    if($(this).prop("checked") == true){
        $('#discount_textfield').show();   
    }
    else if($(this).prop("checked") == false){
        $('#discount_textfield').hide();
    }
    });
});