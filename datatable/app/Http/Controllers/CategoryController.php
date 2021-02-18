<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('category');
    }
    public function fetchServerSide(Request $request)
    {
        $col_order = ['id', 'cname', 'corder', 'cstatus', 'cimage', 'created_at', 'updated_at'];
        $total_data  = Category::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $col_order[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $post = Category::offset($start)->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $total_filtered = Category::count();
        } else {
            $search = $request->input('search.value');
            $post = Category::where('id', 'like', "%{$search}%")
                ->orWhere('cname', 'like', "%{$search}%")
                ->orWhere('corder', 'like', "%{$search}%")
                ->orWhere('cstatus', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $total_filtered = Category::where('id', 'like', "%{$search}%")
                ->orWhere('cname', 'like', "%{$search}%")
                ->orWhere('corder', 'like', "%{$search}%")
                ->orWhere('cstatus', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }
        $data = array();
        if ($post) {
            foreach ($post as $row) {
                $nest['id']     = $row->id;
                $nest['cname']   = $row->cname;
                $nest['corder'] = $row->corder;
                $nest['cstatus']    = $row->cstatus;
                $nest['cimage']    = '<img src='.url('asset/img/Categoryimage/'.$row->cimage).' width="80px" height="70px">';
                $nest['created_at']    = ($row->created_at->format('d/m/Y'));
                $nest['updated_at']    = ($row->updated_at->format('d/m/Y'));
                $data[] = $nest;
            }
        }
        $json = array(
            'draw'              =>  intval($request->input('draw')),
            'recordsTotal'      =>  intval($total_data),
            'recordsFiltered'   =>  intval($total_filtered),
            'data'              =>  $data
        );

        echo json_encode($json);
    }
}
