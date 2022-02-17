<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cars = Car::with('images')->orderBy('created_at', 'desc')->paginate(10);


        return view('pages.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required',
            'model' => 'required',
            'color' => 'required',
            'year' => 'required|numeric',
            'doors' => 'required|numeric',
            'mileage' => 'nullable|required|numeric',
            'daily_rate' => 'required|numeric',
            'imagens' => 'required',
            'imagens.*' => 'mimes:png,jpg,jpeg,gif'
        ]);

        $carRequest = $request->all();

        $car = Car::create(
            $carRequest
        );

        if ($request->hasfile('imagens')) {
            foreach ($request->file('imagens') as $image) {
                $path = $image->store('public/cars');
                $carImage = new CarImage([
                    'description' => "{$car->model}-{$car->license_plate}",
                    'path' => $path
                ]);

                $car->images()->save($carImage);
            }
        }


        return redirect()->route('cars.index')
            ->with('success', 'Carro cadastrado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::with('images')->find($id);

        return view('pages.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'license_plate' => 'required',
            'model' => 'required',
            'color' => 'required',
            'year' => 'required|numeric',
            'doors' => 'required|numeric',
            'mileage' => 'nullable|required|numeric',
            'daily_rate' => 'required|numeric',
        ]);

        $car = Car::with('images')->find($id);

        $carRequest = $request->all();

        $car->update($carRequest);

        if ($request->hasfile('imagens')) {
            foreach ($request->file('imagens') as $image) {
                $path = $image->store('public/cars');
                $carImage = new CarImage([
                    'description' => "{$car->model}-{$car->license_plate}",
                    'path' => $path
                ]);

                $car->images()->save($carImage);
            }
        }

        return redirect()->back()->with('success', 'Carro atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::with('images')->find($id);

        foreach ($car->images as $image) {
            Storage::delete($image->path);
            $image->delete();
        }

        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Carro deletado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyImage($id)
    {
        $image = CarImage::find($id);
        Storage::delete($image->path);
        $image->delete();
        return redirect()->back()->with('success', 'Imagem apagada');
    }
}
