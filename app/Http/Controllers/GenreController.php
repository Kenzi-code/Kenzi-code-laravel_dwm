<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreCollection;
use App\Http\Resources\GenreResource;
use Illuminate\Http\Request;

use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /*  public function index()
    {
        //$genre = Genre::all(); 
        $genre = Genre::paginate(10);
        return response()->json($genre, 200);
    } */
    public function index(Request $request)
    {
        $query = $request->query();


        if(isset($query['sort'])){
            if($query['sort'] === 'nameAsc'){
                $genres = Genre::orderBy('name', 'asc');
                return new GenreCollection($genres->get());
            }
            else if($query['sort'] === 'nameDesc'){
                $genres = Genre::orderBy('name', 'desc');
                return new GenreCollection($genres->get());
            }
        
        }
        else{
            return new GenreCollection(Genre::all());
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

        $newGenre = Genre::addGenre($request->all());

        return response()->json($newGenre, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genre = Genre::find($id);

        if ($genre){
            return new GenreResource($genre);
        }
        else{
            return response()->json(['message' => 'This genre does not exist'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $updatedGenre =  Genre::updateGenre($genre, $request->all());

        return response()->json($updatedGenre, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json('', 204);
    }
}
