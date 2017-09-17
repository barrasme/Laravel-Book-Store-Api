<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{

	/**
	 * @var array
	 */
	protected $hidden = ['id','created_at','updated_at'];

	/**
	 * The roles that belong to the user.
	 */
	public function products()
	{
		return $this->belongsToMany('App\Product');
	}

	/**
	 * @param $categoryName
	 *
	 * @return mixed
	 */
	public static function findByName( $categoryName )
	{
		$books = Category::where( 'name' , 'like' , urldecode( $categoryName ) )->with('products')->first();

		//Return only the related table data.
		return $books->products;

	}

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public static function findOrCreate( $data )
	{
		$category = Category::where( 'name' , 'like' , urldecode( $data['category'] ) )->first();

		if ( count( $category ) == 1 ){
			return $category->id;
		}

		return static::createCategory( $data['category'] );

	}

	/**
	 * @param $name
	 *
	 * @return mixed
	 */
	public static function createCategory( $name )
	{
		$c = new Category();

		$c->name = $name;

		$c->save();

		return $c->id;

	}

	


}
