<!DOCTYPE html>
<html>
<body>
<div id="map" style="width:100%;height:480px;"></div>
<script>
    function initMap() {
        let options = {
            center: {lat: 16.072163491469226, lng: 108.22690536081757},
            zoom: 10,
            // controls: true,
            mapType: "satellite"
        }
        let map = new map4d.Map(document.getElementById("map"), options)
    }
</script>
<script src="https://api.map4d.vn/sdk/map/js?version=2.6&key=320fdc09342c67c6879c20e64e1475c0&mapId=680393095d65bdb7b81fdcaf&callback=initMap"></script>
</body>
</html>
