@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Veelgestelde Vragen</h1>

    @can('manage-faq')
        <div class="mb-4">
            <a href="{{ route('faq.manage') }}" style="background: #00e6e6; color: #222; font-weight: bold; padding: 12px 28px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.12); text-decoration: none; display: inline-block; transition: background 0.2s; cursor: pointer; margin-bottom: 1rem;"
               onmouseover="this.style.background='#00b3b3'" onmouseout="this.style.background='#00e6e6'">
                FAQ Beheer (Admin)
            </a>
        </div>
    @endcan

    @forelse ($categories as $category)
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold mb-4 text-primary">{{ $category->name }}</h2>
            </div>
            <div class="space-y-6">
                @forelse ($category->helpEntries as $faq)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium mb-2" style="color: #1a202c;">{{ $faq->question }}</h3>
                        <p style="color: #1a202c;">{{ $faq->answer }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Geen vragen in deze categorie.</p>
                @endforelse
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-500">Er zijn nog geen FAQ's beschikbaar.</p>
        </div>
    @endforelse

    @auth
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Stel een vraag voor de FAQ</h2>
            <form action="{{ route('faq-suggestions.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-4">
                @csrf
                <div class="mb-2">
                    <label for="question" class="block font-medium">Jouw vraag</label>
                    <input type="text" name="question" id="question" class="w-full border rounded px-2 py-1" required>
                </div>
                <div class="mb-2">
                    <label for="explanation" class="block font-medium">Toelichting (optioneel)</label>
                    <textarea name="explanation" id="explanation" class="w-full border rounded px-2 py-1"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Verstuur voorstel</button>
            </form>
        </div>
    @endauth
</div>
@endsection
