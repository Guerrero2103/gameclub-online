@extends('layouts.app')

@section('content')
<main>
    <h2>Laatste Nieuws</h2>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    {{-- Alleen admin ziet deze knop --}}
    @if(auth()->check() && auth()->user()->isAdmin())
        <div style="margin-bottom: 1rem;">
            <a href="{{ route('news.create') }}" class="btn btn-primary">➕ Nieuws toevoegen</a>
        </div>
    @endif

    @foreach($newsItems as $news)
        <article style="margin-bottom: 2rem;">
            <h3><a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a></h3>
            <p><small>Gepubliceerd op: {{ \Carbon\Carbon::parse($news->published_at)->format('d-m-Y') }}</small></p>

            @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="Afbeelding" style="max-width: 100%; height: auto;">
            @endif

            <p>{{ \Illuminate\Support\Str::limit($news->content, 150) }}</p>

            {{-- Alleen admin ziet bewerk/verwijder acties --}}
            @if(auth()->check() && auth()->user()->isAdmin())
                <div style="margin-top: 0.5rem;">
                    <a href="{{ route('news.edit', $news->id) }}" class="btn btn-warning">✏️ Bewerken</a>

                    <form action="{{ route('news.destroy', $news->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je dit item wilt verwijderen?')">🗑 Verwijderen</button>
                    </form>
                </div>
            @endif
        </article>
    @endforeach

    {{ $newsItems->links() }}
</main>
@endsection
