<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel główny') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Twoje ogłoszenia') }}</h3>
                    
                    @if($advertisements->count() > 0)
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($advertisements as $advertisement)
                                <div class="p-6 bg-white rounded-lg shadow">
                                    @if($advertisement->image_path)
                                        <img src="{{ Storage::url($advertisement->image_path) }}" 
                                             alt="Zdjęcie ogłoszenia" 
                                             class="w-full h-48 object-cover mb-4 rounded">
                                    @endif
                                    <h3 class="text-xl font-bold">{{ $advertisement->title }}</h3>
                                    <p class="text-gray-600">Dodane przez: {{ $advertisement->user->name }}</p>
                                    <p class="mt-2">{{ Str::limit($advertisement->description, 100) }}</p>
                                    
                                    <div class="mt-4 flex space-x-2">
                                        <button onclick="openModal('modal-{{ $advertisement->id }}')" 
                                                class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                                            Szczegóły
                                        </button>
                                        <a href="{{ route('advertisements.edit', $advertisement) }}" 
                                           class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">
                                            Edytuj
                                        </a>
                                        <form action="{{ route('advertisements.destroy', $advertisement) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600" 
                                                    onclick="return confirm('Czy na pewno chcesz usunąć to ogłoszenie?')">
                                                Usuń
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Modal dla ogłoszenia -->
                                <div id="modal-{{ $advertisement->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                                    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                                        <div class="flex flex-col">
                                            <div class="flex justify-between items-center mb-4">
                                                <h3 class="text-2xl font-bold">{{ $advertisement->title }}</h3>
                                                <button onclick="closeModal('modal-{{ $advertisement->id }}')" class="text-gray-600 hover:text-gray-800">
                                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            
                                            @if($advertisement->image_path)
                                                <img src="{{ Storage::url($advertisement->image_path) }}" 
                                                     alt="Zdjęcie ogłoszenia" 
                                                     class="w-full h-64 object-cover mb-4 rounded">
                                            @endif
                                            
                                            <p class="text-gray-600 mb-2">Dodane przez: {{ $advertisement->user->name }}</p>
                                            <p class="text-gray-600 mb-2">Data dodania: {{ $advertisement->created_at->format('d.m.Y H:i') }}</p>
                                            <div class="mt-4">
                                                <h4 class="font-semibold mb-2">Opis:</h4>
                                                <p class="text-gray-800 whitespace-pre-line">{{ $advertisement->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">{{ __('Nie masz jeszcze żadnych ogłoszeń.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Skrypt do obsługi modali -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }
    </script>
</x-app-layout>