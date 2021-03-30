<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Author;
use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return new AuthorCollection(Author::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $newAuthor = Author::addAuthor($request->all());
        return response()->json($newAuthor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Author $author)
    {
        $updatedAuthor = Author::updateAuthor($author, $request->all());

        return response()->json($updatedAuthor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json('',204);
    }
}
