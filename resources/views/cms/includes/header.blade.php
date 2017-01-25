<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Content Management System :: </title>
    <link rel="shortcut icon" href="{{asset('assets/backend/images/favicon.ico')}}" />

{{--Custom Style-Sheet Used By the Template--}}
<link href="{{asset($css_path.'mystyle.css')}}" rel="stylesheet" type="text/css" />
{{--End Custom--}}

{{--Libraries--}}

<script src="{{asset($js_path.'jquery-1.11.2.min.js')}}" type="text/javascript"></script>
<script src="{{asset($js_path.'myscript.js')}}" type="text/javascript"></script>
<script src="{{asset($js_path.'alertify.min.js')}}" type="text/javascript"></script>
<link href="{{asset($css_path.'alertify.css')}}" rel="stylesheet" type="text/css">
{{--Menu Library--}}
<link href="{{asset($js_path.'js_libs/superfish/css/superfish.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset($js_path.'js_libs/superfish/js/hoverIntent.js')}}"></script>
<script src="{{asset($js_path.'js_libs/superfish/js/superfish.js')}}"></script>
<script>
    $(function(){
        $('.sf-menu').superfish();
    });
</script>
{{--End Menu Library--}}

<script src="{{asset($js_path.'js_libs/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{asset($js_path.'js_libs/ckeditor/adapters/jquery.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $(".myeditor").each(function() {
            if($(this).attr('rel')=="basic"){
                var config = {
                    langCode: 'en',
                    width : $(this).attr('cols')*100,
                    height : $(this).attr('rows')*100,
                    toolbar:
                        [
                            ['Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'LeftJustify'],
                            //['TextColor','BGColor'],
                            ['Image', 'Link', 'Unlink'],
                            //['Cut','Copy','Paste'],
                            //['SelectAll'],
                            '/',
                            //	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                            //['Table','NumberedList','BulletedList'],
                            ['Format'],
                            ['Font','FontSize'],
                        ],
                    disableNativeSpellChecker: true,
                    filebrowserBrowseUrl:'ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl:'ckfinder/ckfinder.html?type=Images',
                    filebrowserFlashBrowseUrl:'ckfinder/ckfinder.html?type=Flash',
                    filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                };
            }
            else{
                var config = {
                    langCode: 'en',
                    width : $(this).attr('cols')*100,
                    height : $(this).attr('rows')*100,
                    toolbar:
                        [
                            ['Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'LeftJustify'],
                            ['Image', 'Link', 'Unlink'],
                            ['TextColor','BGColor'],
                            ['Font','FontSize']
                            //	['Cut','Copy','Paste','PasteText','PasteFromWord','-','Find','Replace'],
                            //['SelectAll','RemoveFormat'],
                            //'/',
                            //	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                            //	['Table','NumberedList','BulletedList'],
                            //	['Format'],
                            ,
                        ],
                    filebrowserBrowseUrl:'ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl:'ckfinder/ckfinder.html?type=Images',
                    filebrowserFlashBrowseUrl:'ckfinder/ckfinder.html?type=Flash',
                    filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                };
            }
            $(this).ckeditor(config);
        });
    });
</script>
<script src="{{asset($js_path.'js_libs/freeckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{asset($js_path.'js_libs/freeckeditor/adapters/jquery.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $(".myeditors").each(function() {
            if($(this).attr('rel')=="basic"){
                var config = {
                    langCode: 'en',
                    width : $(this).attr('cols')*100,
                    height : $(this).attr('rows')*100,
                    toolbar:
                        [

                        ]
                };
            }
            else{
                var config = {
                    langCode: 'en',
                    width : $(this).attr('cols')*100,
                    height : $(this).attr('rows')*100,
                    toolbar:
                        [
                            ['Source']
                        ]
                };
            }
            $(this).ckeditor(config);
        });
    });
</script>
<link rel="stylesheet" type="text/css" href="{{asset($js_path.'js_libs/fancybox/css/jquery.fancybox.css')}}" />
<script type="text/javascript" src="{{asset($js_path.'js_libs/fancybox/js/jquery.fancybox.js')}}"></script>
<link rel="stylesheet" href="{{asset($js_path.'js_libs/jquery-ui-calendar/css/jquery-ui-1.10.3-smoothness.css')}}">
<script src="{{asset($js_path.'js_libs/jquery-ui-calendar/js/jquery-ui-1.10.3.js')}}"></script>
<script>
    $(function(){
        $(".mydatepicker").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true
        });
        $("#datepicker-from").datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3
            /*,onClose: function(selectedDate){
             $("#datepicker-to").datepicker("option","minDate",selectedDate);
             }*/
        });
        $("#datepicker-to").datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3
            /*,onClose: function(selectedDate) {
             $("#datepicker-from").datepicker("option","maxDate",selectedDate);
             }*/
        });
    });
</script>
<script type="text/javascript" src="{{asset($js_path.'jquery-ui-1.10.2.custom.js')}}"></script>
<script type="text/javascript">
    $.fn.upload = function(remote,successFn,progressFn) {
        return this.each(function() {
            var formData = new FormData();
            formData.append($(this).attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: remote,
                type: 'POST',
                xhr: function() {
                    myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload && progressFn){
                        myXhr.upload.addEventListener('progress',progressFn, false);
                    }
                    return myXhr;
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                complete : function(res) {
                    if(successFn) successFn(res);
                }
            });
        });
    }
</script>
<link rel="stylesheet" href="{{asset($js_path.'js_libs/tinycarousel/css/tinycarousel.css')}}" type="text/css" media="screen"/>
<script type="text/javascript" src="{{asset($js_path.'js_libs/tinycarousel/js/jquery.tinycarousel.js')}}"></script>
<script>
    $(function(){
        $('a.accordiontab').click(function(){
            var t=$(this);
            var id=$(this).prop('rel');
            if($('#'+id).css('display')=="none"){
                $('.accordionblock').each(function(){
                    if($(this).css('display')=="block"){
                        $(this).slideUp();
                        $('.accordiontab').css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});
                    }
                });
                $('#'+id).slideDown();
                t.css({'background':'url(images/tgup.png) no-repeat right #E30B5D'});
                $('html, body').animate({ scrollTop: t.offset().top },1000);
            }
            else{
                $('#'+id).slideUp();
                t.css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});
            }
        });
    });
</script>
</head>