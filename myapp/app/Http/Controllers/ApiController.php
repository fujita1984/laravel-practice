<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function gpt(Request $request)
    {
        $request_message = $request->input('request');
        $API_KEY = config('sample.GPT_API_KEY');

        $header = array(
            'Authorization: Bearer ' . $API_KEY,
            'Content-type: application/json',
        );

        $params = json_encode(array(
            'messages' => [
                [
                    'role' => 'system',
                    'content' => '日本語'
                ],
                [
                    "role" => 'user',
                    "content" => $request_message
                ]
            ],

            'model' => 'gpt-3.5-turbo',
            'temperature'    => 0.2,
            'max_tokens'    => 500,
            'top_p'            => 0.2
        ));


        $curl = curl_init('https://api.openai.com/v1/chat/completions');
        $options = array(
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_RETURNTRANSFER => true,
        );
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

        if (200 == $httpcode) {
            $json_array = json_decode($response, true);
            $choices = $json_array['choices'];
            return response()->json([
                'message' => $choices[0]["message"]["content"]
            ]);
        }
    }
}
