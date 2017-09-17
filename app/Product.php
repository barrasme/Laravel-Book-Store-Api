<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{

	/**
     * @var array
     */
    protected $hidden = ['id','created_at','updated_at'];


    /**
     * The roles that belong to the user.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

	/**
     * @param $author
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public static function findByAuthor( $author , $categoryName = null )
    {

        /*
         * If we are passed a categoryName then we can use that to query the pivot table.
         */
        if( isset( $categoryName )){

            return Product::where('author' , 'like' , urldecode( $author ) )->
                whereHas('categories', function ($q) use ( $categoryName ) {
                    $q->where('name', 'like' , $categoryName );
                })
                ->get();

        } else {

            return Product::where('author' , 'like' , urldecode( $author ) )
                          ->with('categories')
                          ->get();
        }
    }

	/**
     * @param $data
     */
    public static function createNewProduct( $data )
    {
        //Test the new data
        if (! is_numeric( $data['isbn'])){
            return 'failed';
        }

        //Find or create the new category
        $category_id = Category::findOrCreate( $data );

        $p = new Product();

        $p->isbn = $data['isbn'];
        $p->title = $data['title'];
        $p->author = $data['author'];
        $p->price = $data['price'];

        $p->save();

        //Using the category ID, create the new product
        DB::table('category_product')->insert(
            [
                'product_id' => $p->id,
                'category_id' => $category_id
            ]
        );

        return $p;

    }

}