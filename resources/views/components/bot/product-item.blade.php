Referencia: <b>{{ $product->reference }}</b>
Modelo: <b>{{ $product->name }}</b>
Sabores: 
@foreach ($product->tastes as $taste)
   • <b>{{ $taste->name }}</b> ({{ $taste->stock }})
@endforeach
Precio: <b>{{ $product->price }}€</b>
