<?php

require_once "classes.php";
new ticketMaster("TfrQtQHRSBJ3yoiGOvLBrqEGGFhF6dN6");
new geoCoder("6613a7892ca36075528100kufa42e35");
$content = file_get_contents("php://input");
$decoded = json_decode($content, true);

if ($decoded['process'] === "featuredEvents" || $decoded['process'] === "getEvents") {

    if($decoded['process'] === "featuredEvents"){
        $eventSize = $decoded['eventSize'];
    }
    else{
        $eventSize = 100;
    }
    if (isset($decoded['timezone'])) {
        $userTimezone = $decoded['timezone'];
        $latitude = $decoded['latitude'] ?? 'Not provided';
        $longitude = $decoded['longitude'] ?? 'Not provided';

        // Set the default timezone to user's timezone
        date_default_timezone_set($userTimezone);
        // Create a DateTime object for the specified date/time in the local time zone
        $now = new DateTime('now', new DateTimeZone($userTimezone));
        $delayedDate = clone $now;
        $delayedDate->add(new DateInterval('P14D'));
        // Convert the DateTime object to UTC
        $now->setTimezone(new DateTimeZone("UTC"));
        $delayedDate->setTimezone(new DateTimeZone("UTC"));

        $startDate = $now->format('Y-m-d\TH:i:s\Z');
        $endDate = $delayedDate->format('Y-m-d\TH:i:s\Z');

        $queryLink = ticketMaster::eventList($latitude, $longitude, "25", "km", $startDate, $endDate, $eventSize);
        $content = fileLoader::init()->setSource($queryLink)->decodeJSON();

        // Prepare the response
        $response = $content;

        // Send JSON header and the response
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo json_encode(["error" => "Timezone not set."]);
    }
}
elseif ($decoded['process'] === "getEventDetails") {
    $queryLink = ticketMaster::getEventDetails($decoded['id']);
    $content = fileLoader::init()->setSource($queryLink)->decodeJSON();

    // Prepare the response
    $response = $content;

    // Send JSON header and the response
    header('Content-Type: application/json');
    echo json_encode($response);
}
elseif ($decoded['process'] === "getAddress") {
    $queryLink = geoCoder::getAddress($decoded['latitude'],$decoded['longitude']);
    // Prepare the response
    $content = fileLoader::init()->setSource($queryLink)->decodeJSON();
    $response = $content;

    // Send JSON header and the response
    header('Content-Type: application/json');
    echo json_encode($response);
}