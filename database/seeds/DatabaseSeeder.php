<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
//		 $this->call('CategorySeeder');
//		 $this->call('ProductSeeder');
		 $this->call('PivotSeeder');
	}
}

class CategorySeeder extends Seeder {

	public function run() {

		DB::table( 'categories' )->insert( [
			'name' => 'PHP',
		] );
		DB::table( 'categories' )->insert( [
			'name' => 'JavaScript',
		] );
		DB::table( 'categories' )->insert( [
			'name' => 'Linux',
		] );

	}

}

class ProductSeeder extends Seeder {

	public function run() {

		DB::table( 'products' )->insert( [
			'ISBN' => '978-1491918661',
			'title' => 'Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5',
			'author' => 'Robin Nixon',
			'price' => '9.99',
		] );

		DB::table( 'products' )->insert( [
			'ISBN' => '978-0596804848',
			'title' => 'Ubuntu: Up and Running: A Power User\'s Desktop Guide',
			'author' => 'Robin Nixon',
			'price' => '12.99',
		] );

		DB::table( 'products' )->insert( [
			'ISBN' => '978-1118999875',
			'title' => 'Linux Bible',
			'author' => 'Christopher Negus',
			'price' => '19.99',
		] );

		DB::table( 'products' )->insert( [
			'ISBN' => '978-0596517748',
			'title' => 'JavaScript: The Good Parts',
			'author' => 'Douglas Crockford',
			'price' => '8.99',
		] );

	}

}

class PivotSeeder extends Seeder {

	public function run() {

		DB::table( 'category_product' )->insert( [
			'product_id' => 1,
			'category_id' => 1,
		] );
		DB::table( 'category_product' )->insert( [
			'product_id' => 1,
			'category_id' => 2,
		] );
		DB::table( 'category_product' )->insert( [
			'product_id' => 2,
			'category_id' => 3,
		] );
		DB::table( 'category_product' )->insert( [
			'product_id' => 3,
			'category_id' => 3,
		] );
		DB::table( 'category_product' )->insert( [
			'product_id' => 4,
			'category_id' => 2,
		] );

	}

}