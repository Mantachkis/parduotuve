<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use Illuminate\Http\Request;
use Validator;

class MakerController extends Controller
{
    const RESULT_IN_PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $makers = Maker::orderBy('name')->paginate(self::RESULT_IN_PAGE);
        if ($request->sort) {
            //sortina
            if ('name' == $request->sort && 'asc' == $request->sort_dir) {
                $makers = Maker::orderBy('name')->get();
            } else if ('name' == $request->sort && 'desc' == $request->sort_dir) {
                $makers = Maker::orderBy('name', 'desc')->get();
            } else {
                $makers = Maker::all();
            }
        }

        return view('maker.index', ['makers' => $makers, 'sortDirection' => $request->sort_dir ?? 'asc']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maker.create');
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
                'maker_name' => ['required', 'min:3', 'max:64'],
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $maker = new Maker;
        $maker->name = $request->maker_name;
        $maker->save();
        return redirect()->route('maker.index')->with('success_message', 'New maker created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function show(Maker $maker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function edit(Maker $maker)
    {
        return view('maker.edit', ['maker' => $maker]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maker $maker)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'maker_name' => ['required', 'min:3', 'max:64'],
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $maker->name = $request->maker_name;
        $maker->save();
        return redirect()->route('maker.index')->with('success_message', 'Update succesfull.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maker $maker)
    {
        if ($maker->getCars->count()) {
            return redirect()->route('maker.index')->with('info_message', 'Maker has cars, delete not possible');
        }
        $maker->delete();
        return redirect()->route('maker.index')->with('success_message', 'Edit succesfull.');
    }
}