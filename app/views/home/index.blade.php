<html>

<head>
   <title><?= $title ?></title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" ...>
</head>

<body>

   <div class="container mt-3 header">
      <nav class="navbar navbar-expand-lg navbar-light">
         <a class="navbar-brand" href="/home">Home</a>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
               <li class="nav-item active">
                  <a class="nav-link" href="/login">Đăng nhập</a>
               </li>
            </ul>
         </div>
      </nav>
   </div>
   <div class="container mt-5 main">
      <div class="row">
         <?php foreach ($products as $product): ?>
            <div class="col-md-3 mb-4">
               <div class="card">
                  <img src="<?= $product['img'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                  <div class="card-body">
                     <h5 class="card-title"><?= $product['name'] ?></h5>
                     <p class="card-text"><?= substr($product['mota'], 0, 80) . '...' ?></p>
                     <p class="card-text"><small class="text-muted"><?= $product['price'] ?></small></p>
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </div>
   </div>


   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
<style>
   div.main {
      max-width: 1100px;
   }
</style>