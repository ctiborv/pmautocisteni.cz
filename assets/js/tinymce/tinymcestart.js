

tinymce.init({
    selector: "textarea#e1m1",
    theme: "modern",
    width: 800,
    height: 400,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern jbimages"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
    language : 'cs',
    image_advtab: true,
    media_alt_source: true, 
    relative_urls:false,
    content_css: "/assets/css/main.css"
   
 }); 
