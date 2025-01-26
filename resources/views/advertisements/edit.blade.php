<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edytuj ogłoszenie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg shadow">
                <form action="{{ route('advertisements.update', $advertisement) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="title" class="block mb-2 text-sm font-bold text-gray-700">Tytuł (max 120 znaków)</label>
                        <input type="text" name="title" id="title" maxlength="120" class="w-full px-3 py-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block mb-2 text-sm font-bold text-gray-700">Opis (max 360 znaków)</label>
                        <textarea name="description" id="description" rows="4" maxlength="360" class="w-full px-3 py-2 border rounded" required></textarea>
                    </div>

                    @if ($advertisement->image_path)
                        <div class="mb-4">
                            <img src="{{ Storage::url($advertisement->image_path) }}" alt="Aktualne zdjęcie" class="w-48 h-48 object-cover">
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="image" class="block mb-2 text-sm font-bold text-gray-700">Nowe zdjęcie</label>
                        <input type="file" name="image" id="image" class="w-full px-3 py-2 border rounded">
                    </div>

                    <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">
                        Zapisz zmiany
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>