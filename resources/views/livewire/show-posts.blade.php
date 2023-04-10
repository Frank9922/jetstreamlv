<div wire:init='loadPosts'>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- component -->
        <x-table>
            <div class="px-6 py-4 flex items-center">
                <div class="flex items-center">
                    <span class="mx-7">
                        Mostrar
                    </span>
                    <select wire:model="cant"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mx-4">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="mx-4">
                        Entradas
                    </span>
                </div>
                <x-input type="text" wire:model="search" class="w-full m-2" placeholder="Buscar..."></x-input>
                @livewire('create-post')
            </div>
            @if (count($posts))
                <table class="min-w-full">
                    <thead class="bg-white border-b">
                        <tr>
                            <th scope="col" wire:click="order('id')"
                                class="text-sm font-medium cursor-pointer float-left text-gray-900 px-2 py-4 text-left">
                                ID
                                @if ($sort == 'id')
                                    @if ($direction == 'desc')
                                        <i class="fa-solid fa-arrow-down-9-1 float-right mt-1"></i>
                                    @else
                                        <i class="fa-solid fa-arrow-up-1-9 float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fa-solid fa-sort float-right mt-1"></i>
                                @endif

                            </th>
                            <th scope="col" wire:click="order('title')"
                                class="text-sm font-medium cursor-pointer text-gray-900 px-6 py-4 text-left">
                                TITLE
                                @if ($sort == 'title')
                                    @if ($direction == 'desc')
                                        <i class="fa-solid fa-arrow-down-z-a float-right mt-1"></i>
                                    @else
                                        <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fa-solid fa-sort float-right mt-1"></i>
                                @endif

                            </th>
                            <th scope="col" wire:click="order('content')"
                                class="text-sm font-medium cursor-pointer text-gray-900 px-6 py-4 text-left">
                                CONTENT

                                @if ($sort == 'content')
                                    @if ($direction == 'desc')
                                        <i class="fa-solid fa-arrow-down-z-a float-right mt-1"></i>
                                    @else
                                        <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fa-solid fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col" wire:click="order()"
                                class="text-sm font-medium cursor-pointer text-gray-900 px-6 py-4 text-left">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $item)
                            <tr class="bg-gray-100 border-b">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $item->id }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 ">{{ $item->title }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 ">
                                    {{ $item->content }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 flex">
                                    {{-- @livewire('editpost', ['post' => $post], key($post->id)) --}}
                                    <a wire:click="edit({{ $item }})">
                                        <i
                                            class=" fas fa-edit cursor-pointer inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"></i>
                                    </a>
                                    <a class="ml-2 cursor-pointer inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-red-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        wire:click="$emit('deletePosts', {{ $item->id }})">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($posts->hasPages())
                    <div class="px-6 py-3">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-4">
                    <div class="mb-4 rounded-lg bg-danger-100 py-5 px-6 text-base text-danger-700" role="alert">
                        No se ecnontro ningun resultado!
                    </div>
                </div>
            @endif
        </x-table>

        <x-dialog-modal wire:model='edit_open'>
            <x-slot name="title">
                Editar el post
            </x-slot>
            <x-slot name="content">
                <div wire:loading wire:target='image'>Cargando Imagen....</div>

                @if ($image)
                    <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="">
                @else
                    <img src="{{ Storage::url($post->image) }}" alt="">
                @endif
                <div class="mb-4">
                    <x-label value="Titulo del Post"></x-label>
                    <x-input type="text" wire:model="post.title" class="w-full"></x-input>
                </div>
                <div class="mb-4">
                    <x-label value="Contenido del post"></x-label>
                    <textarea wire:model="post.content"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"></textarea>
                </div>
                <div>
                    <input type="file" id="{{ $identificador }}" wire:model='image'>
                    <x-input-error for="image"></x-input-error>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('edit_open', false)">Cancelar</x-secondary-button>
                <x-danger-button wire:click="update" wire:loading.attr='disabled' class="disabled:opacity-25">Actualizar
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </div>
    @push('js')
        <script src="sweetalert2.all.min.js"></script>
    @endpush
    <script>
        Livewire.on('deletePosts', postId => {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        });
    </script>
</div>
