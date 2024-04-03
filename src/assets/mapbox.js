window.mapboxgl = require('mapbox-gl');

window.BiopamaWDPA = {
    base_layer: 'mapbox://styles/jamesdavy/cjw25laqe0y311dqulwkvnfoc',

    addWdpaLayer: function(map, wdpa_ids, color = null) {

        // Add source: JRC geoserver
        map.addSource("geospatial_jrc", {
            type: 'vector',
            tiles: [
                'https://geospatial.jrc.ec.europa.eu/geoserver/gwc/service/wmts?layer=marxan:wdpa_latest_biopama&tilematrixset=EPSG:900913&Service=WMTS&Request=GetTile&Version=1.0.0&Format=application/x-protobuf;type=mapbox-vector&TileMatrix=EPSG:900913:{z}&TILECOL={x}&TILEROW={y}'
            ],
            'tileSize': 512,
            'scheme': 'xyz',
        });

        color = color || [
            "match",
            ["get", "marine"],
            ["0"],
            "rgba(141, 191, 79, 0.7)",
            "rgba(104, 156, 150, 0.7)"
        ];

        // Add layer: wdpa_latest_biopama
        map.addLayer({
            "id": "biopama_wdpa",
            "type": "fill",
            "source": "geospatial_jrc",
            "source-layer": 'wdpa_latest_biopama',
            "minzoom": 2,
            "paint": {
                "fill-color": color
            }
        });

        wdpa_ids = wdpa_ids
            .split(',')
            .map(function(item){
                return parseInt(item)
            });
        map.setFilter("biopama_wdpa", ['in', 'wdpaid'].concat(wdpa_ids));
    }

};