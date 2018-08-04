Dropzone.options.dropzone = {

    renameFile: function (file) {
        var dt = new Date();
        console.log(dt);

        console.log(file);

        var time = dt.getTime();

        return time + file.name;
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

        var imgId = $(this).parents('.images_min').children('.img-gallery-preview').attr('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/user-logged-apartment-detail/image-delete",
            method: "POST",
            data: {
                filename: imgId
            },
            success: function(data){
                console.log(data.filename);
                var container = $('.img-gallery-preview');
                console.log(container);
                var imageToDelete = $('#' + data.filename);
                console.log(imageToDelete);
                imageToDelete.remove();
            },
            error: function (e) {
                console.log(e);
            }
        });
    });

});
