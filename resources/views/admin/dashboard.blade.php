@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welkom op het Admin Dashboard!

                    {{-- Unieke marker om te controleren of deze view wordt geladen --}}
                    ADMIN_DASHBOARD_VIEW_LOADED

                    <div class="mt-4">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Gebruikers Beheren</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
