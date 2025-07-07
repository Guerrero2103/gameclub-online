@extends('layouts.app')

@section('content')
<main>
    <h2>{{ $news->title }}</h2>
    <p><small>Gepubliceerd op: {{ \Carbon\Carbon::parse($news->published_at)->format('d-m-Y') }}</small></p>

    @if($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" alt="Afbeelding" style="max-width: 100%; height: auto; margin-bottom: 1rem;">
    @endif

    <p>{{ $news->content }}</p>

    <a href="{{ route('news.index') }}">← Terug naar overzicht</a>

    <h3>Reacties</h3>
    @foreach($news->comments as $comment)
        <div style="margin-bottom: 1rem;">
            <strong>{{ $comment->user->username ?? $comment->user->name }}</strong> zegt:<br>
            <p>{{ $comment->content }}</p>
            <small>{{ $comment->created_at->diffForHumans() }}</small>
            @can('delete', $comment)
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Verwijderen</button>
                </form>
            @endcan
        </div>
    @endforeach

    @auth
        <form action="{{ route('comments.store', $news) }}" method="POST">
            @csrf
            <textarea name="content" rows="3" required style="width:100%;"></textarea>
            <button type="submit">Plaats reactie</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Log in</a> om te reageren.</p>
    @endauth
</main>
@endsection
