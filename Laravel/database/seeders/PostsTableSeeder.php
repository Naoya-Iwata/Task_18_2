<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//
		DB::table('posts')->insert([

			['post' => '1つ目の投稿になります', 'title' => 'title1'],
			['post' => 'Laravelの投稿ページを作りました', 'title' => 'title2'],
			['post' => '投稿についてのCRUD一式を作っています', 'title' => 'title3'],
			['post' => 'MVCの役割を体験中です', 'title' => 'title4'],
			['post' => '初期レコードがこれで終わりです。', 'title' => 'title5'],

		]);
	}
}
