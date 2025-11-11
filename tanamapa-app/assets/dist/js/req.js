function getBlynk(token) {
	$.ajax({
		url: "https://blynk.cloud/external/api/isHardwareConnected",
		data: {
			token: token
		},
		type: 'get',
		dataType: 'json',
		success: function (data) {
			if (data) {
				$("#statusInd").removeClass("text-danger").addClass("text-success");
				$("#status").val(" Online");
				$('#resource').removeAttr('hidden');
				$('#readyForSelection').removeAttr('hidden');
			} else {
				$("#statusInd").removeClass("text-success").addClass("text-danger");
				$("#status").val(" Offline");
				$('#resource').attr("hidden", 1);
				$('#readyForSelection').attr("hidden", 1);
			}
		}
	});

	// Get ADC val
	$.ajax({
		url: "https://blynk.cloud/external/api/get?token=" + token + "&v0",
		type: 'get',
		dataType: 'json',
		success: function (data) {
			// var ph = (-0.0693 * data) + 7.3855;
			var ph = (-0.0279 * data) + 7.7761;
			$('#ph').val(parseFloat(ph).toFixed(2));
		}
	});

	// // Get pH val
	// $.ajax({
	// 	url: "https://blynk.cloud/external/api/get?token=" + token + "&v1",
	// 	type: 'get',
	// 	dataType: 'json',
	// 	success: function (data) {
	// 		$('#ph').val(parseFloat(data));
	// 	}
	// });

	// Get Humidity Value
	$.ajax({
		url: "https://blynk.cloud/external/api/get?token=" + token + "&v2",
		type: 'get',
		dataType: 'json',
		success: function (data) {
			$('#humidity').val(data);
		}
	});
};

// Geolokasi HTML5
function getLocation(token) {
	getBlynk(token);
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(getAltitude);
	} else {
		$("#location").html("Geolocation is not supported by this browser.");
	}
};

function getAltitude(position) {

	const lat = position.coords.latitude;
	const lon = position.coords.longitude;
	const alt = position.coords.altitude;

	$("#lat").val(lat);
	$("#lon").val(lon);

	$.ajax({
		url: "https://api.open-elevation.com/api/v1/lookup?locations=" + lat + "," + lon,
		type: 'get',
		dataType: 'json',
		success: function (data) {
			$("#ele").val(data['results'][0]['elevation']);
			var ele = data['results'][0]['elevation'];
			getAddress(lat, lon, ele);
			getMaps(lat, lon);
		}
	});
};

function getAddress(lat, lon, ele) {
	$.ajax({
		url: "https://api.mapbox.com/geocoding/v5/mapbox.places/" + lon + "," + lat + ".json?",
		type: 'get',
		dataType: 'json',
		data: {
			access_token: 'pk.eyJ1Ijoicml5YW5odXNlbiIsImEiOiJjbDN3bzJ2cW4yaXJqM2Jyc2syaW5rNzVsIn0.GAQMIsu2qtkuWnvZXEnxhA',
		},
		success: function (data) {
			var result = data['features'][0]['context'];
			var place_name = data['features'][0]['place_name'];
			var place;
			for (var i = 0; i < result.length; i++) {
				if (result[i]['id'].split(".", 1) == "place") {
					place = result[i]['text'];
				}
			}
			$.ajax({
				url: "getdataloc",
				type: 'post',
				data: {
					place: place,
					ele: ele,
				},
				success: function (results) {
					if (results['status'] != 500 || results['readyState'] != 4) {
						const averageTemp = results['data']['region'][0]['tempByEle'];
						const rainfall = results['data']['region'][0]['rainfall'];

						$("#average_temp").val(averageTemp.toFixed(2));
						$("#rainfall").val(parseFloat(rainfall));
					}
				},
				error: function (results) {
					$('#incompletedata').removeAttr("hidden");
					$('#readyForSelection').attr("hidden", 1).attr("disabled", 1);
					$("#average_temp").val("Data tidak tersedia");
					$("#rainfall").val("Data tidak tersedia");
				}
			});

			$("#place").val(place);
			$("#place_name").html(place_name);
		},
	});
};

function getMaps(lat, lon) {
	const latLng = [lon, lat];

	mapboxgl.accessToken = 'pk.eyJ1Ijoicml5YW5odXNlbiIsImEiOiJjbDN3bzJ2cW4yaXJqM2Jyc2syaW5rNzVsIn0.GAQMIsu2qtkuWnvZXEnxhA';
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v11',
		center: latLng,
		zoom: 13,
		interactive: false
	});

	const marker1 = new mapboxgl.Marker()
		.setLngLat(latLng)
		.addTo(map);
}

function randomId(n) {
	for (var r = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"],
			e = n, t = new Array, a = 0; a <= e - 1; a++) {
		t[a] = r[parseInt(Math.random() * r.length)];
		t = t;
		randomtextnumber = t.join("")
	}
}

function getChart(arr) {
	var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
	var donutData = {
		labels: [
			'Tidak Direkomendasikan',
			'Sangat Tidak Sesuai',
			'Tidak Sesuai',
			'Cukup Sesuai',
			'Sesuai',
			'Rekomendasi',
		],
		datasets: [{
			data: arr,
			backgroundColor: ['#d2d6de', '#f56954', '#f39c12', '#00a65a', '#00c0ef', '#3c8dbc'],
		}]
	}
	var donutOptions = {
		maintainAspectRatio: false,
		responsive: true,
	}
	//Create pie or douhnut chart
	// You can switch between pie and douhnut using the method below.
	new Chart(donutChartCanvas, {
		type: 'doughnut',
		data: donutData,
		options: donutOptions
	})
}
