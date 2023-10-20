<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $author->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="biography" class="form-label">Biography</label>
    <textarea class="form-control" id="biography" name="biography" required>{{ old('biography', $author->biography ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="image" class="form-label">Profile Image</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*">
</div>

<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
<a href="{{route('panel.authors.index')}}" class="btn btn-secondary">Go back</a>
