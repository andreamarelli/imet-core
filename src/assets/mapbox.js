window.mapboxgl = require('mapbox-gl');

window.BiopamaWDPA = {
    base_layer: 'mapbox://styles/jamesdavy/cjw25laqe0y311dqulwkvnfoc',

    addWdpaLayer: function(map, wdpa_ids) {
        map.addSource("geospatial_jrc", {
            type: 'vector',
            tiles: [
                'https://geospatial.jrc.ec.europa.eu/geoserver/gwc/service/wmts?layer=marxan:wdpa_latest_biopama&tilematrixset=EPSG:900913&Service=WMTS&Request=GetTile&Version=1.0.0&Format=application/x-protobuf;type=mapbox-vector&TileMatrix=EPSG:900913:{z}&TILECOL={x}&TILEROW={y}'
            ],
            'tileSize': 512,
            'scheme': 'xyz',
        });

        map.addLayer({
            "id": "biopama_wdpa",
            "type": "fill",
            "source": "geospatial_jrc",
            "source-layer": 'wdpa_latest_biopama',
            "minzoom": 2,
            "paint": {
                "fill-color": [
                    "match",
                    ["get", "marine"],
                    ["0"],
                    "hsla(87, 47%, 53%, 0.7)",
                    "hsla(173, 21%, 51%, 0.7)"
                ],
            }
        });

        wdpa_ids = wdpa_ids.split(',');
        map.setFilter("biopama_wdpa", ['in', 'wdpaid', ...wdpa_ids]);
    }

};