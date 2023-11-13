<div class="card">
    <div class="card-body">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $company->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="direction" class="form-label">Direction</label>
            <input type="text" class="form-control" id="direction" name="direction" value="{{ old('direction', $company->direction ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description', $company->description ?? '') }}</textarea>
        </div>

        {{-- Imagen Existente --}}
        @if(isset($company) && $company->hasMedia('image'))
            <div class="mb-3">
                <label class="form-label">Current Profile Image</label>
                <div>
                    <img src="{{ $company->getFirstMediaUrl('image') }}" alt="Current Image" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                </div>
            </div>
        @endif

        {{-- Campo de Subida de Imagen --}}
        <div class="mb-3">
            <label for="image" class="form-label">Company Image</label>
            <div class="input-group">
                <input type="file" name="image" id="image" class="form-control" onchange="updateImageDescription()">
                <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('image').click()">Select Image<i class="bi bi-file-image ml-2"></i></button>
                <p id="image-description" class="mb-0 mx-3"></p>
            </div>
        </div>

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

        <div>
            <button type="submit" class="btn btn-primary">
                {{ $buttonText }} <i class="bi bi-check-circle ml-2"></i>
            </button>
            <a href="{{ route('panel.companies.index') }}" class="btn btn-secondary">
                Go back <i class="bi bi-arrow-left-circle ml-2"></i>
            </a>
        </div>
    </div>
</div>
