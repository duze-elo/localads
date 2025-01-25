<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Ogłoszenia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('advertisements.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                    Dodaj ogłoszenie
                </a>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($advertisements as $advertisement)
                    <div class="p-6 bg-white rounded-lg shadow">
                        @if ($advertisement->image_path)
                            <img src="{{ Storage::url($advertisement->image_path) }}" alt="Zdjęcie ogłoszenia" class="w-full h-48 object-cover mb-4 rounded">
                        @endif
                        <h3 class="text-xl font-bold">{{ $advertisement->title }}</h3>
                        <p class="text-gray-600">Dodane przez: {{ $advertisement->user->name }}</p>
                        <p class="mt-2">{{ $advertisement->description }}</p>
                        
                        @if (auth()->id() === $advertisement->user_id)
                            <div class="mt-4 flex space-x-2">
                                <a href="{{ route('advertisements.edit', $advertisement) }}" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">
                                    Edytuj
                                </a>
                                <form action="{{ route('advertisements.destroy', $advertisement) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600" onclick="return confirm('Czy na pewno chcesz usunąć to ogłoszenie?')">
                                        Usuń
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>