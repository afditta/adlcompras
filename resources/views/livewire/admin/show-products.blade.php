<div>
   
    <x-slot name="header">
       <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Lista de productos
            </h2>
            <x-button-enlace class="ml-auto" href="{{route('admin.products.create')}}">
                Agregar Productos
            </x-button-enlace>
       </div>
    </x-slot>

    <div class="container py-12">
        <x-table-responsive>
         
            <div class="px-6 py-4">

                <x-jet-input wire:model="search" class="w-full" type="text"
                    placeholder="Ingrese el nombre del producto que quiere buscar"/>

            </div>
         @if($products->count())
            
        
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                  <tr>
                    <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                      Nombre
                    </th>
                    <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                      Categoria
                    </th>
                    <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                      Estado
                    </th>
                    <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                      Precio
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr v-for="(person, i) in persons" :key="i">
                            <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10 object-cover">
                                <img class="w-10 h-10 rounded-full" src="{{Storage::url($product->images->first()->url)}}" :alt="">
                                </div>
                                <div class="ml-4">
                                <div class="text-sm font-medium leading-5 text-gray-900">
                                    {{$product->name}}
                                </div>
                                
                                </div>
                            </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{$product->subcategory->category->name}}</div>
                          
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                @switch($product->status)
                                    @case(1)
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-white bg-red-600 rounded-full">
                                            Borrador
                                        </span>
                                        @break
                                    @case(2)                                        
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-white bg-green-600 rounded-full">
                                            Publicado
                                        </span>
                                    @break

                                    $@default
                                        
                                @endswitch
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap">
                            role
                            </td>
                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                
                  <!-- More rows... -->
                </tbody>
            </table>

        @else
            <div class="px-6 py-4">
                No se han encontrado resultados para tu búsqueda
            </div>
        @endif
          @if($products->hasPages())
            <div class="px-6 py-4">
                {{$products->links()}}
            </div>                      
          @endif
        </x-table-responsive>                
    
    </div>
</div>
