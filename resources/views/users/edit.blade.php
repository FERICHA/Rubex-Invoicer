@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
تعديل مستخدم 
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('message.Users') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/{{ trans('message.User_modification') }}
                </span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">{{ trans('message.Back') }}</a>
                    </div>
                </div><br>

                {!! Form::model($user, ['method' => 'PUT','route' => ['users.update', $user->id]]) !!}
                <div class="">

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6" id="fnWrapper">
                            <label>{{ trans('message.user_name') }} <span class="tx-danger">*</span></label>
                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label> {{ trans('message.email') }}<span class="tx-danger">*</span></label>
                            {!! Form::text('email', null, array('class' => 'form-control')) !!}
                        </div>
                    </div>

                </div>

                <div class="row mg-b-20">
                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>{{ trans('message.password') }} <span class="tx-danger">*</span></label>
                        {!! Form::password('password', array('class' => 'form-control')) !!}
                    </div>

                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>{{ trans('message.confirm_password') }} <span class="tx-danger">*</span></label>
                        {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="row row-sm mg-b-20">
                    <div class="col-lg-6">
                        <label class="form-label">{{ trans('message.state') }} </label>
                        <select name="status" id="select-beast" class="form-control nice-select custom-select">
    <option value="{{ $user->status }}">
        {{ $user->status == 'active' ? trans('message.Enabled') : trans('message.Not_enabled') }}
    </option>
    <option value="active">{{ trans('message.Enabled') }}</option>
    <option value="deactive">{{ trans('message.Not_enabled') }}</option>
</select>

                    </div>
                </div>

               
                <div class="mg-t-30">
                    <button class="btn btn-main-primary pd-x-20" type="submit">{{ trans('message.update') }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>




</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection