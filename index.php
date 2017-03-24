<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>WeatherWonder</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Style/style.css">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top nav-no-space">
        <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">WeatherWonder <span class="glyphicon glyphicon-cloud"></span> </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li ><a href="index.php">Home</a></li>
            <li><a href="weatherTest1.php">Test</a></li>
          </ul>
          <div class="navbar-right">
              <p class="navbar-text ">Hello, Guest!</p>
               <Button type="button" class="btn btn-primary navbar-btn pull-left" data-toggle="modal" data-target="#loginModal" role="login">Sign In</Button> 
                <p class="navbar-text">or <a href="signup.php">Sign up today!</a></p>
          </div>
          </div>
        </div>
        </nav>
        <div class="text-center jumbotron bg-img">
            <h1>The smartest weather application built!</h1>
            <h4>Leveraging the power of mathematics with historical data, WeatherWonder is the MOST accurate weather application built! If you want your forecast enter your Zip Code Here: </h4>
            
            <div class="control-group form-horizontal col-md-offset-5 col-md-2" id="zipDiv">
                <form  id = "zipForm" name = "zipForm" action="/weatherInPhp.php" method = "GET" onsubmit = >
                  <label for="zipCode">Zip Code:</label>
                  <input type="text" class="form-control" name = "zipCode" id="zipCode">
                  <button type = "submit" id = "zipBTN" name = "zipBTN" class = "btn btn-primary"  style = "margin-top:1em">Submit</button>
              </form>
        </div>
        <div class = "col-md-12">
        </div>
        </div>
        <div class="container">
        <h2>Weather Stuff!</h2>
        <div class="col-md-4 col-xs-4">
        <div class="thumbnail">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pulvinar convallis dolor, id ultricies lorem pellentesque eu. Morbi sapien ante, consequat vitae sagittis vitae, tincidunt ac lectus. Sed augue magna, pharetra nec lorem id, sagittis feugiat odio. Nunc fermentum, elit vel facilisis efficitur, diam massa faucibus ante, porttitor maximus tellus libero in nulla. Quisque in suscipit quam. Morbi nibh diam, congue sit amet justo vel, hendrerit suscipit elit. Sed semper enim fermentum viverra venenatis. Proin quis dictum est. Etiam ornare leo ac dolor suscipit, nec egestas nisi maximus. Cras dictum luctus lacus et maximus. Aenean pellentesque enim eget elit laoreet, eget sodales sapien tincidunt.
            In feugiat nunc vel efficitur mollis. Nunc fringilla volutpat porta. Nam et semper diam. Mauris ut sapien feugiat, dignissim nunc sed, commodo lorem. Nam non blandit tortor. Suspendisse suscipit dapibus consequat. Ut mauris risus, gravida fringilla sem quis, faucibus rutrum dolor. Mauris id aliquam odio. Fusce sit amet ante aliquet, tincidunt velit cursus, rutrum ante. Nam a fermentum risus. Nulla volutpat vitae eros a rutrum. Pellentesque imperdiet sem interdum odio commodo, ut ultricies elit semper. Mauris porttitor enim et lorem lacinia, sit amet eleifend lacus fringilla.</p>
        </div>
        </div>
        <div class="col-md-4 col-xs-5">
          <div class="thumbnail">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pulvinar convallis dolor, id ultricies lorem pellentesque eu. Morbi sapien ante, consequat vitae sagittis vitae, tincidunt ac lectus. Sed augue magna, pharetra nec lorem id, sagittis feugiat odio. Nunc fermentum, elit vel facilisis efficitur, diam massa faucibus ante, porttitor maximus tellus libero in nulla. Quisque in suscipit quam. Morbi nibh diam, congue sit amet justo vel, hendrerit suscipit elit. Sed semper enim fermentum viverra venenatis. Proin quis dictum est. Etiam ornare leo ac dolor suscipit, nec egestas nisi maximus. Cras dictum luctus lacus et maximus. Aenean pellentesque enim eget elit laoreet, eget sodales sapien tincidunt.
            In feugiat nunc vel efficitur mollis. Nunc fringilla volutpat porta. Nam et semper diam. Mauris ut sapien feugiat, dignissim nunc sed, commodo lorem. Nam non blandit tortor. Suspendisse suscipit dapibus consequat. Ut mauris risus, gravida fringilla sem quis, faucibus rutrum dolor. Mauris id aliquam odio. Fusce sit amet ante aliquet, tincidunt velit cursus, rutrum ante. Nam a fermentum risus. Nulla volutpat vitae eros a rutrum. Pellentesque imperdiet sem interdum odio commodo, ut ultricies elit semper. Mauris porttitor enim et lorem lacinia, sit amet eleifend lacus fringilla.</p>
        </div>
        </div>
        <div class="col-md-4 col-xs-3">
        <div class="thumbnail">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pulvinar convallis dolor, id ultricies lorem pellentesque eu. Morbi sapien ante, consequat vitae sagittis vitae, tincidunt ac lectus. Sed augue magna, pharetra nec lorem id, sagittis feugiat odio. Nunc fermentum, elit vel facilisis efficitur, diam massa faucibus ante, porttitor maximus tellus libero in nulla. Quisque in suscipit quam. Morbi nibh diam, congue sit amet justo vel, hendrerit suscipit elit. Sed semper enim fermentum viverra venenatis. Proin quis dictum est. Etiam ornare leo ac dolor suscipit, nec egestas nisi maximus. Cras dictum luctus lacus et maximus. Aenean pellentesque enim eget elit laoreet, eget sodales sapien tincidunt.
            In feugiat nunc vel efficitur mollis. Nunc fringilla volutpat porta. Nam et semper diam. Mauris ut sapien feugiat, dignissim nunc sed, commodo lorem. Nam non blandit tortor. Suspendisse suscipit dapibus consequat. Ut mauris risus, gravida fringilla sem quis, faucibus rutrum dolor. Mauris id aliquam odio. Fusce sit amet ante aliquet, tincidunt velit cursus, rutrum ante. Nam a fermentum risus. Nulla volutpat vitae eros a rutrum. Pellentesque imperdiet sem interdum odio commodo, ut ultricies elit semper. Mauris porttitor enim et lorem lacinia, sit amet eleifend lacus fringilla.</p>
        </div>
        </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    
        <script>
        $("#zipForm").validate({
    
        // Specify the validation rules
        rules: {
            zipCode:
            {
                required:true,
                minlength: 5,
                maxlength: 5,
                number: true
            }
        },

        messages: {
            zipCode: "Please enter a valid US zip code"
        },
        highlight: function(element) {
            $(element).closest('#zipDiv').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('#zipDiv').removeClass('has-error');
            
        }
        });
            
        </script>
        <script>
            $("#zipBTN").on('click',function(e){
                if($("#zipForm").valid())
                {
                    var self = this;
                    $(this).hide().after('<img src = "/Images/sunny.gif" alt = "Loading..." style = "height:25px; width:25px;margin-top:1em">');
                }
            });
        </script>
        <footer>
            <div class="text-center containter">
                <h5>©2017 Andrew Haaland All rights reserved.</h5>
            </div>
        </footer>
    </body>
</html>