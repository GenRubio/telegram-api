Referencia: <b>{{ $product->reference }}</b>
Modelo: <b>{{ $product->name }}</b>
Sabores: 
@foreach ($product->productModelsFlavors as $flavor)
   • <b>{{ $flavor->name }}</b> ({{ $flavor->stock }})
@endforeach
Precio: <b>{{ $product->price_getter }}</b>
