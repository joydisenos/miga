<header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('{{asset('storage/banner1.jpg')}}')">
          	<img src="{{asset('storage/banner1.jpg')}}" class="img-fluid" alt="">
            <div class="carousel-caption d-none d-md-block">
              
            </div>
          </div>
		  <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('{{asset('storage/banner0.jpg')}}')">
          	<img src="{{asset('storage/banner0.jpg')}}" class="img-fluid" alt="">
            <div class="carousel-caption d-none d-md-block">
              
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('{{asset('storage/banner2.jpg')}}')">
          	<img src="{{asset('storage/banner2.jpg')}}" class="img-fluid" alt="">
            <div class="carousel-caption d-none d-md-block">
            	
            </div>
          </div>
		  <!-- Slide Four- Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('{{asset('storage/banner3.jpg')}}')">
          	<img src="{{asset('storage/banner3.jpg')}}" class="img-fluid" alt="">
            <div class="carousel-caption d-none d-md-block">
              
            </div>
          </div>
          
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>