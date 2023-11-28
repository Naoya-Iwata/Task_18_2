@extends('layouts.app')

@section('title','新規投稿')

@section('content')

<main>
	<div></div>

	<section class="donation-section">
		<div class="monokuro-bg"></div>

		<div class="partation">
			<h2 class="partation-title">新しく投稿する</h2>
		</div>

		<div class="donation-wrapper" id="donation-wrapper">
			<p>新しい画像とその説明を投稿することができます。内容を入力、画像をアップロード後、「投稿する」ボタンを押してください。
			<p>なお、投稿前に必ず当サイトの<a href="" name="privacy">プライバシーポリシー</a>および<a href="" name="privacy">利用規約</a>をご一読いただきますようにお願い致します。<br><span class="privacy">※著作権侵害等のトラブルが発生した場合、当サイトは一切の責任を負いかねます。</span></p>
		</div>


		<div class="separat-line"></div>

		<section class=" donation-wrapper">
			<div class="donation-detail">

				{!! Form::open(['route' => 'posts.store' ,'files' => 'true' , 'class' => 'uproad-form']) !!}

				<h3 style="margin-top: 0;">タイトル</h3>
				<div class="upmessage-detail" style="margin-bottom:30px;">

					{!! Form::text('newTitle', old('newTitle'), ['required', 'class' => 'form-control','id'=>'song-title'] ) !!}

					@error('newTitle')
					<p class="alert">
						<strong>{{ $message }}</strong>
					</p>
					@enderror
				</div>

				<div class="message-area">
					<h3 style="margin-top: 0;">本文</h3>
					<div class="upmessage-detail">

						{!! Form::textarea('newPost', old('newPost'), ['required', 'class' => 'form-control','cols' => '33','rows' => '10','id'=>'song-message','placeholder' => '画像の説明' ] ) !!}

						{{ Form::file('image'),['required', 'class' => 'form-control' ] }}

					</div>
					@error('newPost')
					<p class="alert">
						<strong>{{ $message }}</strong>
					</p>
					@enderror
				</div>

				{{ Form::button('投稿する', ['type' => 'submit', 'class' => 'btn btn-success pull-rightsearch-submit search-submit search-submit-on']) }}

				{!! Form::close() !!}

			</div>
		</section>

	</section>
</main>

@endsection
