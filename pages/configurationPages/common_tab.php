<?php
add_action( 'admin_init', 'tvsDebate_CommonSettings_init' );

function tvsDebate_CommonSettings_init(  ) {
    register_setting( 'tvsDebate_doSettingsSections', 'tvsDebate_CommonSettings' );


    add_settings_section(
        'tvsDebate_CommonConfig_section',
        __( 'Common', 'wordpress' ),
        'tvsDebate_CommonConfig_section_callback',
        'tvsDebate_doSettingsSections'
    );

    add_settings_field(
        'tvsDebate_usedAjax',
        __( 'Open all pages with modal box', 'wordpress' ),
        'tvsDebate_C_usedAjaxConfig_html',
        'tvsDebate_doSettingsSections',
        'tvsDebate_CommonConfig_section'
    );



    // add_settings_field(
    //     'stncWpKiosk_text_field_euro',
    //     __( 'Euro', 'wordpress' ),
    //     'euro_stncWpKiosk_text_field_render',
    //     'tvsDebate_doSettingsSections',
    //     'tvsDebate_CommonConfig_section'
    // );

    // add_settings_field(
    //     'stncWpKiosk_text_field_altin',
    //     __( 'Altin', 'wordpress' ),
    //     'altin_stncWpKiosk_text_field_render',
    //     'tvsDebate_doSettingsSections',
    //     'tvsDebate_CommonConfig_section'
    // );
    // add_settings_field(
    //     'stncWpKiosk_text_field_ceyrek_altin',
    //     __( 'Ceyrek Altin', 'wordpress' ),
    //     'ceyrek_altin_stncWpKiosk_text_field_render',
    //     'tvsDebate_doSettingsSections',
    //     'tvsDebate_CommonConfig_section'
    // );



    
}

function tvsDebate_C_usedAjaxConfig_html(  ) {
    $options = get_option( 'tvsDebate_CommonSettings' );
    ?>

    <select name='tvsDebate_CommonSettings[tvsDebate_usedAjax]'>

        <option value="yes" <?php selected( $options['tvsDebate_usedAjax'] , "yes"); ?>>Yes</option>
        <option value="no" <?php selected( $options['tvsDebate_usedAjax'] , "no" ); ?>>No</option>

    </select>


    <?php
}







function tvsDebate_CommonConfig_section_callback(  ) {
    echo __( 'Coming Soon ', 'wordpress' );
}

function tvsDebate_config_common(  ) {
    ?>
    <form action='options.php' method='post'>
        <?php
        settings_fields( 'tvsDebate_doSettingsSections' );
        do_settings_sections( 'tvsDebate_doSettingsSections' );
        submit_button();
        ?>
    </form>
    <?php
}