<?php

namespace App\Http\Controllers;
use App\Models\Assignment;
use App\Models\Domain;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function create(){
        return view('admin.event.addevent');
    }

    public function calendar(){
        $events = Event::where('event_status', 'En Espera')->orWhere('event_status', 'En Progreso')->get();
        return view('admin.event.calendar', compact('events'));
    }

/*    public function generate_QR(){
        $qr_path = 'CodeQr/gallery.png';
        $domain = Domain::where('name','subdomain')->first();
        $url = $domain->value.'/gallery/photos/event';
        QrCode::format('png')->size(300)->generate($url, Storage::disk('photos')->path($qr_path));
    }*/
    private function encryptId($value)
    {
        try {
            $encryptedValue = base64_encode($value);
            return $encryptedValue;
        } catch (\Illuminate\Contracts\Encryption\EncryptException $e) {
            error_log("Error al encriptar el valor: " . $e->getMessage());
            return null;
        }
    }
    private  function decryptId($value)
    {
        try {
            $decryptedValue = base64_decode($value);
            return $decryptedValue;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            error_log("Error al desencriptar el valor: " . $e->getMessage());
            return null;
        }
    }
    private function generate_QR($event){
        $idEncrypt = $this->encryptId($event->id);
        $qr_path = 'CodeQr/'.$idEncrypt.'.png';
        $domain = Domain::where('name','subdomain')->first();
        $url = $domain->value.'/event/join-event/'.$idEncrypt;
        $event->event_qr = $qr_path;
        $event->save();
        QrCode::format('png')->size(300)->generate($url, Storage::disk('photos')->path($qr_path));
    }


    public function store(Request $request){
        try {
            $validated = $request->validate([
                'event_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'event_type' => 'required',
                'event_startdate' => 'required|date',
                'event_endate' => 'required|date|after_or_equal:event_startdate',
                'event_starthour' => 'required',
                'event_endhour' => 'required',
                'lat' => 'required',
                'lng' => 'required',
            ]);

            $status = $this->status($request->event_startdate, $request->event_endate);
            $event = new Event;
            $event->event_name = $request->event_name;
            $event->event_type = $request->event_type;
            $event->event_startdate = $request->event_startdate;
            $event->event_endate = $request->event_endate;
            $event->event_starthour = $request->event_starthour;
            $event->event_endhour = $request->event_endhour;
            $event->latitude = $request->lat;
            $event->longitude = $request->lng;
            $event->event_status = $status;

            $event->save();

            $this->generate_QR($event);

            return redirect()->route('event.show');
        } catch (ValidationException $e) {
            // Manejar errores de validación
            return back()->withErrors($e->validator)->withInput();
        } catch (QueryException $e) {
            // Manejar errores de base de datos
            return back()->withError('Error al guardar el evento en la base de datos.');
        } catch (EventCreationException $e) {
            // Manejar errores específicos de la creación de eventos
            return back()->withError('Error al crear el evento: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Manejar otros errores no previstos
            return back()->withError('Ocurrió un error inesperado: ' . $e->getMessage());
        }

    }

    //setting status of event based on dates
    public function status($event_startdate, $event_endate){
        $formatted_dt1=Carbon::parse($event_startdate);
        $formatted_dt2=Carbon::parse($event_endate);
        $progress = Carbon::today()->between($formatted_dt1, $formatted_dt2);
        $fineshed = $formatted_dt2->lessThan(Carbon::today());
        $result = null;
        if ($progress) {
            $result = 'En Progreso';
            return $result;
        }

        if ($fineshed) {
            $result = 'Finalizado';
            return $result;
        }else {
            $result = 'En espera';
            return $result;
        }
        //dd($progress, $fineshed); die();
    }

    public function show(){
        $events = Event::all();
        return view ('admin.event.viewevent', compact('events'));
    }

    public static function event_gallery(){
        $events = Event::all();
        return $events;
    }

    public function edit($id){
        $event = Event::findOrFail($id);
        return view('admin.event.editevent',compact('event'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'event_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'event_type' => 'required',
            'event_startdate' => 'required|date',
            'event_endate' => 'required|date|after_or_equal:event_startdate',
            'event_starthour' => 'required',
            'event_endhour' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $event = Event::findOrFail($id);
        $event->event_name = $request->event_name;
        $event->event_type = $request->event_type;
        $event->event_startdate = $request->event_startdate;
        $event->event_endate = $request->event_endate;
        $event->event_starthour = $request->event_starthour;
        $event->event_endhour = $request->event_endhour;
        $event->latitude = $request->lat;
        $event->longitude = $request->lng;
        $event->save();
        return redirect()->route('event.show');
    }

    public function destroy($id){
        $event = Event::findOrFail($id);
        $event->delete();
        return back();
    }

    public static function subdates($date_start, $date_end){
        $formatted_dt1=Carbon::parse($date_end);
        $formatted_dt2=Carbon::parse($date_start);
        $date_diff=$formatted_dt1->diffInDays($formatted_dt2);
        return $date_diff.'Dias';
    }

    public static function subhours($hour_start, $hour_end){
        $formatted_dt1=Carbon::parse($hour_end);
        $formatted_dt2=Carbon::parse($hour_start);
        $hour_diff=$formatted_dt1->diff($formatted_dt2);
        return $hour_diff->h.'Horas'.' '.$hour_diff->i.'minutos';
    }

    public function join($idEncrypted){
        try {
            $eventId = $this->decryptId($idEncrypted);
            $event = Event::findOrFail($eventId);
            return view('admin.event.joinevent', compact('event'));
        } catch (\Exception $e) {
            // Manejar otros errores inesperados
            return back()->withError('Ocurrió un error inesperado: ' . $e->getMessage());
        }
    }

}
