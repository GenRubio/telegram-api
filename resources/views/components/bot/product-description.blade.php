<b>PRODUCTO</b>
@include('components.bot.product-item')

<b>DESCRIPCION</b>
@if (!empty($product->size))
- Medida: <b>{{ $product->size }}</b>
@endif
@if (!empty($product->power_range))
- Rango de poder: <b>{{ $product->power_range_getter }}</b>
@endif
@if (!empty($product->input_voltage))
- Voltaje de entrada: <b>{{ $product->input_voltage_getter }}</b>
@endif
@if (!empty($product->battery_capacity))
- Capacidad de la batería: <b>{{ $product->battery_capacity_getter }}</b>
@endif
@if (!empty($product->e_liquid_capacity))
- Capacidad E Liquid: <b>{{ $product->e_liquid_capacity_getter }}</b>
@endif
@if (!empty($product->concentration))
- Concentración nicotina: <b>{{ $product->concentration_getter }}</b>
@endif
@if (!empty($product->resistance))
- Resistencia: <b>{{ $product->resistance_getter }}</b>
@endif
@if (!empty($product->absorbable_quantity))
- Cantidad de caladas: <b>{{ $product->absorbable_quantity_getter }}</b>
@endif
@if (!empty($product->charging_port))
- Tipo de puerto de carga: <b>{{ $product->charging_port }}</b>
@endif
<b>Imagen</b>: 
{{ url($product->image) }}