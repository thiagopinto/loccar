<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Car;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cars = Car::with('images')->orderBy('created_at', 'desc')->paginate(10);

        $client = null;
        if ($request->session()->has('client')) {
            $client = $request->session()->get('client');
        }

        foreach ($cars as $car) {
            $lease = $car->leaseRequests()->where(function ($query) {
                $query->orWhere('status', 'active')->orWhere('status', 'pending');
            })->first();

            if ($lease === null) {
                $car->isDisposable = true;
            } else {
                $car->isDisposable = false;
            }
        }

        return view('pages.home', compact('cars', 'client'));
    }

    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data, string $message = null, int $code = 200)
    {
        return response()->json($data, $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message = null, int $code, $data = null)
    {
        return response()->json(
            [
                'error' => $message,
                'status' => 'Error',
                'message' => $message,
                'data' => $data
            ],
            $code
        )->header('Content-Type', 'text/plain');
    }
}
