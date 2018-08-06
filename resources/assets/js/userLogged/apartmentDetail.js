Dropzone.options.dropzone = {

    init: function() {
        this.on("thumbnail", function(file) {
            if (file.width < 1000 || file.height < 600)
            {
                file.rejectDimensions();
            }
            else 
            {
                file.acceptDimensions();    
            }
        })
    },
    accept: function(file, done) {
        file.acceptDimensions = done;
        file.rejectDimensions = function() {  alert('inserire immagine  1000x800'); done("Image too small."); };
    },

    renameFile: function (file) {
    
        var dt = new Date();

        var extension = file.name;
        extension = extension.split('.').pop();
        var time = dt.getTime();

        return time + '.' + extension;
    },
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    addRemoveLinks: true,
    timeout: 5000,
    removedfile: function (file) {
        var name = file.upload.filename;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "/user-logged-apartment-detail/image-delete",
            data: { 
                filename : name 
            },
            success: function (data) {
                console.log("File has been successfully removed!!");
            },
            error: function (e) {
                console.log(e);
            }
        });
        var fileRef;
        return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : void 0;
    },
    success: function (file, response) {
        console.log(response);
    },
    error: function (file, response) {
        return false;
    }
};

$(document).ready(function(){

    $('.fa-times').click(function(){

        var imgId = $(this).parents('.images_min').children('.img-gallery-preview').data("filename");
                
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/user-logged-apartment-detail/image-delete",
            method: "POST",
            data: {
                'filename' : imgId
            },
            success: function(data){
                console.log(data.filename);
                
                console.log('#'+data.filename);
                
               
                console.log($('#'+data.filename));
                
                var imageToDelete = $('#' + data.filename);
                imageToDelete.parent(".images_min").remove();
            },
            error: function (e) {
                console.log(e);
            }
        });
    });

    

});
