<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Location</title>
</head>
<body>
<h1>Search Location</h1>
<input type="text" id="search" placeholder="Nhập tên địa điểm">
<button onclick="searchLocation()">Tìm kiếm</button>

<ul id="results"></ul>

<script>
    function searchLocation() {
        let query = document.getElementById('search').value;
        fetch(`/search-location?q=${query}`)
            .then(response => response.json())
            .then(data => {
                let resultsList = document.getElementById('results');
                resultsList.innerHTML = '';

                if (data.geonames) {
                    data.geonames.forEach(location => {
                        let li = document.createElement('li');
                        li.textContent = `${location.name}, ${location.countryName} (Lat: ${location.lat}, Lng: ${location.lng})`;
                        resultsList.appendChild(li);
                    });
                } else {
                    resultsList.innerHTML = '<li>Không có kết quả.</li>';
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
</body>
</html>
