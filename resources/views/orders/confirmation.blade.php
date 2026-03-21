@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-6 font-serif">
    <div class="text-center max-w-lg">
        <h1 class="text-4xl text-[#b58d67] font-bold mb-6">MERCI POUR VOTRE COMMANDE !</h1>
        <p class="text-lg text-gray-600 leading-relaxed font-sans italic">
            Votre commande a été enregistrée avec succès. <br>
            Nous préparons vos produits artisanaux avec le plus grand soin.
        </p>
        
        <div class="mt-10">
            <a href="{{ route('shop.index') }}" 
                class="inline-block bg-gray-900 text-white px-8 py-3 rounded-md font-semibold font-sans hover:bg-[#b58d67] transition-all duration-300 uppercase tracking-tighter">
                Retourner à la boutique
            </a>
        </div>
    </div>
</div>
@endsection