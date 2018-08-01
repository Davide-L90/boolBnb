@extends('layouts.app')

@section('content')

<div class="container apartment-detail">
    <div class="row">
        
        <div class="col-md-12">
            <div class="images-cnt col-md-6">
                <div id="img-gallery">
                    {{-- @if ($images->isNotEmpty())
                        @foreach ($images as $image)
                            
                        @endforeach    
                    @endif --}}
                </div>
                    <form method="post" action="{{ route('image.store', $data['form_data']['apartment_details']->id) }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                        {{ csrf_field() }}
                    </form>
                      
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
        });    
    </script>


@endsection