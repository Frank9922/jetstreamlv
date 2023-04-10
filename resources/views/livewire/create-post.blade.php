<div>
    <x-danger-button wire:click="$set('open', 'true')">
        Agregar Post
    </x-danger-button>


    <x-dialog-modal wire:model='open'>

        <x-slot name="title">
            Crear un nuevo post
        </x-slot>

        <x-slot name="content">

            <div wire:loading wire:target='image'>Cargando Imagen....</div>

           @if ($image)
               <img class="mb-4" src="{{$image->temporaryUrl()}}" alt="">
           @endif 
            <div class="mb-4">
                <x-label value="Titulo"></x-label>
                <x-input type="text" class="w-full" wire:model="title"></x-input>
                @error('title')
                    <x-input-error for="title"></x-input-error>
                @enderror
                <x-label value="Contenido"></x-label>
                
                <textarea wire:model="content"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"></textarea>
                <x-input-error for="content"></x-input-error>
            </div>

            <div>
                <input type="file" id="" wire:model="image">
                <x-input-error for="image"></x-input-error>
            </div>
        </x-slot>

        <x-slot name="footer">

            <x-danger-button wire:click='close'>
                Cancelar
            </x-danger-button>



            <x-button wire:click='save' wire:loading.remove wire:target='save, image'>
                Crear Post
            </x-button>

            <x-button wire:loading wire:target='save, image' class="opacity-50">
                Cargando...
            </x-button>
        
        </x-slot>


    </x-dialog-modal>
</div> 
