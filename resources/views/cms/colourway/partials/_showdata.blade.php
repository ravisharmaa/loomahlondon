<ul id="sorter" class="polaroid ui-sortable">
    <?php $i = 1;?>
    @foreach($data['colourways'] as $colourway)
    <li id="{{$colourway->colourway_id}}">
        <div class="polaroidimg">
            <a href="#">
                <img src="{{asset('images/colourway/th/'.$colourway->colourway_th_image)}}" width="200" border="0">
            </a>
        </div>
        <div class="polaroidlabel">
            <div class="tr">
                <div class="td">
                    <span class="colourway_sn"> {{ $i }} </span>{{$colourway->colourway_name}}
                </div>
            </div>
        </div>
        <div class="polaroidoption">
            <a href="{{route($base_route.'.edit', $colourway->colourway_id)}}"><img src="{{asset($default_images.'icon_edit.png')}}"
                                                                    width="24" height="24" border="0"></a>
            <a href="JavaScript:void(0);" onclick="return confirm('Do you want to delete this?')"  data-id = "{{$colourway->colourway_id}}" class="colourway_del_link" rel="36"><img
                        src="{{asset($default_images.'icon_delete.png')}}" width="24" height="24" border="0"></a>

            <div style="float:right;width:66px;padding-top:5px;">
            @if($colourway->colourway_default==1)
                <label><input type="checkbox" class="status" data-id="{{$colourway->colourway_id}}" checked> Default</label>
            @else
                <label><input type="checkbox" class="status" data-id="{{$colourway->colourway_id}}"> Default</label>
            @endif
            </div>
            <br/>
            <div style="float:right;width:66px;padding-top:5px;">
                @if($colourway->colourway_status==1)
                    <label><input type="checkbox" data-id="{{ $colourway->colourway_id }}" id="publish_product"  checked=""> Publish</label>
                @else
                    <label><input type="checkbox" data-id="{{ $colourway->colourway_id }}" id="publish_product"> Publish</label>
                @endif
            </div>
            <div id="img-36" style="float:right;width:30px;display:none;">
                <img src="images/loading.gif" width="20" height="20" border="0">
            </div>
        </div>
    </li>
        <?php $i++; ?>
   @endforeach
</ul>
<div class="clearboth"></div>

<script>
    $("document").ready(function(){
        $(".colourway_del_link").click(function(){
           var $this  = $(this);
           var id     =  $this.attr('data-id');
            $.ajax({
                url : '{{url('cms/rug-designs/colourway/delete')}}'+'/'+id,
                type: "GET",
                error:function(request){
                    console.log(request.responseText);
                },
                success:function(data)
                {
                    $this.parent().parent().hide();
                }

            })

           });

    });

    $("document").ready(function(){
        $(".status").click(function(){
           var $this = $(this);
           var id = $this.attr('data-id');
           var v_token = '{{ csrf_token() }}';
           var params = {'id':id,'_token':v_token};
            $.ajax({
                method:"POST",
                url: '{{route($base_route.'.default_colourway')}}',
                data : params,
                success:function(response)
                {
                    var data = jQuery.parseJSON(response);
                    console.log(data);

                    if(data.data==1)
                    {
                        $(this).attr('checked','checked');
                    } else {
                        $(this).removeAttr('checked');
                    }
                }
            })

        });
    });

    $("document").ready(function(){
        $("#sorter").sortable({
           opacity: 0.6,
           cursor: "move",
           update: function (event, ui) {
               var order    =  $(this).sortable('toArray');
               var token    =  '{{ csrf_token() }}';
               var params   =   {'order':order, '_token':token};
               $.ajax({
                  method : "POST",
                  url    :  '{{route($base_route.'.change-order')}}',
                  data   : params,

                   error:function(request){
                      console.log(request.responseText);
                   },
                   success:function (data) {
                       var newData = jQuery.parseJSON(data);
                       var current_order = 0;
                       $(".colourway_sn").each(function(){
                          $(this).html(++current_order+ '.');
                       });

                   }
               });

           }
        });
    });

    $("#publish_product").click(function () {

            var $this     =   $(this);
            var id        =   $this.attr('data-id');
            var token     =  '{{ csrf_token() }}';
            var params    =   {'id':id,'_token':token};
            $.ajax({
                method: "POST",
                url:    '{{route($base_route.'.published-status')}}',
                data: params,
                error:function(request)
                {
                    console.log(request.responseText);
                },

                success:function(data)
                {
                    var newData = jQuery.parseJSON(data);
                    if(newData.data==1)
                    {
                        $(this).attr('checked','checked');
                    } else {
                        $(this).removeAttr('checked');
                    }
                }
            })
    })
</script>