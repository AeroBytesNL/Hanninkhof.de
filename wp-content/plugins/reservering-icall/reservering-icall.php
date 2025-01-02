<?php
/**
 * Plugin Name: Reserveringen I-call
 * Plugin URI: https://github.com/AeroBytesNL/Hanninkhof.de
 * Description: Reservering I-call sync
 * Version: 1.0
 * Author: AeroBytes
 * Author URI: https://AeroBytes.nl
 */

if (!defined('ABSPATH')) {
    exit;
}

function wp_ical_export_rewrite_endpoint() {
    add_rewrite_rule('bookings-ical/?$', 'index.php?ical_export=1', 'top');
}
add_action('init', 'wp_ical_export_rewrite_endpoint');

function wp_ical_export_query_vars($vars) {
    $vars[] = 'ical_export';
    return $vars;
}
add_filter('query_vars', 'wp_ical_export_query_vars');

function wp_ical_export_request() {
    if (get_query_var('ical_export') == 1) {
        global $wpdb;
		
		$bookings = $wpdb->get_results("SELECT * FROM bookings");

        $query = $pdo->prepare("SELECT * FROM bookings");
        $query->execute();
        $bookings = $query->fetchAll(PDO::FETCH_ASSOC);

        $ical = "BEGIN:VCALENDAR\r\n";
        $ical .= "VERSION:2.0\r\n";
        $ical .= "PRODID:-//Your Company//Booking Calendar//EN\r\n";

        foreach ($bookings as $booking) {
            $startDate = date('Ymd', strtotime($booking['start_date']));
            $endDate = date('Ymd', strtotime($booking['end_date'] . ' +1 day'));
            $summary = "Booking for " . $booking['first_name'] . " " . $booking['last_name'];
            $description = "House rented: " . $booking['house_rented'] . "\nTotal price: €" . $booking['total_price'];
            $uid = $booking['id'] . "@yourdomain.com";
            $createdDate = date('Ymd\THis\Z', strtotime('now'));

            $ical .= "BEGIN:VEVENT\r\n";
            $ical .= "UID:$uid\r\n";
            $ical .= "DTSTAMP:$createdDate\r\n";
            $ical .= "DTSTART:$startDate\r\n";
            $ical .= "DTEND:$endDate\r\n";
            $ical .= "SUMMARY:" . addslashes($summary) . "\r\n";
            $ical .= "DESCRIPTION:" . addslashes($description) . "\r\n";
            $ical .= "END:VEVENT\r\n";
        }

        $ical .= "END:VCALENDAR\r\n";

        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="bookings.ics"');
        echo $ical;
        exit;
    }
}
add_action('template_redirect', 'wp_ical_export_request');

function wp_ical_export_shortcode() {
    $ical_url = home_url('/bookings-ical/');
    return '<a href="' . esc_url($ical_url) . '" target="_blank">Download iCal</a>';
}
add_shortcode('ical_download_link', 'wp_ical_export_shortcode');