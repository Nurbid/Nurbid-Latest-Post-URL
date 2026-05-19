<?php
/*
Plugin Name: Nurbid Latest Post URL (NLP)
Plugin URI: https://nurbid.com/nurbid-latest-post-url
Description: A simple WordPress plugin that automatically sets a link's URL to the Latest blog post, simply by adding the class "nurbid-latest-post-url" to a link or button, or by inserting the shortcode "[nurbid_latest_post_url]". Keep “Read latest” CTAs current without manual edits.
Version: 1.0.0
Author: Nurbid - Bespoke IT Services
Author URI: https://nurbid.com
Text Domain: nurbid-latest-post-url
Domain Path: /languages
Requires at least: 6.5
Requires PHP: 8.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined('ABSPATH') || exit;

define('NURBID_LPU_VERSION', '1.0.0');

function nurbid_lpu_get_latest_post_url(): string {
    $recent = wp_get_recent_posts(['numberposts' => 1, 'post_status' => 'publish']);
    return empty($recent) ? '' : esc_url(get_permalink($recent[0]['ID']));
}

function nurbid_lpu_ajax_get_latest_post_url(): void {
    echo nurbid_lpu_get_latest_post_url();
    wp_die();
}

add_action('wp_ajax_get_latest_post_url', 'nurbid_lpu_ajax_get_latest_post_url');
add_action('wp_ajax_nopriv_get_latest_post_url', 'nurbid_lpu_ajax_get_latest_post_url');

add_action('wp_footer', static function (): void {
    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
      fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>?action=get_latest_post_url')
        .then(response => response.text())
        .then(url => {
          const btn = document.querySelector('.nurbid-latest-post-url');
          if (btn && url.startsWith('http')) {
            btn.setAttribute('href', url);
          }
        })
        .catch(err => console.error('Failed to fetch latest post URL:', err));
    });
    </script>
    <?php
});

add_shortcode('nurbid_latest_post_url', static function (): string {
    return nurbid_lpu_get_latest_post_url();
});
