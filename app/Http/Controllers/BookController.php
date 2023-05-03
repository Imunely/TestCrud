<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;



class BookController extends Controller
{

    public function public()
    {
        $books = Book::orderBy('books.id', 'desc')->join('authors', 'authors.id', '=', 'books.author_id')->select('books.*', 'authors.name as author')->paginate(5);

        return view('welcome', compact('books'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('books.id', 'desc')->join('authors', 'authors.id', '=', 'books.author_id')->select('books.*', 'authors.name as author')->paginate(5);

        return view('admin.books', compact('books'));
    }


    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createbook');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author_id' => 'required',
        ]);

        Book::create($request->post());

        return redirect()->route('books')->with('success', 'Book has been created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('admin.editbook', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name' => 'required',
            'author_id' => 'required',
        ]);

        $book->fill($request->post())->save();

        return redirect()->route('books')->with('success', 'Book Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Book $book)
    {
        $book->delete();
        return redirect()->route('books')->with('success', 'Book has been deleted successfully');
    }
}
