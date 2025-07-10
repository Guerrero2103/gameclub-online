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
            <a href="{{ route('news.make') }}" class="btn btn-primary">➕ Nieuws toevoegen</a>
        </div>
    @endif

    @foreach($newsItems as $news)
        <article style="margin-bottom: 2rem;">
            <div style="font-weight:bold; color:#00e6e6; margin-bottom: 2px;">Titel:</div>
            <h3 style="margin: 0 0 2px 0;"><a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a></h3>
            <p style="margin: 0 0 6px 0;"><small>Gepubliceerd op: {{ \Carbon\Carbon::parse($news->published_at)->format('d-m-Y') }}</small></p>

            @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="Afbeelding" style="max-width: 100%; height: auto; margin-bottom: 6px;">
            @endif

            <div style="font-weight:bold; color:#00e6e6; margin-top:4px; margin-bottom:2px;">Inhoud:</div>
            <p style="margin: 0 0 8px 0;">{{ \Illuminate\Support\Str::limit($news->content, 150) }}</p>

            <a href="{{ route('news.show', $news->id) }}" style="
                display: inline-block;
                background: #00e6e6;
                color: #181c2f;
                font-weight: bold;
                padding: 0.6rem 1.5rem;
                border-radius: 8px;
                text-decoration: none;
                margin-top: 2px;
                margin-bottom: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                transition: background 0.2s, color 0.2s;
            " onmouseover="this.style.background='#00b3b3';this.style.color='#fff';" onmouseout="this.style.background='#00e6e6';this.style.color='#181c2f';">
                👁 Bekijk nieuws
            </a>

            <div style="margin-top:10px; margin-bottom:6px; font-weight:bold; color:#00e6e6;">Reacties:</div>
            @if($news->comments->count())
                @foreach($news->comments as $comment)
                    <div style="margin-bottom: 8px; padding: 6px 10px; background: #181c2f; border-radius: 6px;">
                        <strong>{{ $comment->user->username ?? $comment->user->name }}</strong> zegt:<br>
                        <span style="display:block; margin: 2px 0 4px 0;">{{ $comment->content }}</span>
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            @else
                <div style="color:#aaa; margin-bottom:8px;">Nog geen reacties.</div>
            @endif

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
