@component('mail::message')
# New Inquery

Name - {{ $data['name'] }}
<br>
Email - {{ $data['email'] }}
<br>
Contact Number - {{ $data['contact_number'] }}
<br>
Questions - {{ $data['questions'] }}

@component('mail::button', ['url' => route('home.product.show',$product['id'])])
Visit Product
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
