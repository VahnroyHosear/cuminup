@extends('userlayout')

@section('content')

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      div.pac-container {
        z-index: 99999999999 !important;
      } 
    </style>
    <script>
      // This sample uses the Autocomplete widget to help the user select a
      // place, then it retrieves the address components associated with that
      // place, and then it populates the form fields with those details.
      // This sample requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script
      // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      let placeSearch;
      let autocomplete;
      const componentForm = {
        street_number: "short_name",
        route: "long_name",
        locality: "long_name",
        administrative_area_level_1: "short_name",
        country: "long_name",
        postal_code: "short_name",
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
          document.getElementById("autocomplete"),
          { types: ["geocode"] }
        );
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(["address_component"]);
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();

        for (const component in componentForm) {
          document.getElementById(component).value = "";
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (const component of place.address_components) {
          const addressType = component.types[0];

          if (componentForm[addressType]) {
            const val = component[componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition((position) => {
            const geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };
            const circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy,
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-8">
        <div class="card" id="edit">
          <div class="card-header header-elements-inline">
            <h2 class="mb-0">{{__('Add Category and multiple subcategory')}}</h2>
          </div>
          <div class="card-body">
        
      <!-- neelu form-->
     
              <form action="{{route('user.category_insert')}}" method="post">
              @csrf
                  <input type="hidden" name="id" class="form-control">    

              
              <div class="form-group row">
              
              <label class="col-form-label col-lg-4"><h3>{{__('Main Category')}}</h3></label>
              
              <div class="col-lg-6">
                <select type="text" name="maincategory_id" class="form-control" placeholder="Enter category name" >
                    <option value="">Select Main Category</option>
                    @foreach($allcategory as $catDetails)
                    <option value="{{$catDetails->id}}">{{$catDetails->title}}</option>
                    
                    @endforeach
                    
                    
                </select>    
                </div>
              </div>        
              
              <div class="form-group row">
                <label class="col-form-label col-lg-4"><h3>{{__('category')}}</h3></label>
                <div class="col-lg-7">
                <input type="text" name="category" class="form-control" placeholder="Enter subcategory name">
                </div>
                 <div class="col-lg-1">
                 <a href="#"><button style="font-size:16px"><i class="fa fa-plus" id="add"></i></button></a>

                </div>

              </div>    
              <div id="AddMoreFileId">
        	</div>
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm">{{__('Add')}}</button>
              </div>
            </form>
          </div>
        </div>
  
    
      <!-- end here-->
      
      
      <!--neelu list-->
    <div class="card" id="edit">
          <div class="card-header header-elements-inline">
          </div>
          <div class="card-body">     
            <div class="container">
                <h2>Category list</h2>
                <table class="table" id="categorylist_id">
                    <thead>
                          <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Parent_id</th>
                        </tr>
                     </thead>
                     <tbody>
                    @foreach($userlist as $k=>$listing)
                     {
                     <td>{{++$k}}</td>
                     <td>{{$listing->title}}</td>     
                     <td> 
                         @if(empty($listing->parent_id))
                         { 
                           echo "NA";
                         }
                         @else 
                         { 
		                        $this->db->from('allcategory_sk');
	                    	    $this->db->where('id',$listing['parent_id']);
	                    	    $query = $this->db->get();
		                        $categoryDetail = $query->result_array();
		                       @echo $categoryDetail[0]['title'];</td>
                         }@endif
                     }     
                     @endforeach
                     </tbody>
               </table>
        </div>
    </div>
 </div>




      
      <!--end here -->
     
    
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7B46osUBu80aqL18GWC3UaSeaq98jrpg&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src=" https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
$(document).ready(function() {
    $('#categorylist_id').DataTable();
} );
</script>  
@stop