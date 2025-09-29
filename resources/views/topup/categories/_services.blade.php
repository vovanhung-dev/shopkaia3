@foreach($services as $service)
<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <a href="{{ route('topup.show', $service->slug) }}" class="block">
        <div class="relative">
            <img src="{{ $service->thumbnail ? asset('storage/'.$service->thumbnail) : asset('images/default-thumbnail.jpg') }}" alt="{{ $service->name }}" class="w-full h-48 object-cover">
            @if($service->hasDiscount())
            <div class="absolute top-0 left-0 bg-red-600 text-white text-sm font-bold px-3 py-1 m-2 rounded-md">
                -{{ $service->getDiscountPercentage() }}%
            </div>
            @endif
        </div>
        <div class="p-4">
            <h3 class="text-base font-bold text-gray-900 mb-2 text-center">{{ $service->name }}</h3>
            
            <div class="flex justify-between items-center mt-4">
                <div>
                    @if($service->hasDiscount())
                    <span class="text-gray-500 line-through text-sm">{{ number_format($service->price) }}đ</span>
                    <span class="text-red-600 font-bold">{{ number_format($service->getDisplayPrice()) }}đ</span>
                    @else
                    <span class="text-red-600 font-bold">{{ number_format($service->price) }}đ</span>
                    @endif
                </div>
                <span class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm">
                    Xem chi tiết
                </span>
            </div>
        </div>
    </a>
</div>
@endforeach 