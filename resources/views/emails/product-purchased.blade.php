@component('mail::message')
# Purchase successful

Hello {{ $purchase->user->name }},
Your purchase of {{ $purchase->product->name }} was successful.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
