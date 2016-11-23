<?php

namespace App\Http\Controllers;

use App\Color;
use App\Frame;
use App\Image;
use App\MatteTemplate;
use App\User;
use Illuminate\Http\Request;

use App\Project;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Http\Response;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$user)
    {
        try{
            $qb=Project::query();
            return $qb->where('owner_id', '=', $user)
                /*->with(array('images' => function($query) {
                        $query->Select(array('url', 'project_id','imgtemplate_id'));
                    }))*/
                ->select(array('id','name','hash_name','price','preview','frame_id AS frame','background_color_id AS background','matte_template_id AS matte','favorite'))
                ->orderBy('id','desc')
                ->simplePaginate(10);

        }catch(\Exception $e){
            dd($e->getMessage());
            return new Response(Helper::globalMessage(),500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pullToRefresh(Request $request,$user,$lp)
    {
        try{
            $qb=Project::query();
            return $qb->where('id','>',$lp)
                ->where('owner_id', '=', $user)
                /*->with(array('images' => function($query) {
                    $query->Select(array('url', 'project_id','imgtemplate_id'));
                }))*/
                ->select(array('id','name','hash_name','price','preview','frame_id AS frame','background_color_id AS background','matte_template_id AS matte','favorite'))
                ->orderBy('id')
                ->simplePaginate(5);
        }catch(\Exception $e){
            /*dd($e->getMessage());*/
            return new Response(Helper::globalMessage(),500);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$user)
    {

        try{
            $data = $request->all();
            $validator = $this->validator($data);
            if ($validator->fails()) {
                $result['status'] = "failure";
                $result['message'] = $validator->errors()->getMessages();
                return response()->json($result);
            }
            $backcolor= Color::where('code',$data['background_color_id'])->first();
            if(!$backcolor){
                $result['status'] = "failure";
                $result['message'] = "The background color specified not exist, please take another.";
                return response()->json($result);
            }
            $frame= Frame::find($data['frame_id']);
            if(!$frame){
                $result['status'] = "failure";
                $result['message'] = "The frame specified not exist, please take another.";
                return response()->json($result);
            }
            $matte= MatteTemplate::find($data['matte_template_id']);
            if(!$matte){
                $result['status'] = "failure";
                $result['message'] = "The matte template specified not exist, please take another.";
                return response()->json($result);
            }
            $user= User::find($user);
            if(!$user){
                $result['status'] = "failure";
                $result['message'] = "You need to be logged in to create projects.";
                return response()->json($result);
            }

            $entity = new Project();
            $entity->preview =$data['preview'];
            $entity->name=$data['name'];
            $entity->hash_name=$data['hash_name'];
            $entity->price=0;
            $entity->background_color()->associate($backcolor);
            $entity->mattetemplate()->associate($matte);
            $entity->frame()->associate($frame);
            $entity->owner()->associate($user);
            $entity->save();
            if (!empty($data['images'])) {
                $imgs = json_decode($data['images'], true);
                if(count($imgs)!=count($matte->imgtemplates)){
                    $entity->delete();
                    throw  new \Exception("You need to provide all images of the template.");
                }
                foreach ($imgs as $img) {
                    if ($img["url"] == null) {
                        $entity->delete();
                        throw  new \Exception("You need to provide all images of the template.");
                    }if ($img["imgTpl"] == null) {
                        $entity->delete();
                        throw  new \Exception("You need to provide all images of the template.");
                    }
                    $imgItem = new Image();
                    $imgItem->name =$img["name"];
                    $imgItem->imgtemplate_id=$img["imgTpl"];
                    $imgItem->url = $img["url"];
                    $entity->images()->save($imgItem);
                }
            }
            $result['status'] = "success";
            $result['message'] = "Project created successfully";
            return response()->json($result);
        }catch(\Exception $e){
            return new Response($e->getMessage(),500);
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$user, $id)
    {
        try{

            $entity = Project::find($id);

            //dd($entity->getAttributes());
            if(!$entity){
                $result['status'] = "failure";
                $result['message'] = "We don't have this project in our records. Please refresh your project list.";
                return response()->json($result);
            }
            $user = User::find($user);
            if(!$user){
                $result['status'] = "failure";
                $result['message'] = "We don't have the owner of this project in our records. Please call for support.";
                return response()->json($result);
            }
            $data = $request->all();

            $validator = $this->validator($data);
            if ($validator->fails()) {
                $result['status'] = "failure";
                $result['message'] = $validator->errors()->getMessages();
                return response()->json($result);
            }
            $backcolor= Color::find($data['background_color_id']);
            if(!$backcolor){
                $result['status'] = "failure";
                $result['message'] = "The background color specified not exist, please take another.";
                return response()->json($result);
            }
            $frame= Frame::find($data['frame_id']);
            if(!$frame){
                $result['status'] = "failure";
                $result['message'] = "The frame specified not exist, please take another.";
                return response()->json($result);
            }
            $entity->fill($data);
            $entity->background_color()->associate($backcolor);
            $entity->frame()->associate($frame);
            //Not Neccesary for now, because whe an user edit project only overwrite the file,
            //never change your name or your url inside of your phone

           /* $imgs = json_decode($data['images'], true);
            foreach ($entity->images() as $key => $image){
                if(isset($imgs[$key])){
                    $image->fill($imgs[$key]);
                    $image->save();
                }
            }*/
            $entity->save();
            $result['status'] = "success";
            $result['message'] = "Project successfully updated.";
            return response()->json($result);
        }catch(\Exception $e){
            return new Response($e->getMessage(),500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
            'hash_name'=>'required|max:255',
            'preview'=>'required',

        ]);
    }

    /**
     * Toggle a favorite attr of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function toggleFavorite(Request $request,$user_id,$project_id)
    {
        try{
            $entity = Project::find($project_id);
            if(!($entity instanceof Project)){
                throw  new \Exception("The project specified not exist, please update your project list.");
            }
            $user = User::find($user_id);
            if(!($user instanceof  User)){
                throw new \Exception("Your user not exist, please call for support.");
            }else{

                if($user!=$entity->owner){
                    throw new \Exception("Only the owner of the project can toggle favorites this project.");
                }
            }
            $entity->favorite = !$entity->favorite;
            if($entity->save()){
                $result['status'] = "success";
                $result['data']['result']=$entity->favorite;
                $result['message'] = "Project successfully updated.";
                return response()->json($result);
            }
            throw new \Exception("An error ocurred during the escecution of the save proccess.");
        }catch(\Exception $e){
            /*dd($e->getMessage());*/
            return new Response($e->getMessage(),500);
        }
    }

}
