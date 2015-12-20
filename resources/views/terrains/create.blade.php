@extends('front.template')
<header role="banner">

    <div id="flags" class="text-center"></div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">{{ trans('front/site.title') }}</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li {!! classActivePath('/') !!}>
                        {!! link_to('/terrain', trans('front/site.home')) !!}
                    </li>
                    @if(session('statut') == 'visitor' || session('statut') == 'user')
                    @endif
                    @if(Request::is('auth/register'))
                        <li class="active">
                            {!! link_to('auth/register', trans('front/site.register')) !!}
                        </li>
                    @elseif(Request::is('password/email'))
                        <li class="active">
                            {!! link_to('password/email', trans('front/site.forget-password')) !!}
                        </li>
                    @else
                        @if(session('statut') == 'visitor')
                            <li {!! classActivePath('auth/login') !!}>
                                {!! link_to('auth/login', trans('front/site.connection')) !!}
                            </li>
                        @else
                            @if(session('statut') == 'admin')
                                <li>
                                    {!! link_to_route('admin', trans('front/site.administration')) !!}
                                </li>
                            @elseif(session('statut') == 'redac')
                                <li>
                                    {!! link_to('blog', trans('front/site.redaction')) !!}
                                </li>
                            @endif
                            <li>
                                {!! link_to('auth/logout', trans('front/site.logout')) !!}
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('header')
</header>

