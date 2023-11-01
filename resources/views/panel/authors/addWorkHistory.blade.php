<div class="my-3" id="work-histories-container">
    <label for="work-histories" class="form-label">Work Histories</label>
    <div id="work-history-pair-1" class="work-history-pair">
        <!-- Tus campos para cada work history irán aquí -->
    </div>
</div>
<button type="button" id="add-work-history-btn" class="btn btn-warning mb-3">Add work history<i class="bi bi-plus-square-fill ml-2"></i></button>

@push('js')
    <script>
        let workHistoryCounter = 0;

        document.getElementById('add-work-history-btn').addEventListener('click', function() {
            workHistoryCounter++;
            const workHistoriesContainer = document.getElementById('work-histories-container');
            let newWorkHistoryPair = document.createElement('div');
            newWorkHistoryPair.id = `work-history-pair-${workHistoryCounter}`;
            newWorkHistoryPair.className = 'work-history-pair';
            newWorkHistoryPair.innerHTML = `
            <select class="form-control" name="companies[]" required>
                <option value="">Select a company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->company_id }}">{{ $company->name }}</option>
                @endforeach
            </select>
            <input type="text" class="form-control my-3" name="positions[]" placeholder="Position">
            <input type="date" class="form-control my-3" name="starts[]" placeholder="Start Date">
            <input type="date" class="form-control my-3" name="ends[]" placeholder="End Date">
            <button type="button" onclick="removeWorkHistoryPair(${workHistoryCounter})" class="btn btn-danger mb-3">Remove</button>
            `;

            workHistoriesContainer.appendChild(newWorkHistoryPair);
        });

        function removeWorkHistoryPair(id) {
            const workHistoryPair = document.getElementById(`work-history-pair-${id}`);
            workHistoryPair.remove();
        }

        document.addEventListener("DOMContentLoaded", function() {
            @if(isset($author) && $author->companies && $author->companies->isNotEmpty())
            
                let companies = @json($author->companies);

                companies.forEach((companies, index) => {
                    document.getElementById('add-work-history-btn').click();

                    // Asegúrate de que los nombres de los campos coincidan con tu estructura
                    document.querySelector(`#work-history-pair-${index + 1} select[name="companies[]"]`).value = companies.company_id;
                    document.querySelector(`#work-history-pair-${index + 1} input[name="positions[]"]`).value = companies.pivot.position || '';
                    document.querySelector(`#work-history-pair-${index + 1} input[name="starts[]"]`).value = companies.pivot.start || '';
                    document.querySelector(`#work-history-pair-${index + 1} input[name="ends[]"]`).value = companies.pivot.end || '';
                });
            @endif
        });
    </script>
@endpush
