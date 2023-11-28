<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;/* @iwata */
use App\Models\Image;/* @iwata */


class ImageController extends Controller
{
	//

	public function upload(Request $request)
	{
		dd($request);

		// 画像ファイル保存
		// ディレクトリ名
		$dir = 'images';

		// アップロードされたファイル名を取得
		$file_name = $request->file('image')->getClientOriginalName();

		// 取得したファイル名で保存
		$request->file('image')->storeAs('public/' . $dir, $file_name);

		// ファイル情報をDBに保存
		$image = new Image();
		$image->name = $file_name;
		$image->path = 'storage/' . $dir . '/' . $file_name;
		$image->save();

		return redirect('index');
	}
}
