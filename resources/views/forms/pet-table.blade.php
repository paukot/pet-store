

<div class="relative overflow-x-auto shadow-md sm:rounded-lg"
     x-data="tableData()" x-init="fetchData()"
>
    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button" x-on:click="fetchData()"
    >

        Refresh
    </button>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                ID
            </th>
            <th scope="col" class="px-6 py-3">
                Category
            </th>
            <th scope="col" class="px-6 py-3">
                Photo
            </th>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Tags
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
            <template x-for="item in items" :key="item.id">
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-4 font-bold" x-text="item.id"></td>
                    <td x-text="item.category.name"></td>
                    <td>
                        <template x-if="item.images && item.images.length > 0">
                            <img :src="item.images[0]" alt="Photo" style="width: 100px; height: 100px;">
                        </template>
                        <template x-if="!item.images || item.images.length === 0">
                            <span>No image available</span>
                        </template>
                    </td>
                    <td x-text="item.name"></td>
                    <td x-text="item.tags.map(tag => tag.name).join(', ')"></td>
                    <td>
                        <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button"
                                @click="fillEditForm(item.id)"
                        >
                            Edit
                        </button>
                        <form method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                @click="deletePet(item.id)"
                            >
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            </template>
        </tbody>
    </table>

    <script>
        function tableData() {
            return {
                items: [],
                url: '{{ route('api.pets.index', ['limit' => 1000]) }}',
                fetchData() {
                    fetch(this.url)
                        .then(response => response.json())
                        .then(data => {
                            this.items = data.data;
                        })
                        .catch(error => console.error('Error fetching data:', error));
                },
                fillEditForm(id) {
                    document.getElementById('petUpdateForm').setAttribute('data-pet-id', id)
                    this.$dispatch('update-form')
                },
                async deletePet(id) {
                    event.preventDefault();


                    try {
                        const response = await fetch('{{ route('api.pets.index') }}/' + id, {
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'multipart/form-data',
                            },
                            method: 'DELETE',
                        });

                        const data = await response;

                        alert('Pet deleted');
                    } catch (error) {
                        alert(error);
                    }
                }
            };
        }
    </script>
</div>
