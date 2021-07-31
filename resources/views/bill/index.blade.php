<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de contas') }}
        </h2>
    </x-slot>
    
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="py-4 px-6">Nome</th>
                                <th class="py-4 px-6">Recorrência</th>
                                <th class="py-4 px-6">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bills as $bill)
                                <tr class="hover:bg-grey-200">
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $bill->name }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $bill->getRecurrenceName() }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light flex">
                                        <a href="{{ route('bills.edit', ['bill' => $bill]) }}" class="bg-white text-white hover:bg-yellow-100 text-gray-800 font-semibold py-2 px-4 mr-2 border border-yellow-200 rounded shadow">
                                            Editar Conta
                                        </a>
                                        
                                        <form action="{{ route('bills.destroy', ['bill' => $bill]) }}" method="POST" class="ml-2">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="bg-white text-white hover:bg-red-100 text-gray-800 font-semibold py-2 px-4 border border-red-200 rounded shadow">
                                                Remover Conta
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="hover:bg-grey">
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-6">
                        <a href="{{ route('bills.create') }}" class="bg-white text-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                            Nova Conta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
