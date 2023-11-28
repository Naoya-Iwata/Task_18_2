@extends('layouts.app')
@if(Request::routeIs('search.index'))
@section('title','検索結果')
@else
@section('title','投稿楽曲一覧')
@endif
@section('content')

<main>
	<div></div>

	<!-- <div id="top-bg" class="top-bg">
		<div class="top-logo">
			<img class="top-logo-image" src="./img/materials/logo_fix.png" alt="キャッチコピー">
		</div>
	</div> -->

	<!-- サイトについて -->

	<!-- <div class="monokuro-bg"></div>
	<div class="partation">
		<h2 class="partation-title">サイトについて</h2>
	</div>
	<div class="touka wrapper">
		<p><span>｢MArc(マーク)｣</span>は個人で作成した楽曲をアップロードしたり、他のユーザーが作成した楽曲を試聴、ダウンロードできるサウンドクリエイターのためのプラットフォームです。※試聴は登録不要</p>
		<p><span>独創性あふれる刺激的で素敵な楽曲が、あなたを待っています。</span></p>
		<p><a href="{{ route('register') }}">→ユーザー登録はこちら</a></p>
	</div> -->

	<!-- スワイパー部分 -->

	<div class="monokuro-bg"></div>
	<div class="partation">
		<h2 class="partation-title">ギャラリー</h2>
	</div>

	<!-- 投稿・検索フォームのdiv@iwata -->
	<div class="flex wrapper" style="display:flex; justify-content:center; gap:4%;">

		<!-- 投稿ボタン -->
		<p class="pull-right"><a class="btn btn-success" href="/create-form">投稿する</a></p>

		<!-- 検索フォーム@iwata -->
		{!! Form::open(['url' => 'index','style' => 'display:flex; align-items:center;']) !!}

		<div class="form-group">

			{!! Form::input('text', 'newSearch', request()->newSearch, ['class' => 'form-control', 'placeholder' => '本文検索','style' => 'width:100%; line-height:24px; border-radius: 3px; border:1px solid #333']) !!}

		</div>

		<button type="submit" class="btn btn-success pull-right" style="margin-top: 0; cursor: pointer;">検索</button>

		{!! Form::close() !!}

	</div>
	<!-- ここまで検索フォーム -->

	@if(Request::routeIs('search.index') && empty($length))

	<!-- あいまい検索含め、投稿内容が取得できなかった場合はこっちを表示する -->
	<h3 style="text-align: center; margin:20px 0 -20px; color:#333">検索結果は0件です。</h3>

	@elseif(Request::routeIs('search.index') && !empty($length))

	<!-- 検索ボタンのルートはこっちを表示する -->
	<h3 style="text-align: center; margin:20px 0 -20px; color:#333">{{ $length }}件ヒットしました。</h3>
	<p class="pick-p">投稿を左右にスワイプできます</p>

	@elseif(Request::routeIs('index'))

	<p class="pick-p">投稿を左右にスワイプできます</p>

	@endif

	<!-- 投稿一覧 -->

	@if(!empty($lists))

	<section class="top-section">
		<div class="swiper">
			<ul class="swiper-wrapper">

				@foreach ($lists as $list)

				<li class="swiper-slide">
					<div href="player.php" class="swiper-item">
						<div class="swiper-image">

							@if($list->path == 'public/no-image.jpg')
							<img src="{{ asset ('img/no-image.jpg')}}" alt="ジャケット">
							@else
							<img src="{{ asset ('storage/'.$list->name)}}" alt="ジャケット">
							@endif

						</div>
						<div class="swiper-ditail">
							<h3>{{ $list->title }}</h3>
							<p>投稿者：{{ $list->user_name }}</p>
							<p>更新日時：{{ $list->updated_at }}</p>
							<p>{{ $list->post }}</p>
						</div>
						<!-- 現在ログインユーザーが投稿した記事のみボタン表示 -->
						@if(Auth::id() == $list->user_id)
						<div class="btn-flex">
							<a class="btn btn-primary" href="/post/{{ $list->id }}/update-form">UP DATE</a>
							<a class="btn btn-danger" href="javascript:void(0)" onclick="return check(<?php echo $list->id ?>)">DELETE</a>
						</div>
						@else
						<!-- 装飾用 -->
						<div class="btn-flex">
							<div class="btn btn-primary btn-visual"></div>
							<div class="btn btn-danger btn-visual"></div>
						</div>
					</div>
					@endif
				</li>

				@endforeach

			</ul>
		</div>
	</section>

	@endif


	@foreach ($lists as $list)
	<!-- 削除確認ポップアップ -->
	<div id="overflow{{$list->id}}" class="overflow">
		<div class="conf">
			<div class="conf_inner">
				<p>この投稿を削除してもよろしいですか？</p>
				<div class="btns">
					<form action="/post/{{ $list->id }}/{{ $list->name }}/delete" onclick="return next(<?php echo $list->id ?>)">
						<input type="button" value="キャンセル" onclick="cansel(<?php echo $list->id ?>);">
						<input type="submit" value="OK" class="ok">
					</form>
				</div>
			</div>
		</div>
	</div>
	@endforeach


</main>
@endsection
