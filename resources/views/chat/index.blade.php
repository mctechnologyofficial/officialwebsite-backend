@extends('layouts.app')
@section('title', 'Chats')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/emoji/emojibuttonlistjs.min.css') }}">
<style>
    .nav-link:hover{
        cursor: pointer;
    }
    #btnsend:hover{
        cursor: pointer;
    }
</style>
@endsection

@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-5 col-xl-4">
            <div class="card custom-card">
                <div class="main-content-app pt-0">
                    <div class="main-content-left main-content-left-chat">
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <span class="input-group-append">
                                    <button class="btn ripple btn-primary" type="button">Search</button>
                                </span>
                            </div>
                        </div>
                        <nav class="nav main-nav-line main-nav-line-chat card-body d-flex justify-content-center">
                            <a class="nav-link active" data-toggle="tab" href="#ChatList">Recent Chat</a>
                            <a class="nav-link" data-toggle="tab" href="#ChatContacts">Contacts</a>
                        </nav>
                        <div class="tab-content main-chat-list">
                            <div class="tab-pane active" id="ChatList">
                                <div class="main-chat-list tab-pane">
                                    @foreach ($recentchat as $data)
                                        @php
                                            $unreadmessage = App\Models\Chat::where('from_id', $data->from_id)->where('status', 0)->count();
                                        @endphp
                                        <a class="media {{ $unreadmessage > 0 ? 'new' : '' }}" id="recentchat">
                                            <input type="hidden" value="{{ $data->from_id }}" id="fromid">
                                            <div class="main-img-user online">
                                                <img alt="" src="{{ asset($data->image !=null ? $data->image : 'assets/img/users/5.jpg') }}">
                                                <span>{{ $unreadmessage }}</span>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-contact-name">
                                                    <span>{{ $data->name }}</span> <span>{{ $data->created_at->diffInDays() < 1 ? 'Today' : ucwords($data->created_at->diffForHumans(['options' => Carbon\Carbon::ONE_DAY_WORDS])) }}</span>
                                                </div>
                                                {{-- <p>
                                                    @php
                                                        $user = App\Models\Chat::where('from_id', $data->from_id)
                                                        ->orWhere('from_id', Auth::user()->id)
                                                        ->orderBy('id', 'DESC')
                                                        ->take(1)
                                                        ->get();
                                                    @endphp
                                                    {{ $user->first()->message }}
                                                </p> --}}
                                            </div>
                                        </a>
                                    @endforeach
                                    <div id="recentchat"></div>
                                </div><!-- main-chat-list -->
                            </div><!-- main-chat-list -->
                            <div class="tab-pane" id="ChatContacts">
                                @foreach ($contact as $data)
                                    <a href="javascript:void(0)" class="d-flex align-items-center media">
                                        <div class="mb-0 mr-2">
                                            <div class="main-img-user online">
                                                <img alt="user" src="{{ asset($data->image != null ? $data->image : 'assets/img/users/3.jpg') }}"> <span>2</span>
                                            </div>
                                        </div>
                                        <div class="align-items-center justify-content-between">
                                            <div class="media-body ml-2">
                                                <div class="media-contact-name">
                                                    <span>{{ $data->name }}</span>
                                                    <span></span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <p class="text-muted tx-13">{{ $data->roles->first()->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                            <i class="contact-status text-primary fe fe-message-square  mr-2"></i>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <!-- main-chat-list -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-7 col-xl-8 d-none" id="roomchat">
            <div class="card custom-card">
                <div class="main-content-app pt-0">
                    <div class="main-content-body main-content-body-chat">
                        <div class="main-chat-header pt-3">
                            <div class="main-img-user online">
                                <img alt="avatar" id="userimg">
                            </div>
                            <div class="main-chat-msg-name">
                                <h6 id="name"></h6>
                                <span class="dot-label bg-success"></span><small class="mr-3" id="status"></small>
                            </div>
                        </div><!-- main-chat-header -->
                        <div class="main-chat-body" id="ChatBody">
                            <div class="content-inner">
                                {{-- <label class="main-chat-time"><span id="time"></span></label> --}}
                                {{-- <div class="media" id="media-no-flex"> --}}
                                    {{-- <div class="media-body">
                                        <div class="main-msg-wrapper">
                                            Maecenas tempus, tellus eget condimentum rhoncus
                                        </div>
                                        <div class="pd-0">
                                            <img alt="avatar" class="wd-150 mb-1" src="../../assets/img/media/3.jpg">
                                            <img alt="avatar" class="wd-150 mb-1" src="../../assets/img/media/4.jpg">
                                            <img alt="avatar" class="wd-150 mb-1" src="../../assets/img/media/5.jpg">
                                        </div>
                                        <div>
                                            <span>10:12 am</span>
                                            <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                                        </div>
                                    </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="media flex-row-reverse"> --}}
                                    {{-- <div class="media-body">
                                        <div class="main-msg-wrapper">
                                            Maecenas tempus, tellus eget condimentum rhoncus
                                        </div>
                                        <div class="main-msg-wrapper">
                                            Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec
                                            odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.
                                        </div>
                                        <div>
                                            <span>09:40 am</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                                        </div>
                                    </div> --}}
                                {{-- </div> --}}
                                <div id="chatroom"></div>
                            </div>
                        </div>
                        <div class="main-chat-footer">
                            <nav class="nav">
                                {{-- <a class="nav-link mr-3" data-toggle="tooltip" id="filebtn" title="Attach a File"><i class="fe fe-paperclip"></i></a>
                                <input type="file" name="" id="file" accept="*" class="d-none" /> --}}
                                <a class="nav-link" data-toggle="tooltip" title="Emoji" id="emoji"><i class="far fa-smile"></i></a>
                                {{-- <a class="nav-link" data-toggle="tooltip" href="" title="Record Voice"><i class="fe fe-mic"></i></a> --}}
                            </nav>
                            <input class="form-control" id="messagetext" placeholder="Type your message here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Type your message here...'" type="text" style="padding-left: 10px;" />
                            <a class="main-msg-send" id="btnsend"><i class="far fa-paper-plane"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="{{ asset('assets/emoji/emojibuttonlistjs.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var usrid;

            instance = new emojiButtonList("emoji", {
                textBoxID: "messagetext",
                dropDownXAlign: "left",
                dropDownYAlign: "bottom",
                yAlignMargin: 15,
            });

            function getTotalChat(){
                $.ajax({
                    url: '/chat/gettotalchat',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN
                    },
                    dataType: 'json',
                    success: function(response){
                        $('#totalmessage').html(response.data).trigger('change');
                    }
                });
            }

            function getProfile(fromid){
                $.ajax({
                    url: '/chat/getprofile',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        fromid: fromid,
                    },
                    dataType: 'json',
                    success: function(response){
                        var id = response.data[0].id;
                        var name = response.data[0].name;
                        var file = response.data[0].image;
                        var status = response.status;

                        var url = '{{ asset(':file') }}';
                        url = url.replace(':file', file);

                        $('#userimg').attr('src', url);
                        $('#name').html(name);
                        $('#status').html(status).trigger('change');
                    }
                });
            }

            function createChat(userid) {
                $.ajax({
                    type: 'GET',
                    url: "/chat/getchat",
                    data: {
                        _token: CSRF_TOKEN,
                        fromid: userid,
                    },
                    success: (response) => {
                        $('#chatroom').empty();
                        getChat(response, userid);
                    }
                });
            }

            function getChat(response, from) {
                var len = 0;

                if(response['data'] != null){
                    len = response['data'].length;
                }

                if(len > 0){
                    for(var i = 0; i < len; i++){
                        let created_at = moment(response['data'][i].created_at, "YYYY-MM-DD").calendar(null, {
                            lastDay : '[Yesterday]',
                            sameDay : '[Today]',
                            nextDay : '[Tomorrow]',
                            lastWeek : '[last] dddd',
                            nextWeek : 'dddd',
                            sameElse : 'L'
                        });
                        let message = response['data'][i].message;
                        let from_id = response['data'][i].from_id;
                        let to_id = response['data'][i].to_id;
                        let auth_id = {!! Auth::user()->id !!};
                        let timebubble = moment(response['data'][i].created_at).format('LT');


                        var time = "<label class='main-chat-time'><span id='time'>" + created_at + "</span></label>";
                        var from_chat =
                        "<div class='media' id='media-no-flex'>"
                            +"<div class='media-body'>"
                                + "<div class='main-msg-wrapper'>" + message + "</div>"
                                    + "<div>" + "<span>" + timebubble + "</span>"
                                    + "<a href=''><i class='icon ion-android-more-horizontal'></i></a>"
                                + "</div>"
                            + "</div>"
                        + "</div>";

                        var to =
                        "<div class='media flex-row-reverse'>"
                            +"<div class='media-body'>"
                                + "<div class='main-msg-wrapper'>" + message + "</div>"
                                    + "<div>" + "<span>" + timebubble + "</span>"
                                    + "<a href=''><i class='icon ion-android-more-horizontal'></i></a>"
                                + "</div>"
                            + "</div>"
                        + "</div>";

                        // var media =
                        // "<div class='pd-0'>"
                        //     <img alt='avatar' class='wd-150 mb-1'>
                        // </div>

                        let date = new Date().toISOString().slice(0, 10);
                        var today = moment(date, "YYYY-MM-DD").calendar(null, {
                            lastDay : '[Yesterday]',
                            sameDay : '[Today]',
                            nextDay : '[Tomorrow]',
                            lastWeek : '[last] dddd',
                            nextWeek : 'dddd',
                            sameElse : 'L'
                        });

                        if(created_at == today || created_at != today){
                            $('#chatroom').append(time);
                            var map = {};
                            $(".main-chat-time").each(function(){
                                var value = $(this).text();
                                if (map[value] == null){
                                    map[value] = true;
                                } else {
                                    $(this).remove();
                                }
                            });
                            if(from_id == from && to_id == auth_id){
                                $('#chatroom').append(from_chat);
                            }
                            if(from_id == auth_id && to_id == from){
                                $('#chatroom').append(to);
                            }
                        }
                    }
                }else{
                    $('#chatroom').empty();
                }
            }

            window.setInterval(function(){
                getProfile(usrid);
                createChat(usrid);


            }, 1000);

            $('#status').on('change', function(){
                var value = $(this).text();

                if(value == "Online"){
                    $('.dot-label').removeClass('bg-danger');
                    $('.dot-label').addClass('bg-success');
                }else{
                    $('.dot-label').removeClass('bg-success');
                    $('.dot-label').addClass('bg-danger');
                }
            });

            $('#filebtn').on('click', function(){
                $('#file').click();
            });

            $('#btnsend').on('click', function(){
                $.ajax({
                    type: 'POST',
                    url: "{{ route('chat.sendchat') }}",
                    data: {
                        _token: CSRF_TOKEN,
                        message: $('#messagetext').val(),
                        toid: usrid
                    },
                    success: (response) => {
                        $('#messagetext').val('');
                        createChat(usrid);
                    }
                });
            });

            $(document).on('click', '#recentchat', function(){
                var fromid = $(this).find('#fromid').val();
                usrid = fromid;

                $(this).addClass("selected").siblings().removeClass("selected");

                if($(this).hasClass('new')){
                    $(this).removeClass('new');
                }

                $.ajax({
                    type: 'POST',
                    url: "{{ route('chat.updateunreadchat') }}",
                    data: {
                        _token: CSRF_TOKEN,
                        fromid: fromid,
                    },
                    success: (response) => {
                        if(response) {
                            getTotalChat();
                        }
                    }
                });

                $('#totalmessage').on('change', function(){
                    var value = $(this).text();

                    if(value == 0){
                        $(this).text('');
                    }
                });

                // show room chat
                $('#roomchat').removeClass('d-none');
                $('#chatroom').empty();
                createChat(fromid);
            });

        });
    </script>
@endsection