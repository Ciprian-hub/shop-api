<x-app-layout>
    <h1 class="m-16">My orders</h1>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg m-16">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Order #
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    SubTotal
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="bg-white border-b text-gray-900">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        #{{$order['id']}}
                    </th>
                    <td class="px-6 py-4">
                        {{$order['created_at']}}
                    </td>
                    <td class="px-6 py-4">
                        {{$order['status']}}
                    </td>
                    <td class="px-6 py-4">
                        {{$order['total_price']}}
                    </td>
                    <td class="px-6 py-4">
                        @if(!$order->isPaid())
                            <form action="{{route('cart.checkout-order', $order)}}" method="post"
                               class="font-medium text-blue-600 dark:text-blue-500">
                                @csrf
                                <button type="submit">Pay</button>
                            </form>
                        @else
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Invoice</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
