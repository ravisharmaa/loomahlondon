<div class="container" style="margin:0;">
        <h1>Add a Rug</h1>
        <div class="clearboth"></div>
        <div class="info">
            Provide the Rug name and its image that you wish to add.
        </div>

        {{Form::open(['route'=>$base_route.'.store','method'=>'POST','id'=>'form_rug_add','enctype'=>'multipart/form-data','files'=>true])}}
            @include('cms.rug-designs.partials._form',['btnText'=>'Save'])
       {{Form::close()}}
        <script>
            $(function(){
                $('.rug_add').click(function(){
                    var t=$(this);
                    t.hide();
                    var product_name            =           $("#product_name").val();
                    var product_description     =           $("#product_description").val();
                    var product_knotcnt         =           $("#product_knotcnt").val();
                    var product_size            =           $("#product_size").val();
                    var rug_image               =           $("#rug_image").val();
                    $('.saving').show();
                    var _token                  =   '{{ csrf_token() }}';
                    var params                  =   {
                        'product_name':product_name,
                        'product_description':product_description,
                        'product_knotcnt':product_knotcnt,
                        'product_size': product_size,
                        'rug_image':rug_image,
                        '_token':_token
                    };
                    $.ajax({
                        url: '{{$base_route.'.store'}}',
                        type: 'post',
                        data: params,
                        error:function (request) {
                            console.log(request.responseText);
                        },
                        success: function(data){
                            console.log(data);

                            $("#cat_image").upload("ajax/category_image_upload.php?id="+id,function(res){
                                $(location).attr('href','login.php?p_id=manage_products&id='+id);
                            },function(data) {
                            });
                        }
                    })
                });
            });
        </script>
    </div>