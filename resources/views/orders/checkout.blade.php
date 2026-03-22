@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto my-10 px-6 font-serif">
    
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800 tracking-widest uppercase">Checkout</h2>
        <div class="w-12 h-0.5 bg-[#b58d67] mx-auto mt-3"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <div class="lg:col-span-2">
            <form action="{{ route('order.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                @csrf
                <h3 class="font-sans text-lg font-bold mb-6 text-gray-700 uppercase">Informations de livraison</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 font-sans">
                    <div class="md:col-span-1">
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Nom Complet</label>
                        <input type="text" name="name" required 
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#b58d67] focus:border-transparent outline-none transition shadow-sm">
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Email</label>
                        <input type="email" name="email" required 
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#b58d67] focus:border-transparent outline-none transition shadow-sm">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Adresse de Livraison</label>
                        <input type="text" name="address" required 
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#b58d67] focus:border-transparent outline-none transition shadow-sm">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Ville</label>
                        <input type="text" name="city" required 
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#b58d67] focus:border-transparent outline-none transition shadow-sm">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Téléphone</label>
                        <input type="tel" name="phone" required 
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#b58d67] focus:border-transparent outline-none transition shadow-sm">
                    </div>
                </div>

                <button type="submit" 
                    class="w-full mt-10 bg-gray-900 text-white py-4 rounded-lg font-bold tracking-wide hover:bg-[#b58d67] transition-colors duration-300 uppercase shadow-lg">
                    Valider la Commande
                </button>
            </form>
        </div>

        <div class="bg-gray-50 p-8 rounded-xl border border-gray-200 h-fit font-sans shadow-sm">
            <h3 class="text-lg font-bold text-gray-800 uppercase mb-6 border-b pb-3 border-gray-200">Résumé de la commande</h3>
            
            @if(session('cart'))
                <div class="space-y-4 mb-6">
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">{{ $details['name'] }} <span class="text-xs text-gray-400">(x{{ $details['quantity'] }})</span></span>
                            <span class="font-semibold text-gray-800">{{ number_format($details['price'] * $details['quantity'], 2) }} DH</span>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-gray-200 pt-4 flex justify-between items-center">
                    <span class="text-gray-900 uppercase tracking-wider text-sm font-bold">Total</span>
                    <span class="text-2xl font-bold text-[#b58d67]">{{ number_format($total, 2) }} DH</span>
                </div>
            @else
                <p class="text-gray-500 text-sm italic">Votre panier est vide.</p>
            @endif
        </div>

    </div>
</div>
@endsection