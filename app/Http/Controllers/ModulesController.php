<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModulesController extends Controller
{
  public function report_mark(){
    $client = new \GuzzleHttp\Client(['base_uri' => 'https://super-restlvl2.ssmagallanes.cl/']);
    $headers = [
      'Accept'  => 'application/json',
    ];
    $response = $client->request('GET', 'api/mark/report/all',[
      'headers' => $headers
    ]);

    $body=$response->getBody();
    $contents=(string) $body;
    $datas = json_decode($contents);
    $pdf = \PDF::loadView('report.mark', compact('datas'));
    return $pdf->stream('mark.pdf');
  }

  public function report_category(){
    $client = new \GuzzleHttp\Client(['base_uri' => 'https://super-restlvl2.ssmagallanes.cl/']);
    $headers = [
      'Accept'  => 'application/json',
    ];
    $response = $client->request('GET', 'api/category/report/all',[
      'headers' => $headers
    ]);

    $body=$response->getBody();
    $contents=(string) $body;
    $datas = json_decode($contents);
    $pdf = \PDF::loadView('report.categories', compact('datas'));
    return $pdf->stream('category.pdf');
  }

  public function report_product(){
    $client = new \GuzzleHttp\Client(['base_uri' => 'https://super-restlvl2.ssmagallanes.cl/']);
    $headers = [
      'Accept'  => 'application/json',
    ];
    $response = $client->request('GET', 'api/product/report/all',[
      'headers' => $headers
    ]);

    $body=$response->getBody();
    $contents=(string) $body;
    $datas = json_decode($contents);
    $pdf = \PDF::loadView('report.products', compact('datas'));
    return $pdf->stream('products.pdf');
  }

}
