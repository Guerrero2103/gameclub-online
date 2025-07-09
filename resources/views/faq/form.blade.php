@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">{{ isset($faq) ? 'FAQ Bewerken' : 'Nieuwe FAQ Toevoegen' }}</h1>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($faq) ? route('faq.update', $faq->id) : route('faq.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @if(isset($faq))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-medium mb-2">Categorie</label>
            <select name="category" id="category" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('category') border-red-500 @enderror">
                <option value="">Selecteer een categorie</option>
                @if(isset($faq))
                    <option value="{{ $faq->helpGroup->id }}" selected>{{ $faq->helpGroup->name }}</option>
                @endif
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
                <option value="new" {{ old('category') == 'new' ? 'selected' : '' }}>Nieuwe categorie...</option>
            </select>
            @error('category')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div id="newCategoryField" class="mb-4{{ old('category') == 'new' ? '' : ' hidden' }}">
            <label for="newCategory" class="block text-gray-700 font-medium mb-2">Nieuwe Categorie Naam</label>
            <input type="text" name="newCategory" id="newCategory" 
                   value="{{ old('newCategory') }}"
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('newCategory') border-red-500 @enderror">
            @error('newCategory')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="question" class="block text-gray-700 font-medium mb-2">Vraag</label>
            <input type="text" name="question" id="question" 
                   value="{{ old('question', $faq->question ?? '') }}"
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('question') border-red-500 @enderror">
            @error('question')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="answer" class="block text-gray-700 font-medium mb-2">Antwoord</label>
            <textarea name="answer" id="answer" rows="4" 
            <textarea name="answer" id="answer" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">{{ old('answer', $faq->answer ?? '') }}</textarea>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('faq.manage') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">Annuleren</a>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark">
                {{ isset($faq) ? 'Bijwerken' : 'Toevoegen' }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const newCategoryField = document.getElementById('newCategoryField');
        function toggleNewCategoryField() {
            if (categorySelect.value === 'new') {
                newCategoryField.classList.remove('hidden');
            } else {
                newCategoryField.classList.add('hidden');
            }
        }
        categorySelect.addEventListener('change', toggleNewCategoryField);
        toggleNewCategoryField(); // direct bij laden uitvoeren
    });
</script>
@endpush
@endsection 