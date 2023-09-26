@extends('main')
@section('title', 'Forgot Password')

@section('content')
<div class="main_container">
    <div class="left">
        <div class="top">
            <img src="{{ URL::asset('images/XMLID_665_.png') }}" alt="">
            <img src="{{ URL::asset('images/XMLID_1089_-1.png') }}" alt="" srcset="">
        </div>

        <div class="content">
            <h1>Welcome to DOMAIN BIRD</h1>
            <img src="{{ URL::asset('images/Group 1000001238.png') }}" alt="">
        </div>

        <div class="footer">
            <img src="{{ URL::asset('images/XMLID_982_.png') }}" alt="" srcset="">
            <img src="{{ URL::asset('images/XMLID_1089_.png') }}" alt="" srcset="" style="margin-bottom: -42px;">
            <img src="{{ URL::asset('images/XMLID_932_.png') }}" alt="" srcset="" style="align-self: center;">
            <img src="{{ URL::asset('images/XMLID_1112_.png') }}" alt="" srcset="" style="align-self: baseline;">
        </div>
    </div>
    <div class="right">
        <div class="main_content">
            <div class="logo">
                <img src="{{ URL::asset('images/cropped-domain-logo 1.png') }}" alt="" srcset="" style="width: 170px;">
            </div>
            <div class="content">
                <h2>Forgot Your Password</h2>
                <p>Add your mail below to get the link.</p>

                <div class="inputs">
                    <form method="post" id="forgot-password">
                        @csrf
                        <div class="input">
                            {!! Form::email('email', '', ['id' => 'email']) !!}
                            <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                            <div class="invalid-feedback"></div>
                        </div>


                        <input type="submit" value="Submit" id="submit", style="width: 100%;margin-top: 50px;">
                        {{-- {!! Form::button('Submit', ['id' => 'submit', 'style' => 'width: 100%;margin-top: 50px;']) !!} --}}
                    </form>

                    <div class="back">
                        <a href="/"><i class="fa-solid fa-circle-chevron-left"></i> Back to Login</a>

                    </div>
                </div>
            </div>
            <div class="footer">
                All Rightd Reserved to @Domain Bird
            </div>
        </div>

    </div>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}">
@endsection

@section('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> --}}
    <script>
        $("body").on("keyup", "input", function(){
            var label = $(this).next()
            var value = $(this).val().trim()

            if(value !== ""){
                label.css({'top' : 0})
            } else if(value == "") {
                label.css({'top' : '35px'})
            }

        })

        $("body").on("submit", "#forgot-password", function(e){
            e.preventDefault();
            $("#submit").val("Please Wait...")
            $.ajax({
                url: '{{ route('auth.forgot-password') }}',
                method: 'post',
                dataType: 'json',
                data: $(this).serialize(),
                success:function(res){
                    if(res.status == 400){
                        showError('email', res.message.email)
                        $("#submit").val("Submit")
                    } else if(res.status == 200){
                        $(".success_msg").append(showMessage('success', res.message))
                        $("#forgot-password")[0].reset()
                        removeValidtationClasses("#forgot-password")
                        $("#submit").val("Submit")
                    } else {
                        $(".success_msg").append(showMessage('fail', res.message))
                        $("#submit").val("Submit")
                    }
                }
            })
        })

        $("body").on('click', '.btn-close', function(){
            $(this).parent().remove()
        })
    </script>
@endsection
