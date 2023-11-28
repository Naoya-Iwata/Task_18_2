@extends('layouts.app')

@section('content')

<main>
	<div></div>

	<section class="donation-section">
		<div class="monokuro-bg"></div>

		<div class="partation">
			<h2 class="partation-title">投稿を更新する</h2>
		</div>

		<div class="donation-wrapper" id="donation-wrapper">
			<p>投稿の本文を更新することができます。内容を入力後、「更新する」ボタンを押してください。
			<p>なお、更新前に必ず当サイトの<a href="" name="privacy">プライバシーポリシー</a>および<a href="" name="privacy">利用規約</a>をご一読いただきますようにお願い致します。<br><span class="privacy">※著作権侵害等のトラブルが発生した場合、当サイトは一切の責任を負いかねます。</span></p>
		</div>


		<div class="separat-line"></div>

		<section class=" donation-wrapper">
			<div class="donation-detail">

				{!! Form::open(['url' => 'post/update','onSubmit'=>'return next()', 'class' => 'uproad-form']) !!}

				<div class="message-area">
					<h3 style="margin-top: 0;">タイトル</h3>
					<div class="upmessage-detail" style="margin-bottom:30px;">

						{!! Form::hidden('id', $post->id) !!}
						{!! Form::text('upTitle', $post->title, ['required', 'class' => 'form-control','id'=>'song-title' ] ) !!}

						@error('upTitle')
						<p class="alert">
							<strong>{{ $message }}</strong>
						</p>
						@enderror

					</div>

					<h3 style="margin-top: 0;">説明</h3>
					<div class="upmessage-detail">

						{!! Form::textarea('upPost', $post->post, ['required', 'class' => 'form-control','cols' => '33','rows' => '10','id'=>'song-message' ] ) !!}

					</div>
					@error('upPost')
					<p class="alert">
						<strong>{{ $message }}</strong>
					</p>
					@enderror
				</div>

				{!! Form::button('更新する', ['onclick' => 'check()', 'class' => 'btn btn-primary pull-right search-submit search-submit-on']) !!}

				<!-- 確認ポップアップ -->
				<div id="overflow" class="overflow">
					<div class="conf">
						<div class="conf_inner">
							<p>更新してよろしいですか？</p>
							<div class="btns">
								<input type="button" value="キャンセル" onclick="cansel();">
								<!-- {!! Form::button('キャンセル', ['onclick' => 'cansel()']) !!} ※CSSレイアウト直さないといけないので非適用 -->

								<input type="submit" value="OK" class="ok">
								<!-- {!! Form::submit('OK', ['class' => 'ok']) !!} ※CSSレイアウト直さないといけないので非適用 -->
							</div>
						</div>
					</div>
				</div>

				{!! Form::close() !!}

			</div>
		</section>

	</section>
</main>

@endsection
