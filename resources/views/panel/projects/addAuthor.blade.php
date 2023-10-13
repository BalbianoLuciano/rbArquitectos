<div class="mb-3" id="authors-container">
    <label for="authors" class="form-label">Authors</label>
    <div id="author-role-pair-1" class="author-role-pair">
        <select class="form-control" name="authors[]" required>
            <option value="">Select an author</option>
            @foreach ($authors as $author)
                <option value="{{ $author->author_id }}">{{ $author->name }}</option>
            @endforeach
        </select>
        <input type="text" class="form-control my-3" name="roles[]" placeholder="Role" required>
    </div>
</div>
<button type="button" id="add-author-btn" class="">Add another author</button>


@push('js')
    <script>
        let authorCounter = 1;

        document.getElementById('add-author-btn').addEventListener('click', function() {
            authorCounter++;
            const authorsContainer = document.getElementById('authors-container');
            let newAuthorRolePair = document.createElement('div');
            newAuthorRolePair.id = `author-role-pair-${authorCounter}`;
            newAuthorRolePair.className = 'author-role-pair';
            newAuthorRolePair.innerHTML = `
            <select class="form-control" name="authors[]" required>
                <option value="">Select an author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->author_id }}">{{ $author->name }}</option>
                @endforeach
            </select>
            <input type="text" class="form-control" name="roles[]" placeholder="Role" required>
            <button type="button" onclick="removeAuthorRolePair(${authorCounter})">Remove</button>
        `;
            authorsContainer.appendChild(newAuthorRolePair);
        });

        function removeAuthorRolePair(id) {
            const authorRolePair = document.getElementById(`author-role-pair-${id}`);
            authorRolePair.remove();
        }

        document.addEventListener("DOMContentLoaded", function() {
            @if(isset($project) && $project->authors->isNotEmpty())
                let authors = @json($project->authors);
                authors.forEach((author, index) => {
                    if(index !== 0) {
                        document.getElementById('add-author-btn').click();
                    }
                    document.querySelector(`#author-role-pair-${index + 1} select`).value = author.author_id;
                    document.querySelector(`#author-role-pair-${index + 1} input[name="roles[]"]`).value = author.pivot.project_role || '';
                });
            @endif
        });
    </script>
@endpush