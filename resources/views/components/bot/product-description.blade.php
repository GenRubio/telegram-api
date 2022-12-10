<b>PRODUCTO</b>
Referencia: <b>{{ $product->reference }}</b>
Modelo: <b>{{ $product->name }}</b>
Sabores:
@foreach ($product->tastes as $taste)
   • <b>{{ $taste->name }}</b> ({{ $taste->stock }})
@endforeach
Precio: <b>{{ $product->price }}€</b>

<b>DESCRIPCION</b>
- Size: <b>{{ $product->description->size }}</b>
- Resistance: <b>{{ $product->description->resistance }}</b>
- Power Range: <b>{{ $product->description->power }}</b>
- E-liquid Capacity: <b>{{ $product->description->e_liquid }}</b>
- Battery Capacity: <b>{{ $product->description->battery }}</b>
- Charging port: <b>{{ $product->description->charging }}</b>
- Puffs: <b>{{ $product->description->puffs }} puffs</b>