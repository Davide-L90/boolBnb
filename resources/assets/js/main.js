$(document).ready(function() {

    /*
        if the view has a children with validation class, the following
        if-statement will executed
    */
    var hasForm = $('#app').children().hasClass('validation');
    if (hasForm) {
        $('form').submit(function(e) {
            
            /* Value from input field */
            var name_field = $('#name'); 
            var name_value = name_field.val();

            var surname_field = $('#surname'); 
            var surname_value = surname_field.val();
            
            var stringDate_field = $('#date_of_birth');
            var stringDate_value = stringDate_field.val()

            /* Import Moment.js */
            var moment = require('moment');
            
            var bornDate = moment(stringDate_value);
            var today = moment();

            /* 
                This method calculate the difference between today and the date inserted 
                by user. For check if user can sign up to platform 
            */
            var yearDifference = today.diff(bornDate, 'years');
            
            /*
                if true, the post will submit else return an error message
            */
            var canSubmit = true;

            errorReset();

            var hasNumber = /\d/;
            if( hasNumber.test(name_value) ) {
                showError(name_field, 'Il nome non può contenere numeri');
                canSubmit = false;
            }
            if (hasNumber.test(surname_value)) {
                showError(surname_field, 'Il cognome non può contenere numeri');
                canSubmit = false;
            }
            if (yearDifference < 18) {
                showError(stringDate_field, 'Per registrarti devi essere maggiorenne');
                canSubmit = false;
            }
            
            return canSubmit;
        });
    }

    /*
        if the view has a children with apartments-add-form class, the following
        if-statement will executed
    */
    var hasApartmentsAddForm = $('#app').children().children().hasClass('apartments-add-form');
    var hasApartmentEditForm = $('#app').children().hasClass('apartment-detail');
    console.log(hasApartmentsAddForm);
    console.log(hasApartmentEditForm);

    var hasApartmentSearchForm = $('body').find('.search_form_validation');
    var hasResultsFilterForm = $('body').find('.filter_form_validation');
    
    if (hasApartmentSearchForm.length != 0 ||
        hasResultsFilterForm.length != 0) {

        $('#apartment_search_form').submit(function (e) {
            var address_field = $('#address');
            var address_value = address_field.val();
    
            var beds_field = $('#beds_number');
            var beds_value = beds_field.val();
    
            var bathrooms_field = $('#bathrooms_number');
            var bathrooms_value = bathrooms_field.val();
    
            var distance_field = $('#distance');
            var distance_value = distance_field.val();
            
            var canSubmit = true;

            errorReset();
            
            if ( address_value.length == 0 ) {
                showError(address_field, 'E\' necessario inserire l\'indirizzo');
                canSubmit = false;            
            }

            if (beds_value.length != 0 && beds_value <= 0 ) {
                showError(beds_field, 'Il numero di posti letto inserito deve essere maggiore o uguale a 0');
                canSubmit = false;
            }


            if (bathrooms_value.length != 0 && beds_value.length != 0) {
                if (bathrooms_value > beds_value) {
                    showError(bathrooms_field, 'Il numero di bagni inserito deve essere minore dei posti letto richiesti');
                    canSubmit = false;
                } 
            }
            
            if (bathrooms_value.length != 0 && bathrooms_value <= 0) {
                showError(bathrooms_field, 'Il numero di bagni inserito deve essere maggiore o uguale a 0');
                canSubmit = false;
            }

            if (distance_value.length != 0 && distance_value <= 0) {
                showError(distance_field, 'Inserire un numero positivo');
                canSubmit = false;
            }

            return canSubmit;

        });    
        
        
    }
    
    
    console.log(hasApartmentSearchForm.length == 0);
    console.log(hasResultsFilterForm.length == 0);

    


    if (hasApartmentsAddForm || hasApartmentEditForm) {
        

        $('#apartment_form').submit(function(e) {
            
            /* Value from input field */

            var beds_field = $('#beds_number');
            var beds_value = parseInt(beds_field.val());

            var bathrooms_field = $('#bathrooms_number');
            var bathrooms_value = parseInt(bathrooms_field.val());

            var area_field = $('#area');
            var area_value = parseInt(area_field.val());

            var price_field = $('#price');
            var price_value = parseInt(price_field.val());          

            /*
                if true, the post will submit else return an error message
            */
            var canSubmit = true;
            
            errorReset();
            
            /* If statment for check the number of apartment rooms */
            if( isNaN(beds_value)                              ||
                (beds_value - Math.floor(beds_value)) != 0    ||
                (beds_value <= 0)                              ||
                (beds_value >= 255))   {
                
                showError(beds_field, 'Inserisci un numero di posti letto plausibile, intero e maggiore di zero'); 

                canSubmit = false;
            }

            if (isNaN(bathrooms_value) ||
                (bathrooms_value - Math.floor(bathrooms_value)) != 0 ||
                (bathrooms_value <= 0)) {

                showError(bathrooms_field, 'Inserisci un numero di posti letto plausibile, intero e maggiore di zero');

                canSubmit = false;

            } else if ( bathrooms_value > beds_value ) {
                showError(bathrooms_field, 'Numero di bagni deve essere inferiore al numero di posti letto');
                canSubmit = false;
            }

            if (isNaN(area_value) ||
                (area_value - Math.floor(area_value)) != 0 ||
                (area_value <= 0)) {

                showError(area_field, 'Inserisci un valore di superficie plausibile, intero e maggiore di zero');

                canSubmit = false;

            } 

            if (isNaN(price_value) ||
                (price_value - Math.floor(price_value)) != 0 ||
                (price_value <= 0)) {

                showError(price_field, 'Inserisci un prezzo plausibile, intero e maggiore di zero');

                canSubmit = false;

            } 
            
           
            var lat = parseFloat($('#lat').val());
            $('#lat').val(lat.toFixed(8));
            var lng = parseFloat($('#lng').val());
            $('#lng').val(lng.toFixed(8));                     
        
            return canSubmit;
        });
    }

    /* 
        when user click on addApartment button a form will appear
    */
    $('#addApartment').click(function(){
        $('.apartments-add-form').toggle();
    });

    /* 
        when user click on deleteApartment button a popup message appear
        for confirm the choice
    */
    $('.delete-id').click(function() {
        var route = $(this).data("route-delete");
        $('.delete-popup').removeClass('hidden');
        
        
        $('#delete_form').attr('action', route); 

        $('#no').click(function () {
            $(this).parent().addClass('hidden');
        });
        
    });

    /* 
        When user click on button to disable card, background and opacity
        will be changed
    */
    $('.switch').click(function(){
        var state_button = $(this); 
        var state = state_button.siblings(".secret").val();
        
        if (state == 1) {
            state_button.siblings(".secret").val(0);            
        } else {
            state_button.siblings(".secret").val(1);            
        }
    });

    /* 
        Sending message form validation
    */
    $('#send_message_form').submit(function(e){
        var name = $('#name').val();
        var surname = $('#surname').val();
        var email = $('#email').val();
        var message = $('#message_content').val();
        
        var canSubmit = true;

        var hasNumber = /\d/;

        if((hasNumber.test(name)) || (name == "")) {
            alert('il nome è errato o non è stato inserito');
            canSubmit = false;
        }
        if ((hasNumber.test(surname)) || (surname == "")) {
            alert('il cognome è errato o non è stato inserito');
            canSubmit = false;
        }
        if(!(email.includes('.')) || !(email.includes('@')) || email == ""){
            alert('inserire un indirizzo mail corretto');
            canSubmit = false;
        }
        // if(message == ""){
        //     alert('Scrivere un messaggio');
        //     canSubmit = false;
        // }
        return canSubmit;
    });


    function showError(field_obj, message) {
        field_obj.parents('.form-group').addClass('has-error');
        field_obj.parent().append(
            '<span class="help-block">' + 
                '<strong class="error_showed">' + message + '</strong>' + 
            '</span>'
        );        
    }

    function errorReset() {
        $('.help-block').remove();
        $('.form-group').removeClass('has-error');
    }
});

