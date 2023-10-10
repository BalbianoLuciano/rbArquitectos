<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $company->name ?? '') }}" required>
    @error('name')<p class="text-danger">{{ $message }}</p>@enderror
</div>

<div class="mb-3">
    <label for="direction" class="form-label">Direction</label>
    <input type="text" class="form-control" id="direction" name="direction" value="{{ old('direction', $company->direction ?? '') }}" required>
    @error('direction')<p class="text-danger">{{ $message }}</p>@enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" required>{{ old('description', $company->description ?? '') }}</textarea>
    @error('description')<p class="text-danger">{{ $message }}</p>@enderror
</div>

<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
<a href="{{route('companies.index')}}" class="btn btn-secondary">Go back</a>

