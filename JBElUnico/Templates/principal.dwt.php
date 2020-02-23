<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!-- TemplateBeginEditable name="doctitle" -->
    <title>Home | E-Shopper</title>
    <meta name="description" content="">
    <meta name="author" content="">
<!-- TemplateEndEditable -->
    <?php include("includes/head.php"); ?>
    <!-- TemplateBeginEditable name="head" -->
    <!-- TemplateEndEditable -->
</head><!--/head-->

<body>
<!-- TemplateBeginEditable name="contenido" -->
<?php include("includes/header.php"); ?>
<?php include("includes/slider.php"); ?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <?php include("includes/leftsidebar.php"); ?>
      </div>
      <div class="col-sm-9 padding-right">
        <?php include("includes/productlist.php"); ?>
        <?php include("includes/categories.php"); ?>
        <?php include("includes/recomended.php"); ?>
      </div>
    </div>
  </div>
</section>
<?php include("includes/footer.php"); ?>
<?php include("includes/footerjs.php"); ?>
<!-- TemplateEndEditable -->
</body>
</html>