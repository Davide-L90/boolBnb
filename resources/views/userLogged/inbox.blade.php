@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            @foreach($filtered_messages as $fm)
                
                <div class="message_cnt">
                    <div class="info_msg">
                        <span class="apartment-title">{{ $fm->apartament['title'] }}</span> 
                        <span class="">{{ $fm->email }}</span> 
                        <span class="">{{ $fm->name }} {{ $fm->surname }}</span>
                        <span class="">{{ $fm->created_at }}</span> 
                    </div>
                    <div class="content_msg">
                        <div class="content">{{ $fm->content}}</div>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>
        
@endsection