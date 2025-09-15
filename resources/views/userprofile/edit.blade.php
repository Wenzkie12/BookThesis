<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-background p-8 shadow sm:rounded-lg">
                <form id="profile-form" method="POST" action="{{ route('userprofile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="phone" value="Phone" />
                            <x-text-input id="phone" name="phone" type="text" class="w-full"
                                value="{{ old('phone', $profile->phone) }}"
                                placeholder="e.g., 09171234567 or +639171234567" />
                        </div>

                        <div>
                            <x-input-label for="birthdate" value="Birthdate" />
                            <x-text-input id="birthdate" name="birthdate" type="date" class="w-full"
                                value="{{ old('birthdate', $profile->birthdate) }}" />
                        </div>

                        <div>
                            <x-input-label for="age" value="Age" />
                            <x-text-input id="age" name="age" type="number" class="w-full" readonly
                                value="{{ old('age', $profile->age) }}" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="bio" value="Bio" />
                            <textarea id="bio" name="bio" rows="3" class="w-full border-primary rounded-md shadow-sm">
                                {{ old('bio', $profile->bio) }}
                            </textarea>
                        </div>

                        <div>
                            <x-input-label for="province" value="Province" />
                            <select id="province" name="province" class="mt-1 block w-full border-primary rounded-md shadow-sm">
                                <option value="">Select Province</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="city" value="City/Municipality" />
                            <select id="city" name="city" class="mt-1 block w-full border-primary rounded-md shadow-sm" disabled>
                                <option value="">Select City</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="barangay" value="Barangay" />
                            <select id="barangay" name="barangay" class="mt-1 block w-full border-primary rounded-md shadow-sm" disabled>
                                <option value="">Select Barangay</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="avatar" value="Avatar" />
                            <x-text-input id="avatar" name="avatar" type="file" class="w-full" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button type="submit">Update Profile</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-modal name="no-changes-modal" maxWidth="sm" focusable>
        <div class="p-6 text-center">
            <h3 class="text-lg font-semibold mb-4">No changes detected</h3>
            <p>Please update at least one field before submitting.</p>
            <x-primary-button @click="show = false" class="mt-4">Close</x-primary-button>
        </div>
    </x-modal>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('city');
        const barangaySelect = document.getElementById('barangay');

        const initialProvince = @json($profile->province ?? '');
        const initialCity = @json($profile->city ?? '');
        const initialBarangay = @json($profile->barangay ?? '');

        async function fetchProvinces() {
            const res = await axios.get('https://psgc.gitlab.io/api/provinces/');
            res.data.forEach(p => {
                const option = new Option(p.name, p.code);
                provinceSelect.add(option);
                if (p.name === initialProvince) option.selected = true;
            });

            if (initialProvince) {
                const selected = res.data.find(p => p.name === initialProvince);
                if (selected) await fetchCities(selected.code);
            }
        }

        async function fetchCities(provinceCode) {
            citySelect.innerHTML = '<option value="">Select City</option>';
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
            citySelect.disabled = true;
            barangaySelect.disabled = true;

            const res = await axios.get(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`);
            res.data.forEach(c => {
                const option = new Option(c.name, c.code);
                citySelect.add(option);
                if (c.name === initialCity) option.selected = true;
            });

            citySelect.disabled = false;

            if (initialCity) {
                const selected = res.data.find(c => c.name === initialCity);
                if (selected) await fetchBarangays(selected.code);
            }
        }

        async function fetchBarangays(cityCode) {
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
            barangaySelect.disabled = true;

            const res = await axios.get(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`);
            res.data.forEach(b => {
                const option = new Option(b.name, b.name);
                barangaySelect.add(option);
                if (b.name === initialBarangay) option.selected = true;
            });

            barangaySelect.disabled = false;
        }

        provinceSelect.addEventListener('change', async (e) => {
            citySelect.innerHTML = '<option value="">Select City</option>';
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
            citySelect.disabled = true;
            barangaySelect.disabled = true;
            if (e.target.value) await fetchCities(e.target.value);
        });

        citySelect.addEventListener('change', async (e) => {
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
            barangaySelect.disabled = true;
            if (e.target.value) await fetchBarangays(e.target.value);
        });

        document.addEventListener('DOMContentLoaded', () => {
            fetchProvinces();

            const birthdateInput = document.querySelector('#birthdate');
            const ageInput = document.querySelector('#age');

            function calculateAge(birthdate) {
                const birth = new Date(birthdate);
                const today = new Date();
                let age = today.getFullYear() - birth.getFullYear();
                const m = today.getMonth() - birth.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) {
                    age--;
                }
                return age;
            }

            if (birthdateInput && ageInput) {
                if (birthdateInput.value) {
                    ageInput.value = calculateAge(birthdateInput.value);
                }

                birthdateInput.addEventListener('change', function () {
                    ageInput.value = this.value ? calculateAge(this.value) : '';
                });
            }

            const form = document.getElementById('profile-form');
            const initialFormData = {};
            const inputs = form.querySelectorAll('input[type="text"], input[type="date"], textarea, select');

            inputs.forEach(input => {
                initialFormData[input.name] = input.value;
            });

            form.addEventListener('submit', function(event) {
                const currentFormData = {};
                inputs.forEach(input => {
                    currentFormData[input.name] = input.value;
                });

                const hasChanges = Object.keys(initialFormData).some(key => initialFormData[key] !== currentFormData[key]);
                const avatarInput = form.querySelector('input[type="file"][name="avatar"]');
                const avatarChanged = avatarInput && avatarInput.files.length > 0;

                if (!hasChanges && !avatarChanged) {
                    event.preventDefault();
                    window.dispatchEvent(new CustomEvent('open-modal', { detail: 'no-changes-modal' }));
                }
            });
        });
    </script>
</x-app-layout>
