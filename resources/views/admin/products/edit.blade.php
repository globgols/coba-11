<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if ($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                        {{$error}}
                    </div>
                    @endforeach
                @endif
                
                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$product->name}}" 
                        required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" value="{{$product->price}}" 
                        required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category" :value="__('category')" />
                        
                        <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-black">
                            <option value="{{$product->category->id}}">{{$product->category->name}}</option>
                            @forelse ($categories as $category )
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @empty
                            @endforelse
                        </select>

                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="about" :value="__('about')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="border border-black rounded-xl w-full">
                        {{$product->about}}
                        </textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>  
            
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="photo" :value="__('photo')" />
                        <img src="{{Storage::url($product->photo)}}" alt="" class="w-[50px] h-[50px]">
                        <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" 
                        autofocus autocomplete="icon" />
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>
                        
                    <div class="flex items-center justify-end mt-4">



                        <x-primary-button class="ms-4">
                            {{ __('Update Product') }}
                        </x-primary-button>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
</x-app-layout>
