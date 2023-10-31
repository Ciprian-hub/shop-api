<x-app-layout>
    {{--    hero--}}
    <div class="w-full mx-auto">
        <div class="hero mx-auto w-full h-[100vh] flex items-center justify-center"
             style="background-image: url('images/bg-image.png'); background-size: cover; background-position: center; background-repeat: no-repeat"
             )>
            <div
                class="bg-white bg-opacity-75 shadow-sm w-[730px] h-[349px] flex flex-col items-center lg:px-20 mx:px-8 sm:p-8 py-6">
                <p class="text-3xl">🌱</p>
                <h1 class="text-3xl mt-3">The nature candle</h1>
                <p class="text-center text-lg text-gray-900 mt-4">All handmade with natural soy wax, Candleaf is a
                    companion for all your pleasure moments </p>
                <button class="bg-green-400 py-2 px-12 text-white rounded-md mt-12 hover:bg-green-500">Discovery our
                    collection
                </button>
            </div>
        </div>
    </div>
    {{--    hero--}}

    {{--    products--}}
    <div class="mb-10">
        <h1 class="text-5xl text-center mt-20">Products</h1>
        <p class="text-center text-lg text-gray-900 mt-4">
            Order it for you or for your beloved ones
        </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-5">
        @foreach($products as $product)
            <div x-data="productItem({{json_encode([
            'id' => $product->id,
            'image' => $product->image,
            'title' => $product->title,
            'price' => $product->price,
            'addToCartUrl' => route('cart.add', $product)
])              }})"
                 class="max-w-sm bg-white rounded-lg shadow">
                <a href="{{route('product.view', $product->slug)}}" class="block aspect-w-3 aspect-h-2">
                    <img class="rounded-lg object-contain p-3" src="{{$product['image']}}" alt=""/>
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-md truncate ... tracking-tight text-gray-900">{{$product['title']}}</h5>
                    </a>
                    <div class="flex items-center justify-between">
                        <button class="bg-green-400 py-2 px-6 text-white rounded-md hover:bg-green-500 text-sm"
                                @click="addToCart()">
                            Add to cart
                        </button>
                        <p class="font-bold text-gray-700 ">{{$product['price']}}$</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{--    products--}}

    <div class="w-full mx-auto">
        <div class="hero mx-auto w-full h-[100vh] bg-gray-100">

         </div>
    </div>

</x-app-layout>
