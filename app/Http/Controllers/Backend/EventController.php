<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\EventTalent;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Ticket;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Editor\Fields\Options;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    public function eventIndex(Request $request)
    {
        if ($request->ajax()) {

            $events = Events::latest()->get();
            return DataTables::of($events)
                ->addIndexColumn()
                ->addColumn('event_name', function ($event) {
                    return (ucfirst($event->event_name));
                })
                ->addColumn('date_held', function ($event) {
                    $date = date('d F Y', strtotime($event->date_held));

                    $date = $date . ' | ' . date('h:i:sa', strtotime($event->date_held));

                    return $date;
                })
                ->addColumn('event_location', function ($event) {
                    return (ucfirst($event->location_held));
                })
                ->addColumn('event_status', function ($event) {
                    if ($event->event_status == 'listing') {
                        return '<div class="btn btn-secondary">' . ucfirst($event->event_status) . '</div>';
                    } elseif ($event->event_status == 'archive') {
                        return '<div class="btn btn-danger">' . ucfirst($event->event_status) . '</div>';
                    } elseif ($event->event_status == 'publish') {
                        return '<div class="btn btn-info">' . ucfirst($event->event_status) . '</div>';
                    } else {
                        return '<div class="btn btn-success">' . ucfirst($event->event_status) . '</div>';
                    }
                })
                ->addColumn('action', function ($event) {

                    $btn = '<button id="event-edit" data-id="' . $event->slug . '" title="Edit" class="btn btn-secondary btn-sm edit-event ms-1"><i class="mdi mdi-pencil-box-outline"></i></button>';

                    $btn = $btn . '<button id="event-update" data-id="' . $event->slug . '" class="btn btn-success btn-sm ms-1" title="Update Status Event"><i class="mdi mdi-pencil"></i></button>';

                    $btn = $btn . '<button id="event-show" data-id="' . $event->slug . '" class="btn btn-primary btn-sm ms-1" title="Show"><i class="mdi mdi-eye"></i></button>';

                    return $btn;
                })
                ->rawColumns(['event_status', 'action'])
                ->make(true);
        }

        return view('backend.events.data-event');
    }

    public function eventStore(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            // 'date_held' => 'required|after_or_equal:' . date('Y-m-d'),
            'date_held' => 'required',
            'event_description' => 'required',
            'location_held' => 'required',
            // 'event_poster' => 'required|image|dimensions:max_width=800,max_height=450|max:2048',
            'ticket_category_name.*' => 'required|min:1|string',
            'ticket_category_price.*' => 'required|min:1|integer',
            'ticket_category_quota.*' => 'required|min:1|integer',
        ], [
            'event_name.required' => 'Event name must be included!',
            'date_held.required' => 'Date Held must be included!',
            'event_description.required' => 'Event Description must be included!',
            'location_held.required' => 'Location Held must be included!',
            'ticket_category_name.0' => 'Category Name at least 1!',
            'ticket_category_price.0' => 'Category Price must be included!',
            'ticket_category_quota.0' => 'Category quota must be included!',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        if ($request->hasFile('event_poster')) {

            $poster = $request->file('event_poster');
            $event_poster = 'event_poster-' . rand(1, 100000) . '.' . $poster->getClientOriginalExtension();

            // Store the original image
            $path = Storage::putFileAs('public/event_poster', $poster, $event_poster);

            // // Open the stored image
            // $image = Image::make(storage_path('app/' . $path));

            // // Resize the image to the desired dimensions
            // $image->resize(1917, 1027, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });

            // // Save the resized image
            // $image->save(storage_path('app/' . $path));

            $event = Events::updateOrCreate([
                'event_id' => $request->event_id
            ], [
                'event_name' => $request->event_name,
                'date_held' => $request->date_held,
                'event_description' => $request->event_description,
                'location_held' => $request->location_held,
                'event_poster' => $event_poster,
                'user_id' => 3,
            ]);
        } else {
            $event = Events::updateOrCreate([
                'event_id' => $request->event_id
            ], [
                'event_name' => $request->event_name,
                'date_held' => $request->date_held,
                'event_description' => $request->event_description,
                'location_held' => $request->location_held,
                'user_id' => 3,
            ]);
        }

        // Event Ticket Category
        if ($request->ticket_category_status) {
            for ($x = 0; $x < count($request->ticket_category_name); $x++) {

                $dataCategory = TicketCategory::updateOrCreate([
                    'ticket_category_id' => $request->ticket_category_id[$x],
                ], [
                    'ticket_category_name' => $request->ticket_category_name[$x],
                    'ticket_category_price' => $request->ticket_category_price[$x],
                    'ticket_category_quota' => $request->ticket_category_quota[$x],
                    'event_id' => $event->event_id,
                ]);
            }
        } else {
            for ($x = 0; $x < count($request->ticket_category_name); $x++) {

                $dataCategory = TicketCategory::updateOrCreate([
                    'ticket_category_id' => $request->ticket_category_id[$x],
                ], [
                    'ticket_category_name' => $request->ticket_category_name[$x],
                    'ticket_category_price' => $request->ticket_category_price[$x],
                    'ticket_category_quota' => $request->ticket_category_quota[$x],
                    'event_id' => $event->event_id,
                ]);
            }
        }

        // Event Talent
        for ($x = 0; $x < count($request->event_talent_name); $x++) {

            if ($request->hasFile('event_talent_img' . $x)) {

                $talent_photo = $request->file('event_talent_img')[$x];

                $talent_img = 'event_talent-' . rand(1, 100000) . '.' . $talent_photo->extension();

                $path = Storage::putFileAs('public/event_talent', $talent_photo, $talent_img);

                EventTalent::updateOrCreate([
                    'event_talent_id' => $request->event_talent_id[$x]
                ], [
                    'event_talent_name' => $request->event_talent_name[$x],
                    'event_talent_img' => $talent_img,
                ]);
            } else {
                EventTalent::updateOrCreate([
                    'event_talent_id' => $request->event_talent_id[$x]
                ], [
                    'event_talent_name' => $request->event_talent_name[$x],
                    'event_id' => $event->event_id,
                ]);
            }
        }
        // if ($data == null) {

        //     if ($request->hasFile('event_talent_img' . $x)) {

        //         $talent_photo = $request->file('event_talent_img')[$x];

        //         $talent_img = 'event_talent-' . rand(1, 100000) . '.' . $talent_photo->extension();

        //         $path = Storage::putFileAs('public/event_talent', $talent_photo, $talent_img);

        //         EventTalent::create([
        //             'event_talent_name' => $request->event_talent_name[$x],
        //             'event_talent_img' => $talent_img,
        //         ]);
        //     }
        // } else {
        //     if ($request->hasFile('event_talent_img' . $x)) {

        //         $talent_photo = $request->file('event_talent_img')[$x];

        //         $talent_img = 'event_talent-' . rand(1, 100000) . '.' . $talent_photo->extension();

        //         $path = Storage::putFileAs('public/event_talent', $talent_photo, $talent_img);

        //         EventTalent::updateOrCreate([
        //             'event_talent_id' => $request->event_talent_id[$x]
        //         ], [
        //             'event_talent_name' => $request->event_talent_name[$x],
        //             'event_talent_img' => $talent_img,
        //         ]);
        //     }else{
        //         EventTalent::updateOrCreate([
        //             'event_talent_id' => $request->event_talent_id[$x]
        //         ], [
        //             'event_talent_name' => $request->event_talent_name[$x],
        //         ]);
        //     }

        // }

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Successfully Saving the Data!',
        ]);
    }

    public function eventUpdate(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            // 'date_held' => 'required|after_or_equal:' . date('Y-m-d'),
            // 'event_poster' => 'required|image|dimensions:min_width=1918,min_height=1030|max:2048',
            'date_held' => 'required',
            'event_description' => 'required',
            'location_held' => 'required',
            'ticket_category_name.*' => 'required|min:1|string',
            'ticket_category_price.*' => 'required|min:1|integer',
            'ticket_category_quota.*' => 'required|min:1|integer',
        ], [
            'event_name.required' => 'Event name must be included!',
            'date_held.required' => 'Date Held must be included!',
            'event_description.required' => 'Event Description must be included!',
            'location_held.required' => 'Location Held must be included!',
            'ticket_category_name.0' => 'Category Name at least 1!',
            'ticket_category_price.0' => 'Category Price must be included!',
            'ticket_category_quota.0' => 'Category quota must be included!',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        if ($request->hasFile('event_poster')) {

            $poster = $request->file('event_poster');
            $event_poster = 'event_poster-' . rand(1, 100000) . '.' . $poster->getClientOriginalExtension();

            // Store the original image
            $path = Storage::putFileAs('public/event_poster', $poster, $event_poster);

            // // Open the stored image
            // $image = Image::make(storage_path('app/' . $path));

            // // Resize the image to the desired dimensions
            // $image->resize(1917, 1027, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });

            // // Save the resized image
            // $image->save(storage_path('app/' . $path));

            $event = Events::updateOrCreate([
                'event_id' => $request->event_id
            ], [
                'event_name' => $request->event_name,
                'date_held' => $request->date_held,
                'event_description' => $request->event_description,
                'location_held' => $request->location_held,
                'event_poster' => $event_poster,
                'user_id' => 3,
            ]);
        } else {
            $event = Events::updateOrCreate([
                'event_id' => $request->event_id
            ], [
                'event_name' => $request->event_name,
                'date_held' => $request->date_held,
                'event_description' => $request->event_description,
                'location_held' => $request->location_held,
                'user_id' => 3,
            ]);
        }

        // Event Ticket Category
        if ($request->ticket_category_status) {
            for ($x = 0; $x < count($request->ticket_category_name); $x++) {

                $dataCategory = TicketCategory::updateOrCreate([
                    'ticket_category_id' => $request->ticket_category_id[$x],
                ], [
                    'ticket_category_name' => $request->ticket_category_name[$x],
                    'ticket_category_price' => $request->ticket_category_price[$x],
                    'ticket_category_quota' => $request->ticket_category_quota[$x],
                    'ticket_category_status' => $request->ticket_category_status[$x],
                    'event_id' => $event->event_id,
                ]);
            }
        } else {
            for ($x = 0; $x < count($request->ticket_category_name); $x++) {

                $dataCategory = TicketCategory::updateOrCreate([
                    'ticket_category_id' => $request->ticket_category_id[$x],
                ], [
                    'ticket_category_name' => $request->ticket_category_name[$x],
                    'ticket_category_price' => $request->ticket_category_price[$x],
                    'ticket_category_quota' => $request->ticket_category_quota[$x],
                    'event_id' => $event->event_id,
                ]);
            }
        }

        // Event Talent
        for ($x = 0; $x < count($request->event_talent_name); $x++) {

            if ($request->hasFile('event_talent_img' . $x)) {

                $talent_photo = $request->file('event_talent_img')[$x];

                $talent_img = 'event_talent-' . rand(1, 100000) . '.' . $talent_photo->extension();

                $path = Storage::putFileAs('public/event_talent', $talent_photo, $talent_img);

                EventTalent::updateOrCreate([
                    'event_talent_id' => $request->event_talent_id[$x]
                ], [
                    'event_talent_name' => $request->event_talent_name[$x],
                    'event_talent_img' => $talent_img,
                ]);
            } else {
                EventTalent::updateOrCreate([
                    'event_talent_id' => $request->event_talent_id[$x]
                ], [
                    'event_talent_name' => $request->event_talent_name[$x],
                    'event_id' => $event->event_id,
                ]);
            }
        }
        // if ($data == null) {

        //     if ($request->hasFile('event_talent_img' . $x)) {

        //         $talent_photo = $request->file('event_talent_img')[$x];

        //         $talent_img = 'event_talent-' . rand(1, 100000) . '.' . $talent_photo->extension();

        //         $path = Storage::putFileAs('public/event_talent', $talent_photo, $talent_img);

        //         EventTalent::create([
        //             'event_talent_name' => $request->event_talent_name[$x],
        //             'event_talent_img' => $talent_img,
        //         ]);
        //     }
        // } else {
        //     if ($request->hasFile('event_talent_img' . $x)) {

        //         $talent_photo = $request->file('event_talent_img')[$x];

        //         $talent_img = 'event_talent-' . rand(1, 100000) . '.' . $talent_photo->extension();

        //         $path = Storage::putFileAs('public/event_talent', $talent_photo, $talent_img);

        //         EventTalent::updateOrCreate([
        //             'event_talent_id' => $request->event_talent_id[$x]
        //         ], [
        //             'event_talent_name' => $request->event_talent_name[$x],
        //             'event_talent_img' => $talent_img,
        //         ]);
        //     }else{
        //         EventTalent::updateOrCreate([
        //             'event_talent_id' => $request->event_talent_id[$x]
        //         ], [
        //             'event_talent_name' => $request->event_talent_name[$x],
        //         ]);
        //     }

        // }

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Successfully Saving the Data!',
        ]);
    }

    public function eventGetData(Request $request)
    {
        $event = Events::with(['eventTalent', 'ticketCategory'])->where('slug', $request->slug)->first();

        return response()->json($event);
    }

    public function eventShow($slug, Request $request)
    {
        $event = Events::with(['eventTalent', 'ticketCategory'])->where('slug', $slug)->first();

        return view('backend.events.show-event', compact('event'));
    }

    public function eventEdit($slug)
    {
        $event = Events::with(['eventTalent', 'ticketCategory'])->where('slug', $slug)->first();

        return view('backend.events.edit-event', compact('event'));
    }

    public function updateStatusEvent(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'event_status' => 'required|in:publish,listing,archive,finish',
        ], [
            'event_status' => 'Name Must Be Included!',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $event = Events::find($request->event_id);
        $event->update([
            'event_status' => $request->event_status
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Successfully Saving the Data!',
        ]);
    }

    public function ticketCategoryDestory(Request $request)
    {
        TicketCategory::find($request->ticket_category_id)->delete();
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Successfully Delete Ticket Category!',
        ]);
    }
}
