@if(!empty(session('error')))
    <div class="alert alert-danger">
        {{ session('error.message') }}
    </div>
@endif

@if(!empty(session('success')))
    <div class="alert alert-success">
        {{ session('success.message') }}
    </div>
@endif

@if(!empty(session('warning')))
    <div class="alert alert-warning">
        {{ session('warning.message') }}
    </div>
@endif

<script>
    // Get all elements with the 'alert' class
    var alerts = document.getElementsByClassName('alert');

    // Loop through each element and hide it after the specified duration
    for (var i = 0; i < alerts.length; i++) {
        setTimeout(function(element) {
            element.style.opacity = '0';
            element.style.display = 'none';
        }, {{ session('success.duration') }}, alerts[i]);
    }
</script>
