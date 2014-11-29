ja-geocode
==========

A simple spark for CodeIgniter that does Googlemaps geocoding.

Usage:
------

`$this->load->spark('ja-geocode/1.x'); // Use the latest version
$this->ja_geocode->query('Hagebygatan 25B, Norrköping');

$lat = $this->ja_geocode->lat;
$lng = $this->ja_geocode->lng;

(see full list of accessible properties in the class source)

