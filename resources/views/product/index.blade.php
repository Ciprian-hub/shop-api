<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-5">
        @foreach($products as $product)
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                <a href="{{route('product.view', $product->slug)}}" class="block aspect-w-3 aspect-h-2">
                    <img class="rounded object-contain" src="{{$product['image']}}" alt=""/>
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$product['title']}}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700">{{$product['price']}}</p>

                    <a href="#"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-center bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Read more
                        <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
