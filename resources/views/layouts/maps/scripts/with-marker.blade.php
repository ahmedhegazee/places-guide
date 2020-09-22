<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_TOKEN') }}&callback=initMap&libraries=&v=weekly"
    defer>
</script>
<script>
    let map;
    document.onload = function () {
        initMap();
    }

    function initMap() {
        let long = document.getElementById('long');
        let lat = document.getElementById('lat');
        // console.log(long);
        if (long != null && lat != null) {
            lat = parseFloat(lat.value);
            long = parseFloat(long.value);
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: lat,
                    lng: long
                },
                zoom: 18
            });
            var marker = new google.maps.Marker({
                position: {
                    lat: lat,
                    lng: long
                },
                map: map
            });
        }
    }
</script>
