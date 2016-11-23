<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


/*Users*/
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username'=>$faker->userName,
        'name' => $faker->firstName,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'active'=>1,
        'location_id'=>function(){
            return factory(App\Location::class)->create()->id;
        },
        'api_token' => str_random(15)

    ];
});

/*Location for users*/
$factory->define(\App\Location::class,function(Faker\Generator $faker){
    return [
        'city_id'=>function(){
            return App\City::all()->random()->id;
        },
        'address'=>$faker->address,
        'appartment_number' => $faker->buildingNumber,
        'zip_code' => $faker->postcode,
        //'location' =>json_encode(array('type' => 'Point', 'coordinates' => array($faker->longitude, $faker->latitude))) ,
        'longitude'=>$faker->longitude,
        'latitude'=>$faker->latitude
    ];
});

$factory->define(App\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'display_name' => $faker->name,
        'description' => $faker->name
    ];
});

/*Frames*/
$factory->define(App\Frame::class,function (Faker\Generator $faker) {

    return [
        'name'=>$faker->name,
        'top' => $faker->imageUrl(),
        'left' => $faker->imageUrl(),
        'bottom' => $faker->imageUrl(),
        'right' => $faker->imageUrl()
    ];
});

/*Colors*/
$factory->define(App\Color::class,function (Faker\Generator $faker) {

    return [
        'name'=>$faker->name,
        'code' => $faker->rgbCssColor
    ];
});

/*Size*/
$factory->define(App\Size::class,function (Faker\Generator $faker) {

    return [
        'name'=>$faker->name,
        'height' => $faker->numberBetween(5,14),
        'width' => $faker->numberBetween(5,14)
    ];
});

/*Text*/
$factory->define(App\Text::class,function (Faker\Generator $faker) {
    $positions= ['Top','Bottom'];
    return [
        'text'=>$faker->text(50),
        'engravedplate_id'=>function(){
            return App\EngravedPlate::all()->random()->id;
        }
    ];
});

/*status*/
$factory->define(App\Status::class,function (Faker\Generator $faker) {
    return [
        'name'=>$faker->name,
    ];
});

/*Image Templates*/
$factory->define(App\ImgTemplate::class,function (Faker\Generator $faker) {
    $orientations= ['Portrait','Landscape'];
    return [
        'name'=>$faker->name,
        'orientation'=>$faker->randomElement($orientations),
//        'roundedCorners'=>false,
        'cornerRadio'=>0,
        'height'=>$faker->numberBetween(7,23),
        'width'=>$faker->numberBetween(7,23),
    ];
});
/*Engraved Plates*/
$factory->define(App\EngravedPlate::class,function (Faker\Generator $faker) {

    return [
        'name'=>$faker->name,
        'textStyle'=>$faker->text(150),
        'plateStyle'=>$faker->text(150),
        'height'=>$faker->numberBetween(7,23),
        'width'=>$faker->numberBetween(7,23),
    ];
});

/*Project*/
$factory->define(App\Project::class,function (Faker\Generator $faker) {
   /* $pn = str_random(10);
    Storage::disk('s3')->put($pn.'.jpeg', file_get_contents($faker->imageUrl(96,96,'people',false)));
    $prev=Storage::url($pn.'.jpeg');*/
    return [
        'name'=>$faker->name,
        'hash_name'=>unique_random('projects','hash_name'),
        'price'=>$faker->randomFloat(2,10,50),
        'preview'=>$faker->imageUrl(96,96,'people',false),
        'frame_id'=>function(){
            return App\Frame::all()->random()->id;
        },
        'background_color_id'=>function(){
            return App\Color::all()->random()->id;
        },
        'matte_template_id'=>function(){
            return App\MatteTemplate::all()->random()->id;
        },
        'owner_id'=>function(){
            return App\User::all()->random()->id;
        }

    ];
});

/*Order's attributes*/
$factory->define(App\AtributeOrder::class,function (Faker\Generator $faker) {
    return [
        'name'=>$faker->name,
        'deductible_price'=>$faker->randomFloat(2,10,20),
        'description'=>$faker->text()

    ];
});

/*Orders*/
$factory->define(App\Order::class,function (Faker\Generator $faker) {
    return [
        'notes'=>$faker->realText(),
        'order_number'=>unique_random('orders','order_number',10),
        'status_id'=>function(){
            return App\Status::all()->random()->id;
        }
    ];
});

/*Matte Templates*/
$factory->define(App\MatteTemplate::class, function (Faker\Generator $faker) {
    $orientations= ['Vertical','Horizontal'];

    return [
        'name'=>unique_random('matte_templates','name','10'),
        'description'=>$faker->text,
        'orientation'=>$faker->randomElement($orientations),
        'thumbnail' => "",
        'height'=>rand(7,23),
        'width'=>rand(7,33),
        'margin'=>$faker->randomFloat(1,2,4),
        'rows'=>rand(1,3),
        'columns'=>rand(1,3),
        'size_id'=> function(){
            return App\Size::all()->random()->id;
        }
    ];
});

/*Images*/
$factory->define(App\Image::class, function (Faker\Generator $faker) {

    return [
        'name'=>unique_random('images','name','255'),
        'url'=>$faker->imageUrl()
    ];
});

/*City*/
$factory->define(App\City::class,function(Faker\Generator $faker){

    return [
        'name'=>$faker->city,
        'state_id'=>function(){
            return App\State::all()->random()->id;
        }

    ];
});

