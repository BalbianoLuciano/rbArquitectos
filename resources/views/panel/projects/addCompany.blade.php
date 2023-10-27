<div class="my-3" id="companies-container">
    <label for="companies" class="form-label">Companies</label>
    <div id="company-role-pair-1" class="company-role-pair">
    </div>
</div>
<button type="button" id="add-company-btn" class="btn btn-warning">Add another company<i class="bi bi-plus-square-fill ml-2"></i></button>



@push('js')
    <script>
        let companyCounter = 0;

        document.getElementById('add-company-btn').addEventListener('click', function() {
            companyCounter++;
            const companiesContainer = document.getElementById('companies-container');
            let newCompanyRolePair = document.createElement('div');
            newCompanyRolePair.id = `company-role-pair-${companyCounter}`;
            newCompanyRolePair.className = 'company-role-pair';
            newCompanyRolePair.innerHTML = `
            <select class="form-control" name="companies[]" required>
                <option value="">Select a company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->company_id }}">{{ $company->name }}</option>
                @endforeach
            </select>
            <input type="text" class="form-control my-3" name="company_descriptions[]" placeholder="Contribution Description">
            <select class="form-control" name="company_roles[]" required>
                <option value="">Select Role</option>
                <option value="builder">Builder</option>
                <option value="construction manager">Construction Manager</option>
                <option value="designer">Designer</option>
            </select>                
            <input type="text" class="form-control my-3" name="project_updates[]" placeholder="Project Update">
            <input type="date" class="form-control my-3" name="company_starts[]" placeholder="Start Date">
            <input type="date" class="form-control my-3" name="company_ends[]" placeholder="End Date">
            <button type="button" onclick="removeCompanyRolePair(${companyCounter})" class="btn btn-danger mb-3">Remove</button>
            `;

            companiesContainer.appendChild(newCompanyRolePair);
        });

        function removeCompanyRolePair(id) {
            const companyRolePair = document.getElementById(`company-role-pair-${id}`);
            companyRolePair.remove();
        }

        document.addEventListener("DOMContentLoaded", function() {
            @if(isset($project) && $project->companies->isNotEmpty())
                let companies = @json($project->companies);
                
                companies.forEach((company, index) => {
                    
                    document.getElementById('add-company-btn').click();

                    document.querySelector(`#company-role-pair-${index + 1} select[name="companies[]"]`).value = company.company_id;
                    document.querySelector(`#company-role-pair-${index + 1} input[name="company_descriptions[]"]`).value = company.description || ''; // Asegúrate de cambiar los nombres de campo a tus propios nombres de campo
                    document.querySelector(`#company-role-pair-${index + 1} select[name="company_roles[]"]`).value = company.pivot.company_role || '';
                    document.querySelector(`#company-role-pair-${index + 1} input[name="project_updates[]"]`).value = company.pivot.project_update || '';
                    document.querySelector(`#company-role-pair-${index + 1} input[name="company_starts[]"]`).value = company.pivot.start || '';
                    document.querySelector(`#company-role-pair-${index + 1} input[name="company_ends[]"]`).value = company.pivot.end || '';
                });
            @endif
        });
    </script>
@endpush
