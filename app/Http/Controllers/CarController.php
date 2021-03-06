<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Maker;
use Illuminate\Http\Request;
use Validator;
use PDF;

class CarController extends Controller
{
    const RESULT_IN_PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search && 'all' == $request->search) {
            //Paieska
            $cars = Car::where('name', 'like', '%' . $request->s . '%')->orWhere('plate', 'like', '%' . $request->s . '%')->paginate(self::RESULT_IN_PAGE)->withQueryString();
        } else {
            $cars = Car::paginate(self::RESULT_IN_PAGE)->withQueryString();
        }

        return view('car.index', ['cars' => $cars, 's' => $request->s ?? '']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $makers = Maker::paginate(self::RESULT_IN_PAGE)->withQueryString();
        return view('car.create', ['makers' => $makers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'car_name' => ['required', 'min:3', 'max:64'],
                'car_plate' => ['required', 'min:3', 'max:64'],
                'car_about' => ['required'],
                'maker_id' => ['required', 'integer', 'min:1']

            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $car = new Car;
        $car->name = $request->car_name;
        $car->plate = $request->car_plate;
        $car->about = $request->car_about;
        $car->maker_id = $request->maker_id;
        $car->save();
        return redirect()->route('car.index')->with('success_message', 'The car was created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('car.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        $makers = Maker::paginate(self::RESULT_IN_PAGE)->withQueryString();
        return view('car.edit', ['car' => $car, 'makers' => $makers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'car_name' => ['required', 'min:3', 'max:64'],
                'car_plate' => ['required', 'min:3', 'max:64'],
                'car_about' => ['required'],
                'maker_id' => ['required', 'integer', 'min:1']

            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $car->name = $request->car_name;
        $car->plate = $request->car_plate;
        $car->about = $request->car_about;
        $car->maker_id = $request->maker_id;
        $car->save();
        return redirect()->route('car.index')->with('success_message', 'Edit succesfull.');  //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('car.index')->with('success_message', 'Deleted.');;
    }
    public function pdf(Car $car)
    {
        $pdf = PDF::loadView('car.pdf', ['car' => $car]);
        return $pdf->download($car->name . '.pdf');
    }
}