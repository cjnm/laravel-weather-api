<?php

namespace App\Traits;

use App\HAL\HydratorManager;
use Illuminate\Pagination\LengthAwarePaginator;

trait ResponseTrait
{

    /**
     * Status code of response
     *
     * @var int
     */
    protected $statusCode = 200;

    /**
     * Fractal manager instance
     *
     * @var Manager
     */
    protected $hydrator;

    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Set hydrator Manager instance
     *
     * @param Manager $fractal
     *
     * @return void
     */
    public function setHydrator(HydratorManager $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * Send this response when api user provide incorrect data type for the field
     *
     * @param $errors
     *
     * @return mixed
     */
    public function sendInvalidFieldResponse($errors)
    {
        return response()->json((['status' => 400, 'invalid_fields' => $errors]), 400);
    }

    /**
     * Send custom data response
     *
     * @param $status
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendCustomResponse($status, $message)
    {
        return response()->json(['status' => $status, 'message' => $message], $status);
    }

    /**
     * Return single item response from the application
     *
     * @param $item
     * @param $callback
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithItem($item)
    {
        $data = $this->hydrator->extract($item)->toArray();
        
        return $this->respondWithArray($data);
    }

    /**
     * Return a json response from the application
     *
     * @param array $array
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithArray(array $array, array $headers = [])
    {
        return response()->json($array, $this->statusCode, $headers);
    }

    /*
    * Return collection response from the application
    *
    * @param array|LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection $collection
    * @param \Closure|TransformerAbstract $callback
    * @return \Illuminate\Http\JsonResponse
    */
    protected function respondWithCollection($collection)
    {
        //set empty data pagination
        if (empty($collection)) {
            $paginator = new LengthAwarePaginator([], 0, 10);
        } else {
            $paginator = new LengthAwarePaginator($collection, $collection->count(), 10);
        }

        $data = $this->hydrator->paginate('data', $paginator)->toArray();

        return $this->respondWithArray($data);

    }

    /**
     * Send 404 not found response
     *
     * @param string $message
     *
     * @return string
     */
    public function sendNotFoundResponse($message = '')
    {
        if ($message === '') {
            $message = 'The requested resource was not found';
        }

        return response()->json(['status' => 404, 'message' => $message], 404);
    }
}
