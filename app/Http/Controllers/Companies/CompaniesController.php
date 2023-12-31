<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompaniesRequest;
use App\Models\Company\Company;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('panel.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompaniesRequest $request)
    {
        $company = Company::create($request->validated());

        if ($request->hasFile('image')) {
            $company->addMediaFromRequest('image')
                ->withResponsiveImages()
                ->toMediaCollection('image');
        } else {
            // Aquí especificas la ruta a la imagen de perfil por defecto que has guardado en tu proyecto
            $company->addMedia(public_path('images/default-company.png'))
                ->toMediaCollection('image');
        }

        return redirect()->route('panel.companies.index')->with('success', 'Company created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('panel.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('panel.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompaniesRequest $request, Company $company)
    {
        $company->update($request->validated());

        if ($request->hasFile('image')) {
            // Eliminar imagen existente y cargar la nueva
            $company->clearMediaCollection('image'); // Elimina la imagen existente
            $company->addMediaFromRequest('image')  
                ->withResponsiveImages()
                ->toMediaCollection('image');
        }

        return redirect()->route('panel.companies.index')->with('success', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('panel.companies.index')->with('success', 'Company deleted successfully!');
    }
}
