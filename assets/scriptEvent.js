    // Get the user's timezone
    var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    function createMasonry(data) {
        console.log(data)
        if (data.dates.status.code == "onsale") {
            ticketStatus = "Satışta!"
        }
        else {
            ticketStatus = "Satışta Değil!"
        }
        var category;
        if (data.classifications[0].segment.name !== undefined) {
            category = data.classifications[0].segment.name
        }
        else {
            category = '';
        }
        document.querySelector(".eventDetails").setAttribute("class", "eventDetails")
        header = document.querySelector(".eventDetails img")
        header.setAttribute("src", data.images[data.images.length - 1].url)
        document.querySelector(".eventInformation h1").innerText = data.name
        document.querySelector(".eventInformation >:nth-child(2)").innerText = data.dates.start.localDate + " - " + data.dates.start.localTime + ' | ' + data._embedded.venues[0].name
        document.querySelector(".eventInformation >:nth-child(3)").innerText = category
        document.querySelector(".eventInformation >:nth-child(4)").innerText = ticketStatus
        document.querySelector(".eventInformation >:nth-child(6)").innerHTML = "<a href='" + data.url + "' target='_blank'>Bilet almak içın tıklayın.</a>"
        data.images.forEach(imageItem => {
            imageCard = document.createElement("div");
            imageCard.setAttribute("class", "image-card")
            image = document.createElement("img");
            image.setAttribute("src", imageItem.url)
            imageCard.append(image)
            document.querySelector(".image-gallery").append(imageCard)
        });
    }
    // Function to send data to the server
    function sendData(options) {
        fetch('data.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(options),
        })
            .then(response => response.json())
            .then(data => createMasonry(data))
            .catch((error) => console.error('Error:', error));
    }

    // Attempt to get the user's current position
    if (eventID) {
        sendData({ process: "getEventDetails", id: eventID });
    } 