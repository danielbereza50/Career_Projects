<?php 

// here
 wp_register_script( 
    'wc-af-main', 
    plugins_url('/js/autofill.js?v=1', __FILE__), 
    array(), 
    false, 
    true 
  );
  
  wp_enqueue_script( 'wc-af-main' );  
 
  wp_localize_script( 'wc-af-main', 'wcaf',
    array(
    'selectedCountry'               => get_option( 'wc_af_country' ),
    'enable_billing_company_name'   => get_option( 'wc_af_enable_company_name_for_bill' ),
    'enable_billing_phone'          => get_option( 'wc_af_enable_phone_number_for_bill' ),
    )
  );
  // here


// jQuery( "#billing_state" ).prop( "disabled", true );
//function billing_address() {
//initAutocomplete();
//}

add_filter('woocommerce_billing_fields', 'my_woocommerce_billing_fields');
function my_woocommerce_billing_fields($fields)
{
    $fields['billing_address_1']['custom_attributes'] = array('readonly'=>'readonly');
     $fields['billing_address_2']['custom_attributes'] = array('readonly'=>'readonly');
       $fields['billing_city']['custom_attributes'] = array('readonly'=>'readonly');
       $fields['billing_postcode']['custom_attributes'] = array('readonly'=>'readonly');        
     return $fields;
}


?>
<script>
// Getting data from autocomplete field
  var autofill, place;
  function initAutocomplete(){

        autofill = new google.maps.places.Autocomplete(
          (document.getElementById('billing_address_1')), {
          types: ['geocode']
          });
    
    //console.log("Hi out there");

          autofill.addListener('place_changed', function() {

          var place = autofill.getPlace();
             
            if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            // Do anything you like with what was entered in the ac field.
            console.log('You entered: ' + place.name);
            alert("Please Select an Address from Google Suggestions");
            return;
          }

          console.log('You selected: ' + place.formatted_address);
          });
    

    if( wcaf.selectedCountry.length > 0  && wcaf.selectedCountry !== undefined ) {
      autofill.setComponentRestrictions(
            {'country': wcaf.selectedCountry });
    }

    autofill.addListener('place_changed', fillInBillingAddress);
  }



// Filling the address
  function fillInBillingAddress(){
    place = autofill.getPlace();
    jQuery('#billing_postcode').val('');
    jQuery('#billing_address_2').val('');
    jQuery('#billing_address_1').val('');
    jQuery('#billing_city').val('');
    jQuery('#billing_phone').val('');
    jQuery('#billing_company').val('');

    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];
      // filling country field
      if(addressType == 'country'){
        jQuery('#billing_country').val(place.address_components[i]['short_name']);
        jQuery('#billing_country').trigger('change');
      }
      // filling street address field
      if(addressType == 'street_number'){
          jQuery('#billing_address_1').val(place.address_components[i]['long_name']);
      } else {
        if( typeof ( place.address_components[i].types[1] != "undefined" ) ) {
          if( place.address_components[i].types[1] == 'sublocality' ) {
            jQuery('#billing_address_1').val(place.address_components[i]['long_name']);
          } 
        }
      }
      // adding data to street address field
      if(addressType == 'route') {
        var addr = jQuery('#billing_address_1').val();
        if(addr != ''){
          addr = addr +' '+ place.address_components[i]['long_name'];
          jQuery('#billing_address_1').val(addr);
        } else {
          jQuery('#billing_address_1').val(place.address_components[i]['long_name']);
        }
      }

      // filling state field
      if(addressType == 'administrative_area_level_1'){
        var state = place.address_components[i]['short_name'];
        setTimeout(function explode(){
          jQuery('#billing_state').val(state);
          jQuery('#billing_state').trigger('change');
        },1500);
      }

      // filling second address field
      if(addressType == 'neighborhood'){
        jQuery('#billing_address_2').val(place.address_components[i]['long_name']);
      } else if(addressType == 'sublocality_level_3'){
        jQuery('#billing_address_2').val(place.address_components[i]['long_name']);
      } else if(addressType == 'sublocality_level_2'){
        jQuery('#billing_address_2').val(place.address_components[i]['long_name']);
      }

      // filling location
      if(addressType == 'locality'){
        jQuery('#billing_city').val(place.address_components[i]['long_name']);
      }
      // filling postal code
      if(addressType == 'postal_code'){
        jQuery('#billing_postcode').val(place.address_components[i]['long_name']);
      }

    }

    if( wcaf.enable_billing_phone ) {
      if( place.international_phone_number ){
        jQuery('#billing_phone').val(place.international_phone_number);
      }
    }

    if( wcaf.enable_billing_company_name ) {
      if( place.name ){
        jQuery('#billing_company').val(place.name);
      }
    }
    
  }


  function billing_geolocate() {
    if(navigator.geolocation) {
      navigator.geolocation.getCurrentPosition( billing_geoSuccess, geoError );
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  }
  

// Funtion for error
  function geoError() {
    console.log("Geocoder failed.");
  }

// Function for success and getting coordinates
  function billing_geoSuccess(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    billing_codeLatLng(lat, lng);
  }

// Function to fill address
  var geocoder ;
  function billing_codeLatLng( lat, lng ) {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function( results, status ) {

      if( status == google.maps.GeocoderStatus.OK ) {
        if( results[1] ) {
          var address = results[0].address_components;

          jQuery('#billing_postcode').val('');
          jQuery('#billing_address_2').val('');
          jQuery('#billing_city').val('');
          jQuery('#billing_phone').val('');
          jQuery('#billing_company').val('');

          for (var i = 0; i < address.length; i++) {
            var addressType = address[i].types[0];
            

            // filling country field
            if(addressType == 'country'){
              jQuery('#billing_country').val(address[i]['short_name']);
              jQuery('#billing_country').trigger('change');
            }
            // filling street address
            if(addressType == 'street_number' ){
              jQuery('#billing_address_1').val(address[i]['long_name']);
            } else {
              if( typeof ( address[i].types[1] != "undefined" ) ) {
                if( address[i].types[1] == 'sublocality' ) {
                  jQuery('#billing_address_1').val(address[i]['long_name']);
                } 
              }
            }
            // adding data to street address
            if(addressType == 'route'){
              var addr = jQuery('#billing_address_1').val();
              if(addr != ''){
                addr = addr +' '+ address[i]['long_name'];
                jQuery('#billing_address_1').val(addr);
              }
            }

            // filling state field
            if(addressType == 'administrative_area_level_1'){
              var state = address[i]['short_name'];
              setTimeout(function explode(){
                jQuery('#billing_state').val(state);
                jQuery('#billing_state').trigger('change');
              },1500);
            }

            if(addressType == 'neighborhood'){
              jQuery('#billing_address_2').val(address[i]['long_name']);
            } else if(addressType == 'sublocality_level_3'){
              jQuery('#billing_address_2').val(address[i]['long_name']);
            } else if(addressType == 'sublocality_level_2'){
              jQuery('#billing_address_2').val(address[i]['long_name']);
            }

            // filling location
            if(addressType == 'locality'){
              jQuery('#billing_city').val(address[i]['long_name']);
            }
            // filling postal code field
            if(addressType == 'postal_code'){
              jQuery('#billing_postcode').val(address[i]['long_name']);
            }
          }

        }
        else {
          alert("No results found");// alerting if no results found
        }
      }
      else {
        console.log("Geocoder failed due to: " + status);
      }
  });
}

</script>




