@if(Session::has('status'))
    <div class="alert alert-primary py-2" role="alert" id="status-alert">
        {{Session::get('status')}}
    </div>
@endif

{{-- Custom JavaScript Code --}}
@section('javascript')
    @parent

    {{-- Hide Status Message --}}
    <script>
        $(document).ready(function(){
            $('#status-alert').delay(2000).fadeOut(2500);
        });
    </script>
    
@endsection