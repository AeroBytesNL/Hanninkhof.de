<?php
/*
Plugin Name: Reserveringen
Plugin URI: https://github.com/AutiCodes/Hanninkhof.de
Description: Reserveringen systeem
Version: 1.0
Author: AutiCodes
Author URI: https://auticodes.nl
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

    <div class="container">

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
                <th scope="col">Foto</th>
                <th scope="col">Naam</th>
                <th scope="col">Prijs</th>
                <th scope="col">Acties</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">2</th>
                    <td><img class="" src="https://media.istockphoto.com/id/155666671/nl/vector/vector-illustration-of-red-house-icon.jpg?s=612x612&w=0&k=20&c=tFnYvPlhW4cv3A8R03hFjL6AMkHx7fFseemnck05Z4Y=" style="width: 25px;"></td>
                    <td>Huis i</td>
                    <td>70,-</td>
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
                    <th scope="row">1</th>
                    <td><img class="" src="https://media.istockphoto.com/id/155666671/nl/vector/vector-illustration-of-red-house-icon.jpg?s=612x612&w=0&k=20&c=tFnYvPlhW4cv3A8R03hFjL6AMkHx7fFseemnck05Z4Y=" style="width: 25px;"></td>
                    <td>Huis x</td>
                    <td>70,-</td>
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
 * The create house page
 */
function reservation_create_house_page() {
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <h1 class="mt-2 ml-2">Huis aanmaken</h1>

    <hr>

    <div class="container">

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

function booking_form() {
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">

    <div class="container mt-3" style="max-width: 700px;">
        <form>
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
                <li><strong>19</strong></span></li>
                <li><strong>20</strong></span></li>
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

            <p>Geboekt: <span class="badge text-bg-danger p-2 mr-2">&nbsp;</span></p>

            <div class="row">
                <div class="col">
                    <!-- Form -->
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Naam</label>
                        <input type="text" class="form-control" id="first_name" aria-describedby="" placeholder="Voornaam">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Achternaam</label>
                        <input type="text" class="form-control" id="last_name">
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <label for="birthdate" class="form-label">Geboortedatum</label>
                        <input type="date" class="form-control" id="birthdate" aria-describedby="">
                    </div>

                    <div class="mb-3">
                    <label for="birthdate" class="form-label">Nationaliteit</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected disabled>Selecteer</option>
                            <option value="1">Nederlands</option>
                            <option value="2">Duits</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="address" class="form-label">Adres</label>
                        <input type="text" class="form-control" id="address" aria-describedby="">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="city" class="form-label">Woonplaats</label>
                        <input type="text" class="form-control" id="city" aria-describedby="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="zipcode" class="form-label">Postcode</label>
                        <input type="text" class="form-control" id="zipcode" aria-describedby="">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="id_number" class="form-label">ID of paspoort-nummer</label>
                        <input type="text" class="form-control" id="id_number" aria-describedby="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email adres</label>
                        <input type="email" class="form-control" id="email" aria-describedby="">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefoonnummer</label>
                        <input type="text" class="form-control" id="phone" aria-describedby="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h4>Opties</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="animals">
                        <label class="form-check-label" for="animals">
                            Huisdieren die mee komen (5€ extra)
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="child_bed">
                        <label class="form-check-label" for="child_bed">
                        Kinderbedje(ledikantje) (10€ extra)
                        </label>
                    </div>
                </diV>

                <div class="col">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Opmerkingen</label>
                        <textarea class="form-control" aria-label="With textarea"></textarea>
                    </div>
                </div>
            </div>

            <p>Wintermaanden extra verwarmingskosten: 1 Oktober t/m 31 april 10 per nacht per appartement.
                <br>
                Toeristenbelasting: € 2.10 p.p. per nacht 14 jaar en ouder
                <br>
                Prijzen zijn op basis van 2 personen per nacht.
                Extra personen zijn 10 p.p. per nacht voor 13>
                Kinderen 13< zijn gratis.
            </p>

            <hr>

            <div class="mb-3">
                <label for="birthdate" class="form-label">Aantal personen:</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected disabled>Selecteer</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>

            <div class="mb-3">
                <p>Persoon 2:</p>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="name_first_" class="form-label">Voornaam achternaam</label>
                            <input type="text" class="form-control" id="address" aria-describedby="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="city" class="form-label">Adres</label>
                            <input type="text" class="form-control" id="city" aria-describedby="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="address" class="form-label">Woonplaats</label>
                            <input type="text" class="form-control" id="address" aria-describedby="">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Verzend</button>
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

add_shortcode('booking_form', 'booking_form');