<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cupone;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class CuponeController.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:48:38pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class CuponeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - cupone';
        $cupones = Cupone::paginate(6);
        return view('cupone.index',compact('cupones','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - cupone';
        
        return view('cupone.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cupone = new Cupone();

        
        $cupone->user_id = $request->user_id;

        
        $cupone->porcentaje = $request->porcentaje;

        
        $cupone->estatus = $request->estatus;

        
        $cupone->puntos = $request->puntos;

        
        
        $cupone->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new cupone has been created !!']);

        return redirect('cupone');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show - cupone';

        if($request->ajax())
        {
            return URL::to('cupone/'.$id);
        }

        $cupone = Cupone::findOrfail($id);
        return view('cupone.show',compact('title','cupone'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - cupone';
        if($request->ajax())
        {
            return URL::to('cupone/'. $id . '/edit');
        }

        
        $cupone = Cupone::findOrfail($id);
        return view('cupone.edit',compact('title','cupone'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $cupone = Cupone::findOrfail($id);
    	
        $cupone->user_id = $request->user_id;
        
        $cupone->porcentaje = $request->porcentaje;
        
        $cupone->estatus = $request->estatus;
        
        $cupone->puntos = $request->puntos;
        
        
        $cupone->save();

        return redirect('cupone');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/cupone/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$cupone = Cupone::findOrfail($id);
     	$cupone->delete();
        return URL::to('cupone');
    }
}