@section('main')
    {!! HTML::script('//maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry&.js') !!}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.js') !!}

    <div class="col-md-4">
        <h2>Adauga un teren nou</h2>
        {!! Form::open(['url'=> 'terrain', 'class' => 'form_submit']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Name:') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <input type="hidden" id="save_encoded"  />
            {!! Form::label('history', 'History:') !!}
            {!! Form::textarea('history', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-default" id="btn_submit">Salvează</button>
            <button type="button" class="coordonate">log coordonate</button>
        </div>
        
        <div>
            <input id="clear_shapes" value="clear shapes"    type="button"  />
            <input id="save_encoded" value="save encoded(IO.IN(shapes,true))"    type="button" />
            <input id="save_raw"     value="save raw(IO.IN(shapes,false))"        type="button" />
            <input id="data"         value=""                style="width:100%" readonly/>
            <input id="restore"      value="restore(IO.OUT(array,map))"         type="button" />
        </div>

    </div>
    <div class="col-md-6">
        <div class="map" id="map_in"></div>
        <script>
        var goo = {};
        var shapes = [];
            function initialize()
            {
                goo             = google.maps,
                        map_in          = new goo.Map(document.getElementById('map_in'),
                                { 
                                    zoom: 12,
                                    center: new goo.LatLng(44.42684, 26.1025)
                                }),
                        shapes          = [],
                        selected_shape  = null,
                        drawman         = new goo.drawing.DrawingManager({map:map_in}),
                        byId            = function(s){return document.getElementById(s)},
                        clearSelection  = function(){
                            if(selected_shape){
                                selected_shape.set((selected_shape.type
                                        ===
                                        google.maps.drawing.OverlayType.MARKER
                                )?'draggable':'editable',false);
                                selected_shape = null;
                            }
                        },
                        setSelection    = function(shape){
                            clearSelection();
                            selected_shape=shape;

                            selected_shape.set((selected_shape.type
                                    ===
                                    google.maps.drawing.OverlayType.MARKER
                            )?'draggable':'editable',true);

                        },
                        clearShapes     = function(){
                            for(var i=0;i<shapes.length;++i){
                                shapes[i].setMap(null);
                            }
                            shapes=[];
                        };

                goo.event.addListener(drawman, 'overlaycomplete', function(e) {
                    var shape   = e.overlay;
                    shape.type  = e.type;
                    goo.event.addListener(shape, 'click', function() {
                        setSelection(this);
                    });
                    setSelection(shape);
                    shapes.push(shape);
                });

                goo.event.addListener(map_in, 'click',clearSelection);
                goo.event.addDomListener(byId('clear_shapes'), 'click', clearShapes);
                goo.event.addDomListener(byId('save_encoded'), 'click', function(){
                    console.log(data);
                    var data=IO.IN(shapes,true);
                    byId('data').value=JSON.stringify(data);});


                goo.event.addDomListener(byId('btn_submit'), 'click', function(){
                    console.log(shapes);
                    var data=IO.IN(shapes,false);
                    byId('data').value=JSON.stringify(data);
//                    in situatia asta facem aici ajax-ul de insert
                    saveData(data);
                });


                goo.event.addDomListener(byId('restore'), 'click', function(){
                    var data = getData();
                    // [{"type":"RECTANGLE","id":null,"geometry":[[44.462537393755454,26.059348569251597],[44.506136867703425,26.11222027335316]]}]
                    // {"type":"RECTANGLE","id":null,"geometry":[["44.44682598206631","26.06258390005678"],["44.48333421713131","26.133308387361467"]]}]
                    console.log(data);
                    console.log(JSON.parse(data));
                    if(this.shapes){
                        for(var i=0;i<this.shapes.length;++i){
                            this.shapes[i].setMap(null);
                        }
                    }
                    console.log(data);
                    IO.OUT(JSON.parse(data),map_in);
                });

            }


            var IO={
                //returns array with storable google.maps.Overlay-definitions
                IN:function(arr,//array with google.maps.Overlays
                            encoded//boolean indicating whether pathes should be stored encoded
                ){
                    var shapes     = [],
                            goo=google.maps,
                            shape,tmp;

                    for(var i = 0; i < arr.length; i++)
                    {
                        shape=arr[i];
                        tmp={type:this.t_(shape.type),id:shape.id||null};


                        switch(tmp.type){
                            case 'CIRCLE':
                                tmp.radius=shape.getRadius();
                                tmp.geometry=this.p_(shape.getCenter());
                                break;
                            case 'MARKER':
                                tmp.geometry=this.p_(shape.getPosition());
                                break;
                            case 'RECTANGLE':
                                tmp.geometry=this.b_(shape.getBounds());
                                break;
                            case 'POLYLINE':
                                tmp.geometry=this.l_(shape.getPath(),encoded);
                                break;
                            case 'POLYGON':
                                tmp.geometry=this.m_(shape.getPaths(),encoded);

                                break;
                        }
                        shapes.push(tmp);
                    }

                    return shapes;
                },
                //returns array with google.maps.Overlays
                OUT:function(arr,//array containg the stored shape-definitions
                             map//map where to draw the shapes
                ){
                    var shapes     = [],
                            goo=google.maps,
                            map=map||null,
                            shape,tmp;

                    for(var i = 0; i < arr.length; i++)
                    {
                        shape=arr[i];

                        switch(shape.type){
                            case 'CIRCLE':
                                tmp=new goo.Circle({radius:Number(shape.radius),center:this.pp_.apply(this,shape.geometry)});
                                break;
                            case 'MARKER':
                                tmp=new goo.Marker({position:this.pp_.apply(this,shape.geometry)});
                                break;
                            case 'RECTANGLE':
                                tmp=new goo.Rectangle({bounds:this.bb_.apply(this,shape.geometry)});
                                break;
                            case 'POLYLINE':
                                tmp=new goo.Polyline({path:this.ll_(shape.geometry)});
                                break;
                            case 'POLYGON':
                                tmp=new goo.Polygon({paths:this.mm_(shape.geometry)});

                                break;
                        }
                        tmp.setValues({map:map,id:shape.id})
                        shapes.push(tmp);
                    }
                    return shapes;
                },
                l_:function(path,e){
                    path=(path.getArray)?path.getArray():path;
                    if(e){
                        return google.maps.geometry.encoding.encodePath(path);
                    }else{
                        var r=[];
                        for(var i=0;i<path.length;++i){
                            r.push(this.p_(path[i]));
                        }
                        return r;
                    }
                },
                ll_:function(path){
                    if(typeof path==='string'){
                        return google.maps.geometry.encoding.decodePath(path);
                    }
                    else{
                        var r=[];
                        for(var i=0;i<path.length;++i){
                            r.push(this.pp_.apply(this,path[i]));
                        }
                        return r;
                    }
                },

                m_:function(paths,e){
                    var r=[];
                    paths=(paths.getArray)?paths.getArray():paths;
                    for(var i=0;i<paths.length;++i){
                        r.push(this.l_(paths[i],e));
                    }
                    return r;
                },
                mm_:function(paths){
                    var r=[];
                    for(var i=0;i<paths.length;++i){
                        r.push(this.ll_.call(this,paths[i]));

                    }
                    return r;
                },
                p_:function(latLng){
                    return([latLng.lat(),latLng.lng()]);
                },
                pp_:function(lat,lng){
                    return new google.maps.LatLng(lat,lng);
                },
                b_:function(bounds){
                    return([this.p_(bounds.getSouthWest()),
                        this.p_(bounds.getNorthEast())]);
                },
                bb_:function(sw,ne){
                    return new google.maps.LatLngBounds(this.pp_.apply(this,sw),
                            this.pp_.apply(this,ne));
                },
                t_:function(s){
                    var t=['CIRCLE','MARKER','RECTANGLE','POLYLINE','POLYGON'];
                    for(var i=0;i<t.length;++i){
                        if(s===google.maps.drawing.OverlayType[t[i]]){
                            return t[i];
                        }
                    }
                }

            }
            google.maps.event.addDomListener(window, 'load', initialize);
            
            
        </script>
    </div>
    {!! Form::close() !!}

@stop

@section('scripts')
    <script>
        var save_url = "{!! route('terain-save-coordonate')  !!}";

        var saveData = function(data){
            console.log(data)
            window.data_ = data;
           /* $.ajax({
                url: save_url,
                type: 'POST',
                data: {data: data, _token: $('[name=_token]').val()},
                success: function(response){
                    console.log(response);
                }
            }).done(function(data){
                console.log('FINISH');
           }); */ 
        }

        jQuery(document).ready(function($) {
            $(".form_submit").on("submit", function( event ) { 
               event.preventDefault();
               var data = { form: $(this).serialize(), coords: window.data_, _token: $('[name=_token]').val() };
               console.log(data);

               $.ajax({
                        method: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: data,
                        dataType: "json",
                        success: function(data){
                         // do stuff 
                         console.log(data);
                         // location.reload();
                        },
                        error: function(data){
                         // do stuff 
                         console.log(data);
                        }
                 })
             
          });

            setTimeout(function(){
                $('#restore').click()
            }
            , 1000);
        }); 
     

        var getData = function(){
            var out = [];
              $.ajax({
                url: save_url,
                type: 'POST',
                async: false,
                data: {_token: $('[name=_token]').val()},
                success: function(response){
                    out = response;
                    console.log(response);
                }
            }).done(function(data){
                console.log('FINISH');
           });  
                    return out;

        }


    </script>
@stop