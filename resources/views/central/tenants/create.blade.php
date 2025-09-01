<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inquilinos') }}
        </h2>
    </x-slot>

    <x-container class="py-12">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('tenants.store') }}" method="POST">

                    @csrf

                    {{-- Mostrar mensaje de error con input error --}}

                    <div class="mb-4">

                        <x-input-label>
                            Nombre
                        </x-input-label>
                        <x-text-input name="id" type="text" value="{{ old('id') }}" class="w-full mt-2" placeholder="Ingrese el nombre">
                        </x-text-input>

                        <x-input-error :messages="$errors->first('id')"/>

                        <div class="flex justify-end mt-2">
                            <button class="btn btn-blue">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </x-container>

</x-app-layout>
