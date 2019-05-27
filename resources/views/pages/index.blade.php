@extends('layouts.base')

@section('content')

	<div id="banner-wrapper">
<!--- Slider Start -->
		<script src="{{ asset('js/jquery.bxslider.min.js') }}"></script><!--For Image Slider-->
		<div class="slider-wrap">
			<section class="slider">
			<ul class="slider1">
				<li><img src="{{ asset('media/football.jpg') }}"></li>
				<li><img src="{{ asset('media/football2.jpg') }}"></li>
				<li><img src="{{ asset('media/cricket.jpg') }}"></li>
			</ul>
		 </section>
		</div>


		<script type="text/javascript">
			$('.slider1').bxSlider({
				mode: 'fade',
				captions: false,
				auto:true,
				pager:false,

			});
			$('.slider2').bxSlider({
				pager:false,
				captions: true,
				maxSlides: 3,
				minSlides: 1,
				slideWidth: 230,
				slideMargin: 10
			});
			$('.slider3').bxSlider({
				mode: 'fade',
				captions: false,
				auto:true,
				pager:false,
				controls:false,
			});
		</script><!--- Slider End -->
</div> <!--end banner wrapper-->

<div class ="jumbotron">
  <div class="row">
  <section class="col-sm-4">
    <img src="{{asset('media/profile.png')}}" style="width:200px;height:200px;">
    <strong class="text-center">Create Profile</strong>
      <p class="text-center"> Register & create your own profile.</p>
  </section>
  <section class="col-sm-4">
    <img src="{{asset('media/team.png')}}" style="width:200px;height:200px;">
    <strong class="text-center">Join Team</strong>
    <p class="text-center">Find appropriate team or create your own. </p>
  </section>
  <section class="col-sm-4 ">
    <img src="{{asset('media/profile.png')}}" style="width:200px;height:200px;">
      <strong class="text-center">Play</strong>
    <p class="text-center"> Compete at competitive level . </p>
  </section>
</div>
</div>
@endsection
