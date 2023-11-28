@extends('layouts.app')

@section('title','ユーザー登録')
@section('content')
<main class="contact-main">

	<div></div>

	<div class="separat-line"></div>
	<button id="touroku-form">{{ __('Register') }}</button>

	<section class="touroku-wrapper">
		<div class="touroku-form-pos">
			<h3>{{ __('Register') }}フォーム</h3>
			<p class="touroku-detail">各項目を入力後、登録<!-- 確認 -->ボタンを押してください。登録後はログイン画面が表示されるのでログインしてご利用ください。<!-- 自動返信メールに記載の内容をご確認ください。 --></p>

			<form action="{{ route('register') }}" class="touroku-form" method="post">
				@csrf

				<div class="row mb-3">
					<label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

					<div class="col-md-6">
						<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

						@error('name')
						<p class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</p>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

					<div class="col-md-6">
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

						@error('email')
						<p class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</p>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

					<div class="col-md-6">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

						@error('password')
						<p class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</p>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

					<div class="col-md-6">
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
					</div>
				</div>

				<div class="row mb-0">
					<div class="col-md-6 offset-md-4">
						<button id="touroku-submit" type="submit" class="btn btn-primary touroku-submit touroku-submit-on">
							登録
						</button>
					</div>

			</form>
		</div>
	</section>

	<div class="separat-line"></div>

	<div class="contact-top">
		<p><a href="#" name="privacy">プライバシーポリシー</a>についてはこちら。</p>
	</div>

	<div class="info">
		<div class="subtitle wrapper">
			<h3>お知らせ</h3>
		</div>
		<ul class="info-list">
			<li class="info-title"><a href="#">
					New Songs 更新(yyyy年mm月dd日)のお知らせ</a></li>
			<li class="info-title"><a href="#">
					システムメンテナンス(yyyy年mm月dd日)のお知らせ</a></li>


			<li class="info-title"><a href="#">プライバシーポリシーを更新しました。</a></li>


			<li class="info-title"><a href="#">楽曲募集開始のお知らせ</a></li>


			<li class="info-title"><a href="#">サイトオープンのお知らせ</a></li>

			<li class="info-title"><a href="#">→過去のお知らせ一覧</a></li>

		</ul>
	</div>

</main>
@endsection
