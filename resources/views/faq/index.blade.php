@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Veelgestelde Vragen</h1>

    @can('manage-faq')
        <div class="mb-4">
            <a href="{{ route('faq.manage') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">FAQ Beheer (Admin)</a>
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
</div>
@endsection
