<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova conta') }}
        </h2>
    </x-slot>
    
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="w-full" action="{{ route('bills.store') }}" method="POST">
                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-100 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Nome
                                </label>

                                <input class="appearance-none block w-full border border-gray-200 rounded py-3 px-4 mb-3 leading-tight" 
                                    id="grid-first-name" type="text" value="{{ old('name') }}" name="name">
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="grid-state">
                                    Tipo
                                </label>

                                <div class="relative">
                                    <select class="block appearance-none w-full py-3 px-4 pr-8 border border-gray-200 rounded leading-tight" 
                                        id="grid-state" name="recurrence">
                                        @foreach($recurrences as $key => $name)
                                            <option @if(old('recurrence') == $key) selected @endif value="{{ $key }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap my-6 justify-between">
                            <a href="{{ route('bills.index') }}" class="bg-white text-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Voltar</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border border-gray-400 rounded shadow">Criar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
