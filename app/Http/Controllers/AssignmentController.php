<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Event;
use App\Models\Assignment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function create(){
        $events = Event::where('event_status', 'En Espera')->orWhere('event_status', 'En Progreso')->get();
        $photographers = User::where('rol', 'Fotografo')->orderBy('fullname', 'Asc')->get();
        return view('photographer.assignment.addassignment', compact('photographers', 'events'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'event_id' => 'required',
        ]);
        //dd($request->all()); die();
        $event = $request->event_id;
        $photographers = $request->id_photographer;
        foreach ($photographers as $photographer) {
            if (DB::table('assignments')->where('event_id', $event)->where('user_id', $photographer)->doesntExist()) {
                $assign = new Assignment;
                $assign->event_id = $event;
                $assign->user_id = $photographer;
                $assign->save();
                $this->send_whatsapp($event, $photographer);
            }
        }
        return redirect()->route('assign.show');
    }

    public function show(){
        $events = Event::with('assignments')->get();
        return view ('photographer.assignment.viewassignment',compact('events'));
    }

    public function showprofile($id){
        $photographers = Assignment::with('user')->where('event_id',$id)->get();
        $event = Event::where('id', $id)->first();
        return view ('photographer.assignment.viewprofile',compact('photographers', 'event'));
    }

    public function destroy($id){
        $assignments = Assignment::where('event_id', $id)->get();
        foreach ($assignments as $assignment) {
            $assignment->delete();
        }
        return back();
    }

    //this function help to get image from fotographer assigned into event
    public static function auxiliar($event_id){
        $result = Assignment::with('user')->where('event_id',$event_id)->get();
        return $result;
    }

    //send notificacion via whatsapp (only photographers)
    function send_whatsapp($event_id, $photographer_id){
        $photographer = User::findOrFail($photographer_id);
        $event = Event::findOrFail($event_id);
        $name_photographer = str_replace(' ', '%20', $photographer->fullname);
        $name_event = str_replace(' ', '%20', $event->event_name);
        $message='Hola,%20'.$name_photographer.'%20has%20sido%20asignado%20como%20fotografo%20para%20el%20evento%20'.$name_event.'%20para%20tener%20mas%20informacion,%20ingresa%20al%20sistema!';
        $apikey="YcQZquX5XhE6";
        //dd($message); die();
        $url = 'http://api.textmebot.com/send.php?recipient=+591'.$photographer->number.'&apikey='.$apikey.'&text='.$message;
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





    //change status of event(I know, this method shouldn't be here xD)
    public static function auxiliar2($event_startdate, $event_endate, $id){
        $formatted_dt1=Carbon::parse($event_startdate);
        $formatted_dt2=Carbon::parse($event_endate);
        $progress = Carbon::today()->between($formatted_dt1, $formatted_dt2);
        $fineshed = $formatted_dt2->lessThan(Carbon::today());
        $event = Event::findOrFail($id);
        $result = null;
        if ($progress) {
            $result = 'En Progreso';
            $event->event_status = $result;
            $event->save();
            return $result;
        }

        if ($fineshed) {
            $result = 'Finalizado';
            $event->event_status = $result;
            $event->save();
            return $result;
        }else {
            $result = 'En espera';
            $event->event_status = $result;
            $event->save();
            return $result;
        }

        //dd($progress, $fineshed); die();
    } 
}
