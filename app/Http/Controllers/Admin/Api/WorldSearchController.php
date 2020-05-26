<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorldDivision;
use App\Models\WorldCity;
use Illuminate\Support\Facades\Config;

class WorldSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
/*
    public function searchdivision(Request $request)
    { 
        $search_term = $request->input('q');
        $page = $request->input('page');
        $form = collect($request->input('form'))->pluck('value', 'name');
//dump($form);
        $options = WorldDivision::query();

    
        if (isset($form['country_id']) and $form['country_id']) {
        // if a category has been selected, only show articles in that category
            $options = $options->where('country_id', $form['country_id']);
        } elseif (isset($form['contact_addresses[0][data10]']) and $form['contact_addresses[0][data10]']) {
            $options = $options->where('country_id', $form['contact_addresses[0][data10]']);

        } else {
        // if no category has been selected, show no options 
           return []; 
        }

        // if a search term has been given, filter results to match the search term
        if ($search_term) {
            $options = $options->where('name', 'LIKE', '%'.$search_term.'%');
        }
//      dump($form['country_id']);
  //    dump($form['contact_addresses[0][data10]']);   

        return $options->paginate($page);
    }

*/
    public function searchdivision($id) //, Request $request
    { 

    //    $search_term = $request->input('q');
    //    $page = $request->input('page');
     //   $form = collect($request->input('form'))->pluck('value', 'name');
    //    $options = WorldDivision::query();
        //$options = WorldDivision::all()->get();
        $options = WorldDivision::where('country_id', 208)->get();

//dump($form[$id]); 
/*
        if (isset($form[$id]) and $form[$id]) {
            $options = $options->where('country_id', $form[$id]);
        } else {
        // if no category has been selected, show no options 
           return []; 
        }
*/
        // if a search term has been given, filter results to match the search term
   //     if ($search_term) {
   //         $options = $options->where('name', 'LIKE', '%'.$search_term.'%');
   //     }   

        return $options; //->paginate($page);
    }

    public function searchcity($id, Request $request)
    { 
        
        $search_term = $request->input('q');
        $page = $request->input('page');
        $form = collect($request->input('form'))->pluck('value', 'name');
        $options = WorldCity::query();
//dump($id); 
   
        if (isset($form[$id]) and $form[$id]) {
            $options = $options->where('division_id', $form[$id]);
        } else {
        // if no category has been selected, show no options 
           return []; 
        }

//    $options = $options->where('division_id', $id);
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
