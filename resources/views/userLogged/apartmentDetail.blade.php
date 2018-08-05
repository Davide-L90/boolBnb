@extends('layouts.app')

@section('content')

<div class="container apartment-detail">
    <div class="row"> 
        <div class="col-md-12">
            <div class="images-cnt col-md-5">
                <form method="post" action="{{ route('image.store', $data['form_data']['apartment_details']->id) }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                    {{ csrf_field() }}
                </form>
                <h1>Galleria</h1>
                <div id="gallery_cnt">
                     @if ($images->isNotEmpty())
                        @foreach ($images as $image)
                            <div class="images_min">
                                <div class="delete-img">
                                    <i class="fas fa-times"></i>
                                </div>
                                <img class="img-gallery-preview" id="{{ $image->filename }}" src="{{ asset('storage/'.$image->filename) }}" alt="">
                            </div>
                        @endforeach    
                    @endif
                </div>    
            </div>
            <div class="details-cnt col-md-7">
                <div class="panel-body edit_form_cnt">
                       
                    @include('components.add_edit_form')
                         
                    <div id="apartment-sponsor-btn-cnt" class="col-xs-12 buttons-cnt">  
                        <a href="{{ route('show.sponsors', $data['form_data']['apartment_details']->id) }}" class="custom_button">Sponsorizza appartamento</a>
                    </div>
                </div>
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
        });    
    </script>


@endsection