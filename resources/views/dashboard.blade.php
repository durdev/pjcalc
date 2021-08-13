<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto flex mt-6">
        <div class="flex flex-col w-1/2 mx-2">
            <h2 class="text-xl m-3 text-black">Saídas</h2>
            @forelse ($expenses as $expense)
                <div class="bg-white border border-red-200 rounded-lg shadow mt-2">
                    <form action="{{ route('expenses.done', ['expense' => $expense]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="p-4">
                            <div class="flex items-center mr-4 mb-2">
                                <input type="hidden" id="{{ $expense->id }}" name="status" value="1" />
                                <button title="Marcar como pago" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white p-1 border border-red-500 hover:border-transparent rounded-full">
                                    <svg x-show="!open" @mouseenter="open = false" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>

                                <label class="ml-6">{{ $expense->name . ' - ' . $expense->value }}</label>
                            </div>
                        </div>
                    </form>
                </div>
            @empty
                <p>Sem saídas neste mês</p>
            @endforelse

            <div class="bg-red-100 border border-red-500 rounded-lg shadow mt-2 p-5">
                <p>{{ 'R$ '. number_format($expenses->sum('value'), 2, ',', '.') }}</p>
            </div>
        </div>

        <div class="flex flex-col w-1/2 mx-2">
            <h2 class="text-xl m-3 text-black">Entradas</h2>
            @forelse ($incomes as $income)
                <div class="bg-white border border-green-200 rounded-lg shadow mt-2">
                    <form action="{{ route('incomes.done', ['income' => $income]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="p-4">
                            <div class="flex items-center mr-4 mb-2">
                                <input type="hidden" id="{{ $income->id }}" name="status" value="1" />
                                <button title="Marcar como recebido" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white p-1 border border-green-500 hover:border-transparent rounded-full">
                                    <svg x-show="!open" @mouseenter="open = false" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>

                                <label class="ml-6">{{ $income->name . ' + ' . $income->value }}</label>
                            </div>
                        </div>
                    </form>
                </div>
            @empty
                <p>Sem saídas neste mês</p>
            @endforelse

            <div class="bg-green-100 border border-green-500 rounded-lg shadow mt-2 p-5">
                <p>{{ 'R$ '. number_format($incomes->sum('value'), 2, ',', '.') }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
