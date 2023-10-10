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

        <!-- Resto del formulario... -->

        <div class="mb-3">
            <label for="author_id" class="form-label">Author</label>
            <select class="form-control" id="authors" name="authors[]" multiple
                onchange="toggleRoleInput('authors', 'author_role_div')">
                <option value="">Select an author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->author_id }}"
                        {{ old('author_id', $project->author_id ?? '') == $author->author_id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3" id="author_role_div" style="display:none;">
            <label for="author_role" class="form-label">Author Role</label>
            <input type="text" class="form-control" id="author_role" name="author_role"
                value="{{ old('author_role') }}">
        </div>

        <div class="mb-3">
            <label for="company_id" class="form-label">Company</label>
            <select class="form-control" id="company_id" name="company_id"
                onchange="toggleCompanyFields('company_id', 'company_fields_div')">
                <option value="">None</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->company_id }}"
                        {{ old('company_id', $project->company_id ?? '') == $company->company_id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3" id="company_fields_div" style="display:none;">
            <label for="company_description" class="form-label">contribution Description</label>
            <input type="text" class="form-control" id="company_description" name="company_description"
                value="{{ old('company_description') }}">

            <label for="company_role" class="form-label">Company Role</label>
            <input type="text" class="form-control" id="company_role" name="company_role"
                value="{{ old('company_role') }}">

            <label for="project_update" class="form-label">Project Update</label>
            <input type="text" class="form-control" id="project_update" name="project_update"
                value="{{ old('project_update') }}">

            <label for="company_start" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="company_start" name="company_start"
                value="{{ old('company_start') }}">

            <label for="company_end" class="form-label">End Date</label>
            <input type="date" class="form-control" id="company_end" name="company_end"
                value="{{ old('company_end') }}">
        </div>

        <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Go back</a>
    </div>
</div>


@push('js')
    <script>
        function toggleRoleInput(selectId, divId) {
            const selectElement = document.getElementById(selectId);
            const roleDiv = document.getElementById(divId);
            roleDiv.style.display = selectElement.value ? 'block' : 'none';
        }

        function toggleCompanyFields(selectId, divId) {
            const selectElement = document.getElementById(selectId);
            const companyFieldsDiv = document.getElementById(divId);
            companyFieldsDiv.style.display = selectElement.value ? 'block' : 'none';
        }
    </script>
@endpush

<!-- Resto del formulario... -->
