@extends('layouts.app') 
@section('content') 
<div class="text-center py-20">
    <h1 class="text-3xl font-serif mb-4">MERCI POUR VOTRE COMMANDE !</h1>
    
    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <p class="mb-8">Votre commande a été enregistrée avec succès. Nous préparons vos produits artisanaux avec le plus grand soin.</p>
    <a href="{{ route('shop.index') }}" class="underline tracking-widest uppercase text-sm">Retourner à la boutique</a>
</div>
@endsection