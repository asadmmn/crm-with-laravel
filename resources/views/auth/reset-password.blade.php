@extends('main')
@section('title', 'Reset Password')

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
                <h2>Reset Your Password</h2>
                <p>Reset you password here.</p>

                <div class="inputs">
                    <form method="post" id="reset_password_form">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="input">
                            {!! Form::email('email', $email, ['id' => 'email', 'disabled' => 'disabled']) !!}
                            <label for="email" style="top: 0;"><i class="fa-solid fa-lock"></i> Email</label>
                        </div>

                        <div class="input">
                            {!! Form::password('password', ['id' => 'password']) !!}
                            <label for="password"><i class="fa-solid fa-lock"></i> Password</label>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="input">
                            {!! Form::password('confirm_password', ['id' => 'confirm_password']) !!}
                            <label for="confirm_password"><i class="fa-solid fa-lock"></i> Confirm Password</label>
                            <div class="invalid-feedback"></div>
                        </div>

                        <input type="submit" value="Update Password" id="update_pass" style="width: 100%;margin-top: 50px;">
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

        $("body").on("submit", '#reset_password_form', function(e){
            e.preventDefault()
            $("#update_pass").val("Please wait...")
            $.ajax({
                url: '{{ route("auth.reset-password") }}',
                method: 'post',
                data: $(this).serialize(),
                success: function(res){
                    if(res.status == 400){
                        showError('password', res.message.password)
                        showError('confirm_password', res.message.confirm_password)
                        $("#update_pass").val("Update Password")
                    } else if(res.status == 200){
                        $(".success_msg").append(showMessage('success', res.message))
                        $("#reset_password_form")[0].reset()
                        removeValidtationClasses("#reset_password_form")
                        $("#update_pass").val("Update Password")
                    } else {
                        $(".success_msg").append(showMessage('fail', res.message))
                        $("#update_pass").val("Update Password")
                    }
                }
            })
        })

        $("body").on('click', '.btn-close', function(){
            $(this).parent().remove()
        })
    </script>
@endsection
