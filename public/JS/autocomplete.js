var searchInput = 'venueAddress';

$(document).ready(function () {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
    });
	
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        document.getElementById('venue_loc_lat').value = near_place.geometry.location.lat();
        document.getElementById('venue_loc_long').value = near_place.geometry.location.lng();
    });
});