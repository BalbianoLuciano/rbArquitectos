<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\ProjectRequest;
use App\Models\Authors\Author;
use App\Models\Company\Company;
use App\Models\Projects\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $companies = Company::all();
        return view('pages.projects.create', compact('authors', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        // Crear proyecto
        $project = Project::create($request->all());

        // Gestionar relación con autores
        $authors = $request->input('authors');
        $roles = $request->input('roles');

        $authorRoleData = [];
        foreach ($authors as $index => $authorId) {
            $authorRoleData[$authorId] = ['project_role' => trim($roles[$index] ?? '')];
        }
        $project->authors()->attach($authorRoleData);

        
        if ($request->has('companies')) {
            // Gestionar relación con compañías
            $companies = $request->input('companies');
            $company_descriptions = $request->input('company_descriptions');
            $company_roles = $request->input('company_roles');
            $project_updates = $request->input('project_updates');
            $company_starts = $request->input('company_starts');
            $company_ends = $request->input('company_ends');

            $companyData = [];
            foreach ($companies as $index => $companyId) {
                $companyData[$companyId] = [
                    'description' => trim($company_descriptions[$index] ?? ''),
                    'company_role' => trim($company_roles[$index] ?? ''),
                    'project_update' => trim($project_updates[$index] ?? ''),
                    'start' => trim($company_starts[$index] ?? ''),
                    'end' => trim($company_ends[$index] ?? '')
                ];
            }
            $project->companies()->attach($companyData);
        }


        // Redireccionar
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('pages.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $authors = Author::all();
        $companies = Company::all();
        return view('pages.projects.edit', compact('project', 'authors', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        // Actualizar proyecto
        $project->update($request->all());

        // Gestionar relación con autores
        $authors = $request->input('authors');
        $roles = $request->input('roles');

        $authorRoleData = [];
        foreach ($authors as $index => $authorId) {
            $authorRoleData[$authorId] = ['project_role' => trim($roles[$index] ?? '')];
        }
        $project->authors()->sync($authorRoleData);

        // Gestionar relación con compañías solo si están presentes
        if ($request->has('companies')) {
            $companies = $request->input('companies');
            $company_descriptions = $request->input('company_descriptions');
            $company_roles = $request->input('company_roles');
            $project_updates = $request->input('project_updates');
            $company_starts = $request->input('company_starts');
            $company_ends = $request->input('company_ends');

            $companyData = [];
            foreach ($companies as $index => $companyId) {
                $companyData[$companyId] = [
                    'description' => trim($company_descriptions[$index] ?? ''),
                    'company_role' => trim($company_roles[$index] ?? ''),
                    'project_update' => trim($project_updates[$index] ?? ''),
                    'start' => trim($company_starts[$index] ?? ''),
                    'end' => trim($company_ends[$index] ?? '')
                ];
            }
            $project->companies()->sync($companyData);
        }

        // Redireccionar
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
}
