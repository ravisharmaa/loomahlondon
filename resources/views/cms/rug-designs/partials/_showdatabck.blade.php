<ul id="sorter" class="polaroid">
    @foreach($data as $d)
        <img src="" />
        <li id="sortdata_{{$d->product_id}}">
            <div class="polaroidimg">
            <a href="#">
                <img src="{{asset('images/'.$d->product_image)}}" width="200" border="0" />
            </a>
        </div>
        <div class="polaroidlabel">
            <div class="tr">
                <div class="td">
                    <span class="cat_sn">{{$d->product_name}}</span>
                </div>
            </div>
        </div>
        <div class="polaroidoption">
            <a href="login.php?p_id=manage_products&id"><img src="{{asset($default_images.'icon_edit.png')}}" width="24" height="24" border="0" /></a>
            <a href="JavaScript:void(0);" class="cat_del_link" rel=""><img src="{{asset($default_images.'icon_delete.png')}}" width="24" height="24" border="0" /></a>

            <div style="float:right;width:66px;padding-top:5px;">
                <label><input type="checkbox" id="checkbox-" class="publish_product" >Publish</label>
            </div>
            <div id="img-" style="float:right;width:30px;display:none;">
                <img src="images/loading.gif" width="20" height="20" border="0" />
            </div>
        </div>
        </li>
    @endforeach
</ul>