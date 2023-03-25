<script>
    $(document).ready(function () {
        $('#subscribers').DataTable({
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
                    searchable: true
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
                        return `<a href="{{ route('subscribers.edit', ['ID_PLACEHOLDER']) }}"><i class="fas fa-edit mr-2 text-primary"></i></a>`
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

</script>
