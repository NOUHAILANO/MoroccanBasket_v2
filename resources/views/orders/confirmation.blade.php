@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto my-16 px-6 font-serif text-center">
    
    @if(session('success'))
    <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-8 font-sans text-sm font-medium border border-green-200">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
        <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-green-100">
            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h2 class="text-3xl font-bold text-gray-800 tracking-widest uppercase mb-4">Commande Confirmée !</h2>
        <p class="text-gray-500 font-sans mb-8">Merci pour votre achat. Voici les détails de votre commande.</p>
        
        <div class="bg-gray-50 p-8 rounded-xl font-sans text-left mb-8 border border-gray-200">
            
            <div class="mb-6">
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Numéro de référence</p>
                <p class="text-xl font-bold text-gray-900 tracking-widest">{{ session('ref') ?? 'N/A' }}</p>
            </div>

            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest border-b border-gray-200 pb-2 mb-4">Résumé des produits</h3>
            
            @if(isset($order) && $order->items)
                <div class="space-y-3 mb-6">
                    @foreach($order->items as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-700 font-medium">{{ $item->product->nom }} <span class="text-gray-400 text-xs">(x{{ $item->quantity }})</span></span>
                        <span class="font-bold text-gray-900">{{ number_format($item->price * $item->quantity, 2) }} DH</span>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 italic mb-6">Les détails vous ont été envoyés par email.</p>
            @endif

            <div class="border-t border-gray-200 pt-5 flex justify-between items-center mt-4">
                <span class="text-gray-900 uppercase tracking-wider text-sm font-bold">Total Final</span>
                <span class="text-2xl font-bold text-[#b58d67]">
                    {{ isset($order) ? number_format($order->total_amount, 2) : (session('total') ?? '0.00') }} DH
                </span>
            </div>
        </div>

        <a href="{{ route('shop.index') }}" 
            class="inline-block bg-gray-900 text-white px-8 py-4 rounded-lg font-bold tracking-wide hover:bg-[#b58d67] transition-colors duration-300 font-sans uppercase text-sm w-full sm:w-auto shadow-lg">
            Retour à la boutique
        </a>
    </div>
</div>
@endsection