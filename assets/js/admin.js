jQuery(document).ready(function($){ 
    
    $('#discount_textfield').parent().hide();
    $('#discount_textfield').prop('required',false); 
        if( $('#discount_checkbox').prop("checked") == true){
            $('#discount_textfield').parent().show();
            $('#discount_textfield').prop('required',true); 



   
        }
    $('#discount_checkbox').click(function(){
        
        $('#discount_textfield').parent().hide();
        $('#discount_textfield').prop('required',false); 
        if( $(this).prop("checked") == true){
            $('#discount_textfield').parent().show();
            $('#discount_textfield').prop('required',true); 



 
        }

    });
});