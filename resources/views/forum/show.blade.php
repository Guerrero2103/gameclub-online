@extends('layouts.app')

@section('content')
<main>
    <h2>{{ $forum->title }}</h2>
    <div style="color:#00e6e6; font-size:0.95em; margin-bottom:8px;">Door: {{ $forum->user->username ?? $forum->user->name }} op {{ $forum->created_at->format('d-m-Y H:i') }}</div>
    <div style="margin-bottom: 1.5rem;">{{ $forum->body }}</div>

    <a href="{{ route('forum.index') }}" style="display:inline-block; margin-bottom: 18px;">← Terug naar forum</a>

    <div style="margin-top: 18px; margin-bottom: 6px; font-weight: bold; color: #00e6e6; font-size: 1.1em;">Reacties:</div>
    @foreach($forum->forumReplies as $reply)
        <div style="margin-bottom: 1rem; padding: 8px 12px; background: #181c2f; border-radius: 6px;">
            <strong>{{ $reply->user->username ?? $reply->user->name }}</strong> zegt:<br>
            <p style="margin: 4px 0 6px 0;">{{ $reply->body }}</p>
            <small>{{ $reply->created_at->diffForHumans() }}</small>
        </div>
    @endforeach
    @if($forum->forumReplies->isEmpty())
        <div style="color:#aaa; margin-bottom:8px;">Nog geen reacties.</div>
    @endif

    @auth
        <form action="{{ route('forum.reply.store', $forum->id) }}" method="POST" style="margin-top:18px;">
            @csrf
            <label for="body" style="font-weight:bold;">Jouw reactie:</label>
            <textarea name="body" id="body" rows="3" required style="width:100%; margin-bottom:8px;"></textarea>
            <button type="submit" class="btn btn-primary">Plaats reactie</button>
        </form>
    @else
        <p style="margin-top:18px;"><a href="{{ route('login') }}">Log in</a> om te reageren.</p>
    @endauth
</main>
@endsection 