<?php
/*
Plugin Name: Reserveringen
Plugin URI: https://github.com/AutiCodes/Hanninkhof.de
Description: Reserveringen systeem
Version: 1.0
Author: AutiCodes
Author URI: https://auticodes.nl
*/

/**
 * CREATE TABLE `<DB NAME HERE>`.`bookings` (`id` INT NOT NULL AUTO_INCREMENT , `start_date` DATE NOT NULL , `end_date` DATE NOT NULL , `first_name` VARCHAR(255) NOT NULL , `last_name` VARCHAR(255) NOT NULL , `birthdate` DATE NOT NULL , `nationality` VARCHAR(255) NOT NULL , `address` VARCHAR(255) NOT NULL , `city` VARCHAR(255) NOT NULL , `zipcode` VARCHAR(255) NOT NULL , `id_number` VARCHAR(255) NULL DEFAULT NULL , `email` VARCHAR(255) NOT NULL , `phone` VARCHAR(255) NOT NULL , `animals` INT(2) NULL DEFAULT NULL , `child_bed` INT(2) NULL DEFAULT NULL , `comments` TEXT NULL DEFAULT NULL , `amount_persons` INT(10) NOT NULL , `name_first_second` VARCHAR(255) NULL DEFAULT NULL , `name_last_second` VARCHAR(255) NULL DEFAULT NULL , `city_second` VARCHAR(255) NULL DEFAULT NULL , `nationality_person_2` VARCHAR(255) NULL DEFAULT NULL , `birthdate_second` DATE NULL DEFAULT NULL , `id_number_second` VARCHAR(255) NULL DEFAULT NULL , `first_name_thirth` VARCHAR(255) NULL DEFAULT NULL , `last_name_thirth` VARCHAR(255) NULL DEFAULT NULL , `city_thirth` VARCHAR(255) NULL DEFAULT NULL , `nationality_person_3` VARCHAR(255) NULL DEFAULT NULL , `birthdate_thirth` VARCHAR(255) NULL DEFAULT NULL , `id_number_thirth` VARCHAR(255) NULL DEFAULT NULL , `first_name_fourth` VARCHAR(255) NULL DEFAULT NULL , `last_name_fourth` VARCHAR(255) NULL DEFAULT NULL , `city_fourth` VARCHAR(255) NULL DEFAULT NULL , `nationality_person_4` VARCHAR(255) NULL DEFAULT NULL , `birthdate_fourth` DATE NULL DEFAULT NULL , `id_number_fourth` VARCHAR(255) NULL DEFAULT NULL , `house_rented` VARCHAR(255) NOT NULL , `discount_amount` INT(255) NULL DEFAULT NULL , `total_price` BIGINT(1000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
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

add_action('admin_menu', 'create_menus');

/**
 * The reservation page
 */
