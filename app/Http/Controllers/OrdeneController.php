<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ordene;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class OrdeneController.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:44:12pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class OrdeneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - ordene';
        $ordenes = Ordene::paginate(6);
        return view('ordene.index',compact('ordenes','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - ordene';
        
        return view('ordene.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ordene = new Ordene();

        
        $ordene->user_id = $request->user_id;

        
        
        $ordene->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new ordene has been created !!']);

        return redirect('ordene');
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
        $title = 'Show - ordene';

        if($request->ajax())
        {
            return URL::to('ordene/'.$id);
        }

        $ordene = Ordene::findOrfail($id);
        return view('ordene.show',compact('title','ordene'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - ordene';
        if($request->ajax())
        {
            return URL::to('ordene/'. $id . '/edit');
        }

        
        $ordene = Ordene::findOrfail($id);
        return view('ordene.edit',compact('title','ordene'  ));
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
        $ordene = Ordene::findOrfail($id);
    	
        $ordene->user_id = $request->user_id;
        
        
        $ordene->save();

        return redirect('ordene');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/ordene/'. $id . '/delete');

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
     	$ordene = Ordene::findOrfail($id);
     	$ordene->delete();
        return URL::to('ordene');
    }
}
