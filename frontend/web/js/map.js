ymaps.ready(init);

function init() {
    var myMap = new ymaps.Map("map", {
        center: [53.731865, 91.434734],
        zoom: 16
    }, {
        searchControlProvider: 'yandex#search'
    });

    myMap.geoObjects
        .add(new ymaps.Placemark([53.731865, 91.434734], {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        }));
}