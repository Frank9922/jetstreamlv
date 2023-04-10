<div>
    <a wire:click="$set('open', true)">
        <i class="fas fa-edit cursor-pointer inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"></i>
    </a>
    <x-dialog-modal wire:model='open'>
        <x-slot name="title">
            Editar el post 
        </x-slot>
        <x-slot name="content">
            <div wire:loading wire:target='image'>Cargando Imagen....</div>

            @if ($image)
                <img class="mb-4" src="{{$image->temporaryUrl()}}" alt="">

            @else
                <img src="{{Storage::url($post->image)}}" alt="">
                    
            @endif
                <div class="mb-4">
                    <x-label value="Titulo del Post"></x-label>
                    <x-input type="text" wire:model="post.title" class="w-full"></x-input>
                </div>
                <div class="mb-4">
                    <x-label value="Contenido del post"></x-label>
                    <textarea wire:model="post.content" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"></textarea>
                </div>
                <div>
                    <input type="file" id="{{$identificador}}" wire:model='image'>
                    <x-input-error for="image"></x-input-error>
                </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)">Cancelar</x-secondary-button>
            <x-danger-button wire:click="save" wire:loading.attr='disabled' class="disabled:opacity-25">Actualizar</x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
