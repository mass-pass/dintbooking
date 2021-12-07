@extends('layouts.master')
@section('main')
<section class="main-tab mt-5"  id="boat-app">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<div class="place-section">
					<div class="place-section-right general-seting">
						<h3 class="mb-4">Ahoy there <span class="text-danger">Captain!</span></h3>
						<p>Your boat will soon be visible to The largest community of boaters interested in peer-to-peer boat rental. Welcome to Dint.com</p>
						<hr class="mt-4">
						<div class="d-flex justify-content-between">
							<span><strong>Progress</strong></span>  <span class="text-info"><strong>@{{ getProgress() }}%</strong></span>
						</div>
						<div class="progress">
							<div class="progress-bar bg-info" role="progressbar" :style="{'width': getProgress()+'%'}" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<hr class="mt-4">
						<div class="captain-tabs">
							<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
								<a class="nav-link active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true"><span><i class="fal fa-cog"></i>General</span><i v-if="current_step > 0" class="fal fa-check"></i></a>
								<a class="nav-link" id="v-pills-description-tab" data-toggle="pill" href="#v-pills-description" role="tab" aria-controls="v-pills-description" aria-selected="false"><span><i class="fal fa-pen"></i>Description</span><i v-if="current_step > 1" class="fal fa-check"></i></a>
								<a class="nav-link" id="v-pills-pictures-tab" data-toggle="pill" href="#v-pills-pictures" role="tab" aria-controls="v-pills-pictures" aria-selected="false"><span><i class="fal fa-paperclip"></i>Pictures</span><i v-if="current_step > 2" class="fal fa-check"></i></a>
								<a class="nav-link" id="v-pills-price-tab" data-toggle="pill" href="#v-pills-price" role="tab" aria-controls="v-pills-price" aria-selected="false"><span><i class="fal fa-usd-circle"></i>Price</span><i v-if="current_step > 3" class="fal fa-check"></i></a>
								<a class="nav-link" id="v-pills-insurance-tab" data-toggle="pill" href="#v-pills-insurance" role="tab" aria-controls="v-pills-insurance" aria-selected="false"><span><i class="fal fa-user-check"></i>Insurance</span><i v-if="current_step > 5" class="fal fa-check"></i></a>
								<a class="nav-link" id="v-pills-my-calendar-tab" data-toggle="pill" href="#v-pills-my-calendar" role="tab" aria-controls="v-pills-my-calendar" aria-selected="false"><span><i class="far fa-calendar-alt"></i>My calendar</span><i v-if="current_step > 6" class="fal fa-check"></i></a>
								<a class="nav-link" id="v-pills-equipment-tab" data-toggle="pill" href="#v-pills-equipment" role="tab" aria-controls="v-pills-equipment" aria-selected="false"><span><i class="fal fa-check-circle"></i>Equipment</span><i v-if="current_step > 7" class="fal fa-check"></i></a>
								<a class="nav-link" id="v-pills-discounts-tab" data-toggle="pill" href="#v-pills-discounts" role="tab" aria-controls="v-pills-discounts" aria-selected="false"><span><i class="fal fa-usd-circle"></i>Discounts</span><i v-if="current_step > 9" class="fal fa-check"></i></a>
							</div>
						</div>
						<div class="need-some-help">
							<h4><i class="fal fa-life-ring mr-2"></i>Need some help?</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="place-section">
					<div class="d-flex justify-content-end align-items-center mb-5">
						<a href="#" class="btn thme-btn">Calendar</a>
						<a href="#" class="btn thme-btn">Preview listing</a>
					</div>
					<div>
					<div class="alert alert-danger" v-if="errors.length">
						<b>Please correct the following error(s):</b>
						<ul>
						<li v-for="error in errors">@{{ error }}</li>
						</ul>
					</p>


					</div>

					<div class="place-section-right">
					<!-- Tab-content -->
					<div class="tab-content boat-form" id="v-pills-tabContent">

						<!-- Tab-General -->
						<div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
							@include('boats.registration.0-general')
						</div>
						<!-- Tab-General-End -->

						<!-- Tab-Description -->
						<div class="tab-pane fade" id="v-pills-description" role="tabpanel" aria-labelledby="v-pills-description-tab">
							@include('boats.registration.1-description')
						</div>
						<!-- Tab-Description-End -->

						<!-- Tab-Pictures -->
						<div class="tab-pane fade" id="v-pills-pictures" role="tabpanel" aria-labelledby="v-pills-pictures-tab">
							@include('boats.registration.2-photos')
						</div>
						<!-- Tab-Pictures-End -->

						<!-- Tab-Price -->
						<div class="tab-pane fade" id="v-pills-price" role="tabpanel" aria-labelledby="v-pills-price-tab">
							@include('boats.registration.3-price')
						</div>
						<!-- Tab-Price-End -->

						<!-- Tab-Insurance -->
						<div class="tab-pane fade" id="v-pills-insurance" role="tabpanel" aria-labelledby="v-pills-insurance-tab">
							@include('boats.registration.4-insurance')
						</div>
						<!-- Tab-Insurance-End -->

						<!-- Tab-My-calendar -->
						<div class="tab-pane fade" id="v-pills-my-calendar" role="tabpanel" aria-labelledby="v-pills-my-calendar-tab">
							@include('boats.registration.5-calendar')
						</div>
						<!-- Tab-My-calendar-End -->

						<!-- Tab-Equipment -->
						<div class="tab-pane fade" id="v-pills-equipment" role="tabpanel" aria-labelledby="v-pills-equipment-tab">
							@include('boats.registration.6-equipment')
						</div>
						<!-- Tab-Equipment-End -->


						<!-- Tab-Discounts -->
						<div class="tab-pane fade" id="v-pills-discounts" role="tabpanel" aria-labelledby="v-pills-discounts-tab">
						@include('boats.registration.7-discounts')
						</div>
						<!-- Tab-Discounts-End -->

						</div>
					</div>
					<!-- Tab-content-End -->
				</div>
			</div>
		</div>
	</div>
	<div id="map_hidden" style="display: none"> </div>
