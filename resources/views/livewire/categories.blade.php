<div x-data="{
    createModal: null,
    editModal: null,
    deleteModal: null,
}" x-init="() => {
    const createCategoryModal = document.getElementById('create-category-modal');
    const editCategoryModal = document.getElementById('edit-category-modal');
    const deleteConfirmationModal = document.getElementById('delete-confirmation-modal');

    const options = {
        backdrop: 'dynamic',
        backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
        closable: true,
    };

    const createInstanceOptions = {
        id: 'create-category-modal',
        override: true
    };
    const editInstanceOptions = {
        id: 'edit-category-modal',
        override: true
    };
    const deleteInstanceOptions = {
        id: 'delete-confirmation-modal',
        override: true
    };

    createModal = new Modal(createCategoryModal, options, createInstanceOptions)
    editModal = new Modal(editCategoryModal, options, editInstanceOptions)
    deleteModal = new Modal(deleteConfirmationModal, options, deleteInstanceOptions)

    document.addEventListener('closeCategoryModal', () => {
        createModal.hide()
        editModal.hide()
    })
    document.addEventListener('closeDeleteModal', () => {
        deleteModal.hide()
    })
}" class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

    @livewire('modals.create-category')
    @livewire('modals.edit-category')
    @livewire('modals.delete-confirmation')

    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

        <div class="flex w-full gap-4 p-4">
            <button
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                x-on:click="() => createModal.show()" type="button">
                New Category
            </button>
        </div>

        <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">

            <div class="pl-4 py-4">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for categories">
                </div>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Code
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr
                            class="bg-white border-b dark:bg-gray-800/20 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $category->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $category->code }}
                            </td>
                            <td class="px-6 py-4"
                                x-bind:class="{ 'text-green-400': @js($category->is_active), 'text-red-400': @js(!$category->is_active) }">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </td>
                            <td x-data="{ optionsDropdown: null }" class="px-6 py-4" x-init="() => {
                                const targetEl = document.getElementById('options-dropdown-{{ $category->id }}')
                                const triggerEl = document.getElementById('options-button-{{ $category->id }}')
                            
                                const options = {
                                    placement: 'bottom-start',
                                    triggerType: 'click',
                                    offsetSkidding: 0,
                                    offsetDistance: 10,
                                    ignoreClickOutsideClass: false,
                                };
                            
                                // instance options object
                                const instanceOptions = {
                                    id: 'options-dropdown-{{ $category->id }}',
                                    override: true
                                };
                            
                                optionsDropdown = new Dropdown(targetEl, triggerEl, options, instanceOptions);
                            }">
                                <button id="options-button-{{ $category->id }}" x-ref="optionsButton"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900  rounded-full hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                    type="button">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 16 3">
                                        <path
                                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div id="options-dropdown-{{ $category->id }}" x-ref="optionsDropdown"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">

                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="options-button-{{ $category->id }}">
                                        <li>
                                            <button title="Edit"
                                                x-on:click="() => {
                                                    optionsDropdown.hide()
                                                    $wire.dispatch('editCategory', {categoryId: @js($category->id)})
                                                    editModal.show()
                                                }"
                                                class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <button title="Delete"
                                                x-on:click="() => {
                                                    optionsDropdown.hide()
                                                    $wire.dispatch('deleteModel', { modelId: @js($category->id), modelClass: 'App\\Models\\Category' })
                                                    deleteModal.show()
                                                }"
                                                class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-4 pb-4 mt-5">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
