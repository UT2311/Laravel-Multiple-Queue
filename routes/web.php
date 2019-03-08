<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/data',function(){
	$data = [];
	$data['header'] = ['Accept: application/json', 'Content-Type: application/json', 'X-Shopify-Access-Token: 80dacc05fbaa0d19f4e4ae8653447c14'];
	$data['url'] = 'https://rpsubscription.myshopify.com/admin/products.json';
	$data['method'] = "POST";
	for($i=0;$i<1000;$i++){
	$jsonData = array ('product' => 
					  array (
					    'title' => 'Bu'.$i,
					    'body_html' => '<strong>Good snowboard!</strong>',
					    'vendor' => 'Burton',
					    'product_type' => 'Snowboard',
					    'tags' => 'Barnes & Noble, John\'s Fav, "Big Air"',
					    'variants' => 
					    array (
					      0 => 
					      array (
					        'option1' => 'First',
					        'price' => '10.00',
					        'sku' => '123',
					      ),
					    ),
					  ),
					);
	$data['body'] = json_encode($jsonData);
	// for($i=0;$i<100;$i++){
	// ->delay(60)
	// for($i=0;$i<1000;$i++){
		$Job = (new \App\Jobs\SchedulingQueue($data))->onQueue('runJob')->delay(1);
		dispatch($Job);
	}
	// }
});
Route::get('/customer',function(){
	$data = [];
	$header = ['Accept: application/json', 'Content-Type: application/json', 'X-Shopify-Access-Token: 80dacc05fbaa0d19f4e4ae8653447c14'];
	$url = 'https://rpsubscription.myshopify.com/admin/countries.json';
	$method = "GET";
	
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    if ($method == 'POST' || $method == 'PUT') {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    echo "data requested by user";
    return print_r($result,true);
	// for($i=0;$i<100;$i++){
	// ->delay(60)
	
});