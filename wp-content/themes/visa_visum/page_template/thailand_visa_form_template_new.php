<?php
/**
* Template Name: Thailand Visa Form
*
* @package WordPress
* @subpackage visa_visum
* @since Visa 1.0
*/

$thailand_nonce = wp_create_nonce('thailand_form_nonce');
$formSubmit = '';
$cntTraveller = 1;
$redirectURL = 'http://traveldocs.developstaging.com/thank-you/';
$isError = false;
if (isset($_GET['purpose']) && $_GET['purpose'] != '') {
	$visa_purpose = ucfirst($_GET['purpose']);
}
if(!empty($_POST)) {
	$formSubmit = thailand_form_submit_new($_POST);
	wp_redirect( $redirectURL );
}
get_header();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="container">
	<?php
	$outHtml = '';
	$outHtml .= '<div class="recordaddedMessage"> <p> '. __( 'Form Submitted Successfully', 'visachild' ) .' </p> </div>';
	if ($formSubmit) {
		echo $outHtml;
	}
	?>
	<!-- Matlas -->
	<div class="row">
		<div class="col-md-12" style="margin-bottom: 40px !important;">
	        <ul class="process-steps process-2 clearfix">
	            <li class=" active">
	                <a href="#" class="i-bordered i-circled divcenter"><i class="fa fa-wpforms" aria-hidden="true"></i></a>
	                <h5>1. Gegevens invullen</h5>
	            </li>
	            <li class="">
	                <a href="javascript:jQuery('#order-form').submit(); return false;" class="i-bordered i-circled divcenter"><i class="fa fa-check" aria-hidden="true"></i></a>
	                <h5>2. Controle en betaling</h5>
	            </li>
	        </ul>
	    </div>
	</div>
	<div class="row backgrouddark">
		<div class="col-md-8 matlasform mequalheight"  id="matlascontent" >
			<form method="post" id="thailand_visa_form" class="visa_form_submit" enctype="multipart/form-data">
				<div id="visa_travel-information" class="form_seprationSection">
					<h3><?php echo __( 'Travel details', 'visachild' ); ?></h3>

					<div class="form-group row">
						<label for="destination_country" class="vc_col-md-3 col-form-label"><?php echo __( 'Destination', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<input type="text" class="form-control" value="Thailand" name="destination_country" id="destination_country" readonly="true">
						</div>
					</div><!-- form-group -->

					<div class="form-group row">
						<label for="nationality" class="vc_col-md-3 col-form-label"><?php echo __( 'Nationality', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<select name="nationality" id="nationality">
									<option value="Belgium">Belgium</option>
									<option value="Denmark">Denmark</option>
									<option value="Germany">Germany</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="Netherlands">Netherlands</option>
									<option value="Norway">Norway</option>
									<option value="Austria">Austria</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Spain">Spain</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="United States">United States</option>
									<option value="Sweden">Sweden</option>
									<option value="---" disabled="">------------------------------------------</option>
								<?php
									if(!empty(get_list_countries())){
										foreach(get_list_countries() as $country){?>
										<option value="<?php echo $country->country_code;?>" <?php echo 'NL' == $country->country_code ? 'selected' : ''; ?>><?php echo $country->name;?></option>
									<?php } } ?>
							</select>
						</div>
					</div><!-- form-group -->

					<div class="form-group row">
						<label for="purpose" class="vc_col-md-3 col-form-label"><?php echo __( 'Purpose', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<!-- <input type="text" class="form-control" value="<?php //echo isset($visa_purpose) ? $visa_purpose : 'Tourism'; ?>" name="purpose" id="purpose" readonly="true"> -->
							<select name="purpose" id="purpose">
								<option value="Tourism" <?php echo (isset($visa_purpose) == 'Tourism') ? 'selected' : ''; ?>><?php echo __('Tourism', 'visachild') ?></option>
								<option value="Business" <?php echo (isset($visa_purpose) == 'Business') ? 'selected' : ''; ?>><?php echo __('Business', 'visachild') ?></option>
							</select>
							<span class="validate_error"><?php echo isset($purposeErr) ? $purposeErr : ''; ?></span>
							<!-- <span><a id="change_purpose" href="#purpose_modal" class="trigger-btn" data-toggle="modal">change</a></span> -->
						</div>
						<!-- Modal HTML -->
						<div id="purpose_modal" class="modal fade">
							<div class="modal-dialog modal-confirm">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3 class="modal-title"><b>Are you sure to change to business purpose?</b></h3>
									</div>
									<div class="modal-body" style="text-align: center;">
										<p>You must enter all the details again..</p>
									</div>
									<div class="modal-footer">
										<button id="cancel_purpose_btn" type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-success" id="change_purpose_btn">Yes proceed</button>
									</div>
								</div>
							</div>
						</div> <!-- Modal -->

						<!-- No visa required modal -->
						<div id="visa_modal" class="modal fade">
							<div class="modal-dialog modal-confirm">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3 class="modal-title"><b>Tourist Visa</b></h3>
									</div>
									<div class="modal-body" style="text-align: center;">
										<p>You don???t need a visa with these requirements</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
									</div>
								</div>
							</div>
						</div> <!-- Modal -->
					</div><!-- form-group -->

					<div class="form-group row tourism_duration">
						<label for="duration" class="vc_col-md-3 col-form-label"><?php echo __( 'Duration', 'visachild' ); ?></label>
						<div class="vc_col-md-9">
							<select name="duration" id="duration_option">
									<option value="31 to 60 days" <?php echo (isset($duration) == '31 to 60 days') ? 'selected' : ''; ?>><?php echo __('31 to 60 days', 'visachild') ?></option>
									<option value="1 to 30 days" <?php echo (isset($duration) == '1 to 30 days') ? 'selected' : ''; ?>><?php echo __('1 to 30 days', 'visachild') ?></option>
							</select>
						</div>
					</div><!-- form-group -->
				</div> <!-- End travel info -->
				<div class="duration-31-60">
					<div id="visa_general-information" class="form_seprationSection">
						<h2><?php echo __( 'General data', 'visachild' ); ?></h2>
						<p><?php echo __( "Enter all your details below. Take this carefully from your passport. You must apply for a visa for all travelers (including children who are included in their parents' passports). You can do this in one go by clicking on 'add traveler' at the bottom. You only need to enter the general details once (all visas will be sent to the same address). It is not necessary that all travelers are resident at the address entered. The address is only used for sending the visas, if desired.", 'visachild' ); ?></p>


						<div class="form-group row">
							<label for="arrival_date" class="vc_col-md-3 col-form-label"><?php echo __( 'Arrival date', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="date" class="form-control" value="<?php echo isset($arrival_date) ? $arrival_date : ''; ?>" name="arrival_date" id="arrival_date" placeholder="<?php echo __( 'Arrival Date', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($arrivalErr) ? $arrivalErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="email_address" class="vc_col-md-3 col-form-label"><?php echo __( 'Email Address', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="email" class="form-control" value="<?php echo isset($email_address) ? $email_address : ''; ?>" name="email_address" id="email_address" placeholder="name@example.com">
								<span class="validate_error"><?php echo isset($emailErr) ? $emailErr : ''; ?></span>
							</div>
						</div> <!-- form-group -->

						<div class="form-group row">
							<label for="telephone" class="vc_col-md-3 col-form-label"><?php echo __( 'Telephone Number', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="phone" class="form-control" value="<?php echo isset($telephone) ? $telephone : ''; ?>" name="telephone" id="telephone"  placeholder="+316123456789">
								<span class="validate_error"><?php echo isset($phoneErr) ? $phoneErr : ''; ?></span>
							</div>
						</div><!-- form-group -->
					</div>
					<div id="visa_adres-information" class="form_seprationSection">
						<h3><?php echo __( 'Address', 'visachild' ); ?></h3>
						<p><?php echo __( 'Enter the address of one of the travelers. The travelers do not all have to live at this address.', 'visachild' ); ?></p>

						<div class="form-group row">
							<label for="countries" class="vc_col-md-3 col-form-label"><?php echo __( 'Country', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<select name="countries" id="countries">
									<option value="Belgium">Belgium</option>
									<option value="Denmark">Denmark</option>
									<option value="Germany">Germany</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="Netherlands">Netherlands</option>
									<option value="Norway">Norway</option>
									<option value="Austria">Austria</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Spain">Spain</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="United States">United States</option>
									<option value="Sweden">Sweden</option>
									<option value="---" disabled="">------------------------------------------</option>
									<?php
									if(!empty(get_list_countries())){
										foreach(get_list_countries() as $country){?>
										<option value="<?php echo $country->country_code;?>" <?php echo 'NL' == $country->country_code ? 'selected' : ''; ?>><?php echo $country->name;?></option>
									<?php } } ?>
								</select>
								<span class="validate_error"><?php echo isset($countryErr) ? $countryErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="street_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Street name', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($street_name) ? $street_name : ''; ?>" name="street_name" id="street_name" placeholder="<?php echo __( 'Straatnaam', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($streetErr) ? $streetErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="house_number" class="vc_col-md-3 col-form-label"><?php echo __( 'House number', 'visachild' ); ?></label>
							<div class="vc_col-md-9 house_section">
								<input type="text" class="form-control" value="<?php echo isset($house_number) ? $house_number : ''; ?>" name="house_number" id="house_number" placeholder="<?php echo __( 'Huisnummer', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($houseErr) ? $houseErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="town" class="vc_col-md-3 col-form-label"><?php echo __( 'Town', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($town) ? $town : ''; ?>" name="town" id="town" placeholder="<?php echo __( 'Town', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($townErr) ? $townErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="postcode" class="vc_col-md-3 col-form-label"><?php echo __( 'Postcode', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($postcode) ? $postcode : ''; ?>" name="postcode" id="postcode" placeholder="<?php echo __( '1234', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($postcodeErr) ? $postcodeErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="province_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Province', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($province_name) ? $province_name : ''; ?>" name="province_name" id="province_name" placeholder="<?php echo __( 'Province', 'visachild' ); ?>">
								<span class="validate_error"><?php echo isset($provinceErr) ? $provinceErr : ''; ?></span>
							</div>
						</div><!-- form-group -->
					</div> <!-- visa_adres-information -->

					<div id="order_details" class="form_seprationSection">

						<h3><?php echo __( 'Order details', 'visachild' ); ?></h3>
						<p><?php echo __( 'Enter the general details of the application below. You enter this information only once and apply to all travelers in this application.' ); ?></p>

						<div class="form-group row">
							<label for="no_of_days_stay" class="vc_col-md-3 col-form-label"><?php echo __( 'Number of Days Stay', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($no_of_days_stay) ? $no_of_days_stay : ''; ?>" name="no_of_days_stay" id="no_of_days_stay">
								<span class="validate_error"><?php echo isset($days_stayErr) ? $days_stayErr : ''; ?></span>
							</div>
						</div><!-- form-group -->

						<h3><?php echo __( 'Travel Method', 'visachild' ); ?></h3>
						<p><?php echo __( 'Select your travel method below. If you travel by boat or plane, you must also enter the details of the relevant vehicle.' ); ?></p>
						<div class="form-group row">
							<label for="travel_method" class="vc_col-md-3 col-form-label"><?php echo __( 'Travel Method', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<select name="travel_method" id="travel_method">
								    <option value="plane" <?php echo (isset($travel_method) == 'plane') ? 'selected' : ''; ?>>Plane</option>
								    <option value="boat" <?php echo (isset($travel_method) == 'boat') ? 'selected' : ''; ?>>Boat</option>
								    <option value="car" <?php echo (isset($travel_method) == 'car') ? 'selected' : ''; ?>>Car</option>
								</select>
								<span class="validate_error"><?php echo isset($Travel_methodErr) ? $Travel_methodErr : ''; ?></span>
							</div>
						</div>
						<div class="form-group row travel_method_info travel-flight">
							<label for="flight_no" class="vc_col-md-3 col-form-label"><?php echo __( 'Flight Number', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($flight_no) ? $flight_no : ''; ?>" name="flight_no" id="flight_no">
							</div>
						</div>
						<div class="form-group row travel_method_info travel-boat hidden">
							<label for="vessel_name" class="vc_col-md-3 col-form-label"><?php echo __( 'Vessel Name', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($vessel_name) ? $vessel_name : ''; ?>" name="vessel_name" id="vessel_name">
							</div>
						</div>

						<h3><?php echo __( 'Residence', 'visachild' ); ?></h3>
						<p><?php echo __( 'Enter the details of your (first) place of residence below. You must enter the name of the hotel, the street and the place.' ); ?></p>
						<div class="form-group row">
							<label for="residence_address" class="vc_col-md-3 col-form-label"><?php echo __( 'Address', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($residence_address) ? $residence_address : ''; ?>" name="residence_address" id="residence_address">
							</div>
						</div>
						<div class="form-group row">
							<label for="residence_phone_no" class="vc_col-md-3 col-form-label"><?php echo __( 'Phone Number', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<input type="text" class="form-control" value="<?php echo isset($residence_phone_no) ? $residence_phone_no : ''; ?>" name="residence_phone_no" id="residence_phone_no"  placeholder="+316123456789">
							</div>
						</div>

						<h3><?php echo __( 'Shipping Method', 'visachild' ); ?></h3>
						<p><?php echo __( 'Select the way in which you want to send the passport to us (shipping method) and how you want to receive the passport (return method).', 'visachild' ); ?></p>
						<div class="form-group row">
							<label for="shipping_method" class="vc_col-md-3 col-form-label"><?php echo __( 'Shipping Method', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<select name="shipping_method" id="shipping_method">
								    <option value="" <?php echo (isset($shipping_method) == '') ? 'selected' : ''; ?> data-price='0'>Select Send Method ...
								    </option>
									<option value="OC12"<?php echo (isset($shipping_method) == 'OC12') ? 'selected' : ''; ?> data-price='44.95'>Courier next business day before 12:00 (??? 44.95)</option>
									<option value="OC17"<?php echo (isset($shipping_method) == 'OC17') ? 'selected' : ''; ?> data-price='34.95'>Courier next business day before 5:00 PM (??? 34.95)</option>
									<option value="DROPOFF"<?php echo (isset($shipping_method) == 'DROPOFF') ? 'selected' : ''; ?>data-price='0'>Deliver yourself in Rotterdam</option>
									<option value="MAIL"<?php echo (isset($shipping_method) == 'MAIL') ? 'selected' : ''; ?> data-price='0'>Send yourself</option>
								</select>
								<span class="validate_error"><?php echo isset($ShippingErr) ? $ShippingErr : ''; ?></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="return_method" class="vc_col-md-3 col-form-label"><?php echo __( 'Return Method', 'visachild' ); ?></label>
							<div class="vc_col-md-9">
								<select name="return_method" id="return_method">
								    <option value="" <?php echo (isset($Return_method) == '') ? 'selected' : ''; ?> data-price='0'>Select Return Method ...</option>
								    <option value="AVIA" <?php echo (isset($Return_method) == 'AVIA') ? 'selected' : ''; ?> data-price='69.95'>Avia partner desk (??? 69.95)</option>
								    <option value="REGISTERED_MAIL" <?php echo (isset($Return_method) == 'REGISTERED_MAIL') ? 'selected' : ''; ?> data-price='18.15'>Warranty post 2 working days (??? 18.15)
								    </option>
								    <option value="OC12" <?php echo (isset($Return_method) == 'OC12') ? 'selected' : ''; ?> data-price='44.95'>Courier next business day before 12:00 (??? 44.95)</option>
								    <option value="OC17" <?php echo (isset($Return_method) == 'OC17') ? 'selected' : ''; ?> data-price='34.95'>Courier next business day before 5:00 PM (??? 34.95)
								    </option>
								    <option value="PICKUP" <?php echo (isset($Return_method) == 'PICKUP') ? 'selected' : ''; ?> data-price='0'>Pick up yourself in Rotterdam</option>
								</select>
								<span class="validate_error"><?php echo isset($ReturnErr) ? $ReturnErr : ''; ?></span>
							</div>
						</div><!-- form-group -->
					</div>

					<div id="visa_travel_details-information" class="form_seprationSection">
						<h3><?php echo __( 'Traveler data', 'visachild' ); ?></h3>
						<p><?php echo __( 'Enter the general details of the traveler below. Click for explanation on the label / field or the i-tje. Pay particular attention to the "All first names" and "last name" fields.', 'visachild' ); ?></p>
						<?php
						if(isset($_POST['traverler'])){
							$cntTraveller = count($_POST['traverler']['nationality']);
						}

						for ($j = 0; $j < $cntTraveller; $j++)
						{
							?>
							<div class="travel_details_container" id="traveler_info_<?php echo $j; ?>">
								<h4 id="traveler_id_<?php echo $j; ?>">
									Traveler <?php echo $j + 1 ; ?>
									<?php if($j > 0): ?>
										<span onclick="removeTraverler(<?php echo $j; ?>)" > Remove Traveler <?php echo $j + 1 ; ?></span>
									<?php endif; ?>
								</h4>

								<div class="form-group row">
									<label for="traverler_gender_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Sex', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[gender][]" id="traverler_gender_<?php echo $j; ?>">
											<option value="" <?php echo (isset($_POST['traverler']['gender'][$j]) == '') ? 'selected' : ''; ?>>Select gender</option>
											<option value="man" <?php echo (isset($_POST['traverler']['gender'][$j]) == 'man') ? 'selected' : ''; ?>>Man</option>
											<option value="woman" <?php echo (isset($_POST['traverler']['gender'][$j]) == 'woman') ? 'selected' : ''; ?>>Woman</option>
										</select>
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_first_name_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'First name', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" value="<?php echo isset($_POST['traverler']['first_name'][$j]) ? $_POST['traverler']['first_name'][$j] : ''; ?>" class="form-control" name="traverler[first_name][]" id="traverler_first_name_<?php echo $j; ?>" placeholder="<?php echo __( 'First name', 'visachild' ); ?>">
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_surname_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Surname', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" class="form-control" value="<?php echo isset($_POST['traverler']['surname'][$j]) ? $_POST['traverler']['surname'][$j] : ''; ?>" name="traverler[surname][]" id="traverler_surname_<?php echo $j; ?>" placeholder="<?php echo __( 'Surname', 'visachild' ); ?>">
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_date_birth_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Date of birth', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['date_birth'][$j]) ? $_POST['traverler']['date_birth'][$j] : ''; ?>" name="traverler[date_birth][]" id="traverler_date_birth_<?php echo $j; ?>" placeholder="<?php echo __( 'Date of birth', 'visachild' ); ?>">
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_birth_place_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Birth Place', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<input type="text" value="<?php echo isset($_POST['traverler']['birth_place'][$j]) ? $_POST['traverler']['birth_place'][$j] : ''; ?>" class="form-control" name="traverler[birth_place][]" id="traverler_birth_place_<?php echo $j; ?>" placeholder="<?php echo __( 'Birth Place', 'visachild' ); ?>">
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_nationality_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Nationality', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[nationality][]" id="traverler_nationality_<?php echo $j; ?>">
											<option value="" <?php echo (isset($_POST['traverler']['nationality'][$j]) == '') ? 'selected' : ''; ?>>Select Nationality</option>
											<option value="Belgium">Belgium</option>
											<option value="Denmark">Denmark</option>
											<option value="Germany">Germany</option>
											<option value="Finland">Finland</option>
											<option value="France">France</option>
											<option value="Netherlands">Netherlands</option>
											<option value="Norway">Norway</option>
											<option value="Austria">Austria</option>
											<option value="Slovakia">Slovakia</option>
											<option value="Spain">Spain</option>
											<option value="United Kingdom">United Kingdom</option>
											<option value="United States">United States</option>
											<option value="Sweden">Sweden</option>
											<option value="---" disabled="">------------------------------------------</option>
											<?php
											if(!empty(get_list_countries())){
												foreach(get_list_countries() as $country){?>
													<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['nationality'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
												<?php } } ?>
										</select>
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_nationality_at_birth_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Nationality at Birth', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[nationality_at_birth][]" id="traverler_natioinality_at_birth_<?php echo $j; ?>">
											<option value="" <?php echo (isset($_POST['traverler']['nationality_at_birth'][$j]) == '') ? 'selected' : ''; ?>>Select Nationality at Birth</option>
											<?php
											if(!empty(get_list_countries())){
												foreach(get_list_countries() as $country){?>
													<option value="<?php echo $country->country_code;?>" <?php echo (isset($_POST['traverler']['nationality_at_birth'][$j]) == $country->country_code) ? 'selected' : ''; ?>><?php echo $country->name;?></option>
											<?php } } ?>
										</select>
									</div>
								</div><!-- form-group -->

								<div class="form-group row">
									<label for="traverler_marital_status_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Marital Status', 'visachild' ); ?></label>
									<div class="vc_col-md-9">
										<select name="traverler[marital_status][]" id="traverler_marital_status_<?php echo $j; ?>">
											<option value="" <?php echo (isset($_POST['traverler']['marital_status'][$j]) == '') ? 'selected' : ''; ?>>Select Marital Status</option>
											<option value="single" <?php echo (isset($_POST['traverler']['marital_status'][$j]) == 'single') ? 'selected' : ''; ?>>Single</option>
											<option value="divorced" <?php echo (isset($_POST['traverler']['marital_status'][$j]) == 'divorced') ? 'selected' : ''; ?>>Divorced</option>
											<option value="married" <?php echo (isset($_POST['traverler']['marital_status'][$j]) == 'married') ? 'selected' : ''; ?>>Married</option>
											<option value="widow" <?php echo (isset($_POST['traverler']['marital_status'][$j]) == 'widow') ? 'selected' : ''; ?>>Widow</option>
										</select>
									</div>
								</div><!-- form-group -->

								<div id="work_info_section" class="form_seprationSection">
									<h3><?php echo __( 'Work', 'visachild' ); ?></h3>
									<p><?php echo __( 'Enter the details regarding your work or profession (in English) below. If you are a student or housewife / husband, enter it below.' ); ?></p>

									<div class="form-group row">
										<label for="traverler_work_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Work', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[work][]" id="traverler_work">
												<option value="yes" <?php echo (isset($_POST['traverler']['work'][$j]) == 'yes') ? 'selected' : ''; ?>>Yes</option>
												<option value="no" <?php echo (isset($_POST['traverler']['work'][$j]) == 'no') ? 'selected' : ''; ?>>No</option>
											</select>
										</div>
									</div><!-- form-group -->
									<div class="work-info">
										<div class="form-group row">
											<label for="traverler_profession<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'profession', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['profession'][$j]) ? $_POST['traverler']['profession'][$j] : ''; ?>" class="form-control" name="traverler[profession][]" id="traverler_profession_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->

										<div class="form-group row">
											<label for="traverler_name_of_employer_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Name of Employer' ); ?></label>
											<div class="vc_col-md-9">
												<input type="text" value="<?php echo isset($_POST['traverler']['name_of_employer'][$j]) ? $_POST['traverler']['name_of_employer'][$j] : ''; ?>" class="form-control" name="traverler[name_of_employer][]" id="traverler_name_of_employer_<?php echo $j; ?>">
											</div>
										</div><!-- form-group -->
									</div>
								</div>

								<div id="passport_info_section" class="form_seprationSection">
									<h3><?php echo __( 'Passport Details', 'visachild' ); ?></h3>
									<p><?php echo __( 'Enter your passport information below. For Dutch people, the document number is nine characters long and starts with a letter (N, B, A, D). The Dutch passport number contains both numbers and letters. For Belgians, the passport number is eight characters long. This has the form: XX999999 (two letters, six numbers).', 'visachild' ); ?></p>

									<div class="form-group row">
										<label for="traverler_document_number_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Document Number', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="text" value="<?php echo isset($_POST['traverler']['document_number'][$j]) ? $_POST['traverler']['document_number'][$j] : ''; ?>" class="form-control" name="traverler[document_number][]" id="traverler_document_number_<?php echo $j; ?>" placeholder="<?php echo __( 'Document Number', 'visachild' ); ?>">
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_release_date_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Release Date', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['release_date'][$j]) ? $_POST['traverler']['release_date'][$j] : ''; ?>" name="traverler[release_date][]" id="traverler_release_date_<?php echo $j; ?>" placeholder="<?php echo __( 'Release Date', 'visachild' ); ?>">
											<span class="validate_error"><?php echo isset($arrivalErr) ? $arrivalErr : ''; ?></span>
										</div>
									</div><!-- form-group -->

									<div class="form-group row">
										<label for="traverler_expiration_date_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Expiration Date', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['expiration_date'][$j]) ? $_POST['traverler']['expiration_date'][$j] : ''; ?>" name="traverler[expiration_date][]" id="traverler_expiration_date_<?php echo $j; ?>" placeholder="<?php echo __( 'Expiration Date', 'visachild' ); ?>">
											<span class="validate_error"><?php echo isset($arrivalErr) ? $arrivalErr : ''; ?></span>
										</div>
									</div><!-- form-group -->
								</div>

								<div id="previous_visit_info_secrion" class="form_seprationSection">
									<h3><?php echo __( 'Last visit to Thailand', 'visachild' ); ?></h3>
									<p><?php echo __( 'If you have been to Thailand before, please enter the relevant details below.', 'visachild' ); ?></p>
									<div class="form-group row">
										<label for="traverler_thailand_visit_<?php echo $j; ?>" class="vc_col-md-3 col-form-label"><?php echo __( 'Previous Visit to Thailand', 'visachild' ); ?></label>
										<div class="vc_col-md-9">
											<select name="traverler[thailand_visit][]" id="traverler_thailand_visit">
												<option value="No" <?php echo (isset($_POST['traverler']['thailand_visit'][$j]) == 'No') ? 'selected' : ''; ?>>No</option>
												<option value="Yes" <?php echo (isset($_POST['traverler']['thailand_visit'][$j]) == 'Yes') ? 'selected' : ''; ?>>Yes</option>
											</select>
										</div>
									</div><!-- form-group -->
									<div class="previous_visit_info hidden">
										<div class="form-group row">
											<label for="traverler_previous_trip_date" class="vc_col-md-3 col-form-label"><?php echo __( 'Date of Previous Visit', 'visachild' ); ?></label>
											<div class="vc_col-md-9">
												<input type="date" class="form-control" value="<?php echo isset($_POST['traverler']['previous_visit_date'][$j]) ? $_POST['traverler']['previous_visit_date'][$j] : ''; ?>" name="traverler[previous_visit_date][]" id="traverler_previous_visit_date">
											</div>
										</div><!-- form-group -->
									</div>
								</div>
							</div> <!-- traveler_info -->

						<?php } ?>


						<div class="add_travelers-section" id="add_travelers-section">
							<span id="add_traverl_info_button" class="btn btn-full-width btn-primary" data-total="<?php echo $cntTraveller; ?>">
								<i class="fa fa-user-plus" aria-hidden="true"></i>  Add a traveler
							</span>
						</div> <!-- add_travelers-section -->
					</div> <!-- visa_travel_details-information -->

					<div id="visa_form_submit_section" class="visa_form_submit_section form_seprationSection">
						<button type="submit" class="btn btn-conv" data-nonce="<?php echo $thailand_nonce; ?>">
							<span>Apply for visas</span><i class="fa fa-angle-right" aria-hidden="true"></i>
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-4 matlassidebar mequalheight">
			<div class="wrapper">
				<div class="flag-section">
					<img style="display: inline-block; width: 150px" src="<?php echo get_stylesheet_directory_uri().'/Flags/thailand-flag.png'; ?>">
					<h2 style="display: inline-block; font-size: 25px; ">Visum Thailand</h2>
				</div>
				<div class="content">
					<div id="visum">
						<p><b>Visum: </b> Russia Tourism</p>
					</div>
					<div id="duration">
						<p><b>Duration: </b>31 to 60 Days </p>
					</div>
					<div id="price">
						<p><b>Price: </b> ??? 69,95</p>
					</div>
					<div id="FactSheet">
						<p><a href="<?php the_field('factsheet'); ?>" target="_blank">Download PDF</a></p>
					</div>
				</div>
				<div class="more-info">
					<p class="introduction">
						<font style="vertical-align: inherit;">
							Do you need help filling in a certain field?<br>
							For some fields there is alreay an explanation given.
							If you need further assistance, please <b>contact us</b>.
						</font>
					</p>
					<p><span><i class="fa fa-phone"></i> +31 (0) 23 - 221 00 04</span></p>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var old_price = '';

		if ($('#purpose').val() == "Business") {
				$('#visum').html('<p><b>Visum: </b> Thailand Business</p>');
				$('#duration').html('<p><b>Duration: </b> Maximum 60 days</p>');
				$('#price').html('<p><b>Price: </b> ??? 99,95</p>');
				$('.tourism_duration').hide();
				$('#duration_option').val('maximum 60 days');
				$('.duration-31-60').show();

			}
			else {
				$('#visum').html('<p><b>Visum: </b> Thailand Tourism</p>');
				$('#duration_option').val('31 to 60 days');
				$('.tourism_duration').show();
				if ($('#duration_option').val() ==  '1 to 30 days') {
					$('#duration').html('<p><b>Duration: </b> 1 to 30 days</p>');
					$('#price').html('<p><b>Price: </b> No visum required</p>');
					$('.duration-31-60').hide();

				}
				if ($('#duration_option').val() ==  '31 to 60 days'){
					$('#duration').html('<p><b>Duration: </b> 31 to 60 days</p>');
					$('#price').html('<p><b>Price: </b> ??? 69,95</p>');
					$('.duration-31-60').show();
				}
			}

		$('#purpose').change(function() {
			var purpose = $('#purpose').val();

			if (purpose == 'Tourism') {
				$('#purpose_modal .modal-title').html('<b>Are you sure to change to Tourism purpose?</b>');
			}

			else {
				$('#purpose_modal .modal-title').html('<b>Are you sure to change to Business purpose?</b>');
			}
			$('#purpose_modal').modal('show');
		});

		$('#change_purpose_btn').click(function() {
			if ($('#purpose').val() == "Business") {
				newselectedValue = "Business";
				$('#purpose').val( newselectedValue );
				$('#visum').html('<p><b>Visum: </b> Thailand '+ newselectedValue +'</p>');
				$('#duration').html('<p><b>Duration: </b> Maximum 60 days</p>');
				$('#price').html('<p><b>Price: </b> ??? 99,95</p>');
				$('.tourism_duration').hide();
				$('#duration_option').val('maximum 60 days');
				$('.duration-31-60').show();

			}
			else {
				newselectedValue = "Tourism";
				$('#purpose').val( newselectedValue );
				$('#visum').html('<p><b>Visum: </b> Thailand '+ newselectedValue +'</p>');
				$('#duration_option').val('31 to 60 days');
				$('.tourism_duration').show();
				if ($('#duration_option').val() ==  '1 to 30 days') {
					$('#duration').html('<p><b>Duration: </b> 1 to 30 days</p>');
					$('#price').html('<p><b>Price: </b> No visum required</p>');
					$('.duration-31-60').hide();

				}
				if ($('#duration_option').val() ==  '31 to 60 days'){
					$('#duration').html('<p><b>Duration: </b> 31 to 60 days</p>');
					$('#price').html('<p><b>Price: </b> ??? 69,95</p>');
					$('.duration-31-60').show();
				}
			}

			$('#purpose_modal').modal('hide');
			// $('.visa_form_submit')[0].reset();

		});

		$('#cancel_purpose_btn').click(function() {
			if ($('#purpose').val() == "Business") {
				$('#purpose').val('Tourism');
			}
			else{
				$('#purpose').val('Business');
			}
		});


		$("#duration_option").change(function(){
			if ($('#duration_option').val() ==  '1 to 30 days') {
				if ($('#purpose').val() == 'Tourism') {
					$('#duration').html('<p><b>Duration: </b> 1 to 30 days</p>');
					$('#price').html('<p><b>Price: </b> No visum required</p>');
					$('#visa_modal').modal('show');
					$('.duration-31-60').hide();
				}
			}
			if ($('#duration_option').val() ==  '31 to 60 days'){
				if ($('#purpose').val() == 'Tourism') {
					$('#duration').html('<p><b>Duration: </b> 31 to 60 days</p>');
					$('#price').html('<p><b>Price: </b> ??? 69.95</p>');
					$('.duration-31-60').show();

				}
			}
			old_price = $('#price').text().split('???');
		});

		$(document).on('change','#travel_method',function(event) {
			if ($(this).val() == 'plane') {
				$(this).parent().parent().siblings('.travel_method_info').addClass('hidden');
				$(this).parent().parent().siblings('.travel-flight').toggleClass('hidden');

			}
			if($(this).val() == 'boat'){
				$(this).parent().parent().siblings('.travel_method_info').addClass('hidden');
				$(this).parent().parent().siblings('.travel-boat').toggleClass('hidden');
			}
			if ($(this).val() == 'car') {
				$(this).parent().parent().siblings('.travel_method_info').addClass('hidden');
			}
		});

		$(document).on('change','#traverler_work',function(event) {
			$(this).parent().parent().siblings('.work-info').toggleClass('hidden');
		});

		$(document).on('change','#traverler_thailand_visit',function(event) {
			console.log('change');
			$(this).parent().parent().siblings('.previous_visit_info').toggleClass('hidden');
		});
		$(document).on('change', '#shipping_method', function(event) {
			updatePrice();
		});

		$(document).on('change', '#return_method', function(event) {
			updatePrice();
		});

		function updatePrice(){
			var shipping_method = 0;
			var return_method = 0;
			var old_price = 0;
			var price = 0;
			if ($('#purpose').val() == "Tourism") {
				old_price = 69.95;
			}
			else{
				old_price = 99.95;
			}

			shipping_method = $('#shipping_method'). children("option:selected").data('price');

			return_method = $('#return_method'). children("option:selected").data('price');
			price = parseFloat(old_price) + parseFloat(shipping_method) + parseFloat(return_method);

			$('#price').html('<p><b>Price: </b> ??? '+price.toFixed(2)+'</p>');
		}
	});
</script>
<?php get_footer();
?>
