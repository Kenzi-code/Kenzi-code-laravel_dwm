<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public static function getOne($id)
    {
        return Book::find($id);
    }
    
    public static function addBook($data)
    {
        $book = new Book;
        $book->title = $data['title'];
        $book->description = $data['description'];
        $book->author_id = $data['author_id'];
        $book->publication_year = $data['publication_year'];
        $book->pages_nb = $data['pages_nb'];
        $book->save();
        return $book;
    }

    public static function updateBook($book, $data)
    {
        $book->title = $data['title'];
        $book->description = $data['description'];
        $book->author_id = $data['author_id'];
        $book->publication_year = $data['publication_year'];
        $book->pages_nb = $data['pages_nb'];
        $book->save();

        return $book;
    }
}
