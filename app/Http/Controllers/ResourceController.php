<?php

namespace App\Http\Controllers;

use App\Rules\ArrayOrInteger;
use App\Services\ResourceService;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller
{
    /**
     * @param \App\Services\ResourceService $resource_service
     */
    public function __construct( private readonly ResourceService $resource_service ) {}

    /**
     * @param \App\Http\Requests\PostsRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function get_posts( Request $request ): \Illuminate\Http\JsonResponse
    {
        try {
            $validator = $this->make_validator( $request->all() );
            if ( $validator->fails() ) {
                return new JsonResponse( $validator->errors(), 400 );
            }

            $paged = $request->integer( 'page', 1 );
            $category = $request->get( 'category', 0 );
            $data = $this->resource_service->get_posts( [
                'paged' => $paged,
                'category' => $category,
            ] );

            if ( $data ) {
                return new JsonResponse( $data, 200 );
            }
        } catch ( \Exception $e ) {
            return new JsonResponse( ['message' => $e->getMessage()], 500 );
        }

        return new JsonResponse( ['message' => 'No results found'], 404 );
    }

    /**
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    private function make_validator( array $data ): \Illuminate\Validation\Validator
    {
        return Validator::make(
            $data,
            [
                'page' => ['int', 'min:1'],
                'category' => [new ArrayOrInteger],
            ]
        );
    }
}