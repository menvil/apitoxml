<?php

use Illuminate\Support\Facades\Route;

use App\Parsers\RandomUserParser;
use App\Parsers\BoredApiParser;
use Spatie\ArrayToXml\ArrayToXml;
use App\Http\Requests\LimitRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (LimitRequest $request) {

    $classes = [
        new RandomUserParser((int) $request->query('limit', 1)),
        new BoredApiParser((int) $request->query('limit', 1)),
    ];

    for ($i=0; $i<count($classes)-1; $i++) {
        $classes[$i]->setNext($classes[$i+1]);
    }

    $data = reset($classes)->handle();
    return response(ArrayToXml::convert(['record' => $data]))->header('Content-Type', 'text/xml');

});
