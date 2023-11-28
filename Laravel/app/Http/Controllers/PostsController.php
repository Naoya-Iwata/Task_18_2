<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; /* 自分で追加してる */
use App\Models\Post;/* @iwata */
use App\Models\Image;/* @iwata */
use Exception;

class PostsController extends Controller
{
	//


	public function createForm()
	{

		return view('posts.createForm');
	}

	public function create(Request $request)

	{

		$this->validate(
			$request,
			[
				'newPost' => ['required', 'regex:/[^ 　]+/', 'max:100']
			]
		); //必須で100文字制限@iwata

		$post = new Post();
		$post->user_id = Auth::id();
		$post->post = $request->input('newPost');
		$post->title = $request->input('newTitle');
		$post->save();

		return redirect('index');
	}

	public function updateForm($id)
	{

		$post = DB::table('posts')

			->where('id', $id)

			->first();

		return view('posts.updateForm', ['post' => $post]);
	}

	public function update(Request $request)

	{
		$id = $request->input('id');
		$up_title = $request->input('upTitle');
		$up_post = $request->input('upPost');

		// 今表示している投稿id＝$idを受け取って該当する投稿レコードを呼び出し
		$current_post = DB::table('posts')

			->where('id', $id)->get();

		// $current_post がコレクションインスタンスなので		foreachでuser_idを取り出し、$user_id変数へ代入
		foreach ($current_post as $post) {
			$user_id = $post->user_id;
		}

		// 現在ログイン中のユーザーIDと現在の投稿のuser_idが一致しない場合はエラーを返す
		if (Auth::id() !== $user_id) {
			abort(403);
		}

		// 通常のアップデート処理
		$this->validate($request, [
			'upTitle' => ['required', 'regex:/[^ 　]+/', 'max:30'],
			'upPost' => ['required', 'regex:/[^ 　]+/', 'max:100']
		]); //必須で100文字制限@iwata

		DB::table('posts')

			->where('id', $id)

			->update(

				['post' => $up_post, 'title' => $up_title]

			);

		return redirect('index');
	}

	public function delete($id, $name)

	{

		try {

			// 画像自体の削除 ユニークな画像ファイルが存在しない場合は画像削除は無視する
			unlink(public_path('storage/' . $name));
		} catch (Exception $e) {
		};


		DB::table('posts')

			->where('id', $id)

			->delete();


		return redirect('index');
	}

	public function __construct()

	{

		$this->middleware('auth');
	}


	// 通常のindexメソッド
	public function index()

	{

		$list = DB::table('posts')
			->join('users', 'posts.user_id', '=', 'users.id')
			->join('images', 'posts.id', '=', 'images.post_id')
			->select('posts.id', 'users.name as user_name', 'posts.post', 'posts.user_id', 'posts.created_at', 'posts.updated_at', 'images.name', 'images.path', 'posts.title')
			->get();

		return view('posts.index', ['lists' => $list]);
	}

	// あいまい検索で使うsearchメソッド
	public function search(Request $request)

	{

		$search = $request->input('newSearch');

		$validate = preg_match('/[^ 　]+/', $search);

		if ($validate == 1) {

			$list = DB::table('posts')
				->join('users', 'posts.user_id', '=', 'users.id')
				->join('images', 'posts.id', '=', 'images.post_id')
				->select('posts.id', 'users.name as user_name', 'posts.post', 'posts.user_id', 'posts.created_at', 'posts.updated_at', 'images.name', 'images.path', 'posts.title')
				->where('posts.post', 'like', '%' . $search . '%')
				->get();
		} else {

			return redirect('index');
		}

		// 検索結果の数
		$len = $list->count();

		return view('posts.index', ['lists' => $list, 'length' => $len]);
	}

	// 画像付きで保存するメソッド
	public function store(Request $request)
	{

		$this->validate(
			$request,
			[
				'newTitle' => ['required', 'regex:/[^ 　]+/', 'max:30'],
				'newPost' => ['required', 'regex:/[^ 　]+/', 'max:100']
			]
		); //必須で100文字制限@iwata

		$post = new Post();
		$post->user_id = Auth::id();
		$post->title = $request->input('newTitle');
		$post->post = $request->input('newPost');
		$post->save();

		if ($request->hasFile('image')) {

			$image = $request->file('image');
			$filename = uniqid() . '.' . $image->getClientOriginalName();
			$path = $image->storeAs('public', $filename);

			$image = new Image;
			$image->name = $filename;
			$image->path = $path;
			$image->post_id = $post->id;
			$image->save();
		} else {

			$path = 'public/no-image.jpg';
			$image = new Image;
			$image->name = uniqid() . '.' . 'no-image.jpg';
			$image->path = $path;
			$image->post_id = $post->id;
			$image->save();
		}

		return redirect('index');
	}
}
