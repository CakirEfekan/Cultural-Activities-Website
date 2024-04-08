<?php
class ticketMaster
{
    private static string $apiKey;
    public function __construct($key)
    {
        $this->setApiKey($key);
    }
    public function setApiKey($key): void
    {
        self::$apiKey = $key;
    }
    public static function getApiKey(): string
    {
        return self::$apiKey;
    }
    public static function eventList(float $lat, float $long, int $radius, string $unit, string $startDate, string $endDate, $size, $apiKey = null): String
    {
        $apiKey = $apiKey ?? self::getApiKey();
        return "https://app.ticketmaster.com/discovery/v2/events?apikey=$apiKey&latlong=$lat,$long&radius=$radius&unit=$unit&locale=*&startDateTime={$startDate}&endDateTime={$endDate}&size={$size}&sort=date,desc";
    }
    public static function getEventDetails($eventID, $apiKey = null): String
    {
        $apiKey = $apiKey ?? self::getApiKey();
        return "https://app.ticketmaster.com/discovery/v2/events/{$eventID}?apikey={$apiKey}&locale=*";

    }
}
class geoCoder
{
    private static string $apiKey;
    public function __construct($key)
    {
        $this->setApiKey($key);
    }
    public function setApiKey($key): void
    {
        self::$apiKey = $key;
    }
    public static function getApiKey(): string
    {
        return self::$apiKey;
    }
    public static function getAddress($lat, $long, $apiKey = null): String
    {
        $apiKey = $apiKey ?? self::getApiKey();
        return "https://geocode.maps.co/reverse?lat={$lat}&lon={$long}&api_key={$apiKey}";
    }

}

class fileLoader
{
    private static $instance = null;
    private static $content = null;
    private static $url = null;
    private function __construct()
    {
    }
    public static function checkInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
    }
    public static function init()
    {
        self::checkInstance();
        return self::getInstance();
    }
    public static function getInstance()
    {
        return self::$instance;
    }
    public static function setSource($source)
    {
        $data = file_get_contents($source);
        self::setContent($data);
        return self::getInstance();
    }
    public static function getContent()
    {
        return self::$content;
    }
    private static function setContent($content)
    {
        self::$content = $content;
        return self::getInstance();
    }
    public static function decodeJSON()
    {
        return json_decode(self::getContent());
    }
}