@if(Session::has('message'))
    <script>
        toastr.options = {
            timeOut: "2500"
        };
        var type = "{{ Session::get('alert-type', 'info') }}";
        toastr[type]("{{ Session::get('message') }}");

    </script>
@endif
