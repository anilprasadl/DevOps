<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Datatables\Datatables;
use App\AppDetails;
use App\AppEnvironment;
use App\User;

use Auth;
use DB;
class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('config.listing');
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
        // print_r($request->all());exit;
        try{ 
            $rv = DB::transaction(function()use($request) {
            $user = Auth::user();
            if($request->id){
            $config = AppDetails::find($request->id);
            $config->updated_by = $user->id;
            }else {
            $config = new AppDetails;
            }
            

            if($request->start_date > $request->end_date)
              {
                return response([
                    'data' => [
                        "error" => "End Date should be greater thean Start Date ",
                        ],
                    ],206);
              }
                $config->name = $request->name;
                $config->lead_by_id = $request->lead_by_id;
                $config->tech_stack = $request->tech_stack;
                $config->is_POC = $request->is_POC ;
                $config->updated_by = $user->id;
                $config->start_date = $request->start_date;
                $config->end_date = $request->end_date;
                $config->save();

                $req=$request->app_env;
                print_r($req);exit;
                if($req)
                {
                    if($req->id)
                    {
                        $envir = AppEnvironment::find($req->id);
                        $updated_by=Auth::user()->id;
                    }else{
                        $envir = new AppEnvironment;
                    }

                    foreach ( $req as $enn )
                    {   
                        $envir = new AppEnvironment;
                        $envir->type = $enn['type'];
                        $envir->app_details_id = $config->id;     
                        $envir->url = $enn['url'];
                        $envir->ip = $enn['ip'];
                        $envir->port = $enn['port'];    
                        $envir->provider = $enn['provider'];    
                        $envir->instance_family = $enn['instance_family'];
                        $envir->deploy_hook = $enn['deploy_hook'];
                        // $envir->updated_by = $user->id;
                        $envir->save();
                    }
                }
            return response([
            'data' => [
                "config_id" => $config->id,
                "message" => "App Details update success.",
                ],
            ],200);
    
        });

        return $rv;

    }catch(\Exception $e){
            return response($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // print_r($id);exit;   
        try{
            $app = AppDetails::with('app_env')->where('id',$id)->first();

            if(!$app)
            {
                return response(['data'=>
                    [
                    'error'=>"No Records Found!",
                    ],
                ]);
            }else{
                return response(['data'=>$app->toArray()]);
            }
            
        }catch(\Exception $e){
            return response($e->getMessage());
        }
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
    public function listApps(Datatables $datatabels)
    {
        try{
                
            $user = Auth::user();
            $records = AppDetails::select("id","name","start_date","end_date")
            ->orderBy('name')->get();
            return $datatabels::of($records)
            ->editColumn('start_date',function($record){
                return date('d-m-Y', strtotime($record->start_date));
            })->editColumn('end_date',function($record){
                return date('d-m-Y', strtotime($record->end_date));
            })
            ->addColumn('action', function ($record) {
                $buttons = ' <button ng-click="edit('.$record->id.')"'
                        . 'title="Edit" alt="Edit" '
                        . 'class=" btn btn-circle btn-mn btn-danger">'
                        . '<span >Edit</span></button>'.
                $buttons = ' <button ng-click="delete('.$record->id.')" '
                        . 'title="Delete" alt="Delete" '
                        . 'class="btn btn-circle btn-mn btn-danger">'
                        . '<span>Delete</span></button>';

                return $buttons;
            })
           
                 
        ->make();
        }catch(\Exception $e){  
            return response($e->getMessage());
        }
    }
   
    // public function transform($app)
    // {   
    //     // print_r($app['id']);exit;
    //     $env=AppEnvironment::where('app_details_id',$app['id'])->get();
    //     print_r($env);exit;
    //     return [
    //             'id' => $app['id'],
    //             'name' => $app['name'],
    //             'start_date' => $app['start_date'],
    //             'end_date' => $app['end_date'],
    //             'lead_by_id'=>$app['lead_by_id'],
    //             'tech_stack'=>$app['tech_stack'],
    //             'type'=>$env['type'],
    //             'url'=>$env['url'],
    //             'ip'=>$env['ip'],
    //             'port'=>$env['port'],
    //             'provider'=>$env['provider'],
    //             'instance_family'=>$env['instance_family'],
    //             'deploy_hook'=>$env['deploy_hook'],
                
    //         ];
    // }
    // public function transformAll($apps)
    // {
    //     return array_map([$this,'transform'],$apps);
    // }
}
