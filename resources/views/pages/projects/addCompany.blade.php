<div class="mb-3" id="companies-container">
    <label for="companies" class="form-label">Companies</label>
    <div id="company-role-pair-1" class="company-role-pair">
        <select class="form-control" name="companies[]" required>
            <option value="">Select a company</option>
            @foreach ($companies as $company)
                <option value="{{ $company->company_id }}">{{ $company->name }}</option>
            @endforeach
        </select>
        <input type="text" class="form-control my-3" name="company_descriptions[]"
            placeholder="Contribution Description">
        <select class="form-control" name="company_roles[]" required>
            <option value="">Select Role</option>
            <option value="builder">Builder</option>
            <option value="construction manager">Construction Manager</option>
            <option value="designer">Designer</option>
        </select>
        <input type="text" class="form-control my-3" name="project_updates[]" placeholder="Project Update">
        <input type="date" class="form-control my-3" name="company_starts[]" placeholder="Start Date">
        <input type="date" class="form-control my-3" name="company_ends[]" placeholder="End Date">
        <button type="button" onclick="removeCompanyRolePair(1)">Remove</button>
    </div>
</div>
<button type="button" id="add-company-btn" class="">Add another company</button>



@push('js')
    <script>
        let companyCounter = 1;

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
            <button type="button" onclick="removeCompanyRolePair(${companyCounter})">Remove</button>
            `;

            companiesContainer.appendChild(newCompanyRolePair);
        });

        function removeCompanyRolePair(id) {
            const companyRolePair = document.getElementById(`company-role-pair-${id}`);
            companyRolePair.remove();
        }
    </script>
@endpush
