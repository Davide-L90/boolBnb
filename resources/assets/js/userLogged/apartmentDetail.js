Dropzone.options.dropzone = {
    maxFilesize: 12,
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