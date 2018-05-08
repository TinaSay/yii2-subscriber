ymaps.ready(function () {
    ymaps.geolocation.get({
        provider: "yandex",
        autoReverseGeocode: true,
        mapStateAutoApply: true
    }).then(function (result) {
        var metaDataProperty = result.geoObjects.get(0).properties.get("metaDataProperty");
        var country = metaDataProperty.GeocoderMetaData.AddressDetails.Country.CountryName;
        var city = metaDataProperty.GeocoderMetaData.AddressDetails.Country.AddressLine;
        var coords = metaDataProperty.GeocoderMetaData.InternalToponymInfo.Point.coordinates;

        $(".country-yandex").val(country);
        $(".city-yandex").val(city);
        $(".coordinates-yandex").val(coords);
    });
});