@if (Session::has('notifications'))
    <script>
        toastr.options = {timeOut: "2500"};
        const notifications = @json(Session::get('notifications'));
        notifications.forEach(notification => {
            const alertType = notification['type'] ?? 'info';
            toastr[alertType](notification['message']);
        });
    </script>
@endif
