@extends('layouts.app')

@section('content')
<main>
    <div style="margin-bottom: 10px; font-weight: bold; color: #00e6e6;">Titel:</div>
    <h2 style="margin: 0 0 6px 0;">{{ $news->title }}</h2>
    <div style="margin-bottom: 2px; font-weight: bold; color: #00e6e6;">Gepubliceerd op:</div>
    <p style="margin: 0 0 12px 0;"><small>{{ \Carbon\Carbon::parse($news->published_at)->format('d-m-Y') }}</small></p>

    @if($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" alt="Afbeelding" style="max-width: 100%; height: auto; margin-bottom: 10px;">
    @endif

    <div style="margin-bottom: 2px; font-weight: bold; color: #00e6e6;">Inhoud:</div>
    <p style="margin: 0 0 18px 0;">{{ $news->content }}</p>

    <a href="{{ route('news.index') }}" style="display:inline-block; margin-bottom: 18px;">← Terug naar overzicht</a>

    <div style="margin-top: 18px; margin-bottom: 6px; font-weight: bold; color: #00e6e6; font-size: 1.1em;">Reacties:</div>
    @foreach($news->comments as $comment)
        <div style="margin-bottom: 1rem; padding: 8px 12px; background: #181c2f; border-radius: 6px;">
            <strong>{{ $comment->user->username ?? $comment->user->name }}</strong> zegt:<br>
            <p style="margin: 4px 0 6px 0;">{{ $comment->content }}</p>
            <small>{{ $comment->created_at->diffForHumans() }}</small>
            @can('delete', $comment)
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline; margin-left: 8px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:#00e6e6; color:#181c2f; border:none; border-radius:4px; padding:2px 10px; margin-left:4px; cursor:pointer;">Verwijderen</button>
                </form>
            @endcan
        </div>
    @endforeach

    @auth
        <button id="showCommentFormBtn" type="button" style="margin:18px 0 10px 0; display:block; background:#00e6e6; color:#181c2f; font-weight:bold; padding:0.6rem 1.5rem; border-radius:8px; border:none; cursor:pointer;">Plaats een reactie</button>
        <form id="commentForm" action="{{ route('comments.store', $news) }}" method="POST" style="display:none; margin-bottom:18px;">
            @csrf
            <textarea name="content" rows="3" required style="width:100%; margin-bottom:8px;"></textarea>
            <button type="submit" style="background:#00e6e6; color:#181c2f; font-weight:bold; padding:0.4rem 1.2rem; border-radius:6px; border:none; cursor:pointer;">Plaats reactie</button>
        </form>
        <script>
            document.getElementById('showCommentFormBtn').addEventListener('click', function() {
                document.getElementById('commentForm').style.display = 'block';
                this.style.display = 'none';
            });
        </script>
    @else
        <p style="margin-top:18px;"><a href="{{ route('login') }}">Log in</a> om te reageren.</p>
    @endauth
</main>
@endsection
