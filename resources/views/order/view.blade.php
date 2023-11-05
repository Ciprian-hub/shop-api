<x-app-layout>

    <div class="container mx-auto lg:w-2/3 p-5">
        <h1 class="text-3xl font-bold mb-2">Order #{{$order->id}}</h1>
        <div class="bg-white rounded-lg p-3">
            <table>
                <tbody>
                <tr>
                    <td class="font-bold py-1 px-2">Order #</td>
                    <td>{{$order->id}}</td>
                </tr>
                <tr>
                    <td class="font-bold py-1 px-2">Order Date</td>
                    <td>{{$order->created_at}}</td>
                </tr>
                <tr>
                    <td class="font-bold py-1 px-2">Order Status</td>
                    <td>
                        <span
                            class="text-white py-1 px-2 rounded {{$order->isPaid() ? 'bg-emerald-500' : 'bg-gray-400'}}">
                            {{$order->status}}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="font-bold py-1 px-2">SubTotal</td>
                    <td>${{ $order->total_price }}</td>
                </tr>
                </tbody>
            </table>
            @foreach ($order['items'] as $item)
                <div class="flex flex-col sm:flex-row items-center mb-5">
                    <img src=" {{$item['product']['image']}}" class="w-28 mr-3" alt="">
                    <div class="flex flex-col justify-between">
                        <div class="flex justify-between mb-3">
                            <h3 class="overflow-ellipsis">
                                {{$item['product']['title']}}
                            </h3>
                            <span class="text-lg">
                               ${{$item['product']['price']}}
                            </span>
                        </div>
                        <div>
                           Quantity: {{$item['quantity']}}
                        </div>
                    </div>
                </div>
                <hr class="my-5"/>
            @endforeach

        </div>
    </div>
</x-app-layout>
