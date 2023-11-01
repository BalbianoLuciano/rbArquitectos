<?php

namespace App\Http\Controllers\Authors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authors\AuthorRequest;
use App\Models\Authors\Author;
use App\Models\Company\Company;

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
        $companies = Company::all();

        return view('panel.authors.create', compact('companies'));
    }

    /**
     * Store a newly created author in storage.
     *
     * @param  \App\Http\Requests\Authors\AuthorRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AuthorRequest $request)
    {
        $author = Author::create($request->validated());

        if ($request->hasFile('image')) {
            $author->addMediaFromRequest('image')
                ->withResponsiveImages()
                ->toMediaCollection('image');
        } else {
            // Aquí especificas la ruta a la imagen de perfil por defecto que has guardado en tu proyecto
            $author->addMedia(public_path('images/default-profile.jpg'))
                ->toMediaCollection('image');
        }

        $this->manageWorkHistories($author, $request, 'attach');

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
        $companies = Company::all();

        return view('panel.authors.edit', compact('author', 'companies'));
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

        if ($request->hasFile('image')) {
            // Eliminar imagen existente y cargar la nueva
            $author->clearMediaCollection('image'); // Elimina la imagen existente
            $author->addMediaFromRequest('image')
                ->withResponsiveImages()
                ->toMediaCollection('image');
        }

        $this->manageWorkHistories($author, $request, 'sync');

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

    private function manageWorkHistories($author, $request, $method)
    {
        if ($request->has('companies')) {

            $companies = $request->input('companies');
            $positions = $request->input('positions');
            $starts = $request->input('starts');
            $ends = $request->input('ends');

            $workHistoryData = [];

            foreach ($companies as $index => $companyId) {
                $workHistoryData[$companyId] = [
                    'position' => trim($positions[$index] ?? ''),
                    'start' => trim($starts[$index] ?? ''),
                    'end' => trim($ends[$index] ?? '')
                ];
            }
            $author->companies()->$method($workHistoryData);
        }
    }
}
