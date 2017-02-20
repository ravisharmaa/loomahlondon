<ul id="sorter" class="polaroid ui-sortable">
    @foreach($data['colourways'] as $colourway)
    <li id="sortdata_{{$colourway->colourway_id}}">
        <div class="polaroidimg">
            <a href="#">
                <img src="{{asset('images/colourway/th/'.$colourway->colourway_th_image)}}" width="200" border="0">
            </a>
        </div>
        <div class="polaroidlabel">
            <div class="tr">
                <div class="td">
                    <span class="cat_sn">1. </span>{{$colourway->colourway_name}}
                </div>
            </div>
        </div>
        <div class="polaroidoption">
            <a href="{{route($base_route.'.edit', $colourway->colourway_id)}}"><img src="{{asset($default_images.'icon_edit.png')}}"
                                                                    width="24" height="24" border="0"></a>
            <a href="JavaScript:void(0);" onclick="return confirm('Do you want to delete this?')"  data-id = "{{$colourway->colourway_id}}" class="colourway_del_link" rel="36"><img
                        src="{{asset($default_images.'icon_delete.png')}}" width="24" height="24" border="0"></a>
            @if($colourway->colourway_default==1)
                <a href="" class="status" data-id="{{$colourway->colourway_id}}"> Default</a>
            @else
                <a href="" class="status" data-id="{{$colourway->colourway_id}}">Not-Default</a>
            @endif
            <div style="float:right;width:66px;padding-top:5px;">
                <label><input type="checkbox" id="checkbox-36" class="publish_product" checked=""> Publish</label>
            </div>
            <div id="img-36" style="float:right;width:30px;display:none;">
                <img src="images/loading.gif" width="20" height="20" border="0">
            </div>
        </div>
    </li>
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
        $(".status").click(function(e){
           e.preventDefault();
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
                    if(data.default==1)
                    {
                        $this.html('').html('Default');
                    } else {
                        $this.html('').html('Not Default')
                    }
                }
            })

        });
    })
</script>