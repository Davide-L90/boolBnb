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