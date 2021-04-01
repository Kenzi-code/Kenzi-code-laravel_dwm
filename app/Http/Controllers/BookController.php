<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->query();


        if(isset($query['sort'])){
            if($query['sort'] === 'titleAsc'){
                $books = Book::orderBy('title', 'asc');
                return new BookCollection($books->paginate(10));
            }
            else if($query['sort'] === 'titleDesc'){
                $books = Book::orderBy('title', 'desc');
                return new BookCollection($books->paginate(10));
            }
            else if($query['sort'] === 'descriptionAsc'){
                $books = Book::orderBy('description', 'asc');
                return new BookCollection($books->paginate(10));
            }
            else if($query['sort'] === 'descriptionDesc'){
                $books = Book::orderBy('description', 'desc');
                return new BookCollection($books->paginate(10));
            }
        
        }
        else{
            return new BookCollection(Book::paginate(10));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $newBook = Book::addBook($request->all());

        return response()->json($newBook, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book =  Book::find($id);
        if ($book){
            return new BookResource($book);
        }
        else{
            return response()->json(['message' => 'This book does not exist'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $updatedBook =  Book::updateBook($book, $request->all());

        return response()->json($updatedBook, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json('', 204);
    }
}
