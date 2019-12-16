<div id="mapid">
<script>
    function getStartingCoords(properties) {
        var latitude = 0;
        var longitude = 0;
        for (i = 0; i < properties.length; i++) {
            latitude += parseFloat(properties[i]['latitude']);
            longitude += parseFloat(properties[i]['longitude']);
        }
        latitude = latitude/properties.length;
        longitude = longitude/properties.length;
        return [latitude, longitude];
    }
    let properties = <?php echo json_encode($properties); ?> ;
    var initial_coords = getStartingCoords(properties); 
    var mymap = L.map('mapid').setView([initial_coords[0], initial_coords[1]], 5);

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	}).addTo(mymap);

    for (i = 0; i < properties.length; i++) {
            L.marker([properties[i]['latitude'], properties[i]['longitude']]).addTo(mymap);
        }

	var popup = L.popup();

	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent("You clicked the map at " + e.latlng.toString())
			.openOn(mymap);
	}

	mymap.on('click', onMapClick);

</script>
</div>
