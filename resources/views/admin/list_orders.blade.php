@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Orders">
        <div class="container">
            <div class="header">
                <h1>Orders</h1>
                <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
            </div>

            @include('partials.messages')

            <div class="body">
                <table>
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Names</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Shipping</th>
                            <th>Amount (Ksh)</th>
                            <th>Status</th>
                            <th>Paid</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
@include('partials.javascripts')
<script>
    $(document).ready(function () {
        // Function to update the table content
        function updateTable() {
            // Make an AJAX request to fetch the updated table content
            $.ajax({
                type: 'GET',
                url: '{{ route("list_orders_table") }}',
                success: function (data) {
                    // Replace the content of the table body with the updated data
                    $('.body table tbody').html(data);
                },
                error: function () {
                    console.error('Error updating table content.');
                }
            });
        }

        // Set the interval for updating the table (every 10 seconds in this example)
        const updateInterval = 2 * 1000; // 10 seconds in milliseconds

        // Schedule the table update at the specified interval
        setInterval(updateTable, updateInterval);
    });
</script>
@endsection
