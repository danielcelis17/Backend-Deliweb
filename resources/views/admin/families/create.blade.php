<x-admin-layout : breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index')
    ],
    [
        'name' => 'Nuevo'
    ]
]">

    <div class="card">

        <form action="{{route('admin.families.store')}}" method="POST">

            @csrf


            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full"
                    placeholder="Ingrese el nombre de la familia"
                    name="name" 
                    value"{{old('name')}}"/>
            </div>

            <div>
                <x-button class="flex justify-end">
                    Guardar
                </x-button>
            </div>

        </form>

    </div>

</x-admin-layout>