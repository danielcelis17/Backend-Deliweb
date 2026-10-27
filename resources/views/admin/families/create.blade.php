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

        <form action="">


            <div>
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full"
                    placeholder="Ingrese el nombre de la familia" />
            </div>

        </form>

    </div>

</x-admin-layout>