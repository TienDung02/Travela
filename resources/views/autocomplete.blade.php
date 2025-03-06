<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Autocomplete</title>

    <!-- Add Bootstrap CSS for styling (optional) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Autocomplete Address</h2>
    <div class="form-group">
        <label for="autocomplete">Address</label>
        <input type="text" id="autocomplete" class="form-control" placeholder="Enter your address">
    </div>
</div>
<form method="POST" action="{{ route('storeAddress') }}">
    @csrf
    <input type="hidden" id="latitude" name="latitude">
    <input type="hidden" id="longitude" name="longitude">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<!-- Google Places API -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_API_KEY&libraries=places"></script>

<script>
    function initialize() {
        var input = document.getElementById('autocomplete');
        var options = {
            types: ['geocode'], // Restrict results to addresses
        };
        var autocomplete = new google.maps.places.Autocomplete(input, options);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>

</body>
</html>
