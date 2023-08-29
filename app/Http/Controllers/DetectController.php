<?php

namespace App\Http\Controllers;
use App\Models\Photo;
use App\Models\Detect;
use App\Models\Event;
use App\Models\User;
use Sdkconsultoria\WhatsappCloudApi\Waba\SendMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DetectController extends Controller
{
    
    public function show(){
        $user_id = $this->get_id_user();
        //$events = Event::All();
        $images = Detect::with('photo')->where('user_id', $user_id)->get();
        return view('client.photos.showphotos', compact('images'));
    }

    //get name of event by photo_id (tarde me di cuenta que podia hacer relacion entre las tablas xD)
    public static function auxiliar($photo_id){
        $photo = Photo::where('id', $photo_id)->first();
        $event = Event::where('id', $photo->event_id)->first();
        //dd($event_name); die();
        return $event;
    }
    
    //get array from Js File (via AJAX), the array is data recognition face API results 
    public function store(Request $request){
        $pictures = $request->res;
        foreach ($pictures as $key => $value){
            if (DB::table('detects')->where('user_id', $value['user_id'])->where('photo_id', $value['photo_id'])->doesntExist()) {
                //$this->sendClient($value['photo_id']);
                $detect = new Detect;
                $detect->user_id = $value['user_id'];
                $detect->photo_id = $value['photo_id'];
                $detect->photo_status = 'Nuevo';
                $detect->save();
            }
        }
    }

    //creating data to send API FACE
    public function create(){
        $user_id = $this->get_id_user();
        $user = User::find($user_id);
        $photos = Photo::all();
        //$photo = Photo::where('id', '28')->first();
        return view('client.photos.detectphotos', compact('photos', 'user'));
    }

    public function get_id_user(){
        $id = auth()->user()->id;
        return $id;
    }
        
}