//Prova variabilizzazione errori
/* var form_fields = {
    'beds_number': {
        'obj': $('#beds_number'),
        'value': parseInt($('#beds_number').val()),
        'error_msg': {
            'numeric': 'Inserisci un numero plausibile, intero e maggiore di zero'
        }
    },
    'bathrooms_number': {
        'obj': $('#bathrooms_number'),
        'value': parseInt($('#bathrooms_number').val()),
        'error_msg': {
            'numeric': 'Inserisci un numero plausibile, intero e maggiore di zero',
            'compare': 'Inserisci un numero di bagni inferiore ai posti letto'
        }
    },
    'area': {
        'obj': $('#area'),
        'value': parseInt($('#area').val()),
        'error_msg': {
            'numeric': 'Inserisci un valore di superficie plausibile, intero e maggiore di zero'
        }
    },
    'price': {
        'obj': $('#price'),
        'value': parseInt($('#price').val()),
        'error_msg': {
            'numeric': 'Inserisci un prezzo plausibile, intero e maggiore di zero'
        }
    },
};



if (isNaN(form_fields.beds_number.value) ||
    (form_fields.beds_number.value - Math.floor(form_fields.beds_number.value)) != 0 ||
    (form_fields.beds_number.value <= 0)) {

    form_fields.beds_number.obj.parents('.form-group').addClass('has-error');
    form_fields.beds_number.obj.parent().append(
        form_fields.error_show.html_error_init +
        form_fields.beds_number.error_msg.numeric +
        form_fields.error_show.html_error_end
    );

    canSubmit = false;

}

if (isNaN(form_fields.bathrooms_number.value) ||
    (form_fields.bathrooms_number.value - Math.floor(form_fields.bathrooms_number.value)) != 0 ||
    (form_fields.bathrooms_number.value <= 0)) {

    form_fields.bathrooms_number.obj.parents('.form-group').addClass('has-error');
    form_fields.bathrooms_number.obj.parent().append(
        form_fields.error_show.html_error_init +
        form_fields.bathrooms_number.error_msg.numeric +
        form_fields.error_show.html_error_end
    );

    canSubmit = false;

} else if (form_fields.bathrooms_number.value > form_fields.beds_number.value) {
    form_fields.bathrooms_number.obj.parents('.form-group').addClass('has-error');
    form_fields.bathrooms_number.obj.parent().append(
        form_fields.error_show.html_error_init +
        form_fields.bathrooms_number.error_msg.compare +
        form_fields.error_show.html_error_end
    );

    canSubmit = false;
}

if (isNaN(form_fields.area.value) ||
    (form_fields.area.value - Math.floor(form_fields.area.value)) != 0 ||
    (form_fields.area.value <= 0)) {

    form_fields.area.obj.parents('.form-group').addClass('has-error');
    form_fields.area.obj.parent().append(
        form_fields.error_show.html_error_init +
        form_fields.area.error_msg.numeric +
        form_fields.error_show.html_error_end
    );

    canSubmit = false;

}

if (isNaN(form_fields.price.value) ||
    (form_fields.price.value - Math.floor(form_fields.price.value)) != 0 ||
    (form_fields.price.value <= 0)) {

    form_fields.price.obj.parents('.form-group').addClass('has-error');
    form_fields.price.obj.parent().append(
        form_fields.error_show.html_error_init +
        form_fields.price.error_msg.numeric +
        form_fields.error_show.html_error_end
    );

    canSubmit = false;

} */