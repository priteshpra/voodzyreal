<!DOCTYPE html>
<html data-wf-site="" data-wf-page="">

<head>
    <meta charset="utf-8">
    <title>Contact US</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="Webflow">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <style type="text/css">
       body{font-family: 'Open Sans', sans-serif;} 
       .w-container.navbar.mobile{padding:20px 35px;background-color:rgb(46,64,83);text-align: center;}
    </style>
</head>
<body>
  <div data-collapse="medium" data-animation="default" data-duration="400" data-contain="1" class="w-nav navbar">
      <div class="w-container navbar mobile">
          <a href="/" class="w-nav-brand brand">
              <img height="70" src="<?php echo $this->config->item('admin_assets'); ?>img/logo_01.png">
          </a>
          <div class="w-nav-button menu-button">
              <div class="w-icon-nav-menu"></div>
          </div>
      </div>
  </div>
  <section class="inner_page empty-space-70">
    <div class="about_us_page">
      <div class="container">
        <h2 class="lgx-heading font-30 color-black m-t-0 p-b-20 m-b-30 font-o-b ">Contact Us</h2>
        <div class="row">
          <div class="col-md-6">
            <ul class="list-s-none ul_li_box_icon p-0 m-b-30">
              <li class="font-16">
                Aastha tapovan, Tapovan circle<br>Chandkheda, Ahmedabad-382421
              </li>              
            </ul>
            <h2 class="lgx-heading font-30 color-black m-t-0 p-b-20 m-b-30 font-o-b ">Contact Info</h2>
            <ul class="list-s-none ul_li_box_icon p-0 m-b-30">
              <li class="font-16 m-b-10 ">
                (+91)-992-457-7751
              </li>
              <li class="font-16 "><i class="fa fa-envelope color-theme font-14"></i>
                <a href="mailto:info@shreeshaktidevelopers.com">info@shreeshaktidevelopers.com</a>              
              </li>
            </ul>
          </div>
        </div>  
        <div class="address_map m-t-30"> 
          <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Aastha tapovan, Tapovan circle,Chandkheda, Ahmedabad&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        </div>
      </div>
    </div>
  </section>
</body>
</html>