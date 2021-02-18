<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class PersonController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('welcome');
    }//end

    public function fetch(Request $req){
        $col_order = ['id','name','salary','age'];
        $total_data  = Person::count();
        $limit = $req->input('length');
        $start = $req->input('start');
        $order = $col_order[$req->input('order.0.column')];
        $dir = $req->input('order.0.dir');

        if(empty($req->input('search.value'))){
            $post = Person::offset($start)->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $total_filtered = Person::count();
        } else{
            $search = $req->input('search.value');
            $post = Person::where('id','like',"%{$search}%")
                ->orWhere('name','like',"%{$search}%")
                ->orWhere('salary','like',"%{$search}%")
                ->orWhere('age','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $total_filtered = Person::where('id','like',"%{$search}%")
                ->orWhere('name','like',"%{$search}%")
                ->orWhere('salary','like',"%{$search}%")
                ->orWhere('age','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->count();
        }


        $data = array();
        if($post){
            foreach ($post as $row){
                $nest['id']     = $row->id;
                $nest['name']   = $row->name;
                $nest['salary'] = $row->salary;
                $nest['age']    = $row->age;
                $data[] = $nest;
            }
        }

        $json = array(
            'draw'              =>  intval($req->input('draw')),
            'recordsTotal'      =>  intval($total_data),
            'recordsFiltered'   =>  intval($total_filtered),
            'data'              =>  $data
        );

        echo json_encode($json);
    }//end
}//end class
