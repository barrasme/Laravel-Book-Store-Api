<?php

namespace App\Http\Controllers;

use App\Product;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{

	/**
     * @param $author
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Http\JsonResponse|\Illuminate\Support\Collection|static[]
     */
    public function show( $author , $category = null  )
    {

        $books = Product::findByAuthor( $author , $category );

        if ( count( $books ) == 0 ){
            return response()->json(
                [
                    'error' => 'No books found',
                    'data-passed'   => $author
                ]
                , 400 );
        }

        return $books;

    }

	/**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function store( \Illuminate\Http\Request $request )
    {

        $status = Product::createNewProduct( $request->all() );

        if ( $status == 'failed'){
            return response('Invalid ISBN' , 400);
        }

        return response($request->all() , 201);
    }


}
