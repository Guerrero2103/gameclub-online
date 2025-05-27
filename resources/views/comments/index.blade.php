@extends('layouts.app')

@section('content')
<main>
    <h2>Reacties</h2>

    @foreach ($comments as $comment)
        <div class="comment">
            <p>{{ $comment->content }}</p>

            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('comments.edit', $comment->id) }}">Bewerken</a>
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Verwijderen</button>
                    </form>
                @endif
            @endauth
        </div>
        <hr>
    @endforeach
</main>
@endsection
