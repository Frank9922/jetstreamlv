<div>
 
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- component -->
        <x-table>
            <div class="px-6 py-4 flex items-center">
               <x-input type="text" wire:model="search" class="w-full m-2" placeholder="Buscar..."></x-input>
              @livewire('create-post')
            </div>
            @if ($posts->count())
            <table class="min-w-full">
                <thead class="bg-white border-b">
                  <tr>
                    <th scope="col" wire:click="order('id')" class="text-sm font-medium cursor-pointer float-left text-gray-900 px-2 py-4 text-left">
                      ID        
                      @if ($sort=='id')
                      @if ($direction=='desc')
                      <i class="fa-solid fa-arrow-down-9-1 float-right mt-1"></i>
                      @else
                      <i class="fa-solid fa-arrow-up-1-9 float-right mt-1"></i>
                      @endif    
                  @else
                  <i class="fa-solid fa-sort float-right mt-1"></i>
                  @endif

                    </th>
                    <th scope="col" wire:click="order('title')" class="text-sm font-medium cursor-pointer text-gray-900 px-6 py-4 text-left">
                      TITLE
                        @if ($sort=='title')
                            @if ($direction=='desc')
                            <i class="fa-solid fa-arrow-down-z-a float-right mt-1"></i>
                            @else
                            <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                            @endif    
                        @else
                        <i class="fa-solid fa-sort float-right mt-1"></i>
                        @endif

                    </th>
                    <th scope="col" wire:click="order('content')" class="text-sm font-medium cursor-pointer text-gray-900 px-6 py-4 text-left">
                      CONTENT

                      @if ($sort=='content')
                        @if ($direction=='desc')
                            <i class="fa-solid fa-arrow-down-z-a float-right mt-1"></i>
                        @else
                      <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                      @endif    
                  @else
                  <i class="fa-solid fa-sort float-right mt-1"></i>
                  @endif
                    </th>
                    <th scope="col" wire:click="order()" class="text-sm font-medium cursor-pointer text-gray-900 px-6 py-4 text-left">
                        Acciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                  <tr class="bg-gray-100 border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$post->id}}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 ">{{$post->title}}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 ">
                      {{$post->content}}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 ">
                      @livewire('editpost', ['post' => $post], key($post->id))
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            @else
                <div class="px-6 py-4">
                  <div class="mb-4 rounded-lg bg-danger-100 py-5 px-6 text-base text-danger-700" role="alert">
                        No se ecnontro ningun resultado!
                </div>
                </div>
            @endif
        </x-table>
    </div>
</div>
