var ContactUs = function () {

    return {
        //main function to initiate the module
        init: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#map',
	            lat: -7.286022,
				lng: 112.800701,
			  });
			   var marker = map.addMarker({
		            lat: -7.286022,
					lng: 112.800701,
		            title: 'Indojerman, Org.',
		            infoWindow: {
		                content: "<b>Indojerman, Org.</b> Jln. Kejawan Gebang <br>Sukolilo, 60111"
		            }
		        });

			   marker.infoWindow.open(map, marker);
			});
        }
    };

}();