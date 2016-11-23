<?php

namespace App\Http\Controllers;

use App\ImgTemplate;
use App\MatteTemplate;
use App\EngravedPlate;
use App\Size;
use Illuminate\Http\Request;

use App\Http\Requests;

class MatteDesignController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function mette_index()
    {
        return view('matte.matte');
    }

    /**
     * Get a validator for an incoming project request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'hash_name' => 'required|max:255',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


//        try {
        $data = $request->all();

        $matte = MatteTemplate::where('name', '=', $data['matte']['name'])->first();


        if ($matte) {
            $result['status'] = "failure";
            $result['message'] = "The Matte Template exist.";
            return response()->json($result);
        }

        $matte = MatteTemplate::create($data['matte']);
        $size = Size::firstOrCreate(['height' => $data['matte']['height'], 'name' => $data['matte']['name'], 'width' => $data['matte']['width']]);
        $matte->size()->associate($size);
        $matte->save();


        foreach ($data['img'] as $img) {

            if ($img['type'] == 'Image') {
                $img_templete_id = ImgTemplate::firstOrCreate(['height' => $img['height'], 'orientation' => $img['orientation'], 'cornerRadio' => $img['name'], 'name' => $img['name'], 'width' => $img['width']]);

                $matte->imgtemplates()->attach($img_templete_id, ['row' => $img['row'], 'column' => $img['column'], 'rowspan' => $img['rowspan'], 'colspan' => $img['colspan'], 'marginTop' => $img['marginTop'],
                    'marginLeft' => $img['marginLeft'], 'marginRight' => $img['marginRight'], 'marginBottom' => $img['marginBottom'], 'order' => $img['order']]);
                $matte->save();
            } else {
                $img_templete_id = EngravedPlate::firstOrCreate(['height' => $img['height'], 'name' => $img['name'], 'width' => $img['width']]);
                $matte->engravedplates()->attach($img_templete_id, ['row' => $img['row'], 'column' => $img['column'], 'rowspan' => $img['rowspan'], 'colspan' => $img['colspan'], 'marginTop' => $img['marginTop'],
                    'marginLeft' => $img['marginLeft'], 'marginRight' => $img['marginRight'], 'marginBottom' => $img['marginBottom'], 'order' => $img['order']]);
                $matte->save();
            }
        }

        $result['status'] = "success";
        $result['message'] = "Matte templete created successfully";
        return response()->json($result);
//        } catch (\Exception $e) {
//            return new Response($e->getMessage(), 500);
//        }


    }


    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function editor_index()
    {
        return view('matte.editor');
    }
}
