@extends('layouts.app')

@section('content')
<main>
    <h2>Ontvangen berichten</h2>

    @forelse ($messages as $msg)
        <div style="margin-bottom: 2rem;">
            <strong>{{ $msg->name }}</strong> ({{ $msg->email }})<br>
            <p>{{ $msg->message }}</p>
            <hr>
        </div>
    @empty
        <p>Geen berichten ontvangen.</p>
    @endforelse
</main>
@endsection
