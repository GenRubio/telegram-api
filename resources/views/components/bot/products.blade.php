<b>PRODUCTOS</b>

@foreach ($data->products as $product)
    @include('components.bot.product-item', ['product' => $product])
    {{ "\n" }}
@endforeach


