<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-xl text-black leading-tight">
                {{ Auth::user()->hasRole('owner') ? __('Apotek Orders') : __('My Transaction') }}
            </h2>
            
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <div>
                            <p class="text-base text-neutral-950">
                                Total Transaksi
                            </p>
                            <h3 class="text-xl font-bold text-black">
                                Rp {{$productTransaction->total_amount}}
                            </h3>
                        </div>
                    </div>
                    <div>
                        <p class="text-base text-neutral-950">
                            Date
                        </p>
                        <h3 class="text-xl font-bold text-black">
                            {{$productTransaction->created_at}}
                        </h3>
                    </div>
                    @if ($productTransaction->is_paid)
                        <span class="py-1 px-3 rounded-full bg-lime-500">
                            <p class="text-white font-bold text-sm">
                                Success
                            </p>
                        </span>
                    @else
                        <span class="py-1 px-3 rounded-full bg-red-500">
                            <p class="text-white font-bold text-sm">
                                PENDING
                            </p>
                        </span>
                    @endif
                </div>
                <hr class="my-3">

                <h3 class="text-xl font-bold text-black">
                    List of items
                </h3>
                
                <div class="grid-cols-4 grid gap-x-10">
                    <div class="flex flex-col gap-y-5 col-span-2">

                        @forelse ($productTransaction->transactionDetails as $detail )
                        <div class="item-card flex flex-row justify-between items-center">
                            <div class="flex flex-row items-center gap-x-3">
                                <img src="{{Storage::url($detail->product->photo)}}" alt="" class="w-[50px] h-[50px]">
                                <div>
                                    <h3 class="text-xl font-bold text-black">
                                        {{$detail->product->name}}
                                    </h3>
                                    <p class="text-base text-neutral-950">
                                        Rp {{$detail->product->price}}
                                    </p>
                                </div>
                            </div>
                            <p class="text-base text-neutral-950">
                                {{$detail->product->category->name}}
                            </p>
                        </div>
                            
                        @empty  
                        @endforelse


                        <h3 class="text-xl font-bold text-black">
                            Details Of Delivery
                        </h3>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-neutral-950">
                                Address
                            </p>
                            <h3 class="text-xl font-bold text-black">
                                {{$productTransaction->address}}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-neutral-950">
                                City
                            </p>
                            <h3 class="text-xl font-bold text-black">
                                {{$productTransaction->city}}
                            </h3>
                        </div> 
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-neutral-950">
                                Phone number
                            </p>
                            <h3 class="text-xl font-bold text-black">
                                {{$productTransaction->phone_number}}
                            </h3>
                        </div>  
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-neutral-950">
                                Post Code
                            </p>
                            <h3 class="text-xl font-bold text-black">
                                {{$productTransaction->post_code}}
                            </h3>
                        </div>
                        <div class="item-card flex flex-col items-start">
                            <p class="text-base text-neutral-950">
                                Notes
                            </p>
                            <h3 class="text-lg font-bold text-black">
                                {{$productTransaction->notes}}
                            </h3>
                        </div>   
                    </div>
                    <div class="flex flex-col gap-y-5 col-span-2 items-end">
                        <h3 class="text-xl font-bold text-black">
                            Proof of payment:
                        </h3>
                        <img src="{{Storage::url($productTransaction->proof)}}" alt="{{Storage::url($productTransaction->proof)}}" class="w-[300px]h-[400px]">
                    </div>
                </div>

                <hr class="my-3">

                @role('owner')
                @if ($productTransaction->is_paid)
                <a href="#" class=" w-fit font-bold py-3 px-5 rounded-full text-white bg-lime-900">
                    WhatsApp Customer
                </a>
                @else
                <form method="POST" action="{{ route('product_transactions.update', $productTransaction) }}">
                    @csrf
                    @method('PUT')
                    <button class="font-bold py-3 px-5 rounded-full text-white bg-lime-900">
                        Approve Order
                    </button>
                </form>
                @endif
                @endrole

                @role('buyer')
                <a href="#" class=" w-fit font-bold py-3 px-5 rounded-full text-white bg-lime-900">
                    Contact Admin
                </a>
                @endrole

            </div>
        </div>
    </div>
</x-app-layout>
