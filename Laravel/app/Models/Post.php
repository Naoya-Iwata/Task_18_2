<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory;

	public function user()
	{

		return $this->belongsTo(User::class);
	} /* @iwata */

	// Imagesとの1対1のリレーションメソッドを定義
	public function Images()
	{
		return $this->belongsTo(Image::class);
	} /* @iwata */
}