function reservation_options_page() {
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">

    <h1 class="mt-2 ml-2">Reserveringen</h1>

    <hr>

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

    <div class="container">
        <h1>Overzicht</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Huis/kamer</th>
                    <th scope="col">Naam</th>
                    <th scope="col">Aankomst</th>
                    <th scope="col">Vertrek</th>
                    <th scope="col">Geboekt op</th>
                    <th scope="col">Aantal nachten</th>
                    <th scope="col">Betaling status</th>
                    <th scope="col">Status</th>
                    <th scope="col">Weergeven</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="#">Voorbeeld huis</a></td>
                    <td><a href="#">K. de Reus</a></td>
                    <td>29-11-2024</td>
                    <td>30-11-2024</td>
                    <td>29-11-2024</td>
                    <td>1</td>
                    <td>
                        <span class="badge text-bg-danger">NIET BETAALD</span>
                    </td>
                    <td>
                        <span class="badge text-bg-danger">IN BEHANDELING</span>
                    </td>
                    <td>
                        <a href="/wp-admin/index.php?page=reservering-weergeven">
                            <span class="dashicons dashicons-search"></span>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td><a href="#">Voorbeeld huis</a></td>
                    <td><a href="#">K. de Reus</a></td>
                    <td>29-11-2024</td>
                    <td>30-11-2024</td>
                    <td>29-11-2024</td>
                    <td>1</td>
                    <td>
                        <span class="badge text-bg-success">BETAALD</span>
                    </td>
                    <td>
                        <span class="badge text-bg-success">BEHANDELD</span>
                    </td>
                    <td>
                        <a href="/wp-admin/index.php?page=reservering-weergeven">
                            <span class="dashicons dashicons-search"></span>
                        </a>
                    </td>
                </tr>
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
            font-size:12px;
            color: #777;
        }

        .days li .active {
            padding: 5px;
            background: #1abc9c;
            color: white !important
        }

        /* Add media queries for smaller screens */
        @media screen and (max-width:720px) {
            .weekdays li, .days li {width: 13.1%;}
        }

        @media screen and (max-width: 420px) {
            .weekdays li, .days li {width: 12.5%;}
            .days li .active {padding: 2px;}
        }

        @media screen and (max-width: 290px) {
            .weekdays li, .days li {width: 12.2%;}
        }
    </style>

	<script src="js/jquery.min.js"></script>
  	<script src="js/popper.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
}

/**
 * Shows an specific reservation
 */
function reservation_view_page() {
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <h1 class="mt-2 ml-2">Reservering #1</h1>

    <hr>

    <div class="container text-center ">
        <h1>Reservering #1</h1>

        <img class="" src="https://media.istockphoto.com/id/155666671/nl/vector/vector-illustration-of-red-house-icon.jpg?s=612x612&w=0&k=20&c=tFnYvPlhW4cv3A8R03hFjL6AMkHx7fFseemnck05Z4Y=" style="width: 120px;">
        <p>Huis: Voorbeeld huis 1</p>

        <form class="w-25 text-center ">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Naam</label>
                <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example">
            </div>

            <div class="mb-3">

            </div>

            <div class="mb-3">

            </div>
            <div class="mb-3">

            </div>

            <div class="mb-3">

            </div>

            <div class="mb-3">

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
}

/**
 * The customers page
 */
function reservation_customers_page() {
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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
                    <th scope="col">Opties</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">Kelvin</td>
                    <td>de Reus</td>
                    <td>11-05-2001</td>
                    <td>NL</td>
                    <td>Voorbeeldstraat 1</td>
                    <td>Groenlo</td>
                    <td>1234AB</td>
                    <td>voorbeeld@domein.nl</td>
                    <td>06123456790</td>
                    <td>00000000</td>
                    <td>
                        <a href="">
                            <span class="dashicons dashicons-edit"></span>
                        </a>
                        <a href="">
                            <span class="dashicons dashicons-trash"></span>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td scope="row">Kelvin</td>
                    <td>de Reus</td>
                    <td>11-05-2001</td>
                    <td>NL</td>
                    <td>Voorbeeldstraat 1</td>
                    <td>Groenlo</td>
                    <td>1234AB</td>
                    <td>voorbeeld@domein.nl</td>
                    <td>06123456790</td>
                    <td>00000000</td>
                    <td>
                        <a href="">
                            <span class="dashicons dashicons-edit"></span>
                        </a>
                        <a href="">
                            <span class="dashicons dashicons-trash"></span>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td scope="row">Kelvin</td>
                    <td>de Reus</td>
                    <td>11-05-2001</td>
                    <td>NL</td>
                    <td>Voorbeeldstraat 1</td>
                    <td>Groenlo</td>
                    <td>1234AB</td>
                    <td>voorbeeld@domein.nl</td>
                    <td>06123456790</td>
                    <td>00000000</td>
                    <td>
                        <a href="">
                            <span class="dashicons dashicons-edit"></span>
                        </a>
                        <a href="">
                            <span class="dashicons dashicons-trash"></span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
}

/**
 * Create customers page
 */
function reservation_create_customers_page() {
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
}

