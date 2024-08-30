<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodosRequest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Traits\ResponseTrait;

class TodoController extends Controller
{
    use ResponseTrait;
    
    protected $apiUrl = 'https://dummyjson.com/todos';

    public function index()
    {
        $response = Http::get($this->apiUrl);
        // Get the response body as an array
        $data = $response->json();
        return $this->returnData($data, true, 200);


    }

    public function show($id)
    {
        $response = Http::get($this->apiUrl.'/'.$id);
        // Get the response body as an array
        $data = $response->json();
        return $this->returnData($data, true, 200);
    }

    public function store(TodosRequest $request)
    {
        // POST request using the created object
        $postResponse =Http::post($this->apiUrl.'/add', 
            $request->validated()
        );
        $data = $postResponse->json();
        return $this->returnData($data, true, 200);

    }

    public function update(TodosRequest $request, $id)
    {
        $postResponse = Http::put($this->apiUrl.'/'.$id, 
            $request->validated()
        );
        $data = $postResponse->json();
        return $this->returnData($data, true, 200);

    }

    public function destroy($id)
    {
        // POST request using the created object
        $postResponse = Http::delete($this->apiUrl.'/'.$id);
        $data = $postResponse->json();
        return $this->returnData($data, true, 200);

    }
}
