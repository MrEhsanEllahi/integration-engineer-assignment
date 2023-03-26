<script>
    let table;
    $(document).ready(function () {
        table = $('#subscribers').DataTable({
            serverSide: false,
            processing: true,
            paging: false,
            ajax: null,
            columns: [{
                    data: 'name',
                    searchable: false
                },
                {
                    data: 'email',
                    searchable: true,
                    render: function (data, type, full, row) {
                        return '<a href="' + "{{ route('subscribers.edit', ['ID_PLACEHOLDER']) }}".replace('ID_PLACEHOLDER', full.id) + '">' + data + '</a>';
                    }
                },
                {
                    data: 'country',
                    searchable: false
                },
                {
                    data: 'subscribed_date',
                    searchable: false
                },
                {
                    data: 'subscribed_time',
                    searchable: false
                },
                {
                    data: null,
                    searchable: false,
                    render: function (data, type, full, row) {
                        return `<a href="{{ route('subscribers.edit', ['ID_PLACEHOLDER']) }}"><i class="fas fa-edit mr-2 text-primary"></i></a>
                                <i class="fas fa-trash-alt text-danger remove-subscriber" data-id="${full.id}" style="cursor:pointer"></i>`
                            .replace('ID_PLACEHOLDER', full.id);
                    }
                },
            ],
        });
    });

    let currentCursor = null;
    let prevCursor = null;
    let limit = 10;

    function fetchData(requestedCursor) {
        // Show the loader
        $('#loader').show();
        $.ajax({
            url: '{{ route('subscribers.list') }}',
            type: 'GET',
            data: {
                cursor: requestedCursor,
                limit: limit
            },
            success: function (data) {
                prevCursor = data.prevCursor;
                currentCursor = data.nextCursor;
                $('#subscribers').DataTable().clear().rows.add(data.data).draw();

                // Enable or disable buttons based on cursor values
                $('#prevPage').prop('disabled', !prevCursor);
                $('#nextPage').prop('disabled', !currentCursor);
            },
            complete: function () {
                // Hide the loader
                $('#loader').hide();
            }
        });
    }

    // Fetch the initial data
    fetchData(null);

    // Add click event handlers for Next and Previous buttons
    $('#nextPage').on('click', function () {
        fetchData(currentCursor);
    });

    $('#prevPage').on('click', function () {
        fetchData(prevCursor);
    });

    // Add a change event handler for the limit dropdown
    $('#limit').on('change', function () {
        limit = parseInt($(this).val());
        fetchData(null); // Fetch data with the new limit, resetting the cursor
    });

    $('#subscribers tbody').on('click', '.remove-subscriber', function () {
        const row = table.row($(this).closest('tr'));
        const subscriberId = $(this).data('id');

        // Show the loader
        $('#loader').show();

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{ route('subscribers.remove') }}',
            type: 'POST',
            data: {
                subscriber_id: subscriberId
            },
            success: function (response) {
                if (response.success) {
                    // Remove the row from the DataTable
                    row.remove().draw();
                    toastr.success('Subscriber removed successfully');
                } else {
                    toastr.error('Failed to remove subscriber:' + response.message);
                }
            },
            error: function (errorThrown) {
                toastr.error('Failed to remove subscriber:' + errorThrown);
            },
            complete: function () {
                // Hide the loader
                $('#loader').hide();
            }
        });
    });

</script>