/**
 * The houses page
 */
function reservation_houses_page() {
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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
                        ");
                        foreach ($houses as $house) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $house->id ?></th>
                                <td><?php echo $house->name ?></td>
                                <td><?php echo $house->price ?></td>
                                <td><?php echo $house->max_persons ?></td>
                                <td><?php if ($house->animals_allowed == 0) { echo 'Nee';} if ($house->animals_allowed == 1) { echo 'Ja';} ?></td>
                                <td>
                                    <a href="">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
}

/**
 * The create house page
 */
function reservation_create_house_page() {
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <h1 class="mt-2 ml-2">Huis aanmaken</h1>

    <?php
    /**
     * If new house form is submitted
     */
    if (isset($_POST['new_house_submit'])) {
        global $wpdb;

        $query = $wpdb->insert(
            'houses',
            array(
                'name' => $_POST['home_name'],
                'price' => $_POST['home_price_per_person'],
                'max_persons' => $_POST['max_persons'],
                'animals_allowed' => $_POST['home_animals_allowed'],
            )
        );

        if (!$query == true) {
            echo 'Er ging iets mis!';
            return;
        }

        echo 'Huis is opgeslagen!';
    }

    ?>

    <hr>

    <div class="container" style="max-width: 500px;">
        <form action="<?php esc_url($_SERVER['REQUEST_URI']) ?>" method="POST">
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
                <input class="form-check-input" type="checkbox" value="" id="home_animals_allowed" name="home_animals_allowed">
                <label class="form-check-label" for="flexCheckDefault">
                    Huisdieren
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="child_bed_allowed" name="child_bed_allowed">
                <label class="form-check-label" for="flexCheckDefault">
                    Ledikantje
                </label>
            </div>

            <button type="submit" name="new_house_submit" class="btn btn-primary">Opslaan</button>
        <form>
    </div

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
}

/**
 * The finance page
 */
function reservation_financial_page() {
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <h1 class="mt-2 ml-2">Omzet</h1>

    <hr>

    <div class="container">
        <h1>Statistieken</h1>
        <div class="row">
            <div class="col-sm bg-dark text-white rounded p-2 m-2">
                <h5 class="text-center">Totale omzet 2024</h5>
                <br>
                <h5 class="text-center">30 euro</h5>
            </div>
            <div class="col-sm bg-dark text-white rounded p-2 m-2">
                <h5 class="text-center">Aantal dagen verhuurd 2024</h5>
                <br>
                <h5 class="text-center">30 dagen</h5>
            </div>
            <div class="col-sm bg-dark text-white rounded p-2 m-2">
                <h5 class="text-center">Aantal klanten die gehuurd hebben 2024</h5>
                <br>
                <h5 class="text-center">30 klanten</h5>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Laatste x boekingen</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Datum</th>
                <th scope="col">Huis</th>
                <th scope="col">Naam</th>
                <th scope="col">Totale prijs</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">2</th>
                    <td>29-11-2024</td>
                    <td>Voorbeeld huis 1</td>
                    <td>Kelvin</td>
                    <td>30 euro</td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>29-11-2024</td>
                    <td>Voorbeeld huis 2</td>
                    <td>Kelvin</td>
                    <td>30 euro</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container">
        <h1>Exporteer</h1>
        <div class="row">
            <div class="col-sm">
                <div class="ps-2">
                    <h6>Maak een rapport</h6>
                </div>

                <div class="form-group mt-2 p-2">
                    <h5 class="text-dark font-weight-bold">Start datum</h5>
                    <input type="date" id="date" name="date" class="form-control" value="" required>
                </div>

                <div class="form-group mt-2 p-2">
                    <h5 class="text-dark font-weight-bold">Eind datum</h5>
                    <input type="date" id="date" name="date" class="form-control" value="" required>
                </div>

                <div class="mt-2 p-2">
                    <button type="button" class="btn btn-success">Maak omzet rapport</button>
                </div>
            </div>
            <div class="col-sm">
                <div class="ps-2">
                    <h6>Gemaakte rapportages</h6>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Naam</th>
                            <th scope="col">Datum</th>
                            <th scope="col">Gemaakt door</th>
                            <th scope="col">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">rapport_van_29_11_tot_29_11_jr_2024.pdf</th>
                            <td>29-11-2024</td>
                            <td>Kelvin de Reus</td>
                            <td>
                                <a href="#"><span class="dashicons dashicons-download"></span></a>
                                <a href="#"><span class="dashicons dashicons-trash"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">rapport_van_29_11_tot_29_11_jr_2024.pdf</th>
                            <td>29-11-2024</td>
                            <td>Kelvin de Reus</td>
                            <td>
                                <a href="#"><span class="dashicons dashicons-download"></span></a>
                                <a href="#"><span class="dashicons dashicons-trash"></span></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
}

