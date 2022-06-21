jQuery(document).ready(function($){ 
    
    $('#discount_textfield').parent().hide();
        if( $('#discount_checkbox').prop("checked") == true){
            $('#discount_textfield').parent().show();   
        }
    $('#discount_checkbox').click(function(){
        
        $('#discount_textfield').parent().hide();
        if( $(this).prop("checked") == true){
            $('#discount_textfield').parent().show();   
        }

    });
});