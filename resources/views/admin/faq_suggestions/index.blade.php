@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">FAQ Suggesties</h1>
    @foreach($suggestions as $suggestion)
        <div class="bg-white rounded-lg shadow-md p-4 mb-4">
            <strong style="color: #222;">{{ $suggestion->user->username ?? $suggestion->user->name }}</strong> <span style="color: #222;">stelde voor:</span><br>
            <p><b style="color: #222;">Vraag:</b> <span style="color: #222;">{{ $suggestion->question }}</span></p>
            @if($suggestion->explanation)
                <p><b style="color: #222;">Toelichting:</b> <span style="color: #222;">{{ $suggestion->explanation }}</span></p>
            @endif
            <form action="{{ route('faq-suggestions.approve', $suggestion) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Goedkeuren</button>
            </form>
            <form action="{{ route('faq-suggestions.destroy', $suggestion) }}" method="POST" style="display:inline; margin-left: 10px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Verwijderen</button>
            </form>
        </div>
    @endforeach
</div>
@endsection 