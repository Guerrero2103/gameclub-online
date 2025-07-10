@extends('layouts.app')

@section('content')
<main>
    <h2>Nieuw topic aanmaken</h2>
    <form action="{{ route('forum.store') }}" method="POST" style="max-width:500px;">
        @csrf
        <div style="margin-bottom: 1rem;">
            <label for="title" style="font-weight:bold;">Titel:</label>
            <input type="text" name="title" id="title" class="form-control" required style="width:100%;">
        </div>
        <div style="margin-bottom: 1rem;">
            <label for="body" style="font-weight:bold;">Bericht:</label>
            <textarea name="body" id="body" rows="6" class="form-control" required style="width:100%;"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Plaats topic</button>
    </form>
</main>
@endsection 