@extends('layouts.app')
@section('htmlheader_title')
    User
@endsection


@section('main-content')
    @include('matte.new_matte')
    @include('matte.new_img')
    <div class="row" id="matte">
        <div class="col-lg-2" style="min-height:500px;background-color: #FFF8DC;">Left
            <div class="center-block text-center" id="new_mette"
                 style="width:100px;height:100px;border: 1px solid black;">
                <label data-target="#modal_def_mette" style="padding: 30%" data-toggle="modal">New Mette</label>
            </div>

            </br>
            </br>

            <div class="center-block text-center" id="new_img"
                 style="width:100px;height:100px;border: 1px solid black;">
                <label data-target="#modal_def_img" style="padding: 30%" data-toggle="modal">New Image</label>
            </div>
        </div>
        <div class="col-lg-8" id="matte-container" style="min-height:500px;max-height:500px;background-color: white">
            {{--<h1 id="text-h1">Lorem ipsum</h1>--}}
            {{--<p id="text-p">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mollis, leo ut hendrerit--}}
            {{--molestie, nunc--}}
            {{--velit commodo urna, aliquet vehicula eros quam nec neque. Etiam quis elementum justo. Proin eget nunc--}}
            {{--erat. Nam et ullamcorper est. Suspendisse tincidunt, odio in varius fringilla, nunc est pellentesque--}}
            {{--sem, a sagittis libero urna a lacus. Ut sed augue eu massa faucibus pellentesque. Nam vel elit arcu, nec--}}
            {{--fringilla tellus. Vestibulum quis volutpat elit. Aenean eu odio diam. Aenean imperdiet condimentum--}}
            {{--tortor, venenatis varius ipsum cursus viverra. Nunc commodo cursus turpis sit amet viverra. Mauris a--}}
            {{--urna a quam varius consectetur. Duis fringilla erat ac urna ultricies ac adipiscing ipsum tincidunt.--}}
            {{--Nullam sagittis consectetur lorem in commodo. Aliquam bibendum egestas mi vel lacinia. Mauris non odio--}}
            {{--odio, faucibus euismod leo.</p>--}}
            {{--<div class="drag">--}}
            {{--<p>Drag me around</p>--}}
            {{--</div>--}}

            {{--<div class="drag2">--}}
            {{--<p>Drag me too around</p>--}}
            {{--</div>--}}
        </div>
        <div class="col-lg-2" id="matte_prop" style="min-height:500px;background-color: #FFF8DC;">Properties</br>
        </div>
    </div>
@endsection

@section('add_scripts')

    <script src="{{ asset('/plugins/jQueryUI/jquery-ui.min.js') }}"></script>


    {{--<script src="{{ asset('/plugins/css-live/microtpl.js') }}"></script>--}}
    {{--<script src="{{ asset('/plugins/css-live/jquery.livecsseditor.js') }}"></script>--}}
    {{--<script src="{{ asset('/plugins/css-live/lce.editors.js') }}"></script>--}}



    <script src="{{ asset('/js/matte.js') }}" type="text/javascript"></script>
@endsection
