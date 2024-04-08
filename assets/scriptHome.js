// Get the user's timezone
var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
function createMasonry(data) {
    document.querySelector(".image-gallery").innerHTML = ''
    data._embedded.events.forEach(event => {
        imageCard = document.createElement("a");
        imageCard.setAttribute("class", "image-card")
        imageCard.setAttribute("id", event.id)
        imageCard.setAttribute("href", "event.php?id=" + event.id)
        image = document.createElement("img");
        image.setAttribute("loading", "lazy")
        image.setAttribute("src", event.images[event.images.length - 1].url)
        description = document.createElement("div")
        description.setAttribute("class", "image-description")
        nameWrapper = document.createElement("div")
        nameWrapper.setAttribute("class", "image-name")
        p = document.createElement("p")
        p.innerText = event.name
        venue = document.createElement("div")
        venue.setAttribute("class", "image-venue")
        span = document.createElement("span")
        span.innerText = event._embedded.venues[0].name
        imageCard.append(image)
        imageCard.append(description)
        nameWrapper.append(p)
        description.append(nameWrapper)
        venue.append(span)
        description.append(venue)
        document.querySelector(".image-gallery").append(imageCard)
    });
}
function createAddress(data, size) {
    data = data.address
    if (size > 5) {
        document.querySelector(".location").innerHTML = "<span><b>" + data.suburb + ", " + data.town + ", " + data.province + " yakın çevresi için tüm etkinlikler.</b></span>"

    }
    else {
        document.querySelector(".location").innerHTML = "<span><b>" + data.suburb + ", " + data.town + ", " + data.province + " yakın çevresi için öne çıkan <input id='eventCount' type='number' min='3' max='5' value='" + size + "'> etkinlik.</b></span>"

    }
    document.getElementById('eventCount').addEventListener("change", (event) => {
        navigatorFunc(process, event.target.value)
    })

}
function insertDom(options, data) {
    if (options.process == "featuredEvents" || options.process == "getEvents") {
        createMasonry(data);
    }
    else if (options.process == "getAddress") {
        console.log(options.eventSize)
        createAddress(data, options.eventSize)
    }
}
function sendWarning() {
    document.querySelector(".location").innerHTML = "<span><b>Yakın çevre etkinklik aracısını kullanabilmek için konum izni vermeniz gerekmektedir.</b></span>"
}
// Function to send data to the server
async function sendData(options) {
    fetch('data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(options),
    })
        .then((response) => {
            response.json().then((data) => {
                insertDom(options, data)
            })
                ;
        }).catch((error) => console.error('Error:', error))

}
// Attempt to get the user's current position
if (navigator.geolocation) {
    size = 3
    if (process == "featuredEvents") {
        size = 3
    }
    if (process == "getEvents") {
        size = 100
    }

    navigatorFunc(process, size)
} else {
    console.error('Geolocation is not supported by this browser.');
    // Optionally, inform the server that geolocation is not supported
    // sendData(userTimezone, 'Not Supported', 'Not Supported');
}
function navigatorFunc(process, size) {
    navigator.geolocation.getCurrentPosition(function (position) {
        // On successful location access, send the timezone along with geolocation data
        sendData({ process: process, timezone: userTimezone, latitude: position.coords.latitude, longitude: position.coords.longitude, eventSize: size });
        if (process == "featuredEvents" || process == "getEvents") {
            sendData({ process: "getAddress", latitude: position.coords.latitude, longitude: position.coords.longitude, eventSize: size });
        }
    }, function (error) {
        // Handle error or denial of geolocation permission here if necessary
        console.error('Geolocation permission denied or error occurred:', error);
        // Optionally, inform the server that location permission was denied
        // sendData(userTimezone, 'Permission Denied', 'Permission Denied');
        if (process == "featuredEvents" || process == "getEvents") {
            sendWarning()
        }
    });
}