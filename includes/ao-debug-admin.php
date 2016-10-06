<?php

/**
 * Main Admin Page for the AO Debug
 *
 * @author aodev.io
 * @since 1.0.0
 */

add_action( 'admin_menu', 'ao_db_register_admin_menu', 15);

/**
 * Adds the main menu to the WordPress dashboard
 */
function ao_db_register_admin_menu() {
    add_menu_page(
        'AODB Main',
        'AO Debug',
        'update_plugins',
        'aodb-main',
        'ao_db_render_admin_menu',
        'dashicons-admin-network',
        102
    );
    do_action('ao_db_register_admin_menus');
}

/**
 * Renders the HTML for the main admin page of AO Debug
 * on the WordPress dashboard.
 * @since 1.0.0
 * @uses ao_cal_render_admin_header()
 * @uses ao_cal_render_admin_main_content()
 * @return STRING HTML output
 */
function ao_db_render_admin_menu() {

    ao_db_save_admin_main();

    ob_start();
    ao_db_render_admin_header();
    ao_db_render_admin_main_content();
    ao_db_render_admin_signature();
    $output = ob_get_contents();
    ob_end_clean();

    echo $output;

}

/**
 * Renders HTML output for the header of AO Debug admin pages.
 * @since 1.0.0
 * @return STRING HTML output
 */
function ao_db_render_admin_header() {
    ?>
    <h1>AO Debug</h1>
    <h6>A plugin created and released by <a href="<?php echo AO_URL; ?>">aodev.</a></h6>
    <?php
}

/**
 * Renders HTML output for the content of the AO Debug main admin page.
 * @since 1.0.0
 * @return STRING HTML output
 */
function ao_db_render_admin_main_content() {
    ob_start();
    ?>


    <h4>ABSPATH</h4>
    <?php echo ABSPATH; ?>
    <h4>WPINC</h4>
    <?php echo WPINC; ?>
    <h4>WP_PLUGIN_DIR</h4>
    <?php echo WP_PLUGIN_DIR; ?>
    <h4>WP_PLUGIN_URL</h4>
    <?php echo WP_PLUGIN_URL; ?>


    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}


/**
 * [ao_db_render_admin_footer description]
 * @return [type] [description]
 */
function ao_db_render_admin_signature() {
    ?>
    <div class="signature">
        <a href="<?php echo AO_URL; ?>">
            <img src="<?php echo AO_DB_URL . 'images/ao-logo.png'; ?>" alt="aodev logo" class="ao-logo signature-logo" />
        </a>
        <div class="signature-text">
            <p><a href="<?php echo AO_URL; ?>">Alpha Omega Development (aodev)</a> is a small team of developers... Okay so we are really small. By we, I mean I. aodev is currently one person.</p>
        </div>
    </div>
    <?php
}




function ao_db_save_admin_main() {
    global $aodb;
    if (isset($_POST['ao-db-check-form-submit']) && $_POST['ao-db-check-form-submit'] === 'form-submit-check') {
        $username = sanitize_text_field($_POST['ao-db-username']);
        $aodb->opt_username->update($username);
        ?>
            <div class="ao-update">
                <p><?php echo "AO Debug Update: Username Saved"; ?></p>
            </div>
        <?php
    }
    else if (isset($_POST['ao-db-check-form-submit'])) {
        ?>
            <div class="ao-error">
                <p><?php echo "AO Debug Error: Username Update broke... Something went horribly wrong."; ?></p>
            </div>
        <?php
    }

}
