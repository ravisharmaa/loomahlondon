<div class="container" style="margin:0;">
        <h1>Add a Rug</h1>
        <div class="clearboth"></div>
        <div class="info">
            Provide the Colourway Details and its image that you wish to add.
        </div>

        {{Form::open(['route'=>$base_route.'.store','method'=>'POST','id'=>'form_rug_add','enctype'=>'multipart/form-data','files'=>true])}}
        {{Form::hidden('product_id',$product_data->product_id,['id'=>'product_id'])}}
            @include('cms.colourway.partials._form',['btnText'=>'Save'])
       {{Form::close()}}
        <script>
            $(function(){
                $("document").ready(function(){
                    $("#rug_image").click(function(){
                        var rug_image = $(this);
                        console.log(rug_image);
                    })
                });

                $('.colourway_add').click(function(e){
                    var t=$(this);
                    t.hide();
                    var colourway_name          =           $("#colourway_name").val();
                    var colourway_desc          =           $("#colourway_desc").val();
                    var colourway_lg_image      =           $("#colourway_lg_image").val();
                    var colourway_th_image      =           $("#colourway_th_image").val();
                    var colourway_default       =           $("#colourway_default").val();
                    var product_id              =           $("#product_id").val();
                    var _token                  =           '{{ csrf_token() }}';
                    var params                  =           {
                                                             'colourway_name':colourway_name,
                                                            'colourway_desc':colourway_desc,
                                                            'colourway_lg_image':colourway_lg_image,
                                                            'colourway_th_image': colourway_th_image,
                                                            'colourway_default':colourway_default,
                                                            'product_id':product_id,
                                                            '_token':_token
                                                            };
                    $('.saving').show();
                    $.ajax({
                        url: '{{route('cms.rug-designs.colourway.store')}}',
                        type: 'post',
                        data: params,
                        error:function (request) {
                            console.log(request.responseText);
                        },
                        success: function(data){
                            console.log(data);
                        }
                    })
                });
            });


        </script>
    </div>