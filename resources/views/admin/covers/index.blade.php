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

    <ul class="space-y-4" id="covers">
        @foreach ($covers as $cover)

            <li class="bg-white rounded-lg shadow-lg overflow-hidden lg:flex cursor-move"
                data-id="{{$cover->id}}">

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

    @push('js')

        <script src="<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.7/Sortable.js" integrity="sha512-aUIczPo0e7N7BM7pIVe8I0XbFrT5jy9IjFSHuxhyb64yfHZ4JL10tKpTK/y8tWVB/hcO2YYfvQwbv3o+srga+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>"

        <script>
            new Sortable(covers, {
                animation: 150,
                ghostClass: 'bg-blue-100'
                store: {
                    set: (sortable) => {
                        const sorts = sortable.toArray();
                        
                        axios.post("{{route('api.sort.covers')}}", {
                            sorts: sorts
                        }).catch((error) => {
                            console.log(error);
                        });
                    }
                }
            });
        </script>
    @endpush

</x-admin-layout>