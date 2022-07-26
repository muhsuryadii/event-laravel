<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;



class AdminEventJSController extends Controller
{
    //
    public function create()
    {
        //
        return view('pages.admin.event.createWithStepper', [
            'user' => Auth::user(),
        ]);
    }

    private function validateEvent($uuid)
    {
        $event = Event::where('uuid', $uuid)->first();

        if ($event) {
            return $event;
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }
    }

    public function storeInformation(Request $request)
    {

        $uuid = $request->uuid_event;

        $lokasi_acara = $request->tipe_acara == 'online' ? $request->lokasi_acara_online : $request->lokasi_acara_offline;

        $harga_tiket = $request->harga_tiket == 'gratis' ? 0 : ($request->harga_tiket_bayar == null ? 0 : $request->harga_tiket_bayar);

        $eventData = [
            'id_panitia' => $request->id_penyelenggara_event,
            'nama_event' => $request->nama_event,
            'uuid' =>   $uuid,
            'waktu_acara' => $request->waktu_acara,
            'harga_tiket' => (int)$harga_tiket,
            'kuota_tiket' => (int) $request->kuota_tiket,
            'lokasi_acara' => $lokasi_acara,
            'tipe_acara' => $request->tipe_acara
        ];

        $event = Event::where('uuid', $uuid)->first();

        if ($event) {
            $validator =  Validator::make($eventData, [
                'id_panitia' => 'required|exists:users,id',
                'nama_event' => 'required|max:255',
                'uuid' => 'required',
                'waktu_acara' => 'required|after_or_equal:today',
                'harga_tiket' => 'required|numeric',
                'kuota_tiket' => 'required|numeric',
                'lokasi_acara' => 'required|max:255',
                'tipe_acara' => 'required'
            ])->validate();

            $event->update($validator);
            return response()->json([
                'success' => true,
                'message' => 'Event success updated',
            ], 201);
        } else {
            $validator =  Validator::make($eventData, [
                'id_panitia' => 'required|exists:users,id',
                'nama_event' => 'required|max:255',
                'uuid' => 'required|unique:events,uuid',
                'waktu_acara' => 'required|after_or_equal:today',
                'harga_tiket' => 'required|numeric',
                'kuota_tiket' => 'required|numeric',
                'lokasi_acara' => 'required|max:255',
                'tipe_acara' => 'required'
            ])->validate();
            Event::create($validator);
            return response()->json([
                'success' => true,
                'message' => 'Event success created',
            ], 201);
        }
    }

    public function storeDescription(Request $request)
    {
        $uuid = $request->uuid_event;
        $event = $this->validateEvent($uuid);

        $descriptionData = [
            'deskripsi_acara' => $request->deskripsi_acara,
        ];

        $validator =  Validator::make($descriptionData, [
            'deskripsi_acara' => 'required',
        ])->validate();

        $event->update($validator);

        return response()->json([
            'success' => true,
            'message' => 'Description Event updated',
        ]);
    }

