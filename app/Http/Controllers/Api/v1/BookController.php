<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\GaneralController;
use Illuminate\Support\Facades\Validator;



class BookController extends GaneralController
{

    public function list()
    {
        $books = Book::orderBy('books.id', 'desc')->join('authors', 'authors.id', '=', 'books.author_id')->select('books.*', 'authors.name as author')->paginate(5);

        return $this->sendResponse($books, 'Books retrieved successfully.');
    }


    public function get(int $id)
    {
        $book = Book::where('id', $id)->first();

        return $this->sendResponse($book, 'Books retrieved successfully.');
    }


    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'author_id' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $book->fill($request->post())->save();

        return $this->sendResponse([$book->first()], 'Book updated successfully.');
    }


    public function delete(Book $book)
    {
        $book->delete();

        return $this->sendResponse([$book->first()], 'Book deleted successfully.');
    }
}
