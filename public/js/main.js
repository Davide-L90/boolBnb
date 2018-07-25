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
    var hasApartmentsAddForm = $('#app').children().children().hasClass('apartments-add-form');
    var hasApartmentEditForm = $('#app').children().hasClass('apartment-detail');
    console.log(hasApartmentsAddForm);
    console.log(hasApartmentEditForm);

    if (hasApartmentsAddForm || hasApartmentEditForm) {
        

        $('#apartment_form').submit(function(e) {
            
            /* Value from input field */
            var beds_number = parseInt($('#beds_number').val());
            var bathrooms_number = parseInt($('#bathrooms_number').val());
            var area = $('#area').val();
            var price = $('#price').val();

            console.log(beds_number);
            console.log(bathrooms_number);
            console.log(area);
            console.log(price);

            /*
                if true, the post will submit else return an error message
            */
            var canSubmit = true;
            
            /* If statment for check the number of apartment rooms */
            if (isNaN(beds_number)) {
                alert('Devi inserire un numero');
                canSubmit = false;
            }
            /*  else if ( (beds_number - Math.floor(beds_number)) != 0 ) {
                alert('Devi inserire un numero intero');
                canSubmit = false;

            } */
            if(beds_number <= 0){
                alert('Devi inserire un numero positivo');
                canSubmit = false;
            }
            if (beds_number >= 255) {
                alert('Hai inserito un numero non veritiero');
                canSubmit = false;
            }
            
            /* If statment for check the number of apartment bathrooms */
            if (isNaN(bathrooms_number)) {
                alert('Devi inserire un numero');
                canSubmit = false;

            }
            /* if ((bathrooms_number - Math.floor(bathrooms_number)) != 0) {
                alert('Devi inserire un numero intero');
                canSubmit = false;

            } */
            if (bathrooms_number <= 0) {
                alert('Devi inserire un numero positivo');
                canSubmit = false;
            }
            if (bathrooms_number >= 255) {
                alert('Hai inserito un numero non veritiero');
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
            if ((price - Math.floor(price)) != 0) {
                alert('Devi inserire un numero intero');
                canSubmit = false;

            }
            if (price <= 0) {
                alert('Devi inserire un numero positivo');
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
        when user click on deletApartment button a popup message appear
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

});
$(document).ready(function() {
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        autoProcessQueue: true,
        clickable: true,
        accept: function (file, done) {
            done();
        },
        init: function () {
            var submitButton = $('#upload-all');
            var my_dropzone = $(this);
            
            submitButton.click(function() {
                my_dropzone.processQueue(); 
            });


            
            this.on("addedfile", function (file) { alert("Added file."); });
        }
    };
});