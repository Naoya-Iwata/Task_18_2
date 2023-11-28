<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ImagesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//
		DB::table('images')->insert(
			[
				['name' => 'no-image.jpg', 'path' => 'public/no-image.jpg', 'post_id' => '1'],
				['name' => 'no-image.jpg', 'path' => 'public/no-image.jpg', 'post_id' => '2'],
				['name' => 'no-image.jpg', 'path' => 'public/no-image.jpg', 'post_id' => '3'],
				['name' => 'no-image.jpg', 'path' => 'public/no-image.jpg', 'post_id' => '4'],
				['name' => 'no-image.jpg', 'path' => 'public/no-image.jpg', 'post_id' => '5'],
			]
		);
	}
}
