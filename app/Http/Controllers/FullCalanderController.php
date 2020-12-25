<?php

namespace App\Http\Controllers;


use Request;
class FullCalanderController extends Controller
{
    public function index()
    {
       
        if($request->ajax()) {

       

            $data = Event::whereDate('start', '>=', $request->start)

                      ->whereDate('end',   '<=', $request->end)

                      ->get(['id', 'title', 'start', 'end']);

 

            return response()->json($data);

       }
       $data = array(
        'locale'  => 'fr',
        'surname' => $last
    );
 

       return view::make('fullcalender',$data);
    }

    public function ajax(Request $request)

    {

 

        switch ($request->type) {

           case 'add':

              $event = Event::create([

                  'title' => $request->title,

                  'start' => $request->start,

                  'end' => $request->end,

              ]);

 

              return response()->json($event);

             break;

  

           case 'update':

              $event = Event::find($request->id)->update([

                  'title' => $request->title,

                  'start' => $request->start,

                  'end' => $request->end,

              ]);

 

              return response()->json($event);

             break;

  

           case 'delete':

              $event = Event::find($request->id)->delete();

  

              return response()->json($event);

             break;

             

           default:

             # code...

             break;

        }

    }
    
}
