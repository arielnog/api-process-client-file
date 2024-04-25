@component('emails.layout')
    @slot('header')
    @endslot
    Olá,<br><br> Segue o boleto para o pagamento.<br><br>

    @slot('footer')
        @component('emails.footer')
            © {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
        @endcomponent
    @endslot
@endcomponent
