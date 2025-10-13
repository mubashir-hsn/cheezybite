<?php
include('connect.php');
include('./functions/getProducts.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="Website icon" type="png" href="/logo/logo.jpg">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">

  <title>CheezyBite | Best Online Food Delivery Website.</title>
</head>

<body style="font-family: Poppins; background-color: #f5f4f4;">

  <!-- ......Navbar Section Start ..................................    -->
  <header>
    <?php include('navbar.php'); ?>
  </header>

  <!-- ...... Navbar Section End ..............................................................  -->


  <!-- ...... Home Banner Section Start ................................................................ -->

  <section>
    <div class="container" style="margin-top: 10rem;">
      <div class="row">
        <div class="col-12">
          <img class="col-10 m-auto image-responsive rounded" src="./images/hero.png" alt="" style="width: 100%; height: 100%;">
        </div>
      </div>
    </div>
  </section>

  <!-- ......Home Banner Section End ................................................................ -->


  <!-- ....... App Exclusive Section Start ................................... -->

  <section>

    <div class="container mt-5">
      <div class="row">
        <div class="col heading">
          <h1 style="font-size: 30px; text-align: start; border-bottom: 2px solid #ad0101; padding: 10px;">App Exclusive</h1>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="container" style="margin-top: 30px;">
        <div class="row d-flex justify-content-lg-start justify-content-md-start justify-content-center align-items-center">

          <?php getProductByCategory('exclusive'); ?>

        </div>
      </div>
    </div>
  </section>

  <!-- ....... App Exclusive Section End ................................... -->

  <!-- .......... Hero Section Start ...........................................  -->
  <section>
    <div class="container mt-5" style="background-color: #ffffff; border-radius: 15px;">
      <div class="row p-sm-1 d-flex d-sm-col d-md-row d-lg-row">
        <div class="py-4 col-12 col-sm-12 col-md-6 col-lg-6 p-md-3 p-lg-5">
          <p style="font-family: Agbalumo; color: #b50101; text-transform: capitalize; padding-bottom: 5px; font-size: 25px;">Welcome</p>
          <h2 style="font-size: 35px; padding-bottom: 10px;">We make the best pizza in your town</h2>
          <p style="font-size:15px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ullamcorper neque dapibus ipsum semper. <br>
            Suspendisse eu lorem vitae odio eleifend imperdiet. Duis in efficitur sem, at lobortis nulla.</p>
          <a href="./menu.php" class="cartHover btn rounded-pill mt-2 py-3 px-3">Explore menu</a>
        </div>
        <div class="col-sm-10 col-md-6 col-lg-5 d-none d-lg-flex justify-content-end align-items-center" style="text-align: center;">
          <img src="./images/pngwing.com.png" alt="" class="image-responsive" style="width: 80%; height: 60%;">
        </div>
      </div>
    </div>
  </section>

  <!-- .......... Hero Section End ...........................................  -->

  <!-- ....... Starter Section Begin ................................... -->

  <section>

    <div class="container mt-5">
      <div class="row">
        <div class="col heading">
          <h1 style="font-size: 30px; text-align: start; border-bottom: 2px solid #ad0101; padding: 10px;">> Starters</h1>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="container" style="margin-top: 30px;">
        <div class="row d-flex justify-content-md-start justify-content-lg-start justify-content-center align-items-center">

         <?php getProductByCategory('starter'); ?>

        </div>
      </div>
    </div>
  </section>

  <!-- ....... Starter Section End ................................... -->

  <!-- ....... Top Deals Section Start ................................... -->

  <section>

    <div class="container mt-5">
      <div class="row">
        <div class="col heading">
          <h1 style="font-size: 30px; text-align: start; border-bottom: 2px solid #ad0101; padding: 10px;">> Top Deals</h1>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="container" style="margin-top: 30px;">
        <div class="row d-flex justify-content-md-start justify-content-lg-start justify-content-center align-items-sm-center">
          
          <?php getProductByCategory('topdeal'); ?>
       
        </div>
      </div>
    </div>
  </section>

  <!-- ....... Top Deals Section End ................................... -->

  <!-- ......... Accordian Section Start ................................. -->

  <section>
    <div class="container-fluid" style="margin-top: 80px;">
      <div class="container mt-5 p-5" style="background-color: #ffffff; border-radius: 10px; font-size: 14px;">
        <h1 style="font-size: 30px; font-family: Agbalumo; color: #b50101; font-weight: 500; text-align: center;">Finest Taste Ever</h1>

        <div class="accordion accordion-flush mt-5" id="accordionFlushExample" style="outline: none;">
          <div class="accordion-item" style="color: #ffffff; background-color: #000000b5; outline: none;">
            <h2 class="accordion-header" id="flush-headingOne" style="outline: none;">
              <button onfocus="this.style.boxShadow = 'none'" onclick="this.style.color = 'black'" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne"
                style="background-color: #f8d447 ; outline: none;">
                Craving for Something Cheesy and Magical?
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <p>A deal that is light on the pocket yet packed with flavors that are all set to tantalize your taste buds?<br>
                  If yes, then order your favorite deals from CheezyBite right away!
                  We offer a variety of fast food items in our menu, including your favorite pizza and zinger burger bursting with flavors. <br>
                  Even if at midnight you crave for something super delicious, dine-in isn't possible while you search for pizza delivery near me, just look up for CheezyBite and we'll help fill your tummy with food that is finger-licking good. <br>
                  We provide pizza delivery in Islamabad and Rawalpindi, so if you're residing in the twin cities, it is time you get hold of the best tasting fast food in town that too at minimum prices.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item" style="color: #ffffff; background-color: #000000b5;">
            <h2 class="accordion-header" id="flush-headingTwo" style="outline: none;">
              <button onfocus="this.style.boxShadow = 'none'" onclick="this.style.color = 'black'" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo"
                style="background-color: #f8d447; outline: none;">
                Why CheezyBite Deals?
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <p>Feeling hungry? Dreaming of munching on your favorite zinger burger with an extra slice of cheese? <br>
                  When hunger hits hard, it is time to visit us and check out Cheezious menu for your favorite item. What do we offer? <br>
                  We the juiciest and fulfilling zinger burgers and pizza that is a little spicy! Because what is life without spice, right? <br>
                  Or maybe try out something desi as Behari rolls from our menu? Whatever you like, we serve it hot to you.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item" style="color: #ffffff; background-color: #000000b5;">
            <h2 class="accordion-header" id="flush-headingThree" style="outline: none;">
              <button onfocus="this.style.boxShadow = 'none'" onclick="this.style.color = 'black'" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree"
                style="background-color: #f8d447 ; outline: none;">
                So what makes us different from the rest?
              </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <p>The TASTE, of course! And our deals too! <br>
                  We bring to you the best zinger burger deals in Rawalpindi and Islamabad so even if you're a student with a few bucks in your pocket, you can still enjoy the most delicious food in town by ordering from us. <br>
                  Are you up for looking for the best and affordable zinger burger deals in the twin cities? We bet you won't find deals better than ours. <br>
                  Moreover, our deals aren't just restricted to your favorite, crispy burgers. We also have some bombastic deals being offered on our special pizza, calzone and other edible items that'll shout 'AMAZING'.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item" style="color: #ffffff; background-color: #000000b5;">
            <h2 class="accordion-header" id="flush-headingFour" style="outline: none;">
              <button onfocus="this.style.boxShadow = 'none'" onclick="this.style.color = 'black'" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour"
                style="background-color: #f8d447; outline: none;">
                Who are We?
              </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <p>We are a new set up in the twin cities, bringing exciting flavor for you to enjoy. <br>
                  Yes, we know you can find burgers and pizzas everywhere but not as good as ours! <br>
                  From a little desi touch of Behari kabab roll to fabulous Italian pizza, our menu is based on popular fast food items that people love the most..</p>
              </div>
            </div>
          </div>

          <div class="accordion-item" style="color: #ffffff; background-color: #000000b5;">
            <h2 class="accordion-header" id="flush-headingFive" style="outline: none;">
              <button onfocus="this.style.boxShadow = 'none'" onclick="this.style.color = 'black'" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive"
                style="background-color: #f8d447; outline: none;">
                Where are we located?
              </button>
            </h2>
            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <p>We offer food delivery in Islamabad and Rawalpindi, so yes, the twin cities are fortunate enough to get hold of a fast food joint that serve a variety of delectable items that are hard to resist. <br>
                  Are the kids screaming for pizza? Or have friends coming over who are die-hard fans of flaming, hot wings? <br>
                  Whoever at your end craves for whatever thing, call us for the most convenient fast food delivery in Rawalpindi. Oh, and yes, we offer fast food deliver in Islamabad too! <br>
                  Whether it about biting into crispy and spicy kabab rolls or zinger burger oozing with your favorite sauce, call us right away to indulge into a food coma with food that is fit for a king! <br>
                  CheezyBite is the new name for delicious fast food , so do not stay away from ordering your deals right away!</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- ......... Accordian Section end ................................. -->

  <!-- .............. Footer Section Start ............................... -->

  <section>

    <?php include('footer.php'); ?>

  </section>

  <!-- .............. Footer Section End ............................... -->

  <script src="/js/bootstrap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/app.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
      card.addEventListener('mouseenter', () => card.style.border = '2px solid #ffcb04');
      card.addEventListener('mouseleave', () => card.style.border = '2px solid white');
    });
  });
</script>
</body>

</html>