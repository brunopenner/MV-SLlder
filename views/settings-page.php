<!-- <form action="">
    <label for="test">Name</label>
    <input type="text" id="test" name="test">

    <label for="test">Phone number</label>
    <input type="text" id="test" name="test">

    <label for="textarea">Your message</label>
    <textarea name="textarea" id="textarea"></textarea>
</form>

<style>
    label,
    input,
    textarea {
        display: block;
        width: 100%;
        max-width: 500px;
    }
</style> -->

<div class="wrap">
    <h1><?php esc_html(get_admin_page_title()); ?></h1>
    <?php
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'main_options';
    ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=mv_slider_admin&tab=main_options"
            class="nav-tab <?php echo $active_tab == 'main_options' ? 'nav-tab-active' : ''; ?>">Main Options</a>
        <a href="?page=mv_slider_admin&tab=additional_options"
            class="nav-tab <?php echo $active_tab == 'additional_options' ? 'nav-tab-active' : ''; ?>">Additional
            Options</a>
    </h2>
    <form action="options.php" method="POST">
        <?php
        if ($active_tab == 'main_options') {
            settings_fields('mv_slider_group');
            do_settings_sections('mv_slider_page1');
        } else {
            settings_fields('mv_slider_group');
            do_settings_sections('mv_slider_page2');
        }
        submit_button('Save Settings');
        ?>
    </form>
</div>