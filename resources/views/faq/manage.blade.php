@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">FAQ Beheren</h1>
        <a href="{{ route('faq.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>Nieuwe FAQ Toevoegen
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @forelse ($categories as $category)
        <div class="mb-12 bg-white rounded-lg shadow-md overflow-hidden last:mb-0">
            <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                <h2 class="text-2xl font-semibold text-blue-700">{{ $category->name }}</h2>
                <form action="{{ route('faq.category.destroy', $category->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="text-red-600 hover:text-red-800 transition-colors duration-200 uppercase text-sm font-medium flex items-center"
                            onclick="return confirm('Weet je zeker dat je de categorie \'{{ $category->name }}\' en alle bijbehorende FAQ's wilt verwijderen?')">
                        <i class="fas fa-trash mr-1"></i>
                        Categorie Verwijderen
                    </button>
                </form>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse ($category->helpEntries as $faq)
                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex justify-between items-start">
                            <div class="flex-1 pr-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $faq->question }}</h3>
                                <p class="text-gray-600 whitespace-pre-wrap">{{ $faq->answer }}</p>
                            </div>
                            <div class="ml-4 flex flex-col space-y-2 items-end justify-start">
                                <a href="{{ route('faq.edit', $faq->id) }}" 
                                   class="text-gray-700 hover:text-gray-900 transition-colors duration-200 uppercase text-sm font-medium flex items-center">
                                    <i class="fas fa-edit mr-1"></i>
                                    Bewerken
                                </a>
                                <form action="{{ route('faq.destroy', $faq->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 transition-colors duration-200 uppercase text-sm font-medium flex items-center"
                                            onclick="return confirm('Weet je zeker dat je deze FAQ wilt verwijderen?')">
                                        <i class="fas fa-trash mr-1"></i>
                                        Verwijderen
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        Geen vragen in deze categorie.
                    </div>
                @endforelse
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <p class="text-gray-500">Er zijn nog geen FAQ's beschikbaar.</p>
            <a href="{{ route('faq.create') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-800">
                Voeg je eerste FAQ toe
            </a>
        </div>
    @endforelse
</div>

@push('scripts')
<script>
    // Voeg hier eventueel JavaScript toe voor extra functionaliteit
</script>
@endpush
@endsection 