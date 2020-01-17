<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorldDivision;
use Illuminate\Support\Facades\Config;

class WorldSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchdivision(Request $request)
    { 
        $search_term = $request->input('q');
        $page = $request->input('page');
        $form = collect($request->input('form'))->pluck('value', 'name');

        $options = WorldDivision::query();

        if ($form['country_id']) {
        // if a category has been selected, only show articles in that category
            $options = $options->where('country_id', $form['country_id']);
        } else {
        // if no category has been selected, show no options 
           return []; 
        }

        // if a search term has been given, filter results to match the search term
        if ($search_term) {
            $options = $options->where('name', 'LIKE', '%'.$search_term.'%');
        }

        return $options->paginate($page);
    }

    public function filterdivision(Request $request)
    { 
        $search_term = $request->input('q');

        $options = WorldDivision::query();

        // if a search term has been given, filter results to match the search term
        if ($search_term) {
            $options = $options->where('name', 'LIKE', '%'.$search_term.'%');
        }

        return $options->get()->pluck('name', 'id');
    }


    public function show($id)
    {
       // echo "esto es una prueba";
        return WorldDivision::find($id);

    }

    public function prueba()
    {
        echo "esto es una prueba" ;
        
        echo 1;
        $valor = "xxxx";
        $valor =  Config::get('settings.world_continent');
        echo $valor;
/*
Setting::get('contact_email')
// or 
Config::get('settings.contact_email')
*/
    }

}