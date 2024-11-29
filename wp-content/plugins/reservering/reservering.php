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
        'Reserveringen', // page title
        'Reserveringen', // Title in admin menu side bar
        'edit_theme_options',
        'reserveringen', // slug
        'reservation_options_page',  // to render
        'dashicons-admin-home' // sidebar item icon
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
        'reserveringen',
        'Huizen',
        'Huizen',
        'manage_options',
        'reserveringen-huizen',
        'reservation_houses_page',
    );
}

add_action('admin_menu', 'create_menus');

/**
 * The reservation page
 */
function reservation_options_page() {
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <h1 class="mt-2 ml-2">Reserveringen</h1>

    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Huis/kamer</th>
                <th scope="col">Naam</th>
                <th scope="col">Begin datum</th>
                <th scope="col">Eind datum</th>
                <th scope="col">Aangemaakt op</th>
                <th scope="col">Aantal nachten</th>
                <th scope="col">Betaling status</th>
                <th scope="col">Status</th>
                <th scope="col">Weergeven</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row">2</td>
                <td><a href="#">Voorbeeld huis</a></td>
                <td><a href="#">Kelvin de Reus</a></td>
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
                    <a href="">
                        <button type="button" class="btn btn-info">Weergeven</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td scope="row">1</td>
                <td><a href="#">Voorbeeld huis</a></td>
                <td><a href="#">Kelvin de Reus</a></td>
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
                    <a href="">
                        <button type="button" class="btn btn-info">Weergeven</button>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
}