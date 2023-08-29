<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Photo;
use App\Models\User;
use App\Models\Assignment;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function create(){
        //get events from the photographer
        $user_id = $this->get_id_user();
        $user = User::findOrFail($user_id);
        $assignments = Assignment::with('event')->where('user_id', $user_id)->get();
        //dd($user_id, $events); die();
        return view('photographer.photo.addphotos', compact('assignments', 'user'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'event_id' => 'required',
        ]);
        //dd($request->all()); die();
        $user_id = $this->get_id_user();
        if ($request->hasFile('event_photo')) {
            $images = $request->file('event_photo');
            $cant_photos = count($images);
            //$this->send_whatsapp($request->event_id, $user_id, $cant_photos);
            foreach ($images as $image) {
                $event_image = $image->store('event_photo','photos');
                $event_photo = new Photo;
                $event_photo->eventphoto_route = $event_image;
                $event_photo->user_id = $user_id;
                $event_photo->event_id = $request->event_id;
                $event_photo->save();
            }
            $this->send_whatsapp($request->event_id, $user_id, $cant_photos);
        }

        return redirect()->route('photo.show');
    }

    public function show(){
        $user_id = $this->get_id_user();
        $assignments = Assignment::with('event')->where('user_id', $user_id)->get();
        //$photos = Photo::with('event')->where('user_id', $user_id)->orderBy('event_id', 'Asc')->get();
        //dd($assignments); die();
        return view('photographer.photo.showphotos', compact('assignments'));
    }

    public function showtoadmin(){
        $photos = Photo::all();
        $events = Event::all();
        return view('admin.event.showphotos', compact('photos', 'events'));
    }

    // get cant of photos by event (admin)
    public static function getcantphotos2($event_id){
        $photos = Photo::where('event_id', $event_id)->get();
        return $photos;
    }

    //get cant of photos uploaded by the user = fotografo
    public static function getcantphotos($event_id, $user_id){
        $photos = Photo::where('event_id', $event_id)->where('user_id', $user_id)->get();
        return $photos;
    }

    public function get_id_user(){
        $id = auth()->user()->id;
        return $id;
    }

    //send notificacion via whatsapp (only clients)
    function send_whatsapp($event_id, $photographer_id, $cant_photos){
        $photographer = User::findOrFail($photographer_id);
        $event = Event::findOrFail($event_id);
        $users = User::where('rol', 'Cliente')->whereNotNull('number')->get();
        //dd($users); die();
        $name_photographer = str_replace(' ', '%20', $photographer->fullname);
        $name_event = str_replace(' ', '%20', $event->event_name);
        $message='Saludos,%20El%20fotografo%20'.$name_photographer.'%20ha%20subido%20'.$cant_photos.'%20fotos%20al%20evento%20'.$name_event.'%20verifica%20si%20apareces%20en%20alguna!';
        $apikey="YcQZquX5XhE6";
        //dd($message); die();
        foreach ($users as $user) {
            $url = 'http://api.textmebot.com/send.php?recipient=+591'.$user->number.'&apikey='.$apikey.'&text='.$message;
            if($ch = curl_init($url)){
                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $html = curl_exec($ch);
                $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                //echo "Output:".$html;  // you can print the output for troubleshooting
                curl_close($ch);
                return (int) $status;
            }else{
                return false;
            }
        }
    }

    public function gallery(){
        return view('gallery.gallery');
    }

}