</section>
@stop
@push('css')
<link href="/css/boats-register.css" rel="stylesheet" />
<link href="/css/dropzone.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
<script>
	
Dropzone.autoDiscover = false;
$(function(){
	var imgDropzone = new Dropzone("form#DropzoneElement", 
					{  
						url: "{{ url('/boat-photo-upload') }}",
						sending: function(file, xhr, formData) {
							formData.append("photoable_type", "App\Models\Boat");  //name and value
							formData.append("photoable_id", boatsApp.getBoatId()); //name and value
						},
					});

	imgDropzone.on("queuecomplete", function(file, res) { 
		boatsApp.loadImages();
	});

	var fileDropzone = new Dropzone("form#DropzoneFileUploadElement", 
					{  
						url: "{{ url('/file-upload') }}",
						maxFiles: 1
					});

	fileDropzone.on("success", function(file, res) {
		boatsApp.saveAttrib('insurance_certificate_file', res.success.path);
	 });
	 $('.toggler').click(function(){
        var ref = $(this).data('ref');
        console.log({ref:ref});
        $('#'+ref).toggle('slide');
        return false;
    });


});

var boatsApp = new Vue({
    el: '#boat-app',
    data() {
		return {
			errors:[],
			boat:{
				owner_id:<?php echo \Auth::user()->id;?>,
				boat_type:null,
				slug:null,
				harbour_other:'',
				is_owner_professional:0,
				is_rented_with_captain:0,
				languages:[],
			},
			blocked_dates:[],
			language_selector:'',
			blocked_date:{ blockable_type:"\App\\Models\\Boat", blockable_id:null, start_date:null, end_date:null, notes:null},
			current_step:0,
			s3_bucket_path:'<?php echo $s3_bucket_path;?>',
			amenities:<?php echo json_encode($amenity_types);?>,
			images:[],
			languages:<?php echo json_encode($languages);?>,
			selectable_languages:['en', 'es', 'zh', 'fr', 'pt'],
			boat_types:<?php echo json_encode($boat_types);?>,
			languages_map:<?php echo json_encode($languages);?>,
			pricing_intervals:[],
			pricing_interval:{priceable_type:"\App\\Models\\Boat", priceable_id:null,},
			discounts:[],
			discount_first_booking:{ type: 'standard', applicable_at: 'first-time', applicable_meta:{} },
			discount_early_bird:{ type: 'standard', applicable_at: 'early-bird', applicable_meta:{} },
			discount_last_minute:{ type: 'standard', applicable_at: 'last-minute', applicable_meta:{} },
			discount_length:{ applicable_at: 'length-of-stay', applicable_meta:{} },
			discount_custom:{ applicable_at: 'custom', applicable_meta:{} },
			boatAddress: {},
		}
    },
    mounted:function(){
		google.maps.event.addDomListener(window, 'load', this.googelAutoComplete);
		var self = this;
		$('#map_hidden').locationpicker({
                location: {
                    latitude: '',
                    longitude: ''
                },
                locationName: "",
                radius: 0,
                zoom: 15,
                // mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [],
                mapOptions: {},
                scrollwheel: true,
                inputBinding: {
                    latitudeInput: '',
                    longitudeInput: '',
                    locationNameInput: $('#address_line_1')
                },
                enableAutocomplete: true,
                enableAutocompleteBlur: false,
                autocompleteOptions: {
                    
                },
                addressFormat: '',
                // addressFormat: 'administrative_area_level_2',
                enableReverseGeocode: true,
                draggable: true,
                onchanged: function(currentLocation, radius, isMarkerDropped) {
					var mapContext = $(this).locationpicker('map');
                    self.boat.address_line_1 = mapContext.location.formattedAddress;
					self.boat.city = mapContext.location.addressComponents.city;
                },
                onlocationnotfound: function(locationName) {},
                oninitialized: function (component) {},
                // must be undefined to use the default gMaps marker
                markerIcon: undefined,
                markerDraggable: true,
                markerVisible : false,
                draggable: true,
            });
    },
    methods:{
		googelAutoComplete() {
			var self = this;

			// var city = document.getElementById('city');
			// this.boatAddress = new google.maps.places.Autocomplete(city);
			// google.maps.event.addListener(this.boatAddress, 'place_changed', function () {
			// 	var place = self.boatAddress.getPlace();
			// 	self.boat.city = place.name;
			// 	// console.log(place.geometry.location.lat());
			// 	// console.log(place.geometry.location.lng());
			// });


		
			
		},
        initialize(){
        },
		pushLanguageToSelectableLanguages(){
			console.log({ss:this.language_selector});
			if(this.language_selector!=''){
				this.selectable_languages.push(this.language_selector);
			}
		},

		addDiscount(discount){
			var self = this;
			discount.discountable_type = 'App\\Models\\Boat';
			discount.discountable_id = this.boat.id;
			axios.post('/api/discounts/create', discount ).then(function(response){
				self.getDiscounts();
				$('.modal').modal('hide');
			});
		},
		deleteDiscount(discount){
			var self = this;
			axios.post('/api/discounts/'+discount.id+'/delete').then(function(response){
				self.getDiscounts();
			});
		},
		getDiscounts(){
			var self = this;
			axios.post('/api/discounts', { discountable_type:"App\\Models\\Boat", discountable_id:this.boat.id } ).then(function(response){
				self.discounts = response.data.success;
			});
		},

		addPricingInterval(){
			var self = this;
			this.pricing_interval.priceable_id = this.boat.id;
			axios.post('/api/pricing_intervals/create', this.pricing_interval ).then(function(response){
				self.getPricingIntervals();
			});
		},
		deletePricingIntervals(id){
			var self = this;
			axios.post('/api/pricing_intervals/'+id+'/delete').then(function(response){
				self.getPricingIntervals();
			});
		},
		getPricingIntervals(){
			var self = this;
			axios.post('/api/pricing_intervals', this.pricing_interval ).then(function(response){
				self.pricing_intervals = response.data.success;
			});
		},
		saveAttrib(attrib, val){
			this.boat[attrib] =  val;
		},
		test(){
			alert(1);
		},
		validateForm(){
			this.errors = [];
			if(this.boat.boat_type ==null){
				this.errors.push('Select Boat Type is required');
			}
			if(typeof(this.boat.address_line_1)=='undefined'){
				this.errors.push('Address is required');
			}
		
			if(typeof(this.boat.manufacturer)=='undefined'){
				this.errors.push('Manufacturer is required');
			}
			if(typeof(this.boat.name)=='undefined'){
				this.errors.push('Boat Name is required');
			}

			return this.errors.length > 0 ? false:true;

		},
		createBlockedDate(){
			var self = this;
			axios.post('/api/blocked_dates/create', this.blocked_date ).then(function(response){
				self.getBlockedDates();
			});

		},
		deleteBlockedDate(id){
			var self = this;
			axios.post('/api/blocked_dates/'+id+'/delete').then(function(response){
				self.getBlockedDates();
			});
		},
		getBlockedDates(){
			var self = this;
			axios.post('/api/blocked_dates', this.blocked_date ).then(function(response){
				self.blocked_dates = response.data.success;
			});

		},
		getProgress(){
			return this.current_step == 8 ? 100 : (this.current_step * 12);
		},
		getLanguageNameFromCode(code){
			return typeof(this.languages_map[code])=='undefined'?code:this.languages_map[code];
		},
		isBoatType(the_boat_type){
			return (this.boat.boat_type == the_boat_type)?true:false;
		},
		setBoatType(the_boat_type){
			this.boat.boat_type = the_boat_type;
			this.boat.slug = the_boat_type;
			console.log({
				the_boat_type:the_boat_type, 
				this_boat_boat_type:this.boat.boat_type,
			});
			console.log(this.boat.slug);
		},
		nextStep(){
			this.current_step+=1;

			if(this.current_step >= 8) {
				swal({
					title: 'Boat Registered!',
					text: 'The boat has been regsitered on dint.',
					icon: 'success'
				}).then(function() {
					window.location.href = APP_URL + "/boats/dashboard";
				});

				setTimeout(function() {
					window.location.href = APP_URL + "/boats/dashboard";
				}, 3000);
				
				return false;
			} else {
				this.moveToStep(this.current_step);
			}
		},
		prevStep(){
			if(this.current_step > 0){
				this.current_step-=1;
			}
			this.moveToStep(this.current_step);
		},
		moveToStep(step){
			let map = [
				"v-pills-general-tab", "v-pills-description-tab",
				"v-pills-pictures-tab", "v-pills-price-tab", 
				"v-pills-insurance-tab", "v-pills-my-calendar-tab", 
				"v-pills-equipment-tab", "v-pills-discounts-tab"
			];

			$('#'+map[step]).trigger('click');
		},
		getBoatId(){
			if(typeof(this.boat.id)!='undefined') {
				return this.boat.id;
			}

			return 0;

		},
		saveImages(){
			var self = this;
			var url = '/api/images/save';
			axios.post(url, { images: this.images }).then(function(response){
				self.nextStep();
			});

		},
        save(){
			if(!this.validateForm()){
				return false;
			}
			var self = this;
			var url = '/api/boats/create';
			
			if(typeof(this.boat.id)!='undefined') {
				url = '/api/boats/'+this.boat.id+'/update';
			}

			axios.post(url, this.boat).then(function(response){
				console.log({response:response});
				if(typeof(response.data.success.id)!='undefined') {
					self.boat.id =  response.data.success.id;
					self.blocked_date.blockable_id = response.data.success.id;
				}
				
				self.nextStep();
			});
		},
		resetCover(image_id){
			for(i in this.images){
				if(this.images[i].id != image_id){
					this.images[i].cover_photo = 0;
				}
			}
		},
		loadImages(){
			var url = '/api/images/get/Boat/'+this.boat.id;
			var self = this;
			axios.get(url).then(function(response){
				self.images = response.data.success;
			});
		},
		deletePhoto(image_id) {
			var self = this;
			var url = '/api/images/delete/'+image_id;
			axios.post(url).then(function(response){
				self.loadImages();
			});

		}
	}
});

</script>

@endpush

