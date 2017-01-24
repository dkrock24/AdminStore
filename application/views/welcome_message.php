<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="../assets/a/bootstrap.css" rel="stylesheet">
    <script src="../assets/a/jquery.js"></script>
    <script src="../assets/a/bootstrap.js"></script>

    <!-- include summernote css/js-->
    
    <link href="../assets/a/summernote.css" rel="stylesheet">


    <script src="../assets/a/summernote.js"></script>

    <!-- include summernote css/js-->
    
    
  </head>
  <body>
  Aqui
    <form method="post" action="">
      <div class="form-group">
        <textarea id="summernote" name="summernote"></textarea>
      </div>
      <button type="submit">Submit</button>
    </form>
    <script>
    $(document).ready(function() {
        $('#summernote').summernote({
        minHeight: 200,
          maxHeight: 450,
          toolbar: [
            ['style', ['bold', 'italic', 'underline','clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['color', ['color']],
            ['table', ['table']],
            ['height', ['height']],
            ['fontsize', ['fontsize']],
            ['link', ['linkDialogShow', 'unlink']],
            ['insert', ['link', 'picture']],
            ['fontname',['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New']],
            ['fontname', ['fontname']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']],
            ['style', ['style']],
            ['view', ['codeview']],
            ['misc', ['codeview']],
            ['para', ['ul', 'ol', 'paragraph']],
          ],
      });


    });
    </script>
  </body>
</html>