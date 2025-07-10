@extends('layouts.app')

@section('content')
<main>
    <h2>Forum</h2>
    @auth
        <a href="{{ route('forum.create') }}" class="btn btn-primary" style="margin-bottom: 1rem; display:inline-block;">➕ Nieuw topic</a>
    @endauth
    @foreach($forums as $forum)
        <article style="margin-bottom: 1.5rem; padding: 1rem; background: #181c2f; border-radius: 8px;">
            <h3 style="margin-bottom: 0.2rem;"><a href="{{ route('forum.show', $forum->id) }}">{{ $forum->title }}</a></h3>
            <div style="color:#00e6e6; font-size:0.95em;">Door: {{ $forum->user->username ?? $forum->user->name }} op {{ $forum->created_at->format('d-m-Y H:i') }}</div>
            <p style="margin: 0.5rem 0 0 0;">{{ \Illuminate\Support\Str::limit($forum->body, 120) }}</p>
        </article>
    @endforeach
    {{ $forums->links() }}
</main>
@endsection 