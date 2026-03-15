@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto my-10 px-6 font-serif">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800 tracking-widest uppercase">Checkout</h2>
        <div class="w-12 h-0.5 bg-[#b58d67] mx-auto mt-3"></div>
    </div>

    <form action="{{ route('order.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 font-sans">
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Nom Complet</label>
                <input type="text" name="name" required 
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
@endsection