@extends('layouts.app')

@section('title','ログイン')
@section('content')
<main class="login-main">

	<div> </div>

	<div class="separat-line"></div>
	<img src="{{ asset ('img/materials/logo_fix.png')}}" alt="" id="login-img">

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<!-- <div class="card-header">{{ __('Login') }}</div> -->

					<div class="card-body">
						<form id="login-form" method="POST" action="{{ route('login') }}">
							@csrf

							<div class="row mb-3">
								<label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

									@error('email')
									<span class="invalid-feedback" role="alert" style="white-space: nowrap;">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="row mb-3" style="margin-bottom: 5px;">
								<label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

									@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-md-6 offset-md-4">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" style="width: auto;" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

										<label class="form-check-label" for="remember">
											{{ __('Remember Me') }}
										</label>
									</div>
								</div>
							</div>

							<div class="row mb-0">
								<div class="col-md-8 offset-md-4">
									<button id="login" name="login" type="submit" class="btn btn-primary">
										{{ __('Login') }}
									</button>

									@if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}" style="display: block; text-align:center; margin-top:30px; margin-bottom:30px; color: revert;">
										{{ __('Forgot Your Password?') }}
									</a>
									@endif
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection
