<div class="card">
    <div class="card-body">

        {{-- Campo Nombre --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $author->name ?? '') }}" required>
        </div>

        {{-- Campo Fecha de Nacimiento --}}
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $author->date_of_birth ?? '') }}" required>
        </div>

        {{-- Campo Lugar de Nacimiento --}}
        <div class="mb-3">
            <label for="place_of_birth" class="form-label">Place of Birth</label>
            <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth', $author->place_of_birth ?? '') }}" required>
        </div>

        {{-- Campo Biografía --}}
        <div class="mb-3">
            <label for="biography" class="form-label">Biography</label>
            <textarea class="form-control" id="biography" name="biography" required>{{ old('biography', $author->biography ?? '') }}</textarea>
        </div>

        {{-- Imagen Existente --}}
        @if(isset($author) && $author->hasMedia('image'))
            <div class="mb-3">
                <label class="form-label">Current Profile Image</label>
                <div>
                    <img src="{{ $author->getFirstMediaUrl('image') }}" alt="Current Image" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                </div>
            </div>
        @endif

        {{-- Campo de Subida de Imagen --}}
        <div class="mb-3">
            <label for="image" class="form-label">Profile Image</label>
            <div class="input-group">
                <input type="file" name="image" id="image" class="form-control" onchange="updateImageDescription()">
                <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('image').click()">Select Image<i class="bi bi-file-image ml-2"></i></button>
                <p id="image-description" class="mb-0 mx-3"></p>
            </div>
        </div>

        @include('panel.authors.addWorkHistory')

        {{-- Botones --}}
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">{{ $buttonText }} <i class="bi bi-check-circle ml-2"></i></button>
            <a href="{{ route('panel.authors.index') }}" class="btn btn-secondary">Go Back <i class="bi bi-arrow-left-circle ml-2"></i></a>
        </div>
    </div>
</div>
