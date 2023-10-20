<div class="card">
    <div class="card-body">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', $project->name ?? '') }}" required>
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="direction" class="form-label">Direction (Optional)</label>
            <input type="text" class="form-control" id="direction" name="direction"
                value="{{ old('direction', $project->direction ?? '') }}">
            @error('direction')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $project->description ?? '') }}</textarea>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="start" class="form-label">Start Date (Optional)</label>
            <input type="date" class="form-control" id="start" name="start"
                value="{{ old('start', $project->start ?? '') }}">
            @error('start')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="end" class="form-label">End Date (Optional)</label>
            <input type="date" class="form-control" id="end" name="end"
                value="{{ old('end', $project->end ?? '') }}">
            @error('end')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Project Images</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
            @error('images')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Resto del formulario... -->

        @include('panel.projects.addAuthor')
        @include('panel.projects.addCompany')

        
    </div>
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    <a href="{{ route('panel.projects.index') }}" class="btn btn-secondary">Go back</a>
</div>
