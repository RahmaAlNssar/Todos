<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodosRequest;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function index()
    {
        try {
           
            $apiUrl = 'https://dummyjson.com/todos';
            $client = new Client();
            $response = $client->get($apiUrl);

            // Get the response body as an array
            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $apiUrl = 'https://dummyjson.com/todos/' . $id;
            $client = new Client();
            $response = $client->get($apiUrl);

            // Get the response body as an array
            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function store(TodosRequest $request)
    {
        try {
            $apiUrl = 'https://dummyjson.com/todos/add';
            $client = new Client();
            $data = $request->all();

            // POST request using the created object
            $postResponse = $client->post($apiUrl, [
                'json' => $data,
            ]);
            $data = json_decode($postResponse->getBody(), true);
            return $data;
      
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function update(TodosRequest $request,$id)
    {
        try {
            $apiUrl ='https://dummyjson.com/todos/'.$id;
            $client = new Client();
            $data = $request->all();

            // POST request using the created object
            $postResponse = $client->put($apiUrl, [
                'json' => $data,
            ]);
            $data = json_decode($postResponse->getBody(), true);
            return $data;
       
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $apiUrl ='https://dummyjson.com/todos/'.$id;
            $client = new Client();
            // POST request using the created object
            $postResponse = $client->delete($apiUrl);
            $data = json_decode($postResponse->getBody(), true);
            return $data;
         
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
