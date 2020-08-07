<?php

class BookFlight
{
    private static $country_information;

    public function __construct(){
        self::$country_information = self::getCountryInformation();
    }

    private function getIpAddress() {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if ($_SERVER['REMOTE_ADDR'] != '::1'){
            return $_SERVER['REMOTE_ADDR'];
        }
        else {
            // Get ip address from external api if running on localhost
            return file_get_contents('https://api.ipify.org');
        }
    }

    private function getCountryInformation() {
        $country_information = array();
        $ip_address = self::getIpAddress();
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip_address));
        $country_information['country_code'] = $ip_data->geoplugin_countryCode;
        $country_information['currency_code'] = $ip_data->geoplugin_currencyCode;
        $country_information['language_code'] = 'en-US';
        return $country_information;
    }

    public function getPlaces($query) {
        $query = implode('',$query);    // Converting array to single string, jquery autocomplete passes array
        $curl = curl_init();
        $country_code = self::$country_information['country_code'];
        $currency_code = self::$country_information['currency_code'];
        $language_code = self::$country_information['language_code'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://skyscanner-skyscanner-flight-search-v1.p.rapidapi.com/apiservices/autosuggest/v1.0/$country_code/$currency_code/$language_code/?query=".$query,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: skyscanner-skyscanner-flight-search-v1.p.rapidapi.com",
                "x-rapidapi-key: e42867c66emsh9c5ddf22b64c877p1d621ejsnc6f8ea91ab2b"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return $response;
        }
    }

    public function getFlights($origin, $destination, $check_in_date, $check_out_date){
        $curl = curl_init();
        $country_code = self::$country_information['country_code'];
        $currency_code = self::$country_information['currency_code'];
        $language_code = self::$country_information['language_code'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://skyscanner-skyscanner-flight-search-v1.p.rapidapi.com/apiservices/browseroutes/v1.0/$country_code/$currency_code/$language_code/$origin/$destination/$check_in_date?inboundpartialdate=$check_out_date",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: skyscanner-skyscanner-flight-search-v1.p.rapidapi.com",
                "x-rapidapi-key: e42867c66emsh9c5ddf22b64c877p1d621ejsnc6f8ea91ab2b"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return $response;
        }

    }
}