@extends('layouts.app')


@section('content')

<style>
    .pagination {
        display: flex;
        list-style: none;
        gap: 10px;
        align-items: center;
    }

    .pagination li a,
    .pagination li span {
        padding: 8px 16px;
        border: 1px solid #eee;
        border-radius: 5px;
        text-decoration: none;
        color: #1a1a1a;
        font-family: 'Poppins', sans-serif;
        transition: 0.3s;
    }

    .pagination li.active span {
        background: #b58d67;
        color: white;
        border-color: #b58d67;
    }

    .pagination li a:hover {
        background: #f8f8f8;
        border-color: #b58d67;
    }

    /* Hide the "Showing X to Y" text if you only want the numbers */
    .pagination-wrapper nav div:first-child {
        display: none;
    }
</style>

<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px; font-family: 'Playfair Display', serif;">



    <div style="text-align: center; margin-bottom: 60px;">

        <h1 style="font-size: 42px; color: #2c3e50; margin-bottom: 10px; letter-spacing: 2px;">MOROCCAN BASKET</h1>

        <p style="color: #888; font-style: italic;">L'essence de l'artisanat et du soin au naturel</p>

        <div style="width: 80px; height: 2px; background: #b58d67; margin: 20px auto;"></div>

    </div>

    <div style="margin-bottom: 40px; display: flex; justify-content: center;">
        <form action="{{ route('shop.index') }}" method="GET" id="filterForm" style="width: 100%; max-width: 400px;">
            <label for="category" style="display: block; font-family: 'Poppins', sans-serif; font-size: 14px; color: #555; margin-bottom: 8px; text-align: center;">FILTRER PAR CATÉGORIE</label>
            <select name="category"
                id="category"
                onchange="document.getElementById('filterForm').submit()"
                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: 'Poppins', sans-serif; appearance: none; background: #fff url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23b58d67%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22/%3E%3C/svg%3E') no-repeat right 12px center; background-size: 12px auto;">
                <option value="">Toutes les collections</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->nom }}
                </option>
                @endforeach
            </select>
        </form>
    </div>


    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">

        @foreach($products as $product)

        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05); transition: 0.3s; border: 1px solid #eee;"

            onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">



            <div style="height: 300px; overflow: hidden; position: relative;">

                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom }}"

                    style="width: 100%; height: 100%; object-fit: cover;">




                <span style="position: absolute; top: 15px; left: 15px; background: rgba(255,255,255,0.9); padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; color: #b58d67; text-transform: uppercase;">

                    {{ $product->category->nom }}

                </span>

            </div>


            <div style="padding: 20px; text-align: center;">

                <h3 style="font-size: 20px; margin: 0 0 10px 0; color: #333; font-family: 'Poppins', sans-serif;">{{ $product->nom }}</h3>

                <p style="color: #b58d67; font-size: 18px; font-weight: bold; margin-bottom: 20px; font-family: 'Poppins', sans-serif;">

                    {{ number_format($product->price, 2) }} DH

                </p>



                <a href="{{ route('shop.show', $product->id) }}"

                    style="display: block; background: #1a1a1a; color: white; text-decoration: none; padding: 12px; border-radius: 6px; font-weight: 500; transition: 0.3s; font-family: 'Poppins', sans-serif;"

                    onmouseover="this.style.background='#b58d67'" onmouseout="this.style.background='#1a1a1a'">

                    DÉCOUVRIR

                </a>

            </div>

        </div>

        @endforeach



    </div>

</div>


<div class="pagination-wrapper" style="margin-top: 50px; display: flex; justify-content: center;">
    {{ $products->appends(request()->input())->links() }}
</div>
@endsection