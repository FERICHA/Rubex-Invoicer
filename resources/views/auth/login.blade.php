@extends('layouts.master2')

@section('title')
{{ trans('message.login') }}
@stop


@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection
@section('content')
		<div class="container-fluid @if(app()->getLocale() == 'ar') text-right @else text-left @endif">
			<div class="row no-gutter">
				
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										{{-- <div class="mb-5 d-flex"> <a href="{{ url('/' . $page='Home') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Mora<span>So</span>ft</h1></div> --}}
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>{{ trans('message.welcome') }}</h2>
												<h5 class="font-weight-semibold mb-4"> {{ trans('message.login') }}</h5>
                                                <form method="POST" action="{{ route('login') }}">
                                                 @csrf
													<div class="form-group">
													<label>{{ trans('message.email') }}</label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                     @error('email')
                                                     <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                    </span>
                                                     @enderror
													</div>

												 <div class="form-group">
											 	 <label>{{ trans('message.password') }}</label> 
                                                
                                                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                  @error('password')
                                                  <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                  </span>
												  @enderror
                                                  <div class="form-group row">
                                                      <div class="col-md-6 offset-md-4 @if(app()->getLocale() == 'ar') text-right @else text-left @endif">
                                                           <!-- <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label class="form-check-label" for="remember">
																{{ trans('message.remember_me') }}
                                                                </label>
                                                           </div> -->
                                                       </div>
                                                   </div>
												  </div>
                                                    <button type="submit" class="btn btn-main-primary btn-block">
                                                    {{ trans('message.login') }}
                                                    </button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->

                <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex ">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('assets/img/brand/logo.png')}}" alt="" width="310px">
						</div>
					</div>
				</div>

			</div>
			<form action="{{ route('change-language') }}" method="post">
    @csrf
    <select name="locale" class=" mt-5"   onchange="this.form.submit()">
        @foreach(config('app.locales') as $code => $label)
            <option value="{{ $code }}" {{ app()->getLocale() === $code ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    <input type="hidden" name="redirect_url" value="{{ url()->previous() }}">
</form>


		</div>
@endsection
@section('js')
@endsection