@extends('main')
@section('title', 'Team Registration')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="page_top">
    <div class="content">
        <div>
            <h2><i class="fa-solid fa-user-group" style="margin-right: 15px;"></i> Add Team Member</h2>
            <div class="back_link">
                <a href="/" style="margin-right: 10px;"><i class="fa-solid fa-chevron-left"></i></a>
                <a href="/">Home</a>/<a href="#">team</a>
            </div>

        </div>

        <div>
            <a href="/team" class="button">Team Members</a>
        </div>
    </div>
</div>
{{-- {{ print_r($data) }} --}}

    <div class="crf_container" style="margin-top: 60px;">
        <div class="form">

            @if (isset($data) && (Str::contains(request()->url(), "/$data->id") || request()->has('id')))
                @php $form_class = 'update'; @endphp
            @else
                @php $form_class = 'register'; @endphp
            @endif

        {!! Form::open(array( 'method' => 'POST', 'class' => "$form_class")) !!}

            <input type="hidden" name="user_Type" value="team">
            <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

            <div class="input_group">

                <div class="input">
                    {!! Form::label('name', 'Client Name') !!}
                    {!! Form::text('name', $data->name ?? '', array('id' => 'name', 'placeholder' => 'Name')) !!}
                    <div class="invalid-feedback"></div>
                </div>

                <div class="input">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', $data->email ?? '', array('id' => 'email', 'placeholder' => 'Email')) !!}
                    <div class="invalid-feedback"></div>
                </div>

            </div>

            <div class="input_group">


                <div class="input">
                    {!! Form::label('role', 'Service Packages') !!}
                    {!! Form::select('role', ['SEO Lead', 'Local SEO Analyst', 'SEO Analyst', 'Web Support specialist', 'Content Manager', 'Content Analyst', 'Link Analyst', 'Outreach Specialist', 'Web Designer', 'Web Developer'], $data->role ?? '', ['id' => 'role']) !!}
                    <div class="invalid-feedback"></div>
                </div>

                <div class="input">
                    {!! Form::label('phone', 'phone') !!}
                    {!! Form::text('phone', $data->phone ?? '', array('id' => 'phone', 'placeholder' => 'Phone Number')) !!}
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="textarea">
                {!! Form::label('notes', 'Client Description', ) !!}
                {!! Form::textarea('notes', $data->notes ?? '', ['id' => 'notes', 'placeholder' => 'Please ad Client Notes here...', 'rows' => 5]) !!}
                <div class="invalid-feedback"></div>
            </div>

            <div class="submit_btn">
                @if (isset($data) && (Str::contains(request()->url(), "/$data->id") || request()->has('id')))
                    <input type="submit" value="Update" id="update">
                @else
                    <input type="submit" value="Add" id="submit">
                @endif
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection


@section('script')
    <script>
        $(function(){
            $(".register").submit(function(e){
                e.preventDefault();
                $("#submit").val("Please wait...")

                $.ajax({
                    url: '{{ route('register-team-member') }}',
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.status == 400){
                            showError('name', data.message.name)
                            showError('email', data.message.email)
                            showError('role', data.message.service_pkj)
                            $("#submit").val("Add")
                        } else if(data.status == 200){
                            $(".success_msg").html(showMessage('success', data.message))
                            $(".register")[0].reset()
                            removeValidtationClasses(".register")
                            $("#submit").val("Add")
                        } else {
                            $(".success_msg").html(showMessage('fail', "Some Thing went wrong!"))
                            $("#submit").val("Add")
                        }
                    }

                })
            })

            $(".update").submit(function(e){
                e.preventDefault();
                $("#update").val("Please wait...")

                $.ajax({
                    url: '{{ route('updateTeam-member') }}',
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.status == 400){
                            showError('name', data.message.name)
                            showError('email', data.message.email)
                            showError('role', data.message.service_pkj)
                            $("#update").val("Update")
                        } else if(data.status == 200){
                            $(".success_msg").html(showMessage('success', data.message))
                            removeValidtationClasses(".update")
                            $("#update").val("Update")
                        } else {
                            $(".success_msg").html(showMessage('fail', "Some Thing went wrong!"))
                            $("#update").val("Update")
                        }
                    }

                })
            })

        })
    </script>
@endsection
