<?php

if (!class_exists('MV_Slider_Settings')) {
    class MV_Slider_Settings
    {
        public static $options;

        public function __construct()
        {
            self::$options = get_option('mv_slider_options');
            add_action('admin_init', array($this, 'admin_init'));
        }

        public function admin_init()
        {
            register_setting('mv_slider_group', 'mv_slider_options');

            add_settings_section(
                'mv_slider_main_section',
                'How does it work?',
                null,
                'mv_slider_page1'
            );

            add_settings_section(
                'mv_slider_second_section',
                'Other Plugin Options',
                null,
                'mv_slider_page2'
            );

            add_settings_field(
                'mv_slider_shortcode',
                'Shortcode',
                array($this, 'mv_slider_shortcode_callback'),
                'mv_slider_page1',
                'mv_slider_main_section'
            );

            add_settings_field(
                'mv_slider_title',
                'Slider Title',
                array($this, 'mv_slider_title_callback'),
                'mv_slider_page2',
                'mv_slider_second_section',
                array(
                    'label_for' => 'mv_slider_title'
                )
            );

            add_settings_field(
                'mv_slider_bullets',
                'Display bullets?',
                array($this, 'mv_slider_bullets_callback'),
                'mv_slider_page2',
                'mv_slider_second_section',
                array(
                    'label_for' => 'mv_slider_bullets'
                )
            );

            add_settings_field(
                'mv_slider_style',
                'Slider Style',
                array($this, 'mv_slider_style_callback'),
                'mv_slider_page2',
                'mv_slider_second_section',
                array(
                    'items' => array(
                        'style-1',
                        'style-2'
                    ),
                    'label_for' => 'mv_slider_style'
                )
            );
        }

        public function mv_slider_shortcode_callback()
        {
            ?>
            <span>Use the shortcode [mv_slider] to display the slider in any page/post-widget</span>
            <?php
        }

        public function mv_slider_title_callback($args)
        {
            ?>
            <input type="text" name="mv_slider_options[mv_slider_title]" id="mv_slider_title"
                value="<?php echo isset(self::$options['mv_slider_title']) ? esc_attr(self::$options['mv_slider_title']) : ''; ?>">
            <?php
        }

        public function mv_slider_bullets_callback($args)
        {
            $value = isset(self::$options['mv_slider_bullet']) ? self::$options['mv_slider_bullet'] : '';
            ?>
            <label for="mv_slider_bullet_yes">
                <input type="radio" name="mv_slider_options[mv_slider_bullet]" id="mv_slider_bullet_yes" value="yes" <?php checked($value, 'yes'); ?>>
                Yes
            </label>
            <label for="mv_slider_bullet_no">
                <input type="radio" name="mv_slider_options[mv_slider_bullet]" id="mv_slider_bullet_no" value="no" <?php checked($value, 'no'); ?>>
                No
            </label>
            <?php
        }

        public function mv_slider_style_callback($args)
        {
            $value = isset(self::$options['mv_slider_style']) ? self::$options['mv_slider_style'] : '';
            ?>
            <select name="mv_slider_options[mv_slider_style]" id="mv_slider_style">
                <?php foreach ($args['items'] as $item): ?>
                    <option value="<?php echo esc_attr($item) ?>" <?php selected($value, $item); ?>>
                        <?php echo esc_html(ucfirst($item)) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <?php
        }
    }
}