    public function storeHumas(Request $request)
    {
        $uuid = $request->uuid_event;
        $humaslist = $request->humasList;
        $event = $this->validateEvent($uuid);

        $humasCheck = DB::table('humas')->where('id_event', $event->id)->get();


        if (count($humasCheck) == 0) {
            foreach ($humaslist as $humas) {
                $data = [
                    'id_event' => $event->id,
                    'nama' => $humas['nama_humas'],
                    'no_wa' => $humas['no_wa'],
                    'uuid' => Str::uuid()->getHex(),
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $validator =  Validator::make($data, [
                    'id_event' => 'required|exists:events,id',
                    'nama' => 'required|max:255',
                    'no_wa' => 'required|max:255',
                    'uuid' => 'required|unique:humas,uuid',
                    'created_at' => 'required',
                    'updated_at' => 'required'
                ])->validate();
                DB::table('humas')->insert($validator);
            }

            return response()->json([
                'success' => true,
                'message' => 'Humas Event created',
            ]);
        } else {
            DB::table('humas')->where('id_event', $event->id)->delete();

            foreach ($humaslist as $humas) {
                $data = [
                    'id_event' => $event->id,
                    'nama' => $humas['nama_humas'],
                    'no_wa' => $humas['no_wa'],
                    'uuid' => Str::uuid()->getHex(),
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $validator =  Validator::make($data, [
                    'id_event' => 'required|exists:events,id',
                    'nama' => 'required|max:255',
                    'no_wa' => 'required|max:255',
                    'uuid' => 'required|unique:humas,uuid',
                    'created_at' => 'required',
                    'updated_at' => 'required'
                ])->validate();
                DB::table('humas')->insert($validator);
            }
            return response()->json([
                'success' => true,
                'message' => 'Humas Event Updated',
            ]);
        }
    }

    public function storeMedia(Request $request)
    {
        $path = null;
        if ($request->file('file')) {
            $path = $request->file('file')->store('images/events');
        }

        return response()->json([
            'success' => true,
            'message' => 'Media stored',
            'path' => $path
        ]);
    }

    public function storePamflet(Request $request)
    {
        $uuid = $request->uuid_event;
        $event = $this->validateEvent($uuid);

        if ($request->uuid_event && $request->image) {
            $pamfletData = [
                'famplet_acara_path' => $request->image,
                'updated_at' => now()
            ];

            $validator =  Validator::make($pamfletData, [
                'famplet_acara_path' => 'required',
                'updated_at' => 'required',
            ])->validate();

            $event->update($validator);

            return response()->json([
                'success' => true,
                'message' => 'Pamflet Event updated',
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'ok',
            ]);
        }
    }

    public function storeCertificate(Request $request)
    {
        $url = null;
        $uuid = $request->uuid_event;
        $event = $this->validateEvent($uuid);

        if ($request->file('file')) {
            $image = $request->file('file');
            $path = $image->hashName('images/certificates_template');
            $certificate = Image::make($image->getRealPath())->resize(800, 550);
            Storage::put($path, (string) $certificate->encode());

            $url = $path;
        }

        if ($url) {
            /* Update certificate ready on Events table */
            $certificateData = [
                'is_certificate_ready' => true,
                'updated_at' => now()
            ];
            $event->update($certificateData);

            /* Update certificate_layout table */
            $certificateLayout = DB::table('certificate_layouts')->where('id_event', $event->id)->first();

            if ($certificateLayout) {
                $certificateLayoutData = [
                    'certificate_path' => $url,
                    'x_coordinate_name' => (int) $request->xCoordinate,
                    'y_coordinate_name' => (int) $request->yCoordinate,
                    'heightName' => (int) $request->heightName,
                    'font' => $request->font,
                    'fontSize' => (int) $request->fontsize,
                    'color' => $request->color,
                    'updated_at' => now()
                ];
                DB::table('certificate_layouts')->where('id_event', $event->id)->update($certificateLayoutData);
            } else {
                $certificateLayoutData = [
                    'uuid' => Str::uuid()->getHex(),
                    'id_event' => $event->id,
                    'certificate_path' => $url,
                    'x_coordinate_name' => (int) $request->xCoordinate,
                    'y_coordinate_name' => (int) $request->yCoordinate,
                    'heightName' => (int) $request->heightName,
                    'font' => $request->font,
                    'fontSize' => (int) $request->fontsize,
                    'color' => $request->color,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                DB::table('certificate_layouts')->insert($certificateLayoutData);
            }

            return response()->json([
                'success' => true,
                'message' => 'Sertificate stored successfully'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Ok'
        ]);
    }

    public function updateInformation(Request $request, $uuid)
    {
        $lokasi_acara = $request->tipe_acara == 'online' ? $request->lokasi_acara_online : $request->lokasi_acara_offline;

        $harga_tiket = $request->harga_tiket == 'gratis' ? 0 : ($request->harga_tiket_bayar == null ? 0 : $request->harga_tiket_bayar);

        $eventData = [
            'id_panitia' => $request->id_penyelenggara_event,
            'nama_event' => $request->nama_event,
            'waktu_acara' => $request->waktu_acara,
            'harga_tiket' => (int)$harga_tiket,
            'kuota_tiket' => (int) $request->kuota_tiket,
            'lokasi_acara' => $lokasi_acara,
            'tipe_acara' => $request->tipe_acara
        ];

        $event = Event::where('uuid', $uuid)->first();

        $validator =  Validator::make($eventData, [
            'id_panitia' => 'required|exists:users,id',
            'nama_event' => 'required|max:255',
            'waktu_acara' => 'required|after_or_equal:today',
            'harga_tiket' => 'required|numeric',
            'kuota_tiket' => 'required|numeric',
            'lokasi_acara' => 'required|max:255',
            'tipe_acara' => 'required'
        ])->validate();

        $event->update($validator);
        return response()->json([
            'success' => true,
            'message' => 'Event success updated',
        ]);
    }

    public function updateDescription(Request $request, $uuid)
    {
        $event = Event::where('uuid', $uuid)->first();

        $descriptionData = [
            'deskripsi_acara' => $request->deskripsi_acara,
        ];

        $validator =  Validator::make($descriptionData, [
            'deskripsi_acara' => 'required',
        ])->validate();

        $event->update($validator);

        return response()->json([
            'success' => true,
            'message' => 'Description Event updated',
        ]);
    }

    public function updateHumas(Request $request, $uuid)
    {
        $humaslist = $request->humasList;
        $event = Event::where('uuid', $uuid)->first();

        $humasCheck = DB::table('humas')->where('id_event', $event->id)->get();

        if (count($humasCheck) == 0) {
            foreach ($humaslist as $humas) {
                $data = [
                    'id_event' => $event->id,
                    'nama' => $humas['nama_humas'],
                    'no_wa' => $humas['no_wa'],
                    'uuid' => Str::uuid()->getHex(),
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $validator =  Validator::make($data, [
                    'id_event' => 'required|exists:events,id',
                    'nama' => 'required|max:255',
                    'no_wa' => 'required|max:255',
                    'uuid' => 'required|unique:humas,uuid',
                    'created_at' => 'required',
                    'updated_at' => 'required'
                ])->validate();
                DB::table('humas')->insert($validator);
            }

            return response()->json([
                'success' => true,
                'message' => 'Humas Event created',
            ]);
        } else {
            DB::table('humas')->where('id_event', $event->id)->delete();

            foreach ($humaslist as $humas) {
                $data = [
                    'id_event' => $event->id,
                    'nama' => $humas['nama_humas'],
                    'no_wa' => $humas['no_wa'],
                    'uuid' => Str::uuid()->getHex(),
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $validator =  Validator::make($data, [
                    'id_event' => 'required|exists:events,id',
                    'nama' => 'required|max:255',
                    'no_wa' => 'required|max:255',
                    'uuid' => 'required|unique:humas,uuid',
                    'created_at' => 'required',
                    'updated_at' => 'required'
                ])->validate();
                DB::table('humas')->insert($validator);
            }
            return response()->json([
                'success' => true,
                'message' => 'Humas Event Updated',
            ]);
        }
    }

    public function updateMedia(Request $request, $uuid)
    {
        $path = null;
        if ($request->file('file')) {
            $path = $request->file('file')->store('images/events');
        }

        return response()->json([
            'success' => true,
            'message' => 'Media stored',
            'path' => $path
        ]);
    }

    public function updatePamflet(Request $request, $uuid)
    {
        $events = Event::where('uuid', $uuid)->first();

        if ($request->image) {
            $pamfletData = [
                'famplet_acara_path' => $request->image,
                'updated_at' => now()
            ];

            $validator =  Validator::make($pamfletData, [
                'famplet_acara_path' => 'required',
                'updated_at' => 'required',
            ])->validate();

            $events->update($validator);

            return response()->json([
                'success' => true,
                'message' => 'Pamflet Event updated',
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'ok',
            ]);
        }
    }
    public function updateCertificate(Request $request, $uuid)
    {
        $url = null;
        $uuid = $request->uuid_event;
        $event = $this->validateEvent($uuid);

        if ($request->file('file')) {
            $image = $request->file('file');
            $path = $image->hashName('images/certificates_template');
            $certificate = Image::make($image->getRealPath())->resize(800, 550);
            Storage::put($path, (string) $certificate->encode());

            $url = $path;
        }

        if ($url) {
            /* Update certificate ready on Events table */
            $certificateData = [
                'is_certificate_ready' => true,
                'updated_at' => now()
            ];
            $event->update($certificateData);

            /* Update certificate_layout table */
            $certificateLayout = DB::table('certificate_layouts')->where('id_event', $event->id)->first();

            if ($certificateLayout) {
                $certificateLayoutData = [
                    'certificate_path' => $url,
                    'x_coordinate_name' => (int) $request->xCoordinate,
                    'y_coordinate_name' => (int) $request->yCoordinate,
                    'heightName' => (int) $request->heightName,
                    'font' => $request->font,
                    'fontSize' => (int) $request->fontsize,
                    'color' => $request->color,
                    'updated_at' => now()
                ];
                DB::table('certificate_layouts')->where('id_event', $event->id)->update($certificateLayoutData);
            } else {
                $certificateLayoutData = [
                    'uuid' => Str::uuid()->getHex(),
                    'id_event' => $event->id,
                    'certificate_path' => $url,
                    'x_coordinate_name' => (int) $request->xCoordinate,
                    'y_coordinate_name' => (int) $request->yCoordinate,
                    'heightName' => (int) $request->heightName,
                    'font' => $request->font,
                    'fontSize' => (int) $request->fontsize,
                    'color' => $request->color,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                DB::table('certificate_layouts')->insert($certificateLayoutData);
            }

            return response()->json([
                'success' => true,
                'message' => 'Sertificate stored successfully'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Ok'
        ]);
    }
}

