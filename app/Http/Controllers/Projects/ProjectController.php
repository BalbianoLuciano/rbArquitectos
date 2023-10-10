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
        $project = Project::create($request->all());
        
        $project->authors()->attach($request->input('author_id'), ['project_role' => $request->input('author_role')]);
        
        if ($request->input('company_id')) {
            $project->companies()->attach(
                $request->input('company_id'),
                [
                    'description' => $request->input('company_description'),
                    'company_role' => $request->input('company_role'),
                    'project_update' => $request->input('project_update'),
                    'start' => $request->input('company_start'),
                    'end' => $request->input('company_end')
                ]
            );
        }

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
        $project->update($request->all());

        // Desatachar y volver a atachar para actualizar el pivot. Considera usar sync() para proyectos con múltiples autores/companies
        $project->authors()->detach();
        $project->authors()->attach($request->input('author_id'), ['project_role' => $request->input('author_role')]);

        if ($request->input('company_id')) {
            $project->companies()->detach();
            $project->companies()->attach(
                $request->input('company_id'),
                [
                    'description' => $request->input('company_description'),
                    'company_role' => $request->input('company_role'),
                    'project_update' => $request->input('project_update'),
                    'start' => $request->input('company_start'),
                    'end' => $request->input('company_end')
                ]
            );
        }

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
