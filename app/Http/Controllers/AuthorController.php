<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;



class AuthorController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::orderBy('id', 'desc')->paginate(5);

        return view('admin.authors', compact('authors'));
    }


    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createauthor');
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
        ]);

        Author::create($request->post());

        return redirect()->route('authors')->with('success', 'Author has been created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('admin.editauthor', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $author->fill($request->post())->save();

        return redirect()->route('authors')->with('success', 'Author Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Author $author)
    {
        $author->delete();
        return redirect()->route('authors')->with('success', 'Author has been deleted successfully');
    }
}
