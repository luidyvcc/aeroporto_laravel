<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;

class CityController extends Controller
{
    private $city;
    private $totalPage;

    public function __construct(City $city)
    {
        $this->city = $city;
        $this->totalPage = 4;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($initials)
    {
        $state = State::where('initials', $initials)->get()->first();
        if(!$state) return redirect()->back()->with('error', 'Erro ao localizar cidades!');

        $cities = $state->cities()->paginate($this->totalPage);

        $title = "Cidades do estado {$state->name}";
        $bred = "Cidades do {$state->name}";

        return view('panel.cities.index', compact('title', 'cities', 'bred', 'state'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request, $initials)
    {
        $state = State::where('initials', $initials)->get()->first();
        if(!$state) return redirect()->back()->with('error', 'Erro ao localizar cidades!');

        $searchForm = $request->all();
        $keySearch = $request->key_search;

        $cities = $state->searchCities($request->key_search, $this->totalPage);

        $title = "Busca por '{$keySearch}' nas cidades do estado: {$state->name}";
        $bred = "Cidades";

        return view('panel.cities.index', compact('title', 'cities', 'bred', 'state', 'searchForm'));
    }
}
