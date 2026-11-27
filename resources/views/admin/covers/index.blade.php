<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
    ]

]">

    <x-slot name="action">

        <a href="{{route('admin.covers.create')}}" class="btn btn-blue">
            Nuevo
        </a>

    </x-slot>

    <ul class="space-y-4">
        @foreach ($covers as $cover)

            <li class="bg-white rounded-lg shadow-lg overflow-hidden lg:flex">

                <img src="{{$cover->image}}" alt="" class="w-full lg:w-64 aspect-[3/1] object-cover object-center">

                <div class="p-4 lg:flex-1 lg:flex lg:justify-between lg:items-center space-y-3 lg:space-y-0">

                    <div>
                        <h1 class="font-semibold">
                            {{$cover->title}}
                        </h1>

                        <p>
                            @if ($cover->is_active)
                                <span class="bg-neutral-secondary-medium text-heading text-xs font-medium px-1.5 py-0.5 rounded">
                                    Activo
                                </span>
                            @else
                                <span class="bg-danger-soft text-fg-danger-strong text-xs font-medium px-1.5 py-0.5 rounded">
                                    Inactivo
                                </span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold">
                            Fecha de inicio
                        </p>

                        <p>
                            {{$cover->start_at->format('d/m/Y')}}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold">
                            Fecha de finalización
                        </p>

                        <p>
                            {{$cover->end_at ? $cover->end_at->format('d/m/Y'): '-'}}
                        </p>
                        
                    </div>
                        <a class="btn btn-blue" href="{{route('admin.covers.edit', $cover)}}">
                            Editar
                        </a>
                    <div>
                        
                    </div>

                </div>
            </li>
            
        @endforeach
    </ul>

</x-admin-layout>