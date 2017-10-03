ymaps.ready(function () {
    var ROUTE_SOUTH = [
        [55.581454096883384, 37.596119427255694],
        [55.5805690003119, 37.595785216576566],
        [55.580433728250476, 37.595226981825355],
        [55.579844204387854, 37.5949480320878],
        [55.57974088485717, 37.59485147256325],
        [55.578400745027444, 37.59427747983407],
        [55.57808469628697, 37.59334943551492],
        [55.57754376078325, 37.591718652433876],
        [55.5775012149767, 37.59124658364725],
        [55.57740092824953, 37.590940811819536],
        [55.57738877226511, 37.59062967557383],
        [55.57759542348607, 37.59030781049204],
        [55.57770629863349, 37.58960473645399],
        [55.57764551914836, 37.58941161740494],
        [55.577840013168135, 37.589465261585225],
        [55.578040584112635, 37.58858549702834],
        [55.578320166136606, 37.58839237797926],
        [55.578429567253906, 37.587931038028714],
        [55.578727, 37.587982]
    ];
    
    var ROUTE_NORTH = [
        [55.855994882327565, 37.65424609550088],
        [55.85576556644623, 37.65497565635295],
        [55.85670695982277, 37.6555979288444],
        [55.85717764792192, 37.65703559287639],
        [55.85700868362208, 37.65860200294109],
        [55.85756384926507, 37.66098380454631],
        [55.85747936805065, 37.66325831779093],
        [55.857766, 37.663261],
    ];
    
    var POINTS = [{
            elementId: 'southMap',
            coords: [55.578727,37.587982],
            center: [55.578400745027444, 37.59427747983407],
            title: 'г.Москва, МКАД 33-й км., вл.6, стр.5, 2 этаж.',
            route: ROUTE_SOUTH,
            zoom: 15
        } , {
            elementId: 'northMap',
            coords: [55.857766, 37.663261],
            center: [55.85700868362208, 37.65860200294109],
            title: 'г. Москва, ул. Верхоянская, дом 18, корпус 2, помещение № 1',
            route: ROUTE_NORTH,
            zoom: 16
        }                
    ];                   
          
    for (var i = 0; i < POINTS.length; i++){   
        var point = POINTS[i];
        var map = new ymaps.Map(point.elementId, {
            center: point.center,
            zoom: point.zoom,
            controls: ['zoomControl']
        });
                            
        addRouteToMap(map, point);
        addPointToMap(map, point);        
    }   
                         
    function addPointToMap(map, point){
        map.geoObjects.add(new ymaps.Placemark(point.coords, {
            iconContent: 'makita-vsem.ru',
            hintContent: point.title
        }, {
            iconLayout: 'default#image',
            iconImageHref: '/wp-content/themes/storefront/images/placemark.png',
            iconImageSize: [16, 16],
            iconImageOffset: [-8, -8]
        }));                
    }
    
    function addRouteToMap(map, point){
        if (!point.route){
            return;
        }
        
        map.geoObjects.add(new ymaps.Placemark(point.route[0], {}, {
            iconLayout: 'default#image',
            iconImageHref: '/wp-content/themes/storefront/images/metro.png',
            iconImageSize: [20, 20],
            iconImageOffset: [-10, -10]
        }));

        var routePolyline = new ymaps.Polyline(point.route, {}, {
            strokeColor: "#ff0000", // Ширину линии.
            strokeWidth: 2
        });

        // Добавляем линию на карту.
        map.geoObjects.add(routePolyline);
    }

   function edit(map){
        var ROUTE = [];

        var test = new ymaps.Polyline(
        [[55.857766, 37.663261]]
        , {}, {
            // Задаем опции геообъекта.
            // Цвет с прозрачностью.
            strokeColor: "#00000088",
            // Ширину линии.
            strokeWidth: 4,
            // Добавляем в контекстное меню новый пункт, позволяющий удалить ломаную.
            editorMenuManager: function (items) {
                items.push({
                    title: "test",
                    onClick: function () {
                        console.log(test);
                    }
                });
                return items;
            }
        });
        
        map.geoObjects.add(test);
        test.editor.startEditing();
   }
});