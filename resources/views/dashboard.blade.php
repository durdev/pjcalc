<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard de contas') }}
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font my-4">
        <div class="container mx-auto">
            <div class="flex flex-col text-center w-full mb-3">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-1 text-gray-900">
                    Resumo de contas
                </h1>
            </div>
            <div class="flex flex-wrap -m-4 text-center">
                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-1 py-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-green-500 w-6 h-6 mb-3 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h2 class="title-font font-medium text-3xl text-gray-900">
                            R$ {{ $unpaid_incomes->sum('value') + $paid_incomes->sum('value') }}
                        </h2>
                        <p class="leading-relaxed">Total de receitas</p>
                    </div>
                </div>
                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-1 py-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-500 w-6 h-6 mb-3 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <h2 class="title-font font-medium text-3xl text-gray-900">
                            R$ {{ $unpaid_expenses->sum('value') + $paid_expenses->sum('value') }}
                        </h2>
                        <p class="">Total de gastos</p>
                    </div>
                </div>
                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-1 py-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-500 w-6 h-6 mb-3 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                        <h2 class="title-font font-medium text-3xl text-gray-900">
                            {{ ($unpaid_incomes->sum('value') + $paid_incomes->sum('value')) - ($unpaid_expenses->sum('value') + $paid_expenses->sum('value')) }}
                        </h2>
                        <p class="leading-relaxed">Projetado</p>
                    </div>
                </div>
                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-1 py-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 w-6 h-6 mb-3 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h2 class="title-font font-medium text-3xl text-gray-900">
                            {{ $paid_incomes->sum('value') - $paid_expenses->sum('value') }}
                        </h2>
                        <p class="leading-relaxed">Em saldo (apenas pagos)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto flex mt-1">
        <div class="flex flex-col w-1/2 mx-2">
            <h2 class="text-xl m-3 text-black">Saídas</h2>

            <div class="grid grid-cols-2 p-4 divide-x divide-red-200 rounded-lg bg-red-50 border border-red-500 rounded-lg shadow text-center">
                <div class="flex flex-col justify-center align-middle">
                    <p class="text-2xl font-semibold leading-none text-gray-600">
                        {{ 'R$ '. number_format($unpaid_expenses->sum('value'), 2, ',', '.') }}
                    </p>
                    <p class="text-gray-800">A pagar</p>
                </div>

                <div class="flex flex-col justify-center align-middle">
                    <p class="text-2xl font-semibold leading-none text-gray-500">
                        {{ 'R$ '. number_format($paid_expenses->sum('value'), 2, ',', '.') }}
                    </p>
                    <p class="text-gray-800">Pago</p>
                </div>
            </div>

            @forelse ($unpaid_expenses as $expense)
                <hr class="mt-2">
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
                <hr class="mt-2">
                <p>Sem saídas pendentes</p>
            @endforelse
        </div>

        <div class="flex flex-col w-1/2 mx-2">
            <h2 class="text-xl m-3 text-black">Entradas</h2>

            <div class="grid grid-cols-2 p-4 divide-x divide-green-200 rounded-lg bg-green-50 border border-green-500 rounded-lg shadow text-center">
                <div class="flex flex-col justify-center align-middle">
                    <p class="text-2xl font-semibold leading-none text-gray-600">
                        {{ 'R$ '. number_format($unpaid_incomes->sum('value'), 2, ',', '.') }}
                    </p>
                    <p class="text-gray-800">A receber</p>
                </div>

                <div class="flex flex-col justify-center align-middle">
                    <p class="text-2xl font-semibold leading-none text-gray-500">
                        {{ 'R$ '. number_format($paid_incomes->sum('value'), 2, ',', '.') }}
                    </p>
                    <p class="text-gray-800">Recebido</p>
                </div>
            </div>

            @forelse ($unpaid_incomes as $income)
                <hr class="mt-2">
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
                <hr class="mt-2">
                <p>Sem recebimentos pendentes</p>
            @endforelse
        </div>
    </div>

    <h1 class="sm:text-3xl text-2xl text-center font-medium title-font my-3 text-gray-900">
        Categorias em alerta
    </h1>

    @forelse ($in_alert_categories as $category)
        <div class="flex items-center justify-center font-sans container mx-auto my-6">
            <div class="w-full">
                <div class="bg-white shadow-md rounded">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">Id</th>
                                <th class="py-3 px-6 text-center">Nome</th>
                                <th class="py-3 px-6 text-center">Alerta</th>
                                <th class="py-3 px-6 text-center">Somatório</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class=" text-sm font-light">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-center">
                                    <span class="font-medium">{{ $category->id }}</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span>{{ $category->name }}</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span>{{ $category->alert_value }}</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span>{{ $category->expenses_sum }}</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{ route('categories.edit', ['category' => $category->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
    @endforelse
</x-app-layout>
