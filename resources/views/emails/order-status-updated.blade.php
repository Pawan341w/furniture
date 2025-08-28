@component('mail::message')
# Hello {{ $order->user->name }}

Your order **{{ $order->order_number }}** status has been updated.

**Current Status:** {{ ucfirst($order->order_status) }}

@component('mail::button', ['url' => config('app.url') . '/orders/' . $order->id])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
