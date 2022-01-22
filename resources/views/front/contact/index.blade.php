@extends('front._layout.layout')

@section('seo_title','Contact Us')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        @if(!empty($system_message))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{__('Your message has been received, we will contact you soon')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading"><h3>{{__('Contact Us')}}</h3></div>
            <div class="panel-body">
                <form action="{{route('front.contact.send_message')}}" method="post" id="contact_us_form" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="">{{__('Your Name')}}</label>
                        <input 
                            type="text" 
                            class="form-control @if($errors->has('contact_person')) is-invalid @endif" 
                            id=""
                            name="contact_person"
                            value="{{old('contact_person')}}"
                        >
                        @include('admin._layout.partials.form_errors',['fieldName' => 'contact_person'])
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Your E-mail')}}</label>
                        <input 
                            type="text" 
                            class="form-control @if($errors->has('contact_email')) is-invalid @endif" 
                            id=""
                            name="contact_email"
                            value="{{old('contact_email')}}"
                        >
                        @include('admin._layout.partials.form_errors',['fieldName' => 'contact_email'])
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Message')}}</label>
                        <textarea 
                            class="form-control @if($errors->has('contact_message')) is-invalid @endif" 
                            id="" 
                            cols="10"
                            name="contact_message"
                            style="height: 100px;">{{old('contact_message')}}</textarea>
                            @include('admin._layout.partials.form_errors',['fieldName' => 'contact_message'])
                    </div>
                    <div class="form-group">
                        {!! htmlFormSnippet() !!}
                        @if($errors->has('g-recaptcha-response'))
                        <div class="text-danger">
                            Please confirm that you are not a robot
                        </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{__('Send Message')}}</button>
                    <button type="button" class="btn btn-link btn-block"><span>Having trouble?</span> Call us: +1 555 555 7</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('head_recaptcha')
{!! ReCaptcha::htmlScriptTagJsApi() !!}
@endpush


@push('footer_javascript')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
<script type="text/javascript">
$('#contact_us_form').validate({
    
    "rules":{
        "contact_person":{
            "required":true,
            "minlength":2,
            "maxlength":255
        },
        "contact_email":{
            "required":true,
            "email":true,
            "maxlength":255
        },
        "contact_message":{
            "required":true,
            "minlength":50,
            "maxlength":500
        }
    },
    "errorPlacement": function (error, element) {
        error.addClass('text-danger');
        error.insertAfter(element);
    }
});



</script>
@endpush