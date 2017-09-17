<?php

namespace App\Http\Controllers;

use App\Category;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{

	/**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Http\JsonResponse|static[]
     */
    public function index( ){

        $categories = Category::all();

        if ( count( $categories ) == 0 ){
            return response()->json(
                [
                    'error' => 'No books found',
                    'data-passed'   => 'null'
                ]
                , 400 );
        }

        return $categories;

    }

	/**
     * @param $categoryName
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Http\JsonResponse|\Illuminate\Support\Collection|static[]
     */
    public function show( $categoryName )
    {
        $books = Category::findByName( $categoryName );

        if ( count( $books ) == 0 ){
            return response()->json(
                [
                    'error' => 'No books found',
                    'data-passed'   => $categoryName
                ]
                , 400 );
        }

        return $books;

    }



}
