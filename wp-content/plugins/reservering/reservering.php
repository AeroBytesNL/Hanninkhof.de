<?php
	/*
  Plugin Name: Reserveringen
  Plugin URI: https://github.com/AeroBytesNL/Hanninkhof.de
  Description: Reserveringen systeem
  Version: 1.0
  Author: AeroBytes
  Author URI: https://AeroBytes.nl
  */
  
	/**
	 * CREATE TABLE `<DB NAME HERE>`.`bookings` (`id` INT NOT NULL AUTO_INCREMENT , `start_date` DATE NOT NULL , `end_date` DATE NOT NULL , `first_name` VARCHAR(255) NOT NULL , `last_name` VARCHAR(255) NOT NULL , `birthdate` DATE NOT NULL , `nationality` VARCHAR(255) NOT NULL , `address` VARCHAR(255) NOT NULL , `city` VARCHAR(255) NOT NULL , `zipcode` VARCHAR(255) NOT NULL , `id_number` VARCHAR(255) NULL DEFAULT NULL , `email` VARCHAR(255) NOT NULL , `phone` VARCHAR(255) NOT NULL , `animals` INT(2) NULL DEFAULT NULL , `child_bed` INT(2) NULL DEFAULT NULL , `comments` TEXT NULL DEFAULT NULL , `amount_persons` INT(10) NOT NULL , `name_first_second` VARCHAR(255) NULL DEFAULT NULL , `name_last_second` VARCHAR(255) NULL DEFAULT NULL , `city_second` VARCHAR(255) NULL DEFAULT NULL , `nationality_person_2` VARCHAR(255) NULL DEFAULT NULL , `birthdate_second` DATE NULL DEFAULT NULL , `id_number_second` VARCHAR(255) NULL DEFAULT NULL , `first_name_thirth` VARCHAR(255) NULL DEFAULT NULL , `last_name_thirth` VARCHAR(255) NULL DEFAULT NULL , `city_thirth` VARCHAR(255) NULL DEFAULT NULL , `nationality_person_3` VARCHAR(255) NULL DEFAULT NULL , `birthdate_thirth` VARCHAR(255) NULL DEFAULT NULL , `id_number_thirth` VARCHAR(255) NULL DEFAULT NULL , `first_name_fourth` VARCHAR(255) NULL DEFAULT NULL , `last_name_fourth` VARCHAR(255) NULL DEFAULT NULL , `city_fourth` VARCHAR(255) NULL DEFAULT NULL , `nationality_person_4` VARCHAR(255) NULL DEFAULT NULL , `birthdate_fourth` DATE NULL DEFAULT NULL , `id_number_fourth` VARCHAR(255) NULL DEFAULT NULL , `house_rented` VARCHAR(255) NOT NULL , `discount_amount` INT(255) NULL DEFAULT NULL , `total_price` BIGINT(1000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
	 * CREATE TABLE `booking_settings` (
	 * `name` varchar(255) NOT NULL,
	 * `value` varchar(255) NOT NULL
	 * ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
	 * COMMIT;
   *
   * CREATE TABLE `auticodes_hanninkshof`.`houses` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `price` VARCHAR(255) NOT NULL , `max_persons` INT(12) NULL DEFAULT NULL , `animals_allowed` INT(2) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
	 */
	
	function create_menus() {
		add_menu_page(
			'Reserveringen',
			'Reserveringen',
			'edit_theme_options',
			'reserveringen',
			'reservation_options_page',
			'dashicons-admin-home'
		);
		
		add_submenu_page(
			'',
			'Weergeven',
			'Weergeven',
			'manage_options',
			'reservering-weergeven',
			'reservation_view_page',
		);
		
		add_submenu_page(
			'reserveringen',
			'Klanten',
			'Klanten',
			'manage_options',
			'reserveringen-customers',
			'reservation_customers_page',
		);
		
		add_submenu_page(
			'',
			'',
			'',
			'manage_options',
			'reserveringen-customers-aanmaken',
			'reservation_create_customers_page',
		);
		
		add_submenu_page(
			'reserveringen',
			'Huizen',
			'Huizen',
			'manage_options',
			'reserveringen-huizen',
			'reservation_houses_page',
		);
		
		add_submenu_page(
			'',
			'',
			'',
			'manage_options',
			'reserveringen-huizen-aanmaken',
			'reservation_create_house_page',
		);
	  
	  add_submenu_page(
		  '',
		  '',
		  '',
		  'manage_options',
		  'reserveringen-huizen-wijzigen',
		  'reservation_edit_house_page',
	  );
		
		add_submenu_page(
			'reserveringen',
			'Omzet',
			'Omzet',
			'manage_options',
			'reserveringen-omzet',
			'reservation_financial_page',
		);
		
		add_submenu_page(
			'reserveringen',
			'Instellingen',
			'Instellingen',
			'manage_options',
			'reserveringen-instellingen',
			'reservation_settings_page',
		);
	}
	
	add_action( 'admin_menu', 'create_menus' );
  
  function send_email() {

//    try {
//      $mail = new PHPMailer();
//      $mail->isSMTP();
//      $mail->Host = getenv("MAIL_HOST");
//      $mail->SMTPAuth = false;
//      $mail->Username = getenv("MAIL_USERNAME");
//      $mail->Password = getenv("MAIL_PASSWORD");
//      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//      $mail->Port = 587;
//      $mail->setFrom(getenv("MAIL_USERNAME"), 'Reserveringen');
//      $mail->addAddress("prive@auticodes.nl", "Prive");
//      $mail->isHTML(true);
//      $mail->Subject = 'Reservering';
//      $mail->Body = 'Hier is een bericht';
//      $mail->send();
//
//      if ($mail->send()) {
//          echo 'Email sent!';
//      } else {
//          echo 'Email not sent!';
//      }
//    } catch (Exception $e) {
//      echo 'Message could not be sent.';
//    }
  }
  
  send_email();
  
	function get_admin_bookings() {
		global $wpdb;
		
		$bookings = $wpdb->get_results(
			"SELECT * FROM bookings ORDER BY id DESC "
		);
		
		return $bookings;
	}
	
	/**
	 * The reservation page
	 */
	function reservation_options_page() {
		?>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">

      <h1 class="mt-2 ml-2">Reserveringen</h1>

      <hr>

      <!--
	  <div class="container">
		  <div class="month">
			  <ul>
				  <li class="prev">&#10094;</li>
				  <li class="next">&#10095;</li>
				  <li>
				  November<br>
				  <span style="font-size:18px">2025</span>
				  </li>
			  </ul>
		  </div>
  
		  <ul class="weekdays">
			  <li>Maandag</li>
			  <li>Dinsdag</li>
			  <li>Woensdag</li>
			  <li>Donderdag</li>
			  <li>Vrijdag</li>
			  <li>Zaterdag</li>
			  <li>Zondag</li>
		  </ul>
  
		  <ul class="days">
			  <li><strong>1</strong></li>
			  <li><strong>2</strong></li>
			  <li><strong>3</strong></li>
			  <li><strong>4</strong></li>
			  <li><strong>5</strong></li>
			  <li><strong>6</strong></li>
			  <li><strong>7</strong></li>
			  <li><span class="badge text-bg-danger p-2"><strong>8</strong></span></li>
			  <li><span class="badge text-bg-danger p-2"><strong>9</strong></li>
			  <li><span class="badge text-bg-danger p-2"><strong>10</strong></span></li>
			  <li><strong>11</strong></li>
			  <li><strong>12</strong></li>
			  <li><strong>13</strong></li>
			  <li><strong>14</strong></li>
			  <li><strong>15</strong></li>
			  <li><strong>16</strong></li>
			  <li><strong>17</strong></li>
			  <li><strong>18</strong></li>
			  <li><span class="badge text-bg-warning p-2"><strong>19</strong></span></li>
			  <li><span class="badge text-bg-warning p-2"><strong>20</strong></span></li>
			  <li><strong>21</strong></li>
			  <li><strong>22</strong></li>
			  <li><strong>23</strong></li>
			  <li><strong>24</strong></li>
			  <li><strong>25</strong></li>
			  <li><strong>26</strong></li>
			  <li><strong>27</strong></li>
			  <li><strong>28</strong></li>
			  <li><strong>29</strong></li>
			  <li><strong>30</strong></li>
			  <li><strong>31</strong></li>
		  </ul>
  
		  <p>Geboekt: <span class="badge text-bg-danger p-2 mr-2">&nbsp;</span> Onbevestigt: <span class="badge text-bg-warning p-2 mr-3">&nbsp;</span></p>
	  </div>
  
	  -->

      <div class="container">
        <h1>Overzicht</h1>

        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">Huis/kamer</th>
            <th scope="col">Naam</th>
            <th scope="col">Aankomst</th>
            <th scope="col">Vertrek</th>
            <th scope="col">Aantal personen</th>
            <th scope="col">Aantal nachten</th>
            <th scope="col">Totaal prijs</th>
            <th scope="col">Betaling status</th>
            <th scope="col">Status</th>
            <th scope="col">Weergeven</th>
          </tr>
          </thead>
          <tbody>
		  <?php
			  foreach ( get_admin_bookings() as $booking ) {
				  ?>
                <tr>
                  <td><a href="#"><?php echo $booking->home; ?></a></td>
                  <td><a href="#"><?php echo $booking->first_name . ' ' . $booking->last_name; ?></a></td>
                  <td><?php echo date_format( date_create( $booking->start_date ), 'd-m-Y' ); ?></td>
                  <td><?php echo date_format( date_create( $booking->end_date ), 'd-m-Y' ); ?></td>
                  <td><?php echo $booking->amount_persons; ?></td>
                  <td>
					  <?php
						  echo ( new DateTime( $booking->end_date ) )->diff( new DateTime( $booking->start_date ) )->format( '%a' );
					  ?>
                  </td>
                  <td>€<?php echo $booking->total_price; ?></td>
                  <td>
					  <?php
						  if ( $booking->is_paid == 0 ) {
							  echo '<span class="badge text-bg-danger">NIET BETAALD</span>';
						  } else {
							  echo '<span class="badge text-bg-success">BETAALD</span>';
						  }
					  ?>
                  </td>
                  <td>
					  <?php
						  if ( $booking->accepted == 0 ) {
							  echo '<span class="badge text-bg-danger">IN BEHANDELING</span>';
						  } else {
							  echo '<span class="badge text-bg-success">BEHANDELD</span>';
						  }
					  ?>
                  </td>
                  <td>
                    <a href="/wp-admin/index.php?page=reservering-weergeven&booking_id=<?php echo $booking->id ?>">
                      <span class="dashicons dashicons-search"></span>
                    </a>
                  </td>
                </tr>
				  <?php
			  }
		  ?>
          </tbody>
        </table>
      </div>

      <style>
          .month {
              padding: 10px 25px;
              width: 100%;
              background: #1d2327;
              text-align: center;
          }

          .month ul {
              margin: 0;
              padding: 0;
          }

          .month ul li {
              color: white;
              font-size: 20px;
              text-transform: uppercase;
              letter-spacing: 3px;
          }

          .month .prev {
              float: left;
              padding-top: 10px;
          }

          .month .next {
              float: right;
              padding-top: 10px;
          }

          .weekdays {
              margin: 0;
              padding: 10px 0;
              background-color: #ddd;
          }

          .weekdays li {
              display: inline-block;
              width: 13.6%;
              color: #666;
              text-align: center;
          }

          .days {
              padding: 10px 0;
              background: #eee;
              margin: 0;
          }

          .days li {
              list-style-type: none;
              display: inline-block;
              width: 13.6%;
              text-align: center;
              margin-bottom: 5px;
              font-size: 12px;
              color: #777;
          }

          .days li .active {
              padding: 5px;
              background: #1abc9c;
              color: white !important
          }

          /* Add media queries for smaller screens */
          @media screen and (max-width: 720px) {
              .weekdays li, .days li {
                  width: 13.1%;
              }
          }

          @media screen and (max-width: 420px) {
              .weekdays li, .days li {
                  width: 12.5%;
              }

              .days li .active {
                  padding: 2px;
              }
          }

          @media screen and (max-width: 290px) {
              .weekdays li, .days li {
                  width: 12.2%;
              }
          }
      </style>

      <script src="js/jquery.min.js"></script>
      <script src="js/popper.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
              integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
              crossorigin="anonymous"></script>
		<?php
	}
 
	function handle_reservation_view_update() {
		global $wpdb;
		
		$id = intval( $_POST['booking_id'] );
		
		if ( isset( $_POST['booking_view_update_submit'] ) ) {
			$updated = $wpdb->update(
				'bookings',
				array(
					'start_date'           => sanitize_text_field( $_POST['start_date'] ),
					'end_date'             => sanitize_text_field( $_POST['end_date'] ),
					'home'                 => sanitize_text_field( $_POST['home'] ),
					'first_name'           => sanitize_text_field( $_POST['first_name'] ),
					'last_name'            => sanitize_text_field( $_POST['last_name'] ),
					'birthdate'            => sanitize_text_field( $_POST['birthdate'] ),
					'nationality'          => sanitize_text_field( $_POST['nationality'] ),
					'address'              => sanitize_text_field( $_POST['address'] ),
					'city'                 => sanitize_text_field( $_POST['city'] ),
					'zipcode'              => sanitize_text_field( $_POST['zipcode'] ),
					'id_number'            => sanitize_text_field( $_POST['id_number_first'] ),
					'email'                => sanitize_email( $_POST['email'] ),
					'phone'                => sanitize_text_field( $_POST['phone'] ),
					'animals'              => sanitize_text_field( $_POST['animals'] ?? null ),
					'child_bed'            => sanitize_text_field( $_POST['child_bed'] ?? null ),
					'comments'             => sanitize_text_field( $_POST['comments'] ?? null ),
					'amount_persons'       => intval( 1 ),
					'name_first_second'    => sanitize_text_field( $_POST['name_first_second'] ?? null ),
					'name_last_second'     => sanitize_text_field( $_POST['name_last_second'] ?? null ),
					'city_second'          => sanitize_text_field( $_POST['city_second'] ?? null ),
					'nationality_person_2' => sanitize_text_field( $_POST['nationality_person_2'] ?? null ),
					'birthdate_second'     => sanitize_text_field( $_POST['birthdate_second'] ?? null ),
					'id_number_second'     => sanitize_text_field( $_POST['id_number_second'] ?? null ),
					'first_name_thirth'    => sanitize_text_field( $_POST['first_name_thirth'] ?? null ),
					'last_name_thirth'     => sanitize_text_field( $_POST['last_name_thirth'] ?? null ),
					'city_thirth'          => sanitize_text_field( $_POST['city_thirth'] ?? null ),
					'nationality_person_3' => sanitize_text_field( $_POST['nationality_person_3'] ?? null ),
					'birthdate_thirth'     => sanitize_text_field( $_POST['birthdate_thirth'] ?? null ),
					'id_number_thirth'     => sanitize_text_field( $_POST['id_number_thirth'] ?? null ),
					'first_name_fourth'    => sanitize_text_field( $_POST['first_name_fourth'] ?? null ),
					'last_name_fourth'     => sanitize_text_field( $_POST['last_name_fourth'] ?? null ),
					'city_fourth'          => sanitize_text_field( $_POST['city_fourth'] ?? null ),
					'nationality_person_4' => sanitize_text_field( $_POST['nationality_person_4'] ?? null ),
					'birthdate_fourth'     => sanitize_text_field( $_POST['birthdate_fourth'] ?? null ),
					'id_number_fourth'     => sanitize_text_field( $_POST['id_number_fourth'] ?? null ),
					'house_rented'         => sanitize_text_field( $_POST['home'] ),
					'discount_amount'      => 0,
				),
				array( // Voorwaarde voor update
					'id' => $id,
				)
			);
			
			// Controleer het resultaat
			if ( $updated === false ) {
				echo 'Er is iets mis gegaan bij het updaten van de reservering.';
			} elseif ( $updated === 0 ) {
				echo 'Geen wijzigingen doorgevoerd.';
			} else {
				echo 'Reservering is geüpdatet!';
			}
		}
		
	}
	
	function handle_reservation_view_accept() {
		echo 'jeej';
	}
	
	function handle_reservation_view_deny() {
		if ( ! isset( $_POST['booking_view_deny_submit'] ) ) {
			return;
		}
	}
 
	
	/**
	 * Shows an specific reservation
	 */
	function reservation_view_page() {
		global $wpdb;
    send_email();

		$booking_id = intval( $_GET['booking_id'] );
		
		if ( isset( $_POST['booking_view_update_submit'] ) ) {
			if ( isset( $_POST['name_first_second'] ) && ! empty( $_POST['name_first_second'] ) ) {
				$amount_persons = 2;
			} elseif ( isset( $_POST['name_first_thirth'] ) && ! empty( $_POST['name_first_thirth'] ) ) {
				$amount_persons = 3;
			} elseif ( isset( $_POST['name_first_fourth'] ) && ! empty( $_POST['name_first_fourth'] ) ) {
				$amount_persons = 4;
			} else {
				$amount_persons = 1;
			}
			
			$updated = $wpdb->update(
				'bookings',
				array(
					'start_date'           => $_POST['start_date'],
					'end_date'             => $_POST['end_date'],
					'home'                 => sanitize_text_field( $_POST['home'] ),
					'first_name'           => sanitize_text_field( $_POST['first_name'] ),
					'last_name'            => sanitize_text_field( $_POST['last_name'] ),
					'birthdate'            => sanitize_text_field( $_POST['birthdate'] ),
					'nationality'          => sanitize_text_field( $_POST['nationality'] ),
					'address'              => sanitize_text_field( $_POST['address'] ),
					'city'                 => sanitize_text_field( $_POST['city'] ),
					'zipcode'              => sanitize_text_field( $_POST['zipcode'] ),
					'id_number'            => sanitize_text_field( $_POST['id_number_first'] ),
					'email'                => sanitize_email( $_POST['email'] ),
					'phone'                => sanitize_text_field( $_POST['phone'] ),
					'animals'              => sanitize_text_field( $_POST['animals'] ?? null ),
					'child_bed'            => sanitize_text_field( $_POST['child_bed'] ?? null ),
					'comments'             => sanitize_text_field( $_POST['comments'] ?? null ),
					'amount_persons'       => intval( $amount_persons ),
					'name_first_second'    => sanitize_text_field( $_POST['name_first_second'] ?? null ),
					'name_last_second'     => sanitize_text_field( $_POST['name_last_second'] ?? null ),
					'city_second'          => sanitize_text_field( $_POST['city_second'] ?? null ),
					'nationality_person_2' => sanitize_text_field( $_POST['nationality_person_2'] ?? null ),
					'birthdate_second'     => sanitize_text_field( $_POST['birthdate_second'] ?? null ),
					'id_number_second'     => sanitize_text_field( $_POST['id_number_second'] ?? null ),
					'first_name_thirth'    => sanitize_text_field( $_POST['first_name_thirth'] ?? null ),
					'last_name_thirth'     => sanitize_text_field( $_POST['last_name_thirth'] ?? null ),
					'city_thirth'          => sanitize_text_field( $_POST['city_thirth'] ?? null ),
					'nationality_person_3' => sanitize_text_field( $_POST['nationality_person_3'] ?? null ),
					'birthdate_thirth'     => sanitize_text_field( $_POST['birthdate_thirth'] ?? null ),
					'id_number_thirth'     => sanitize_text_field( $_POST['id_number_thirth'] ?? null ),
					'first_name_fourth'    => sanitize_text_field( $_POST['first_name_fourth'] ?? null ),
					'last_name_fourth'     => sanitize_text_field( $_POST['last_name_fourth'] ?? null ),
					'city_fourth'          => sanitize_text_field( $_POST['city_fourth'] ?? null ),
					'nationality_person_4' => sanitize_text_field( $_POST['nationality_person_4'] ?? null ),
					'birthdate_fourth'     => sanitize_text_field( $_POST['birthdate_fourth'] ?? null ),
					'id_number_fourth'     => sanitize_text_field( $_POST['id_number_fourth'] ?? null ),
					'house_rented'         => sanitize_text_field( $_POST['home'] ),
					'discount_amount'      => 0,
				),
				array( // Voorwaarde voor update
					'id' => intval( $_POST['booking_id'] ),
				)
			);
			
			// Controleer het resultaat
			if ( $updated === false ) {
				echo 'Er is iets mis gegaan bij het updaten van de reservering.';
			} elseif ( $updated === 0 ) {
				echo 'Geen wijzigingen doorgevoerd.';
			} else {
				echo 'Reservering is geüpdatet!';
			}
		}
		
		if ( isset( $_POST['booking_view_accept_booking_submit'] ) ) {
			$updated = $wpdb->update(
				'bookings',
				array(
					'accepted' => 1,
				),
				array(
					'id' => intval( $_POST['booking_id'] ),
				)
			);
		}
		
		if ( isset( $_POST['booking_view_accept_payment_submit'] ) ) {
			$updated = $wpdb->update(
				'bookings',
				array(
					'is_paid' => 1,
				),
				array(
					'id' => intval( $_POST['booking_id'] ),
				)
			);
		}
		
		$booking = $wpdb->get_results(
			$wpdb->prepare(
				"
                SELECT * FROM `bookings` WHERE id = $booking_id
            "
			)
		)[0];
		
		$houses = $wpdb->get_results(
			$wpdb->prepare(
				"
                SELECT * FROM `houses`
            "
			)
		);
		
		if ( ! $booking ) {
			echo 'Geen boeking gevonden, OEPS';
		}
		
    if ( isset( $_POST['booking_view_delete_submit'] ) ) {
      global $wpdb;

      $booking_id = intval( $_POST['booking_id'] );

      $delete_query = $wpdb->delete(
        'bookings',
        array(
          'id' => $booking_id,
        )
      );
      
      if ( $delete_query === false ) {
          error_log( 'Query mislukt: ' . $wpdb->last_query );
          error_log( 'DB Error: ' . $wpdb->last_error );
          wp_redirect('/wp-admin/index.php?page=reservering-overzicht&status=error');
          exit;
      }
  
      wp_redirect('/wp-admin/index.php?page=reservering-overzicht&status=success');
      exit;
		}
  
		?>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

      <h1 class="mt-2 ml-2">Reservering</h1>

      <hr>

      <div class="container">
        <div class="d-flex justify-content-center">
          <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="POST">
            <input type="hidden" value="<?php echo $booking_id; ?>" name="booking_id">
            <div class="mb-3">
              <h1>Huis/appartement</h1>
              <select class="form-select" aria-label="" id="home" name="home" onchange="changePrice(event)">
                <option selected disabled>Selecteer</option>
				  <?php
					  global $wpdb;
					  
					  $houses = $wpdb->get_results(
						  "
            SELECT * FROM `houses`;
            "
					  );
					  
					  foreach ( $houses as $house ) {
						  ?>
                        <option value="<?php echo $house->name; ?>"
                                data-price="<?php echo $house->price; ?>" <?php if ( $booking->home == $house->name ) {
							echo 'selected';
						} ?>><?php echo $house->name; ?></option>
						  <?php
					  }
				  ?>
              </select>
            </div>

            <hr>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="start_date" class="form-label">Aankomst</label>
                  <input type="date" class="form-control" id="start_date" name="start_date" aria-describedby=""
                         value="<?php echo $booking->start_date; ?>">
                </div>
              </div>

              <div class="col">
                <div class="mb-3">
                  <label for="end_date" class="form-label">Vertrek</label>
                  <input type="date" class="form-control" id="end_date" name="end_date" aria-describedby=""
                         value="<?php echo $booking->end_date; ?>">
                </div>
              </div>
            </div>

            <input type="hidden" name="days_to_rent" id="selected_days" value="">

            <hr>

            <div class="row">
              <h1>Boeker</h1>
              <div class="col">
                <!-- Form -->
                <div class="mb-3">
                  <label for="first_name" class="form-label">Naam</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" aria-describedby=""
                         placeholder="Voornaam" value="<?php echo $booking->first_name; ?>">
                </div>
                <div class="mb-3">
                  <label for="last_name" class="form-label">Achternaam</label>
                  <input type="text" class="form-control" id="last_name" name="last_name"
                         value="<?php echo $booking->last_name; ?>">
                </div>
              </div>

              <div class="col">
                <div class="mb-3">
                  <label for="birthdate" class="form-label">Geboortedatum</label>

                  <input type="date" class="form-control" id="birthdate" name="birthdate" aria-describedby=""
                         value="<?php echo $booking->birthdate; ?>">
                </div>

                <div class="mb-3">
                  <label for="nationality" class="form-label">Nationaliteit</label>
                  <select class="form-select" aria-label="Default select example" id="nationality" name="nationality"
                          onchange="showHideIdFirst()">
                    <option value="NL" <?php if ( $booking->nationality == 'NL' ) {
						echo 'selected';
					} ?>>Nederlands
                    </option>
                    <option value="GE" <?php if ( $booking->nationality == 'GE' ) {
						echo 'selected';
					} ?>>Duits
                    </option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="address" class="form-label">Adres</label>
                  <input type="text" class="form-control" id="address" name="address" aria-describedby=""
                         value="<?php echo $booking->address ?>">
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="city" class="form-label">Woonplaats</label>
                  <input type="text" class="form-control" id="city" name="city" aria-describedby=""
                         value="<?php echo $booking->city ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="zipcode" class="form-label">Postcode</label>
                  <input type="text" class="form-control" id="zipcode" name="zipcode" aria-describedby=""
                         value="<?php echo $booking->zipcode ?>">
                </div>
              </div>
              <div class="col">
                <div class="mb-3" style="display: none;" id="id_number_first">
                  <label for="id_number_first" class="form-label">ID/paspoort nummer</label>
                  <input type="text" class="form-control" id="id_number_first" name="id_number_first"
                         aria-describedby="" value="<?php echo $booking->id_number ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="email" class="form-label">Email adres</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby=""
                         value="<?php echo $booking->email ?>">
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="phone" class="form-label">Telefoonnummer</label>
                  <input type="text" class="form-control" id="phone" name="phone" aria-describedby=""
                         value="<?php echo $booking->phone ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <h4>Opties</h4>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="5" id="animals" name="animals"
                         onchange="changePrice()" <?php if ( $booking->animals == 1 ) {
					  echo 'checked';
				  } ?>>
                  <label class="form-check-label" for="animals">
                    Huisdieren die mee komen (5€ extra)
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="10" id="child_bed" name="child_bed"
                         onchange="changePrice()" <?php if ( $booking->child_bed == 1 ) {
					  echo 'checked';
				  } ?>>
                  <label class="form-check-label" for="child_bed">
                    Kinderbedje(ledikantje) (10€ extra)
                  </label>
                </div>
              </diV>

              <div class="col">
                <div class="mb-3">
                  <label for="comments" class="form-label">Opmerkingen</label>
					<?php echo $booking->comments; ?>
                  <textarea class="form-control" aria-label="" id="comments"
                            name="comments"><?php echo $booking->comments; ?></textarea>
                </div>
              </div>
            </div>

            <p>
              Wintermaanden extra verwarmingskosten: 1 Oktober t/m 31 april 10 per nacht per appartement.
              <br>
              Toeristenbelasting: €2.10 p.p. per nacht 14 jaar en ouder.
              <br>
              Prijzen zijn op basis van 2 personen per nacht.
              Extra personen zijn €10 p.p. per nacht voor 13>.
              Kinderen 13< zijn gratis.
            </p>

            <hr>

            <h1>Aantal personen</h1>

            <div class="mb-3" style="display: block" id="person_2">
              <p>Persoon 2:</p>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="name_first_second" class="form-label">Voornaam</label>
                    <input type="text" class="form-control" id="name_first_second" name="name_first_second"
                           aria-describedby="" value="<?php echo $booking->name_first_second ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="name_last_second" class="form-label">Achternaam</label>
                    <input type="text" class="form-control" id="name_last_second" name="name_last_second"
                           aria-describedby="" value="<?php echo $booking->name_last_second ?>">
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="city_second" class="form-label">Woonplaats</label>
                    <input type="text" class="form-control" id="city_second" name="city_second" aria-describedby=""
                           value="<?php echo $booking->city_second ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="nationality_person_2" class="form-label">Nationaliteit</label>
                    <select class="form-select" aria-label="Default select example" id="nationality_person_2"
                            name="nationality_person_2" onchange="showHideIdSecond()">
                      <option value="NL" <?php if ( $booking->nationality_person_2 == 'NL' ) {
						  echo 'selected';
					  } ?>>Nederlands
                      </option>
                      <option value="GE" <?php if ( $booking->nationality_person_2 == 'GE' ) {
						  echo 'selected';
					  } ?>>Duits
                      </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="birthdate_second" class="form-label">Geboortedatum</label>
                    <input type="date" class="form-control" id="birthdate_second" name="birthdate_second"
                           aria-describedby="" value="<?php echo $booking->birthdate_second ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3" style="display: none;" id="id_number_second">
                    <label for="id_number_second" class="form-label">ID/paspoort nummer</label>
                    <input type="text" class="form-control" id="id_number_second" name="id_number_second"
                           aria-describedby="" value="<?php echo $booking->id_number_second ?>">
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-3" style="display: block" id="person_3">
              <p>Persoon 3:</p>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="first_name_thirth" class="form-label">Voornaam</label>
                    <input type="text" class="form-control" id="first_name_thirth" name="first_name_thirth"
                           aria-describedby="" value="<?php echo $booking->first_name_thirth ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="last_name_thirth" class="form-label">Achternaam</label>
                    <input type="text" class="form-control" id="last_name_thirth" name="last_name_thirth"
                           aria-describedby="" value="<?php echo $booking->last_name_thirth ?>">
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="city_thirth" class="form-label">Woonplaats</label>
                    <input type="text" class="form-control" id="city_thirth" name="city_thirth" aria-describedby=""
                           value="<?php echo $booking->city_thirth ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="nationality_person_3" class="form-label">Nationaliteit</label>
                    <select class="form-select" aria-label="Default select example" id="nationality_person_3"
                            name="nationality_person_3" onchange="showHideIdThirth()">
                      <option value="NL" <?php if ( $booking->nationality_person_3 == 'NL' ) {
						  echo 'selected';
					  } ?>>Nederlands
                      </option>
                      <option value="GE" <?php if ( $booking->nationality_person_3 == 'GE' ) {
						  echo 'selected';
					  } ?>>Duits
                      </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="birthdate_thirth" class="form-label">Geboortedatum</label>
                    <input type="date" class="form-control" id="birthdate_thirth" name="birthdate_thirth"
                           aria-describedby="" value="<?php echo $booking->birthdate_thirth ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3" style="display: none;" id="id_number_thirth">
                    <label for="id_number_thirth" class="form-label">ID/paspoort nummer</label>
                    <input type="text" class="form-control" id="id_number_thirth" name="id_number_thirth"
                           aria-describedby="" value="<?php echo $booking->id_number_thirth ?>">
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-3" style="display: block" id="person_4">
              <p>Persoon 4:</p>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="first_name_fourth" class="form-label">Voornaam</label>
                    <input type="text" class="form-control" id="first_name_fourth" name="first_name_fourth"
                           aria-describedby="" value="<?php echo $booking->first_name_fourth ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="last_name_fourth" class="form-label">Achternaam</label>
                    <input type="text" class="form-control" id="last_name_fourth" name="last_name_fourth"
                           aria-describedby="" value="<?php echo $booking->last_name_fourth ?>">
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="city_fourth" class="form-label">Woonplaats</label>
                    <input type="text" class="form-control" id="city_fourth" name="city_fourth" aria-describedby=""
                           value="<?php echo $booking->city_fourth ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="nationality_person_4" class="form-label">Nationaliteit</label>
                    <select class="form-select" aria-label="Default select example" id="nationality_person_4"
                            name="nationality_person_4" onchange="showHideIdFourth()">
                      <option value="NL" <?php if ( $booking->nationality_person_4 == 'NL' ) {
						  echo 'selected';
					  } ?>>Nederlands
                      </option>
                      <option value="GE" <?php if ( $booking->nationality_person_4 == 'GE' ) {
						  echo 'selected';
					  } ?>>Duits
                      </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="birthdate_fourth" class="form-label">Geboortedatum</label>
                    <input type="date" class="form-control" id="birthdate_fourth" name="birthdate_fourth"
                           aria-describedby="" value="<?php echo $booking->birthdate_fourth ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3" style="display: none;" id="id_number_fourth">
                    <label for="id_number_fourth" class="form-label">ID/paspoort nummer</label>
                    <input type="text" class="form-control" id="id_number_fourth" name="id_number_fourth"
                           aria-describedby="" value="<?php echo $booking->id_number_fourth ?>">
                  </div>
                </div>
              </div>
            </div>

            <hr>

            <!-- Total pricing -->
            <h1>Prijs</h1>
            <div class="">
              <h2 class="d-inline">€
                <div class="d-inline" id="total_price" name="total_price"><?php echo $booking->total_price; ?></div>
              </h2>
              <input type="hidden" id="total_price_hidden" name="total_price_hidden" value=""></input>
            </div>

            <hr>

            <h1>Beheer boeking</h1>

            <button type="submit" name="booking_view_update_submit" class="btn btn-primary d-inline">
              Update
            </button>

            <button type="submit" name="booking_view_accept_booking_submit" class="btn btn-success d-inline">Accepteer
              boeking
            </button>

            <button type="submit" name="booking_view_accept_payment_submit" class="btn btn-info d-inline">Accepteer
              betaling
            </button>

            <button type="submit" name="booking_view_deny_submit" class="btn btn-warning d-inline" onclick="return confirm('Weet je zeker dat je deze boeking wilt afwijzen?')">
              Wijs boeking af
            </button>

            <button type="submit" name="booking_view_delete_submit" class="btn btn-danger d-inline" onclick="return confirm('Weet je zeker dat je deze boeking wilt verwijderen?')">
              Verwijder boeking
            </button>

          </form>
        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
              integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
              crossorigin="anonymous"></script>
		<?php
	}
	
	/**
	 * The customers page
	 */
	function reservation_customers_page() {
    global $wpdb;
    
    $customers = $wpdb->get_results(
      "
        SELECT
          first_name,
          last_name,
          MIN(birthdate) AS birthdate,
          MIN(nationality) AS nationality,
          MIN(address) AS address,
          MIN(city) AS city,
          MIN(zipcode) AS zipcode,
          MIN(email) AS email,
          MIN(phone) AS phone,
          MIN(id_number) AS id_number
        FROM
            bookings
        GROUP BY
          first_name, last_name;
      "
    );

  
		?>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

      <h1 class="mt-2 ml-2">Klanten</h1>

      <hr>

      <div class="mt-2 mb-2">
        <a href="/wp-admin/index.php?page=reserveringen-customers-aanmaken">
          <button type="button" class="btn btn-success">Nieuw</button>
        </a>
      </div>

      <div class="container">
        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">Voornaam</th>
            <th scope="col">Achternaam</th>
            <th scope="col">Geboortedatum</th>
            <th scope="col">Nat.</th>
            <th scope="col">Adres</th>
            <th scope="col">Woonplaats</th>
            <th scope="col">Postcode</th>
            <th scope="col">Email</th>
            <th scope="col">Telefoon</th>
            <th scope="col">ID/Paspoort nmr.</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach ( $customers as $customer ) {
              
              ?>
                <tr>
                <td scope="row"><?php echo $customer->first_name ?></td>
                <td><?php echo $customer->last_name ?></td>
                <td><?php echo $customer->birthdate ?></td>
                <td><?php echo $customer->nationality ?></td>
                <td><?php echo $customer->address ?> 1</td>
                <td><?php echo $customer->city ?></td>
                <td><?php echo $customer->zipcode ?></td>
                <td><?php echo $customer->email ?></td>
                <td><?php echo $customer->phone ?></td>
                <td><?php echo $customer->id_number ?></td>
              </tr>
            <?php
            }
            ?>
          </td>
          </tbody>
        </table>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
              integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
              crossorigin="anonymous"></script>
		<?php
	}
	
	/**
	 * Create customers page
	 */
	function reservation_create_customers_page() {
		?>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

      <h1 class="mt-2 ml-2">Nieuwe klant</h1>

      <hr>

      <div class="container" style="max-width: 300px;">
        <div class="mb-3">
          <label for="first_name" class="form-label">Voornaam</label>
          <input type="text" class="form-control" id="first_name" aria-describedby="">
        </div>

        <div class="mb-3">
          <label for="first_name" class="form-label">Achtername</label>
          <input type="text" class="form-control" id="last_name" aria-describedby="">
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Adres</label>
          <input type="text" class="form-control" id="address" aria-describedby="">
        </div>

        <div class="mb-3">
          <label for="zipcode" class="form-label">Postcode</label>
          <input type="text" class="form-control" id="zipcode" aria-describedby="">
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" aria-describedby="">
        </div>

        <div class="mb-3">
          <label for="id_number" class="form-label">ID/paspoort nummer</label>
          <input type="text" class="form-control" id="id_number" aria-describedby="">
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
              integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
              crossorigin="anonymous"></script>
		<?php
	}
	
	/**
	 * The houses page
	 */
	function reservation_houses_page() {
		?>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

      <h1 class="mt-2 ml-2">Huizen</h1>

      <hr>

      <div class="container">
        <div class="mt-2 mb-2">
          <a href="/wp-admin/index.php?page=reserveringen-huizen-aanmaken">
            <button type="button" class="btn btn-success">Nieuw</button>
          </a>
        </div>

        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Naam</th>
            <th scope="col">Prijs p.p</th>
            <th scope="col">Max. mensen</th>
            <th scope="col">Huisdieren toegestaan</th>
            <th scope="col">Acties</th>
          </tr>
          </thead>
          <tbody>
          <tr>
			  <?php
				  global $wpdb;
				  $houses = $wpdb->get_results(
					  "
                        SELECT * FROM `houses`;
                        " );
				  foreach ( $houses
				  
				  as $house ) {
			  ?>
          <tr>
            <th scope="row"><?php echo $house->id ?></th>
            <td><?php echo $house->name ?></td>
            <td><?php echo $house->price ?></td>
            <td><?php echo $house->max_persons ?></td>
            <td><?php if ( $house->animals_allowed == 0 ) {
					echo 'Nee';
				}
					if ( $house->animals_allowed == 1 ) {
						echo 'Ja';
					} ?></td>
            <td>
              <a href="<?php echo get_site_url() . '/wp-admin/index.php?page=reserveringen-huizen-wijzigen&house_id=' . $house->id ?>">
                <span class="dashicons dashicons-edit"></span>
              </a>
              <a href="">
                <span class="dashicons dashicons-trash"></span>
              </a>
            </td>
          </tr>
		  <?php
			  }
		  ?>
          </tr>
          </tbody>
        </table>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
              integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
              crossorigin="anonymous"></script>
		<?php
	}
  
	/**
	 * Edit home page
	 */
  function reservation_edit_house_page() {
    global $wpdb;
    
    $house = $wpdb->get_results(
            "SELECT * FROM `houses` WHERE id = " . $_GET['house_id'] . ";"
    );
	  
	  if ( isset( $_POST['edit_house_submit'] ) ) {
		  $res = $wpdb->update(
			  'houses',
			  array(
				  'name' => $_POST['home_name'],
				  'price' => intval($_POST['home_price_per_person']),
				  'max_persons' => intval($_POST['max_persons']),
				  'animals_allowed' => intval($_POST['home_animals_allowed'] ?? 0),
			  ),
			  array(
				  'id' => $_POST['house_id'],
			  )
		  );
    
		  echo 'Huis is aangepast. Herlaadt pagina om wijzigingen te zien.';
	  }
    
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <h1 class="mt-2 ml-2">Huis bewerken</h1>

    <hr>

    <div class="container" style="max-width: 500px;">
      <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="POST">
        <div class="mb-3">
          <label for="home_name" class="form-label">Huis naam</label>
          <input type="text" class="form-control" id="home_name" name="home_name" aria-describedby=""
                 value="<?php echo $house[0]->name ?>">
        </div>
        
        <input type="hidden" name="house_id" value="<?php echo $house[0]->id ?>">
        
        <label for="home_price_per_person" class="form-label">Prijs p.p</label>
        <div class="input-group mb-3">
          <span class="input-group-text">€</span>
          <input type="text" class="form-control" aria-label="" name="home_price_per_person"
            value="<?php echo $house[0]->price ?>"
          >
          <span class="input-group-text">.00</span>
        </div>

        <label for="max_persons" class="form-label">Max aantal personen</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" aria-label="" name="max_persons"
            value="<?php echo $house[0]->max_persons ?>"
          >
          <span class="input-group-text">personen</span>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="home_animals_allowed"
                 name="home_animals_allowed"
            <?php if ( $house[0]->animals_allowed == 1 ) {echo 'checked';} ?>
          >
          <label class="form-check-label" for="flexCheckDefault">
            Huisdieren
          </label>
        </div>

        <button type="submit" name="edit_house_submit" class="btn btn-primary">Opslaan</button>
        <form>
    </div

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>
	  <?php
  }
  
	/**
	 * The create house page
	 */
	function reservation_create_house_page() {
		?>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

      <h1 class="mt-2 ml-2">Huis aanmaken</h1>
		
		<?php
		/**
		 * If new house form is submitted
		 */
		if ( isset( $_POST['new_house_submit'] ) ) {
			global $wpdb;
			
			$query = $wpdb->insert(
				'houses',
				array(
					'name'            => $_POST['home_name'],
					'price'           => $_POST['home_price_per_person'],
					'max_persons'     => $_POST['max_persons'],
					'animals_allowed' => $_POST['home_animals_allowed'] ?? 0,
				)
			);
			
			if ( ! $query == true ) {
				echo 'Er ging iets mis!';
				
				return;
			}
			
			echo 'Huis is opgeslagen!';
		}
		
		?>

      <hr>

      <div class="container" style="max-width: 500px;">
        <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="POST">
          <div class="mb-3">
            <label for="home_name" class="form-label">Huis naam</label>
            <input type="text" class="form-control" id="home_name" name="home_name" aria-describedby="">
          </div>
          <label for="home_price_per_person" class="form-label">Prijs p.p</label>
          <div class="input-group mb-3">
            <span class="input-group-text">€</span>
            <input type="text" class="form-control" aria-label="" name="home_price_per_person">
            <span class="input-group-text">.00</span>
          </div>

          <label for="max_persons" class="form-label">Max aantal personen</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" aria-label="" name="max_persons">
            <span class="input-group-text">personen</span>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="home_animals_allowed"
                   name="home_animals_allowed">
            <label class="form-check-label" for="flexCheckDefault">
              Huisdieren
            </label>
          </div>

          <button type="submit" name="new_house_submit" class="btn btn-primary">Opslaan</button>
          <form>
      </div

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
              integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
              crossorigin="anonymous"></script>
		<?php
	}
	
	function my_plugin_download_file() {
		if ( isset( $_GET['my_plugin_download_file'] ) ) {
			$file_name = sanitize_text_field( $_GET['my_plugin_download_file'] );
			$file_path = WP_CONTENT_DIR . '/' . $file_name;
			
			if ( file_exists( $file_path ) ) {
				header( 'Content-Description: File Transfer' );
				header( 'Content-Type: application/octet-stream' );
				header( 'Content-Disposition: attachment; filename="' . basename( $file_path ) . '"' );
				header( 'Content-Length: ' . filesize( $file_path ) );
				header( 'Pragma: no-cache' );
				header( 'Expires: 0' );
				flush();
				
				readfile( $file_path );
				exit;
			} else {
				echo 'Bestand niet gevonden.';
			}
		}
	}
	
	add_action( 'init', 'my_plugin_download_file' );
	
	function my_plugin_delete_file() {
		if ( isset( $_GET['my_plugin_delete_file'] ) && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'delete_file_nonce' ) ) {
			$file_name = sanitize_text_field( $_GET['my_plugin_delete_file'] );
			$file_path = WP_CONTENT_DIR . '/' . $file_name;
			
			if ( file_exists( $file_path ) ) {
				unlink( $file_path );
				wp_redirect( $_SERVER['HTTP_REFERER'] );
				exit;
			} else {
				echo 'Bestand niet gevonden.';
			}
		}
	}
	
	add_action( 'init', 'my_plugin_delete_file' );
	
	/**
	 * The finance page
	 */
	function reservation_financial_page() {
		global $wpdb;
		
		$query = $wpdb->get_results(
        "
        SELECT * FROM `bookings` where YEAR(start_date) = YEAR(CURDATE());
        "
		);
		
		$totalRevenue = 0;
		
		foreach ( $query as $booking ) {
			$totalRevenue += $booking->total_price;
		}
		
		$totalDaysRented = 0;
		
		foreach ( $query as $booking ) {
			$interval        = ( new DateTime( $booking->end_date ) )->diff( new DateTime( $booking->start_date ) );
			$totalDaysRented += $interval->days;
		}
		
		if ( isset( $_POST['submit_report'] ) ) {
			$year = $_POST['report_year'];
			
			$query = $wpdb->get_results( "
                 SELECT * FROM `bookings` where YEAR(start_date) = YEAR($year)
                "
			);
			
			$upload_dir = wp_upload_dir();
			$file_path  = $upload_dir['basedir'] . '_report_door_' . ( wp_get_current_user() )->user_login . '_jaartal_' . $_POST['report_year'] . '.txt';
			
			// Calculate total revenue
      $current_year = date( 'Y' );
      
			$file_content = "
Omzet rapport van $current_year
\n\n
Totaal omzet: $totalRevenue\n
Totaal aantal dagen gehuurd: $totalDaysRented\n
			";
			
			if ( file_exists( $file_path ) ) {
				echo 'Het bestand bestaat al.';
				
				return;
			}
			
			$file_handle = fopen( $file_path, 'w' );
			if ( $file_handle ) {
				fwrite( $file_handle, $file_content );
				fclose( $file_handle );
				echo 'Bestand succesvol aangemaakt';
			} else {
				echo 'Het bestand kon niet worden aangemaakt.';
			}
		}
		
		?>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

      <h1 class="mt-2 ml-2">Omzet</h1>

      <hr>

      <div class="container">
        <h1>Statistieken</h1>
        <div class="row">
          <div class="col-sm bg-dark text-white rounded p-2 m-2">
            <h5 class="text-center">Totale omzet <?php echo date( 'Y' ); ?></h5>
            <br>
            <h5 class="text-center">€<?php echo $totalRevenue; ?></h5>
          </div>
          <div class="col-sm bg-dark text-white rounded p-2 m-2">
            <h5 class="text-center">Aantal dagen verhuurd <?php echo date( 'Y' ); ?></h5>
            <br>
            <h5 class="text-center"><?php echo $totalDaysRented; ?></h5>
          </div>
        </div>
      </div>

      <div class="container">
        <h1>Exporteer</h1>
        <div class="row">
          <div class="col-sm">
            <div class="ps-2">
              <h6>Maak een rapport</h6>
            </div>

            <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="POST">
              <select class="form-select" aria-label="" id="report_year" name="report_year">
                <option selected>Selecteer een jaar...</option>
                <option value=2024>2024</option>
                <option value=2025>2025</option>
                <option value=2026>2026</option>
                <option value=2027>2027</option>
                <option value=2028>2028</option>
                <option value=2029>2029</option>
                <option value=2030>2030</option>
                <option value=2031>2031</option>
                <option value=2032>2032</option>
              </select>

              <div class="mt-2 p-2">
                <button type="submit" name="submit_report" class="btn btn-success">Maak omzet rapport</button>
              </div>
            </form>

          </div>
          <div class="col-sm">
            <div class="ps-2">
              <h6>Gemaakte rapportages</h6>
            </div>

            <table class="table">
              <thead>
              <tr>
                <th scope="col">Naam</th>
                <th scope="col">Acties</th>
              </tr>
              </thead>
              <tbody>
			  <?php
				  foreach ( glob( WP_CONTENT_DIR . '/' . 'uploads_report_' . '*' ) as $file ) {
					  ?>
                    <tr>
                      <th scope="row"><?php echo basename( $file ) ?></th>
                      <td>
						  <?php
							  $file_name    = basename( $file );
							  $download_url = add_query_arg( 'my_plugin_download_file', $file_name, home_url() );
						  ?>
                        <a href="<?php echo esc_url( $download_url ); ?>"><span
                                  class="dashicons dashicons-download"></span></a>
						  <?php
							  $file_name  = basename( $file );
							  $delete_url = add_query_arg(
								  array(
									  'my_plugin_delete_file' => $file_name,
									  '_wpnonce'              => wp_create_nonce( 'delete_file_nonce' ),
								  ),
								  home_url()
							  );
						  ?>
                        <a href="<?php echo esc_url( $delete_url ); ?>"
                           onclick="return confirm('Weet je zeker dat je dit bestand wilt verwijderen?');"><span
                                  class="dashicons dashicons-trash"></span></a>
                      </td>
                    </tr>
					  <?php
				  }
			  ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
              integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
              crossorigin="anonymous"></script>
		<?php
	}
	
	/**
	 * The settings page
	 */
	function reservation_settings_page() {
		global $wpdb;
		
		$email_one_booking = $wpdb->get_results(
			"
            SELECT * FROM `booking_settings` WHERE name='send_new_booking_email_one';
        "
		);
		
		$email_two_booking = $wpdb->get_results(
			"
            SELECT * FROM `booking_settings` WHERE name='send_new_booking_email_two';
        "
		);
		
		if ( isset( $_POST['setting_form_submit'] ) ) {
			$email_one = $_POST['email_one'];
			$wpdb->query( $wpdb->prepare( "REPLACE INTO `booking_settings` (`name`, `value`) VALUES (%s, %s)", 'send_new_booking_email_one', $email_one ) );
			
			if ( isset( $_POST['email_two'] ) ) {
				$email_two = $_POST['email_two'];
				$wpdb->query( $wpdb->prepare( "REPLACE INTO `booking_settings` (`name`, `value`) VALUES (%s, %s)", 'send_new_booking_email_two', $email_two ) );
			}
		}
		
		?>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

      <h1 class="mt-2 ml-2">Instellingen</h1>

      <hr>

      <div class="container">
        <h2>Email adressen om nieuwe boekingen op te ontvangen</h1>
			<?php echo var_dump( $email_one_booking[0]->value ); ?>
          <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="POST">
            <div class="mb-3">
              <label for="email_one" class="form-label">Email adres 1</label>
              <input type="email" style="max-width: 300px;" class="form-control" id="email_one" name="email_one"
                     placeholder="name@example.com" value="<?php echo $email_one_booking[0]->value ?? '' ?>"
                     aria-describedby="">
            </div>

            <div class="mb-3">
              <label for="email_one" class="form-label">Email adres 2</label>
              <input type="email" style="max-width: 300px;" class="form-control" id="email_two" name="email_two"
                     placeholder="name@example.com" value="<?php echo $email_two_booking[0]->value ?? '' ?>">
            </div>

            <button type="submit" name="setting_form_submit" class="btn btn-primary">Opslaan</button>
          </form>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
              integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
              crossorigin="anonymous"></script>
		<?php
	}
	
	function email_customer_new_booking( $email ) {
		$message = "
    <!doctype html>
    <html lang='en'>
      <head>
        <meta charset='utf-8'>
        <meta content='width=device-width, initial-scale=1' name='viewport'>
        <link crossorigin='anonymous' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css'
              integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' rel='stylesheet'>
      </head>

      <body>
      <h1>Hello, world!</h1>

      <script crossorigin='anonymous' integrity='sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4' src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>
      </body>
    </html>
  ";
		
		$sent = wp_mail(
			sanitize_email( $email ),
			'Reservering',
			'Test',
			array( 'Content-Type: text/html; charset=UTF-8' ),
		);
		if ( ! $sent ) {
			echo 'Email niet verstuurd!';
			
			return;
		}
		echo 'Er is een reservering gemaakt!';
		
		return;
	}
	
	function handle_booking_form_submit() {
		global $wpdb;
		
		$query = $wpdb->insert(
			'bookings',
			array(
				'start_date'           => sanitize_text_field( $_POST['start_date'] ),
				'end_date'             => sanitize_text_field( $_POST['end_date'] ),
				'home'                 => sanitize_text_field( $_POST['home'] ),
				'first_name'           => sanitize_text_field( $_POST['first_name'] ),
				'last_name'            => sanitize_text_field( $_POST['last_name'] ),
				'birthdate'            => sanitize_text_field( $_POST['birthdate'] ),
				'nationality'          => sanitize_text_field( $_POST['nationality'] ),
				'address'              => sanitize_text_field( $_POST['address'] ),
				'city'                 => sanitize_text_field( $_POST['city'] ),
				'zipcode'              => sanitize_text_field( $_POST['zipcode'] ),
				'id_number'            => sanitize_text_field( $_POST['id_number_first'] ),
				'email'                => sanitize_text_field( $_POST['email'] ),
				'phone'                => sanitize_text_field( $_POST['phone'] ),
				'animals'              => sanitize_text_field( $_POST['animals'] ?? null ),
				'child_bed'            => sanitize_text_field( $_POST['child_bed'] ?? null ),
				'comments'             => sanitize_text_field( $_POST['comments'] ?? null ),
				'amount_persons'       => sanitize_text_field( $_POST['amount_persons'] ),
				'name_first_second'    => sanitize_text_field( $_POST['name_first_second'] ?? null ),
				'name_last_second'     => sanitize_text_field( $_POST['name_last_second'] ?? null ),
				'city_second'          => sanitize_text_field( $_POST['city_second'] ?? null ),
				'nationality_person_2' => sanitize_text_field( $_POST['nationality_person_2'] ?? null ),
				'birthdate_second'     => sanitize_text_field( $_POST['birthdate_second'] ?? null ),
				'id_number_second'     => sanitize_text_field( $_POST['id_number_second'] ?? null ),
				'first_name_thirth'    => sanitize_text_field( $_POST['first_name_thirth'] ?? null ),
				'last_name_thirth'     => sanitize_text_field( $_POST['last_name_thirth'] ?? null ),
				'city_thirth'          => sanitize_text_field( $_POST['city_thirth'] ?? null ),
				'nationality_person_3' => sanitize_text_field( $_POST['nationality_person_3'] ?? null ),
				'birthdate_thirth'     => sanitize_text_field( $_POST['birthdate_thirth'] ?? null ),
				'id_number_thirth'     => sanitize_text_field( $_POST['id_number_thirth'] ?? null ),
				'first_name_fourth'    => sanitize_text_field( $_POST['first_name_fourth'] ?? null ),
				'last_name_fourth'     => sanitize_text_field( $_POST['last_name_fourth'] ?? null ),
				'city_fourth'          => sanitize_text_field( $_POST['city_fourth'] ?? null ),
				'nationality_person_4' => sanitize_text_field( $_POST['nationality_person_4'] ?? null ),
				'birthdate_fourth'     => sanitize_text_field( $_POST['birthdate_fourth'] ?? null ),
				'id_number_fourth'     => sanitize_text_field( $_POST['id_number_fourth'] ?? null ),
				'house_rented'         => sanitize_text_field( $_POST['home'] ),
				'discount_amount'      => 0,
				'total_price'          => sanitize_text_field( $_POST['total_price_hidden'] ),
				'is_paid'              => 0,
				'accepted'             => 0,
				'is_viewed'            => 0,
			)
		);
		
		if ( ! $query ) {
			echo '<div class="container">';
			echo '<h6>Uw aanvraag is verstuurd!</h6>';
			echo '</div>';
			
			return;
		}
		
		email_customer_new_booking( $_POST['email'] );
		echo 'Je aanvraag is verstuurd';
	}
	
	function fetch_bookings_for_home() {
		global $wpdb;
		
		if ( ! isset( $_POST['home'] ) || empty( $_POST['home'] ) ) {
			wp_send_json_error( 'Geen huis geselecteerd.' );
		}
		
		$home = sanitize_text_field( $_POST['home'] );
		
		$bookings = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT start_date, end_date FROM `bookings` WHERE `home` = '%s'",
				$home
			),
			ARRAY_A
		);
		
		wp_send_json_success( $bookings );
	}
	
	add_action( 'wp_ajax_fetch_bookings_for_home', 'fetch_bookings_for_home' );
	add_action( 'wp_ajax_nopriv_fetch_bookings_for_home', 'fetch_bookings_for_home' );
	
	function enqueue_custom_scripts() {
		wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/custom.js', [ 'jquery' ], null, true );
		
		wp_localize_script( 'custom-script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );
	
	function booking_form() {
		if ( isset( $_POST['booking_form_submit'] ) ) {
			handle_booking_form_submit();
		}
		
		?>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">

      <div class="container mt-3" style="max-width: 700px;">
        <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="POST">

          <div class="mb-3">
            <h1>Huis/appartement</h1>
            <select class="form-select" aria-label="" id="home" name="home" onchange="changePrice(event)">
              <option selected disabled>Selecteer</option>
				<?php
					global $wpdb;
					
					$houses = $wpdb->get_results(
						"
                    SELECT * FROM `houses`;
                    "
					);
					
					foreach ( $houses as $house ) {
						?>
                      <option value="<?php echo $house->name; ?>"
                              data-price="<?php echo $house->price; ?>"><?php echo $house->name; ?></option>
						<?php
					}
				?>
            </select>
          </div>

          <hr>

          <div class="month">
            <ul>
              <select id="month-select" name="month">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maart</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Augustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
              <select id="year-select" name="year">
              </select>
              <!--
			  <li id="month-year" name="month-year">
				  November<br>
				  <span style="font-size:18px" id="year">2025</span>
			  </li>
			  -->
            </ul>
          </div>

          <ul class="weekdays">
            <li>Maandag</li>
            <li>Dinsdag</li>
            <li>Woensdag</li>
            <li>Donderdag</li>
            <li>Vrijdag</li>
            <li>Zaterdag</li>
            <li>Zondag</li>
          </ul>

          <ul class="days" id="days_to_rent" name="days_to_rent">
          </ul>

          <input type="hidden" name="days_to_rent" id="selected_days" value="">
          <input type="hidden" name="start_date" id="start_date" value="">
          <input type="hidden" name="end_date" id="end_date" value="">

          <p>Geboekt: <span class="badge text-bg-danger p-2 mr-2">&nbsp;</span></p>

          <hr>

          <div class="row">
            <h1>Boeker</h1>
            <div class="col">
              <!-- Form -->
              <div class="mb-3">
                <label for="first_name" class="form-label">Naam</label>
                <input type="text" class="form-control" id="first_name" name="first_name" aria-describedby=""
                       placeholder="Voornaam">
              </div>
              <div class="mb-3">
                <label for="last_name" class="form-label">Achternaam</label>
                <input type="text" class="form-control" id="last_name" name="last_name">
              </div>
            </div>

            <div class="col">
              <div class="mb-3">
                <label for="birthdate" class="form-label">Geboortedatum</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" aria-describedby="">
              </div>

              <div class="mb-3">
                <label for="nationality" class="form-label">Nationaliteit</label>
                <select class="form-select" aria-label="Default select example" id="nationality" name="nationality"
                        onchange="showHideIdFirst()">
                  <option selected disabled>Selecteer</option>
                  <option value="NL">Nederlands</option>
                  <option value="GE">Duits</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="address" class="form-label">Adres</label>
                <input type="text" class="form-control" id="address" name="address" aria-describedby="">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="city" class="form-label">Woonplaats</label>
                <input type="text" class="form-control" id="city" name="city" aria-describedby="">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="zipcode" class="form-label">Postcode</label>
                <input type="text" class="form-control" id="zipcode" name="zipcode" aria-describedby="">
              </div>
            </div>
            <div class="col">
              <div class="mb-3" style="display: none;" id="id_number_first">
                <label for="id_number_first" class="form-label">ID/paspoort nummer</label>
                <input type="text" class="form-control" id="id_number_first" name="id_number_first" aria-describedby="">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="email" class="form-label">Email adres</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="phone" class="form-label">Telefoonnummer</label>
                <input type="text" class="form-control" id="phone" name="phone" aria-describedby="">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <h4>Opties</h4>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="5" id="animals" name="animals"
                       onchange="changePrice()">
                <label class="form-check-label" for="animals">
                  Huisdieren die mee komen (5€ extra)
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="10" id="child_bed" name="child_bed"
                       onchange="changePrice()">
                <label class="form-check-label" for="child_bed">
                  Kinderbedje(ledikantje) (10€ extra)
                </label>
              </div>
            </diV>

            <div class="col">
              <div class="mb-3">
                <label for="comments" class="form-label">Opmerkingen</label>
                <textarea class="form-control" aria-label="With textarea" id="comments" name="comments"></textarea>
              </div>
            </div>
          </div>

          <p>
            Wintermaanden extra verwarmingskosten: 1 Oktober t/m 31 april 10 per nacht per appartement.
            <br>
            Toeristenbelasting: €2.10 p.p. per nacht 14 jaar en ouder.
            <br>
            Prijzen zijn op basis van 2 personen per nacht.
            Extra personen zijn €10 p.p. per nacht voor 13>.
            Kinderen 13< zijn gratis.
          </p>

          <hr>

          <h1>Aantal personen</h1>
          <div class="mb-3">
            <label for="amount_persons" class="form-label">Aantal personen:</label>
            <select class="form-select" aria-label="Default select example" id="amount_persons" name="amount_persons"
                    onchange="changeExtraPersons(event)">
              <option selected disabled>Selecteer</option>
              <option value="1">1</option>
              <option selected value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>

          <div class="mb-3" style="display: display" id="person_2">
            <p>Persoon 2:</p>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="name_first_second" class="form-label">Voornaam</label>
                  <input type="text" class="form-control" id="name_first_second" name="name_first_second"
                         aria-describedby="">
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="name_last_second" class="form-label">Achternaam</label>
                  <input type="text" class="form-control" id="name_last_second" name="name_last_second"
                         aria-describedby="">
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="city_second" class="form-label">Woonplaats</label>
                  <input type="text" class="form-control" id="city_second" name="city_second" aria-describedby="">
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="nationality_person_2" class="form-label">Nationaliteit</label>
                  <select class="form-select" aria-label="Default select example" id="nationality_person_2"
                          name="nationality_person_2" onchange="showHideIdSecond()">
                    <option selected disabled>Selecteer</option>
                    <option value="NL">Nederlands</option>
                    <option value="GE">Duits</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="birthdate_second" class="form-label">Geboortedatum</label>
                  <input type="date" class="form-control" id="birthdate_second" name="birthdate_second"
                         aria-describedby="">
                </div>
              </div>
              <div class="col">
                <div class="mb-3" style="display: none;" id="id_number_second">
                  <label for="id_number_second" class="form-label">ID/paspoort nummer</label>
                  <input type="text" class="form-control" id="id_number_second" name="id_number_second"
                         aria-describedby="">
                </div>
              </div>
            </div>
          </div>

          <div class="mb-3" style="display: none" id="person_3">
            <p>Persoon 3:</p>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="first_name_thirth" class="form-label">Voornaam</label>
                  <input type="text" class="form-control" id="first_name_thirth" name="first_name_thirth"
                         aria-describedby="">
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="last_name_thirth" class="form-label">Achternaam</label>
                  <input type="text" class="form-control" id="last_name_thirth" name="last_name_thirth"
                         aria-describedby="">
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="city_thirth" class="form-label">Woonplaats</label>
                  <input type="text" class="form-control" id="city_thirth" name="city_thirth" aria-describedby="">
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="nationality_person_3" class="form-label">Nationaliteit</label>
                  <select class="form-select" aria-label="Default select example" id="nationality_person_3"
                          name="nationality_person_3" onchange="showHideIdThirth()">
                    <option selected disabled>Selecteer</option>
                    <option value="NL">Nederlands</option>
                    <option value="GE">Duits</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="birthdate_thirth" class="form-label">Geboortedatum</label>
                  <input type="date" class="form-control" id="birthdate_thirth" name="birthdate_thirth"
                         aria-describedby="">
                </div>
              </div>
              <div class="col">
                <div class="mb-3" style="display: none;" id="id_number_thirth">
                  <label for="id_number_thirth" class="form-label">ID/paspoort nummer</label>
                  <input type="text" class="form-control" id="id_number_thirth" name="id_number_thirth"
                         aria-describedby="">
                </div>
              </div>
            </div>
          </div>

          <div class="mb-3" style="display: none" id="person_4">
            <p>Persoon 4:</p>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="first_name_fourth" class="form-label">Voornaam</label>
                  <input type="text" class="form-control" id="first_name_fourth" name="first_name_fourth"
                         aria-describedby="">
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="last_name_fourth" class="form-label">Achternaam</label>
                  <input type="text" class="form-control" id="last_name_fourth" name="last_name_fourth"
                         aria-describedby="">
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="city_fourth" class="form-label">Woonplaats</label>
                  <input type="text" class="form-control" id="city_fourth" name="city_fourth" aria-describedby="">
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="nationality_person_4" class="form-label">Nationaliteit</label>
                  <select class="form-select" aria-label="Default select example" id="nationality_person_4"
                          name="nationality_person_4" onchange="showHideIdFourth()">
                    <option selected disabled>Selecteer</option>
                    <option value="NL">Nederlands</option>
                    <option value="GE">Duits</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="birthdate_fourth" class="form-label">Geboortedatum</label>
                  <input type="date" class="form-control" id="birthdate_fourth" name="birthdate_fourth"
                         aria-describedby="">
                </div>
              </div>
              <div class="col">
                <div class="mb-3" style="display: none;" id="id_number_fourth">
                  <label for="id_number_fourth" class="form-label">ID/paspoort nummer</label>
                  <input type="text" class="form-control" id="id_number_fourth" name="id_number_fourth"
                         aria-describedby="">
                </div>
              </div>
            </div>
          </div>

          <hr>
          <!-- Total pricing -->
          <h1>Prijs</h1>
          <div class="">
            <h2 class="d-inline">€
              <div class="d-inline" id="total_price" name="total_price"></div>
            </h2>
            <input type="hidden" id="total_price_hidden" name="total_price_hidden" value=""></input>
          </div>

          <button type="submit" name="booking_form_submit" class="btn btn-primary" style="background-color: #0E3E1A">Verzend</button>
        </form>
      </div>

      <style>
          .month {
              padding: 10px 25px;
              width: 100%;
              background: #0E3E1A;
              text-align: center;
          }

          .month ul {
              margin: 0;
              padding: 0;
          }

          .month ul li {
              color: white;
              font-size: 20px;
              text-transform: uppercase;
              letter-spacing: 3px;
          }

          .month .prev {
              float: left;
              padding-top: 10px;
          }

          .month .next {
              float: right;
              padding-top: 10px;
          }

          .weekdays {
              margin: 0;
              padding: 10px 0;
              background-color: #0E3E1A;
          }

          .weekdays li {
              display: inline-block;
              width: 13.6%;
              color: #666;
              text-align: center;
          }

          .days {
              padding: 10px 0;
              background: #eee;
              margin: 0;
          }

          .days li {
              list-style-type: none;
              display: inline-block;
              width: 13.6%;
              text-align: center;
              margin-bottom: 5px;
              font-size: 12px;
              color: #777;
          }

          .days li .active {
              padding: 5px;
              background: #1abc9c;
              color: white !important
          }

          .selected {
              background-color: green;
              color: white !important;
              border-radius: 5px;
          }

          .booked {
              background-color: red;
              color: white !important;
              border-radius: 5px;
          }

          @media screen and (max-width: 720px) {
              .weekdays li, .days li {
                  width: 13.1%;
              }
          }

          @media screen and (max-width: 420px) {
              .weekdays li, .days li {
                  width: 12.5%;
              }

              .days li .active {
                  padding: 2px;
              }
          }

          @media screen and (max-width: 290px) {
              .weekdays li, .days li {
                  width: 12.2%;
              }
          }
      </style>

      <script>
          const daysToRentSecond = document.getElementById("days_to_rent");
          const selectedDaysInput = document.getElementById('selected_days');
          var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

          daysToRentSecond.addEventListener('click', function (event) {
              if (event.target.tagName === 'LI') {
                  const dayElement = event.target;

                  if (!this.classList.contains("booked")) {
                      dayElement.classList.toggle('selected');

                  }

                  const selectedDays = [];
                  document.querySelectorAll('#days_to_rent li.selected').forEach(selectedDay => {
                      selectedDays.push(selectedDay.getAttribute('data-day'));
                  });

                  selectedDaysInput.value = selectedDays.join(',');

                  const res = getMinAndMaxDaysFromString(selectedDaysInput.value);
                  const selectedYear = document.getElementById("year-select");
                  const selectedMonth = document.getElementById("month-select");
                  const startDate = new Date(selectedYear.value, selectedMonth.value - 1, res.minNumber);
                  const endDate = new Date(selectedYear.value, selectedMonth.value - 1, res.maxNumber);

                  document.getElementById('start_date').value = startDate.toISOString();
                  document.getElementById('end_date').value = endDate.toISOString();

                  changePrice();
              }
          });

          const monthSelect = document.getElementById("month-select");
          const yearSelect = document.getElementById("year-select");
          const daysToRent = document.getElementById("days_to_rent");

          const currentYear = new Date().getFullYear();
          const currentMonth = new Date().getMonth();

          const homeSelect = document.getElementById('home');

          homeSelect.addEventListener('change', function () {
              const selectedHome = this.value;
              if (typeof ajaxurl === 'undefined') {
                  console.error('ajaxurl is niet gedefinieerd');
                  return;
              }

              fetch(ajaxurl, {
                  method: 'POST',
                  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                  body: new URLSearchParams({
                      action: 'fetch_bookings_for_home',
                      home: selectedHome,
                  }),
              })
                  .then((response) => response.json())
                  .then((data) => {
                      if (data.success) {
                          const bookings = data.data;
                          updateCalendarWithBookings(bookings);
                      } else {
                          console.error(data.data || 'Geen boekingen gevonden.');
                      }
                  })
                  .catch((error) => console.error('Error fetching bookings:', error));
          });

          function updateCalendarWithBookings(bookings) {
              const selectedMonth = parseInt(monthSelect.value);
              const selectedYear = parseInt(yearSelect.value);
              const daysInMonth = getDaysInMonth(selectedMonth, selectedYear);

              daysToRent.innerHTML = "";

              for (let day = 1; day <= daysInMonth; day++) {
                  const li = document.createElement("li");
                  li.setAttribute("data-day", day);
                  li.textContent = day;
                  const currentDate = new Date(selectedYear, selectedMonth - 1, day);
                  currentDate.setHours(0, 0, 0, 0); // Zet de tijd naar 00:00:00 voor vergelijking

                  const isBooked = bookings.some((booking) => {
                      const startDate = new Date(booking.start_date);
                      const endDate = new Date(booking.end_date);
                      startDate.setHours(0, 0, 0, 0); // Zet de tijd naar 00:00:00 voor vergelijking
                      endDate.setHours(23, 59, 59, 999); // Zet de tijd naar het einde van de dag

                      return currentDate >= startDate && currentDate <= endDate;
                  });

                  if (isBooked) {
                      li.classList.add('booked');
                  }

                  daysToRent.appendChild(li);
              }
          }

          for (let i = currentYear - 10; i <= currentYear + 10; i++) {
              const option = document.createElement("option");
              option.value = i;
              option.textContent = i;
              yearSelect.appendChild(option);
          }

          monthSelect.value = currentMonth;
          yearSelect.value = currentYear;

          function getDaysInMonth(month, year) {
              return new Date(year, month + 1, 0).getDate();
          }

          function updateCalendar() {
              const selectedMonth = parseInt(monthSelect.value);
              const selectedYear = parseInt(yearSelect.value);
          
              const selectedHome = homeSelect.value;
          
              if (typeof ajaxurl === 'undefined') {
                  console.error('ajaxurl is niet gedefinieerd');
                  return;
              }
          
              fetch(ajaxurl, {
                  method: 'POST',
                  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                  body: new URLSearchParams({
                      action: 'fetch_bookings_for_home',
                      home: selectedHome,
                      year: selectedYear,
                      month: selectedMonth,
                  }),
              })
              .then((response) => response.json())
              .then((data) => {
                  if (data.success) {
                      const bookings = data.data;
          
                      const daysInMonth = getDaysInMonth(selectedMonth, selectedYear);
                      daysToRent.innerHTML = "";
          
                      for (let day = 1; day <= daysInMonth; day++) {
                          const li = document.createElement("li");
                          li.setAttribute("data-day", day);
                          li.textContent = day;
          
                          // Controleer of de dag geboekt is
                          const currentDate = new Date(selectedYear, selectedMonth, day);
                          const isBooked = bookings.some((booking) => {
                              const startDate = new Date(booking.START_DATE);
                              const endDate = new Date(booking.END_DATE);
                              return currentDate >= startDate && currentDate <= endDate;
                          });
          
                          if (isBooked) {
                              li.classList.add('booked');
                          }
          
                          daysToRent.appendChild(li);
                      }
                  } else {
                      console.error(data.data || 'Geen boekingen gevonden.');
                  }
              })
              .catch((error) => console.error('Error fetching bookings:', error));
          }
          
          monthSelect.addEventListener("change", updateCalendar);
          yearSelect.addEventListener("change", updateCalendar);
          
          updateCalendar();

          // Extra persons selector
          // TODO: fix horrible code
          function changeExtraPersons(event) {
              console.log(event.target.value)
              if (event.target.value == 1) {
                  document.getElementById("person_2").style.display = "none";
                  document.getElementById("person_3").style.display = "none";
                  document.getElementById("person_4").style.display = "none";
              }

              if (event.target.value == 2) {
                  document.getElementById("person_2").style.display = "block";
                  document.getElementById("person_3").style.display = "none";
                  document.getElementById("person_4").style.display = "none";

              }

              if (event.target.value == 3) {
                  document.getElementById("person_2").style.display = "block";
                  document.getElementById("person_3").style.display = "block";
                  document.getElementById("person_4").style.display = "none";
              }

              if (event.target.value == 4) {
                  document.getElementById("person_2").style.display = "block";
                  document.getElementById("person_3").style.display = "block";
                  document.getElementById("person_4").style.display = "block";
              }

              changePrice();
          }

          //
          // Calendar
          //
          function getMinAndMaxDaysFromString(input) {
              const numbersFromString = String(input).split(',').map(Number);
              const minNumber = Math.min(...numbersFromString);
              const maxNumber = Math.max(...numbersFromString);

              return {minNumber, maxNumber}
          }

          function changePrice() {
              const selectHome = document.getElementById('home')
              var homePrice = (selectHome.options[selectHome.selectedIndex]).dataset.price;
              var selectedDaysInput = (document.getElementById('selected_days').value).split(',');

              if (document.getElementById('animals').checked) {
                  var animals = document.getElementById('animals').value;
              } else {
                  var animals = 0;
              }
              if (document.getElementById('animals').checked) {
                  var animals = document.getElementById('animals').value;
              } else {
                  var animals = 0;
              }
              if (document.getElementById('child_bed').checked) {
                  var childBed = document.getElementById('child_bed').value;
              } else {
                  var childBed = 0;
              }

              if (document.getElementById('amount_persons').value == 3) {
                  var extraPeoplePrice = 10;
              } else if (document.getElementById('amount_persons').value == 4) {
                  var extraPeoplePrice = 20;
              } else {
                  var extraPeoplePrice = 0;
              }

              var totalHomePrice =
                  Number(animals) +
                  Number(childBed) +
                  (Number(homePrice) * Number(selectedDaysInput.length)) +
                  Number(extraPeoplePrice);

              document.getElementById('total_price').innerHTML = totalHomePrice;
              document.getElementById('total_price_hidden').value = totalHomePrice;
          }

          function showHideIdFirst() {
              if (document.getElementById('nationality').value != 'GE') {
                  document.getElementById('id_number_first').style.display = 'block';
              } else {
                  document.getElementById('id_number_first').style.display = 'none';
              }
          }

          function showHideIdSecond() {
              if (document.getElementById('nationality_person_2').value != 'GE') {
                  document.getElementById('id_number_second').style.display = 'block';
              } else {
                  document.getElementById('id_number_second').style.display = 'none';
              }
          }

          function showHideIdThirth() {
              if (document.getElementById('nationality_person_3').value != 'GE') {
                  document.getElementById('id_number_thirth').style.display = 'block';
              } else {
                  document.getElementById('id_number_thirth').style.display = 'none';
              }
          }

          function showHideIdFourth() {
              if (document.getElementById('nationality_person_4').value != 'GE') {
                  document.getElementById('id_number_fourth').style.display = 'block';
              } else {
                  document.getElementById('id_number_fourth').style.display = 'none';
              }
          }
      </script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
              integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
              crossorigin="anonymous"></script>
		<?php
	}
	
	function booking_form_handle() {
		if ( ! isset( $_POST['booking_form_submitted'] ) ) {
			return;
		}
		
		echo '<div>';
		echo $_POST['first_name'];
		echo $_POST['days_to_rent'];
		echo "<p style=background-color: green; !important; text-align: center; margin-top: -7px;'><strong>Uw aanmelding is verstuurd! Er zal contact met u opgenomen worden.</strong></p>";
		echo '</div>';
	}
	
	function register_booking_form_short_code() {
		ob_start();
		booking_form();
		booking_form_handle();
		
		return ob_get_clean();
	}
	
	add_shortcode( 'booking_form', 'register_booking_form_short_code' );