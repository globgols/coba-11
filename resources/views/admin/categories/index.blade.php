<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-xl text-black leading-tight">
                {{ __('Manage Categories') }}
            </h2>
            <a href="{{route('admin.categories.create')}}" class="font-bold py-3 px-5 rounded-full text-lime-950 bg-lime-600">Add Category</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @forelse ($categories as $category )
                <div class="item-card flex flex-row justify-between items-center">
                    <img src="{{Storage::url($category->icon)}}" alt="" class="w-[50px] h-[50px]">
                    <h3 class="text-xl font-bold text-black">
                        {{$category->name}}
                    </h3>
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{route('admin.categories.edit', $category) }}" class="font-bold py-3 px-5 rounded-full text-lime-950 bg-lime-600">Edit</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                            @csrf
                            @method('DELETE')
                            <button class="font-bold py-3 px-5 rounded-full text-white bg-lime-900">
                                Delete
                            </button>
                        </form>
        
                    </div>
                    
                </div>
                    
                @empty
                    
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
