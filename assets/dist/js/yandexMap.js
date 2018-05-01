ymaps.ready(function () {
    ymaps.geolocation.get({
        provider: 'yandex',
        autoReverseGeocode: true
    }).then(function (result) {
        var metaDataProperty = result.geoObjects.get(0).properties.get('metaDataProperty');
        var country = metaDataProperty.GeocoderMetaData.AddressDetails.Country.CountryName;
        var city = metaDataProperty.GeocoderMetaData.AddressDetails.Country.AddressLine;
        $('#country').val(country);
        $('#city').val(city);
    });
});
