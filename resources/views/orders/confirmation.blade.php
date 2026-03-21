@extends('layouts.app')

@section('content')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="luxury-card">
        <h2>Merci pour votre commande !</h2>
        <p>Votre numéro de référence est : <strong>{{ session('ref') }}</strong></p>
    </div>
@endsection