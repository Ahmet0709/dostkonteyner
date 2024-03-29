<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensör Verileri</title>
    <style>
        .map-container {
            height: 400px;
            margin-top: 20px;
        }

        .custom-container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 50px;
        }

        .progress-wrapper {
            border-radius: 15px;
            background-color: #ffffff00;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .progress {
            height: 30px;
            background-color: #00000000
        }

        .progress-bar {
            transition: width 0.5s ease-in-out;
            height: 30px;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .bg-success.progress-bar {
            box-shadow: 0 0 20px rgba(40, 167, 69, 0.5);
        }

        .bg-warning.progress-bar {
            box-shadow: 0 0 20px rgba(255, 193, 7, 0.5);
        }

        .bg-danger.progress-bar {
            box-shadow: 0 0 20px rgba(220, 53, 69, 0.5);
        }

        .progress-bar-wrapper {
            border-radius: 15px;
        }

        .sensor-value {
            color: #FF0000;
        }

        .sensor-icon {
            border-radius: 50%;
            background-color: #FF0000;
            color: #FFF;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            display: inline-block;
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <div class="container custom-container">
        <h1 class="text-center">Sensör Verileri</h1>

        <div id="map" class="map-container"></div>

        <form action="{{ route('sensor-verileri') }}" method="GET">
            <div class="mb-3">
                <label for="cop_konteyneri_id" class="form-label">Çöp Konteyneri Seçin:</label>
                <select name="cop_konteyneri_id" id="cop_konteyneri_id" class="form-select">
                    @foreach ($cop_konteynerleri as $konteyner)
                        <option value="{{ $konteyner->id }}">{{ $konteyner->id }} - {{ $konteyner->konteyner_adi }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Göster</button>
        </form>

        <div id="sensorData"></div>

    </div>

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 37.92511770952708,
                    lng: 32.50767304474799
                },
                zoom: 15
            });

            var trashContainerLocations = [
                @foreach ($cop_konteynerleri as $konteyner)
                    {
                        id: {{ $konteyner->id }},
                        lat: {{ $konteyner->latitude }},
                        lng: {{ $konteyner->longitude }}
                    },
                @endforeach
            ];

            trashContainerLocations.forEach(function(location) {
                var markerColor;
                if (location.doluluk_orani >= 75) {
                    markerColor = 'red'; 
                } else if (location.doluluk_orani >= 50) {
                    markerColor = 'yellow'; 
                } else {
                    markerColor = 'green'; 
                }

                var marker = new google.maps.Marker({
                    position: {
                        lat: location.lat,
                        lng: location.lng
                    },
                    map: map,
                    title: "Çöp Konteyneri " + location.id,
                    icon: {
                        url: 'http://maps.google.com/mapfiles/ms/icons/' + markerColor +'-dot.png' 
                    }
                });

                marker.addListener('click', function() {
                    getSensorData(location.id);
                });
            });
        }


        function getSensorData(containerId) {
            fetch('/get-sensor-data?cop_konteyneri_id=' + containerId)
                .then(function(response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(function(data) {
                    console.log(data); 

                    var sensorDataHTML = '<h3>Sensör Verileri</h3>';
                    sensorDataHTML += '<p>Çöp Konteyneri ID: ' + data.container_id + '</p>';
                    sensorDataHTML += '<p>Doluluk Oranı: ' + data.doluluk_orani + '%</p>';
                    sensorDataHTML += '<p>Sıcaklık: ' + data.sicaklik + '°C</p>';
                    sensorDataHTML += '<p>Nem: ' + data.nem + '%</p>';
                    sensorDataHTML += '<p>Hava Kalitesi: ' + data.hava_kalitesi + '</p>';

                    document.getElementById("sensorData").innerHTML = sensorDataHTML;
                })
                .catch(function(error) {
                    console.error('Hata:', error);
                });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy7BoZBLdcGPHrnap4F4hqXyVVZmeQqhU&callback=initMap" async
        defer></script>

</body>

</html>
