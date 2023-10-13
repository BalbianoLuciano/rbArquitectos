<?php

namespace App\Http\Controllers\Authors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authors\AuthorRequest;
use App\Models\Authors\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of authors.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $authors = Author::paginate(10); // 10 autores por página
        return view('panel.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new author.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('panel.authors.create');
    }

    /**
     * Store a newly created author in storage.
     *
     * @param  \App\Http\Requests\Authors\AuthorRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AuthorRequest $request)
    {
        Author::create($request->validated());
        return redirect()->route('panel.authors.index')->with('success', 'Author created successfully.');
    }

    /**
     * Display the specified author.
     *
     * @param  \App\Models\Authors\Author  $author
     * @return \Illuminate\View\View
     */
    public function show(Author $author)
    {
        return view('panel.authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified author.
     *
     * @param  \App\Models\Authors\Author  $author
     * @return \Illuminate\View\View
     */
    public function edit(Author $author)
    {
        return view('panel.authors.edit', compact('author'));
    }

    /**
     * Update the specified author in storage.
     *
     * @param  \App\Http\Requests\Authors\AuthorRequest  $request
     * @param  \App\Models\Authors\Author  $author
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->validated());
        return redirect()->route('panel.authors.index')->with('success', 'Author updated successfully.');
    }

    /**
     * Remove the specified author from storage.
     *
     * @param  \App\Models\Authors\Author  $author
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('panel.authors.index')->with('success', 'Author deleted successfully.');
    }
}
