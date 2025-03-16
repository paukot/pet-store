<div class="isolate bg-white px-6 lg:px-8">
    <form action="{{ route('api.pets.index') }}" id="petUpdateForm" method="POST" class="mx-auto max-w-xl"
          x-data="updateData()"
          x-on:update-form.window="fetchData()"
          data-pet-id="0"
          enctype="multipart/form-data"
    >
        @csrf
        @method('PATCH')
        <h3 x-text="'Update pet id:' + petId"></h3>

        <div class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="category_id"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                <select id="category_id" name="category_id" x-model="categoryId"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($categories as $category)
                        <option :value="{{ $category->id }}"
                                :selected="{{ $category->id }} === categoryId"
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2">
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags</label>
                <select id="tags" name="tags[]" x-model="tags"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        multiple
                >
                    @foreach($tags as $tag)
                        <option :value="{{ $tag->id }}"
                                :selected="tags.includes({{ $tag->id }})">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-2">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" id="name" x-model="name" name="name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="sm:col-span-2">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="status" name="status" x-model="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach(\App\Enums\PetStatusEnum::cases() as $petStatus)
                        <option :value="{{ $petStatus->value }}"
                                :selected="{{ $petStatus->value }} === categoryId">{{ $petStatus->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="photo">Upload
                    file</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                       aria-describedby="photo" id="photo" type="file" name="photo"
                >
            </div>

            <div class="mt-5">
                <button type="submit" id="petSubmitForm"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Submit
                </button>
            </div>

        </div>
    </form>

    <script>
        function updateData() {
            return {
                petId: null,
                data: null,
                categoryId: null,
                tags: [],
                name: null,
                status: null,
                url: '{{ route('api.pets.index') }}',
                fetchData() {
                    this.petId = document.getElementById('petUpdateForm').getAttribute('data-pet-id');
                    document.getElementById('petUpdateForm').setAttribute('action', this.url + '/' + this.petId)

                    fetch(this.url + '/' + this.petId)
                        .then(response => response.json())
                        .then(data => {
                            this.data = data;

                            this.name = this.data.name
                            this.categoryId = this.data.category.id;
                            this.tags = this.data.tags.map(tag => tag.id);
                            this.status = this.data.status

                        })
                        .catch(error => console.error('Error fetching data:', error));

                },
            };
        }

        document.getElementById('petUpdateForm')
            .addEventListener('submit', async function (event) {
                event.preventDefault();

                const form = event.target;
                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        headers: {
                            'Accept': 'application/json',
                        },
                        method: 'POST',
                        body: formData,
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        console.log(data.errors)
                        throw new Error(data.message);
                    }

                    alert('Pet added');
                    window.dispatchEvent(new CustomEvent('pet-added'));
                } catch (error) {
                    console.error('error:', error);
                    alert(error);
                }
            });
    </script>
</div>