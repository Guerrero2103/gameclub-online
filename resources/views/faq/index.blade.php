@extends('layouts.app')

@section('content')
<main>
    <h1>Veelgestelde Vragen</h1>

    @forelse ($entries as $faq)
        <div style="margin-bottom: 1.5rem;">
            <strong>Vraag:</strong> {{ $faq->question }}<br>
            <strong>Antwoord:</strong> {{ $faq->answer }}
        </div>
    @empty
        <p>Er zijn nog geen FAQ's beschikbaar.</p>
    @endforelse
</main>
@endsection
