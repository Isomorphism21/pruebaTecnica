<form id="formCrearContribuyente" action="{{ url('/contribuyentes')}}" method="post">
    @csrf
    @include('contribuyente.form')
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/contribuyente/contribuyenteHelper.js') }}"></script>
<script src="{{ asset('js/contribuyente/contribuyenteFormCreate.js') }}"></script>