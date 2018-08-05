$(document).ready(function() {
    $('#sponsor_form').on('submit', function() {
        var canSubmit = false;

        if( $('.advertisement').is(':checked')) {
            canSubmit = true;        
        } 
       return canSubmit;
    });

})