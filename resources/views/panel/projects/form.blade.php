<div class="card">
    <div class="card-body">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', $project->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="direction" class="form-label">Direction (Optional)</label>
            <input type="text" class="form-control" id="direction" name="direction"
                value="{{ old('direction', $project->direction ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $project->description ?? '') }}</textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="hidden" name="isOtherProject" value="0">
            <input type="checkbox" class="form-check-input" id="isOtherProject" name="isOtherProject" value="1" {{ old('isOtherProject', $project->isOtherProject ?? 0) ? 'checked' : '' }}>
            <label class="form-check-label" for="isOtherProject">Is this an Other Project?</label>
        </div>
        
        <div class="mb-3">
            <label for="start" class="form-label">Start Date (Optional)</label>
            <input type="date" class="form-control" id="start" name="start"
                value="{{ old('start', $project->start ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="end" class="form-label">End Date (Optional)</label>
            <input type="date" class="form-control" id="end" name="end"
                value="{{ old('end', $project->end ?? '') }}">
        </div>

        <!-- Imágenes del Proyecto -->
        @if(isset($project) && $project->hasMedia('projects')) <!-- Asegúrate de que 'projects' sea el nombre correcto de la colección -->
            <div class="mb-3">
                <label class="form-label">Current Project Images</label>
                <div>
                    @foreach($project->getMedia('projects') as $image) <!-- Usar 'projects' para coincidir con la colección de medios -->
                        <img src="{{ $image->getUrl() }}" alt="Project Image" class="img-thumbnail mb-2" style="max-width: 150px; max-height: 150px;">
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Campo de Subida de Imagen Múltiple -->
        <div class="mb-3">
            <label for="images" class="form-label">Project Images</label>
            <div class="input-group">
                <input type="file" name="images[]" id="images" class="form-control" multiple onchange="updateImagesDescription()">
                <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('images').click()">Select Images <i class="bi bi-file-image ml-2"></i></button>
                <p id="images-description" class="mb-0 mx-3"></p>
            </div>
        </div>

        <!-- Resto del formulario... -->

        @include('panel.projects.addAuthor')
        @include('panel.projects.addCompany')

        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible p-0 fade show position-fixed d-flex align-items-center"
                style="top: 20px; right: 20px; z-index: 1050; white-space: normal;"
                role="alert">
                @foreach ($errors->all() as $error)
                    <i class="bi bi-exclamation-square-fill text-black px-2"></i>
                    <span>{{ $error }}</span>
                @endforeach
                <button type="button" data-bs-dismiss="alert" class="" aria-label="Close" style="background: none; border: none;"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
        @endif

        <div class="my-3">
            <button type="submit" class="btn btn-primary">{{ $buttonText }}<i class="bi bi-check-circle ml-2"></i></button>
            <a href="{{ route('panel.projects.index') }}" class="btn btn-secondary">Go back <i class="bi bi-arrow-left-circle ml-2"></i></a>
        </div>        
    </div>
</div>
