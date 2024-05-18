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
                
                @forelse ($product_transactions as $transaction)
                    
                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <div>
                            <p class="text-base text-neutral-950">
                                Total Transaksi
                            </p>
                            <h3 class="text-xl font-bold text-black">
                                Rp {{$transaction->total_amount}}
                            </h3>
                        </div>
                    </div>
                    <div>
                        <p class="text-base text-neutral-950">
                            Date
                        </p>
                        <h3 class="text-xl font-bold text-black">
                            {{$transaction->created_at}}
                        </h3>
                    </div>
                    @if ($transaction->is_paid)
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
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{route('product_transactions.show', $transaction)}}" class="font-bold py-3 px-5 
                        rounded-full text-lime-950 bg-lime-600">View Details</a>
                    </div>
                </div>

                <hr class="my-3">
                @empty
                <p>
                    Belum adanya transaksi
                </p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
