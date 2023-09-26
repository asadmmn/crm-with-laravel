@extends('main')
@section('title', 'Client Registration')

@php
use Illuminate\Support\Str;
@endphp

@section('content')

    <div class="page_top">
        <div class="content">
            <div>
                <h2><i class="fa-solid fa-user-group" style="margin-right: 15px;"></i>Add Client</h2>
                <div class="back_link">
                    <a href="/" style="margin-right: 10px;"><i class="fa-solid fa-chevron-left"></i></a>
                    <a href="/">Home</a>/<a href="#">Add Client</a>
                </div>

            </div>

            <div>
                <a href="/clients" class="button">View Clients</a>
            </div>
        </div>
    </div>

    <div class="crf_container" style="margin-top: 60px;">
        <div class="form">

            @if (isset($data) && (Str::contains(request()->url(), "/$data->id") || request()->has('id')))
                @php $form_class = 'update_client_form'; @endphp
            @else
                @php $form_class = 'client_reg_form'; @endphp
            @endif

        {!! Form::open(array('url' =>  '#' , 'method' => 'POST', 'class' => "$form_class")) !!}

            <input type="hidden" name="user_Type" value="client">
            <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
            <div class="input_group">
                <div class="input">
                    {!! Form::label('business_name', 'Client Business Name') !!}
                    {!! Form::text('business_name', $data->business_name ?? '', array('id' => 'business_name', 'placeholder' => 'Add Client business Name')) !!}
                    <div class="invalid-feedback"></div>
                </div>

                <div class="input">
                    {!! Form::label('website', 'Website') !!}
                    {!! Form::text('website', $data->website ?? '', array('id' => 'website', 'placeholder' => 'Add Client Website')) !!}
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="input_group">
                <div class="input">
                    {!! Form::label('service_pkj', 'Service Packages') !!}
                    {!! Form::select('service_pkj', ['Local SEO Starter', 'Local SEO Standard', 'Local SEO Silver', 'Local SEO Gold', 'B2B SEO Starter', 'B2B SEO Standard', 'B2B SEO Silver', 'B2B SEO Gold'], $data->service_pkj ?? '', ['id' => 'service_pkj']) !!}
                    <div class="invalid-feedback"></div>
                </div>

                <div class="input">
                    {!! Form::label('name', 'Client Name') !!}
                    {!! Form::text('name', $data->name ?? '', array('id' => 'name', 'placeholder' => 'Add Client Name')) !!}
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="input_group">
                <div class="input">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', $data->email ?? '', array('id' => 'email', 'placeholder' => 'Add Client Email')) !!}
                    <div class="invalid-feedback"></div>
                </div>

                <div class="input">
                    {!! Form::label('industry', 'Industry') !!}
                    {!! Form::text('industry', $data->industry ?? '', array('id' => 'industry', 'placeholder' => 'Add Client Industry')) !!}
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="input_group">
                <div class="input">
                    {!! Form::label('location', 'Location') !!}
                    {!! Form::text('location', $data->location ?? '', array('id' => 'location', 'placeholder' => 'Add Client Location')) !!}
                    <div class="invalid-feedback"></div>
                </div>

                <div class="input">
                    {!! Form::label('client_type', 'Client Type') !!}
                    <div class="radio">
                        <input type="radio" name="client_type" value="New" id="client_type" label="New" @if (isset($data) && $data->client_type == 'New'){ checked=true } @endif ?? checked=true >
                        <input type="radio" name="client_type" value="Existing" id="client_type" label="Existing" @if (isset($data) && $data->client_type == 'Existing'){ checked=true } @endif ?? '' >
                    </div>
                    <div class="invalid-feedback"></div>

                </div>
            </div>

            <div class="input_group">
                <div class="input">
                    {!! Form::label('website_type', 'Website Type') !!}
                    <div class="radio">
                        <input type="radio" name="website_type" value="New" id="website_type" label="New" @if (isset($data) && $data->website_type == 'New'){ checked=true } @endif ?? checked=true >
                        <input type="radio" name="website_type" value="Existing" id="website_type" label="Existing" @if (isset($data) && $data->website_type == 'Existing'){ checked=true } @endif ?? '' >
                    </div>
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
                    <input type="submit" value="Update Client" id="update_client">
                @else
                    <input type="submit" value="Add New Client" id="submit_new_client">
                @endif
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection


@section('script')
    <script>
        $(function(){
            $(".client_reg_form").submit(function(e){
                e.preventDefault();
                $("#submit_new_client").val("Please wait...")

                $.ajax({
                    url: '{{ route('client.client-registration') }}',
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.status == 400){
                            showError('name', data.message.name)
                            showError('email', data.message.email)
                            showError('service_pkj', data.message.service_pkj)
                            showError('business_name', data.message.business_name)
                            $("#submit_new_client").val("Add New Client")
                        } else if(data.status == 200){
                            $(".success_msg").html(showMessage('success', data.message))
                            $(".client_reg_form")[0].reset()
                            removeValidtationClasses(".client_reg_form")
                            $("#submit_new_client").val("Add New Client")
                        } else {
                            $(".success_msg").html(showMessage('fail', "Some Thing went wrong!"))
                            $("#submit_new_client").val("Add New Client")
                        }
                    }

                })
            })

            $(".update_client_form").submit(function(e){
                e.preventDefault();
                $("#update_client").val("Please wait...")

                $.ajax({
                    url: '{{ route('updateClient') }}',
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.status == 400){
                            showError('name', data.message.name)
                            showError('email', data.message.email)
                            showError('service_pkj', data.message.service_pkj)
                            showError('business_name', data.message.business_name)
                            $("#update_client").val("Update Client")
                        } else if(data.status == 200){
                            $(".success_msg").html(showMessage('success', data.message))
                            removeValidtationClasses(".update_client_form")
                            $("#update_client").val("Update Client")
                        } else {
                            $(".success_msg").html(showMessage('fail', "Some Thing went wrong!"))
                            $("#update_client").val("Update Client")
                        }
                    }

                })
            })

        })
    </script>
@endsection