/**
 * The settings page
 */
function reservation_settings_page() {
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <h1 class="mt-2 ml-2">Instellingen</h1>

    <hr>

    <div class="container">
        <h2>Email adressen om nieuwe boekingen op te ontvangen</h1>

        <form>
            <div class="mb-3">
                <label for="email_one" class="form-label">Email adres 1</label>
                <input type="email"  style="max-width: 300px;" class="form-control" id="email_one" placeholder="name@example.com">
            </div>

            <div class="mb-3">
                <label for="email_one" class="form-label">Email adres 2</label>
                <input type="email"  style="max-width: 300px;" class="form-control" id="email_one" placeholder="name@example.com">
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
}

function handle_booking_form() {
    global $wpdb;

    $query = $wpdb->insert(
        'bookings',
        array(
            'test' => $wpdb,
        )
    );

}

function booking_form() {
    if (isset($_POST['booking_form_submit'])) {
        handle_booking_form();
    }

    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">

    <div class="container mt-3" style="max-width: 700px;">
        <form action="<?php esc_url($_SERVER['REQUEST_URI']) ?>" method="POST">
            <div class="month">
                <ul>
                    <li class="prev">&#10094;</li>
                    <li class="next">&#10095;</li>
                    <select id="month-select" name="month">
                        <option value="0">Januari</option>
                        <option value="1">Februari</option>
                        <option value="2">Maart</option>
                        <option value="3">April</option>
                        <option value="4">Mei</option>
                        <option value="5">Juni</option>
                        <option value="6">Juli</option>
                        <option value="7">Augustus</option>
                        <option value="8">September</option>
                        <option value="9">Oktober</option>
                        <option value="10">November</option>
                        <option value="11">December</option>
                    </select>
                    <select id="year-select" name="year">
                        <!-- Dynamisch toevoegen van jaren via JS -->
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
                <li data-day="1"><strong>1</strong></li>
                <li data-day="2"><strong>2</strong></li>
                <li data-day="3"><strong>3</strong></li>
                <li data-day="4"><strong>4</strong></li>
                <li data-day="5"><strong>5</strong></li>
                <li data-day="6"><strong>6</strong></li>
                <li data-day="7"><strong>7</strong></li>
                <li data-day="8"><strong>8</strong></li>
                <li data-day="9"><strong>9</strong></li>
                <li data-day="10"><strong>10</strong></li> <!-- class="badge text-bg-danger p-2" -->
                <li data-day="11"><strong>11</strong></li>
                <li data-day="12"><strong>12</strong></li>
                <li data-day="13"><strong>13</strong></li>
                <li data-day="14"><strong>14</strong></li>
                <li data-day="15"><strong>15</strong></li>
                <li data-day="16"><strong>16</strong></li>
                <li data-day="17"><strong>17</strong></li>
                <li data-day="18"><strong>18</strong></li>
                <li data-day="19"><strong>19</strong></li>
                <li data-day="20"><strong>20</strong></li>
                <li data-day="21"><strong>21</strong></li>
                <li data-day="22"><strong>22</strong></li>
                <li data-day="23"><strong>23</strong></li>
                <li data-day="24"><strong>24</strong></li>
                <li data-day="25"><strong>25</strong></li>
                <li data-day="26"><strong>26</strong></li>
                <li data-day="27"><strong>27</strong></li>
                <li data-day="28"><strong>28</strong></li>
                <li data-day="29"><strong>29</strong></li>
                <li data-day="30"><strong>30</strong></li>
                <li data-day="31"><strong>31</strong></li>
            </ul>

            <input type="hidden" name="days_to_rent" id="selected_days" value="">
            <input type="hidden" name="start_day" id="start_day" value="">
            <input type="hidden" name="end_day" id="end_day" value="">

            <p>Geboekt: <span class="badge text-bg-danger p-2 mr-2">&nbsp;</span></p>

            <hr>

            <div class="mb-3">
                <h1>Huis/appartement</h1>
                <select class="form-select" aria-label="Default select example" id="home" name="home" onchange="changePrice(event)">
                    <option selected disabled>Selecteer</option>
                    <?php
                    global $wpdb;

                    $houses = $wpdb->get_results(
                    "
                    SELECT * FROM `houses`;
                    "
                    );

                    foreach ($houses as $house) {
                        ?>
                        <option value="<?php echo $house->price; ?>"><?php echo $house->name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="row">
                <h1>Boeker</h1>
                <div class="col">
                    <!-- Form -->
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Naam</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" aria-describedby="" placeholder="Voornaam">
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
                        <select class="form-select" aria-label="Default select example" id="nationality" name="nationality" onchange="showHideIdFirst()">
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
                        <input class="form-check-input" type="checkbox" value="5" id="animals" name="animals" onchange="changePrice()">
                        <label class="form-check-label" for="animals">
                            Huisdieren die mee komen (5€ extra)
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="10" id="child_bed" name="child_bed" onchange="changePrice()">
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
                <select class="form-select" aria-label="Default select example" id="amount_persons" name="amount_persons" onchange="changeExtraPersons(event)">
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
                            <input type="text" class="form-control" id="name_first_second" name="name_second" aria-describedby="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="name_last_second" class="form-label">Achternaam</label>
                            <input type="text" class="form-control" id="name_last_second" name="name_second" aria-describedby="">
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
                            <select class="form-select" aria-label="Default select example" id="nationality_person_2" name="nationality_person_2" onchange="showHideIdSecond()">
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
                            <input type="date" class="form-control" id="birthdate_second" name="birthdate_second" aria-describedby="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3" style="display: none;" id="id_number_second">
                            <label for="id_number_second" class="form-label">ID/paspoort nummer</label>
                            <input type="text" class="form-control" id="id_number_second" name="id_number_second" aria-describedby="">
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
                            <input type="text" class="form-control" id="first_name_thirth" name="first_name_thirth" aria-describedby="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="last_name_thirth" class="form-label">Achternaam</label>
                            <input type="text" class="form-control" id="last_name_thirth" name="last_name_thirth" aria-describedby="">
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
                            <select class="form-select" aria-label="Default select example" id="nationality_person_3" name="nationality_person_3" onchange="showHideIdThirth()">
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
                            <input type="date" class="form-control" id="birthdate_thirth" name="birthdate_thirth" aria-describedby="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3" style="display: none;" id="id_number_thirth">
                            <label for="id_number_thirth" class="form-label">ID/paspoort nummer</label>
                            <input type="text" class="form-control" id="id_number_thirth" name="id_number_thirth" aria-describedby="">
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
                            <input type="text" class="form-control" id="first_name_fourth" name="first_name_fourth" aria-describedby="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="last_name_fourth" class="form-label">Achternaam</label>
                            <input type="text" class="form-control" id="last_name_fourth" name="last_name_fourth" aria-describedby="">
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
                            <select class="form-select" aria-label="Default select example" id="nationality_person_4" name="nationality_person_4" onchange="showHideIdFourth()">
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
                            <input type="date" class="form-control" id="birthdate_fourth" name="birthdate_fourth" aria-describedby="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3" style="display: none;" id="id_number_fourth">
                            <label for="id_number_fourth" class="form-label">ID/paspoort nummer</label>
                            <input type="text" class="form-control" id="id_number_fourth" name="id_number_fourth" aria-describedby="">
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <!-- Total pricing -->
            <h1>Prijs</h1>
            <div class="">
                <h2 class="d-inline">€<div class="d-inline" id="total_price"></div></h2>
            </div>

            <button type="submit" name="booking_form_submit" class="btn btn-primary">Verzend</button>
        </form>
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
            font-size:12px;
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

        @media screen and (max-width:720px) {
            .weekdays li, .days li {width: 13.1%;}
        }

        @media screen and (max-width: 420px) {
            .weekdays li, .days li {width: 12.5%;}
            .days li .active {padding: 2px;}
        }

        @media screen and (max-width: 290px) {
            .weekdays li, .days li {width: 12.2%;}
        }
    </style>

    <script>
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

        const days = document.querySelectorAll('#days_to_rent li');
        const selectedDaysInput = document.getElementById('selected_days');

        days.forEach(day => {
            day.addEventListener('click', function() {

                this.classList.toggle('selected');
                const selectedDays = [];
                document.querySelectorAll('#days_to_rent li.selected').forEach(selectedDay => {
                    selectedDays.push(selectedDay.getAttribute('data-day'));

                });

                selectedDaysInput.value = selectedDays.join(',');

                const res = getMinAndMaxDaysFromString(input = selectedDaysInput.value);
                const selectedYear = document.getElementById("year-select");
                const selectedMonth = document.getElementById("month-select");
                const startDate = new Date(selectedYear.value, selectedMonth.value, res.minNumber);
                const endDate = new Date(selectedYear.value, selectedMonth.value, res.maxNumber);

                console.log(startDate.toLocaleDateString(), endDate.toLocaleDateString());
                document.getElementById('start_day').value = startDate.toLocaleDateString();
                document.getElementById('end_day').value = endDate.toLocaleDateString();

                changePrice();
            });
        });

        // Initialiseer de maanden en jaren
        const monthSelect = document.getElementById("month-select");
        const yearSelect = document.getElementById("year-select");
        const daysToRent = document.getElementById("days-to-rent");

        const currentYear = new Date().getFullYear();
        const currentMonth = new Date().getMonth();

        // Voeg de jaren toe aan de dropdown
        for (let i = currentYear - 10; i <= currentYear + 10; i++) {
            const option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            yearSelect.appendChild(option);
        }

        // Stel standaardwaarde in voor maand en jaar
        monthSelect.value = currentMonth;
        yearSelect.value = currentYear;

        // Functie om het aantal dagen in een maand te berekenen
        function getDaysInMonth(month, year) {
            return new Date(year, month + 1, 0).getDate();
        }

        // Functie om de dagen in de kalender bij te werken
        function updateCalendar() {
            const selectedMonth = parseInt(monthSelect.value);
            const selectedYear = parseInt(yearSelect.value);
            const daysInMonth = getDaysInMonth(selectedMonth, selectedYear);

            // Wis bestaande dagen
            daysToRent.innerHTML = "";

            // Voeg de dagen toe
            for (let day = 1; day <= daysInMonth; day++) {
                const li = document.createElement("li");
                li.setAttribute("data-day", day);
                li.textContent = day;
                daysToRent.appendChild(li);
            }
        }

        // Event listeners voor wijzigingen in maand en jaar
        monthSelect.addEventListener("change", updateCalendar);
        yearSelect.addEventListener("change", updateCalendar);

        updateCalendar();

        function changePrice() {
            var homePrice = document.getElementById('home').value;
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
}

function booking_form_handle() {
    if (!isset($_POST['booking_form_submitted'])) {
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

add_shortcode('booking_form', 'register_booking_form_short_code');