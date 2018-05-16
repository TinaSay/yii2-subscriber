ymaps.ready(function () {
    ymaps.geolocation.get({
        provider: "yandex",
        autoReverseGeocode: true
    }).then(function (result) {
        var metaDataProperty = result.geoObjects.get(0).properties.get("metaDataProperty");
        var country = metaDataProperty.GeocoderMetaData.AddressDetails.Country.CountryName;
        var city = metaDataProperty.GeocoderMetaData.AddressDetails.Country.AddressLine;
        var longitude = metaDataProperty.GeocoderMetaData.InternalToponymInfo.Point.coordinates[0];
        var latitude = metaDataProperty.GeocoderMetaData.InternalToponymInfo.Point.coordinates[1];
        var coords = latitude + "," + longitude;

        $(".country-yandex").val(country);
        $(".city-yandex").val(city);
        $(".coordinates-yandex").val(coords + ",5");
    });
});