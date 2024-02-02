<html>  
  <head>  
    <title>Croppie</title>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
     
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
  </head>  
<body>  
<div class="container" style="margin-top:20px;padding:20px;">  
    <div class="card">
      <div class="card-header">
        Rasmni yuklash
      </div>
      <div class="card-body">
        <h5 class="card-title">Rasm yuklash</h5>
        <input type="file" name="upload_image" id="upload_image" />       
      </div>
    </div>
 
    <div class="card text-center" id="uploadimage" style='display:none'>
      <div class="card-header">
        Crop image
      </div>
      <div class="card-body">
            <div id="image_demo" style="width:350px; margin-top:30px"></div>
            <div id="uploaded_image" style="width:350px; margin-top:30px;"></div>  
      </div>
      <div class="card-footer text-muted">
        <button class="crop_image">Crop & Upload Image</button>
      </div>
    </div>
</div>
</body>  
</html>
  
<script>  
$(document).ready(function(){
 $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:280,
      height:280,
      type:'circle'
    },
    boundary:{
      width:300,
      height:300
    }
  });
  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }) 
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimage').show();
  });
  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"upload.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
           $('#uploaded_image').html(data)
        }
      });
    })
  });
});  
</script>