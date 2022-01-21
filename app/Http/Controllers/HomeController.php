<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\data_ajuan;
use App\Models\User; 
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


     // $response = Http::get('https://data.covid19.go.id/public/api/prov.json');
     // $data = $response->json();
     //   //dd($data);
     // return view('home',compact('data'));
        // $data = Auth::user()->id;
        // $data = data_ajuan::paginate(10);
        // return view('home', compact('data'));
        $data = data_ajuan::with('User')->get();
        return view('home', compact('data'));
    }

    public function store(Request $request)
    {

     $post = new data_ajuan;

     
     $post->no_tlp = $request->no_tlp;
     $post->ajuan = $request->ajuan;
     $post->user_id = Auth::user()->id;

     $post->save()->with('message','data added successfully');

     return back();

 }


 public function del($id)
 {
     $del=data_ajuan::find($id);
     $del->delete();
     return redirect('home');
 }

 public function update(Request $request, $id)
 {
     $update=data_ajuan::find($id);
     $update->no_tlp = $request->no_tlp;
     $update->ajuan = $request->ajuan;
    

     $update->update();

     return back()->with('message','data updated successfully');
 }
}
