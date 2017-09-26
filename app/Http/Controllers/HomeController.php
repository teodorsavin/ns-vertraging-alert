<?php

namespace App\Http\Controllers;

use App\Http\Requests\StationsFormRequest;
use GuzzleHttp;
use SimpleXMLElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    private $_client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->_client = new GuzzleHttp\Client();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', ["stations" => json_encode($this->getAllStations(), JSON_HEX_APOS)]);
    }

    public function storeUserData(StationsFormRequest $request)
    {
        $times = '';
        try {
            $res = $this->_client->request('GET', 'http://webservices.ns.nl/ns-api-treinplanner?fromStation=' .
                $request->get('from') . '&toStation=' . $request->get('to') . '&dateTime=' .
                date('Y-m-d\TH:i:s').'&Departure=true', [
                    'auth' => ['teodorsavin@gmail.com', 'zPOjen4v_N2q5REvAUbrlxp2qynwMikLH3gLZFw4912MTzL2_O7eFw']
                ]
            );
            $times = $this->parseResponse($res);
        } catch (Exception $e) {
            Log::error('Error in getting times:'. $e->getMessage());
        }

        echo '<pre>';
        print_r($times);
        die();
    }

    protected function getAllStations(): array
    {
        $arrStations = [];
        try {
            $res = $this->_client->request('GET', 'http://webservices.ns.nl/ns-api-stations-v2', [
                'auth' => ['teodorsavin@gmail.com', 'zPOjen4v_N2q5REvAUbrlxp2qynwMikLH3gLZFw4912MTzL2_O7eFw']
            ]);
            $stations = $this->parseResponse($res);
        } catch (Exception $e) {
            Log::error('Error in getting stations:'. $e->getMessage());
        }

        if(!empty($stations->Station)) {
            foreach ($stations->Station as $station) {
                $arrStations[(string) $station->Code] = (string) $station->Namen->Lang;
            }
        }

        return $arrStations;
    }

    protected function parseResponse ($response): SimpleXMLElement
    {
        return new SimpleXMLElement($response->getBody()->getContents());
    }
}
