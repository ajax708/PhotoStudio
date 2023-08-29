<?php

namespace App\Http\Controllers;
use App\Models\Detect;
use App\Models\Photo;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function create(){
        $user_id = $this->get_id_user();
        $images = Detect::where('user_id', $user_id)->get();
        return view('client.ecommerce.createshop', compact('images'));
    }

    public function cart($id){
        $detect = Detect::findOrFail($id);
        $photo = Photo::findOrFail($detect->photo_id);
        $photograph = User::findOrFail($photo->user_id);
        $event = Event::findOrFail($photo->event_id);
        return view('client.ecommerce.shoppingcart', compact('detect', 'photograph', 'event', 'photo'));
    }

    public function pay($id){
        $detect = Detect::findOrFail($id);
        $detect->photo_status = 'Pagado';
        $detect->save();
        return redirect()->route('sale.create');
    }

    public function download($id){
        $detect = Detect::findOrFail($id);
        $photo = Photo::findOrFail($detect->photo_id);
        return Storage::disk('photos')->download($photo->eventphoto_route);
    }

    public function invoice(){
        $user_id = $this->get_id_user();
        $invoices = Detect::where('photo_status', 'Pagado')->where('user_id', $user_id)->get();
        return view('client.ecommerce.invoice', compact('invoices'));
    }

    public static function getEvent($id){
        $photo = Photo::findOrFail($id);
        $event = Event::findOrFail($photo->event_id);
        return $event;
    }

    public static function getPhotographer($id){
        $photo = Photo::findOrFail($id);
        $photograph = User::findOrFail($photo->user_id);
        return $photograph;
    }

    public function get_id_user(){
        $id = auth()->user()->id;
        return $id;
    }
}
