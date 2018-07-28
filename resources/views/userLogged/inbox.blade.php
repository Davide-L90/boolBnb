@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <span class="filter_name">Filtra per Appartamento: </span>
            <select class="selected_apartment_id" name="" id="">
                <option value="-1">Tutti</option>
                @foreach($user_apartments as $ua)
                    <option class="selected_apartment_id" value="{{ $ua->id }}">{{ $ua->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="container">
        <div class="row msg_section">
            @foreach($filtered_messages as $fm)
                
                <div class="message_cnt">
                    <div class="info_msg">
                        <span class="apartment-title">{{ $fm->apartament['title'] }}</span> 
                        <span class="email-from">{{ $fm->email }}</span> 
                        <span class="name-surname-from">{{ $fm->name }} {{ $fm->surname }}</span>
                        <span class="date-from">{{ $fm->created_at }}</span> 
                    </div>
                    <div class="content_msg">
                        <div class="content">{{ $fm->content}}</div>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>
        
@endsection

@section('additional-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.selected_apartment_id').click(function() {
                var option_value = $(this).val(); 
                
                
                $.ajax({    
                    url: "{{ route('inbox.show') }}",
                    method : "GET", 
                    data : {
                        "apartment_id" : option_value,
                    },
                    beforeSend:function() {
                        $('body').css('backgroundColor', 'red');                        
                    },          
                    success:function(data, stato) {
                        console.log( data.filtered_message );
                        $('body').css('background', 'transparent');
                        
                        $('.message_cnt').remove();
                            //On success, the old html will be changed with result of ajax call's response
                            $.each(data.filtered_message, function(k, v) {
                                $('.msg_section').append(
                                    '<div class="message_cnt">' +
                                        '<div class="info_msg">' +
                                            '<span class="apartment-title">' + v.title + '</span>'     + 
                                            '<span class="email-from">' + v.email + '</span>' + 
                                            '<span class="name-surname-from">' + v.name + ' ' + v.surname + '</span>' +
                                            '<span class="date-from">' + v.created_at + '</span>'     +
                                            '</div>' +
                                            '<div class="content_msg">' +
                                            '<div class="content">' + v.content + '</div>' +
                                        '</div>' +
                                    '</div>'
                                );
                            });
                    },
                    error:function(richiesta,stato,errori) {
                        alert( "E' avvenuto un errore. ");
                    }
                });
                
            }); 
        });
    </script>
@endsection