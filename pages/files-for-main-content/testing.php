<!DOCTYPE html>
<html lang="en">
   <head>
      <title>jQuery Example</title>
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       
      <script>
         var x = 0;
         $(document).ready(function() {
            $('.add').on('click', function (event) {
               var html = `<div class='child-div' onclick="alert('k xa yr');">demo text ` + x++ + "</div>";
               $("#parent-div").prepend(html);
            });
         });
      </script>
      <style>
         .div {
            margin:10px;
            padding:12px;
            border:2px solid #F38B00;
            width:60px;
         }
      </style>
   </head>
<body>
<div id="parent-div">
    <div>Hello World</div>
</div>
<input type="button" value="Click to add" class="add" />
</body>    
</html>