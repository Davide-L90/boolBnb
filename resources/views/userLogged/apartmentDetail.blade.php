@extends('layouts.app')

@section('content')

<div class="container apartment-detail">
    <div class="row">
        
        <div class="images-cnt col-md-6">
            <div class="col-md-12">
                
            </div>
            <div class="details-cnt col-md-6">
                <div class="panel-body">
                       
                    @include('components.add_edit_form')
                         
                </div>
            </div>    
            <div class="buttons-cnt">
                <a href="{{ route('show.sponsors', $data['form_data']['apartment_details']->id) }}" class="btn btn-primary">Sponsorizza appartamento</a>
            </div>
        </div>
    </div>

@endsection

@section('additional-scripts')
    <script type="text/javascript">

        $(document).ready(function() {

            $("#address").geocomplete({ 
                details: "#apartment_form" 
            });

         //     Dropzone.options.dropzone =
        //     {
        //         maxFilesize: 12,
        //         renameFile: function(file) {
        //             var dt = new Date();
        //             var time = dt.getTime();
        //         return time+file.name;
        //         },
        //         acceptedFiles: ".jpeg,.jpg,.png,.gif",
        //         addRemoveLinks: false,
        //         timeout: 5000,
        //         removedfile: function(file) 
        //         {
        //             var name = file.upload.filename;
        //             $.ajax({
        //                 headers: {
        //                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                         },
        //                 type: 'POST',
        //                 url: "{{ route('image.delete') }}",
        //                 data: {filename: name},
        //                 success: function (data){
        //                     console.log(data);                        
        //                     console.log("File has been successfully removed!!");
        //                 },
        //                 error: function(e) {
        //                     console.log(e);
        //                 }});
        //                 var fileRef;
        //                 return (fileRef = file.previewElement) != null ? 
        //                 fileRef.parentNode.removeChild(file.previewElement) : void 0;
        //         },
        //         success: function(file, response) 
        //         {
        //             console.log(response);
        //         },
        //         error: function(file, response)
        //         {
        //         return false;
        //     }
        // };
        });

    
    </script>


@endsection