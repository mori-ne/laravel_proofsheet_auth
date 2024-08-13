<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function getAddress($zipcode)
    {
        // ZipCloud APIにリクエストを送信
        $response = Http::get('https://zipcloud.ibsnet.co.jp/api/search', [
            'zipcode' => $zipcode
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['message' => '住所を取得できませんでした'], 404);
    }
}
