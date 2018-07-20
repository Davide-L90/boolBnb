$(document).ready(function() {

    /*
        if the view has a children with validation class, the following
        if-statement will executed
    */
    var hasForm = $('#app').children().hasClass('validation');
    if (hasForm) {
        $('form').submit(function(e) {
            
            /* Value from input field */
            var name = $('#name').val();
            var surname = $('#surname').val();
            var stringDate = $('#date_of_birth').val();

            /* Import Moment.js */
            var moment = require('moment');
            
            var bornDate = moment(stringDate);
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

            hasNumber = /\d/;
            if( hasNumber.test(name) ) {
                alert('nome contiene un numero');
                canSubmit = false;
            }
            if (hasNumber.test(surname)) {
                alert('cognome contiene un numero');
                canSubmit = false;
            }
            if (yearDifference < 18) {
                alert('Per registrarti devi essere maggiorenne');
                canSubmit = false;

            }
            
            return canSubmit;

        });

    }

    /*
        if the view has a children with apartments-add-form class, the following
        if-statement will executed
    */
    var hasApartmentsAddForm = $('#app').children().hasClass('apartments-add-form');
    if (hasApartmentsAddForm) {
       
        $('#apartment_register_form').submit(function(e) {
            
            /* Value from input field */
            var beds_number = $('#beds_number').val();
            var bathrooms_number = $('#bathrooms_number').val();
            var area = $('#area').val();
            var price = $('#price').val();

            /*
                if true, the post will submit else return an error message
            */
            var canSubmit = true;
            
            /* If statment for check the number of apartment rooms */
            if (isNaN(beds_number)) {
                alert('Devi inserire un numero');
                canSubmit = false;
            }
            else if ( (beds_number - Math.floor(beds_number)) != 0 ) {
                alert('Devi inserire un numero intero');
                canSubmit = false;

            }
            if(beds_number <= 0){
                alert('Devi inserire un numero positivo');
                canSubmit = false;
            }
            
            /* If statment for check the number of apartment bathrooms */
            if (isNaN(bathrooms_number)) {
                alert('Devi inserire un numero');
                canSubmit = false;

            }
            else if ((bathrooms_number - Math.floor(bathrooms_number)) != 0) {
                alert('Devi inserire un numero intero');
                canSubmit = false;

            }
            if (bathrooms_number <= 0) {
                alert('Devi inserire un numero positivo');
                canSubmit = false;

            }
            if (bathrooms_number >= beds_number) {
                alert('Non puoi avere un numero di bagni maggiore o uguale delle stanze totali');
                canSubmit = false;

            } 

            /* If statment for check the area value of apartment */
            if (isNaN(area)) {
                alert('Devi inserire un numero');
                canSubmit = false;

            }
            else if ((area - Math.floor(area)) != 0) {
                alert('Devi inserire un numero intero');
                canSubmit = false;

            }
            if (area <= 0) {
                alert('La superficie dell\'appartamento deve essere positiva');
                canSubmit = false;

            }

            /* If statment for check the price of apartment */
            if (isNaN(price)) {
                alert('Devi inserire un numero');
                canSubmit = false;

            }
            else if ((price - Math.floor(price)) != 0) {
                alert('Devi inserire un numero intero');
                canSubmit = false;

            }
            if (price <= 0) {
                alert('Devi inserire un numero positivo');
                canSubmit = false;

            }

            var lat = $('#lat').val();
            $('#lat').val(lat.toFixed(8));
            var lng = $('#lng').val();
            $('#lng').val(lng.toFixed(8));
            console.log('lat: ' + lat + ', ' + 'lng: ' + lng);  
                       
            return canSubmit;
        });
    }
});