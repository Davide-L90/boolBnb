$(document).ready(function() {

    var hasForm = $('#app').children().hasClass('validation');
    /* console.log(hasForm); */
    
    if (hasForm) {
        $('form').submit(function(e) {
            
            var name = $('#name').val();
            var surname = $('#surname').val();

            /* Import Moment.js */
            var moment = require('moment');
            var stringDate = $('#date_of_birth').val();
            
            var bornDate = moment(stringDate);
            var today = moment();

            var yearDifference = today.diff(bornDate, 'years');
            
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
                alert('sei un bimbo minkia e non puoi registrarti a questo sito');
                canSubmit = false;

            }
            
            return canSubmit;

        });

    }

});