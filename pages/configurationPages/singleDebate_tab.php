<?php
add_action( 'admin_init', 'tvsDebate_spdSettings_init' );



function tvsDebate_spdSettings_init(  ) {

    register_setting( 'tvsDebate_spdSettingsSections', 'tvsDebate_spdSettings' );
    
    // add_settings_section(
    //     'tvsDebate_CommonConfig_section',
    //     __( 'Common', 'wordpress' ),
    //     'tvsDebate_spdtabConfig_section_callback',
    //     'tvsDebate_spdSettingsSections'
    // );


    add_settings_field(
        'tvsDebate_ShowRelatedCategory',
        __( 'Show related category on single discussion page', 'wordpress' ),
        'tvsDebate_ShowRelatedCategoryConfig_spdtab_html',
        'tvsDebate_spdSettingsSections',
        'tvsDebate_CommonConfig_section'
    );



}

function tvsDebate_ShowRelatedCategoryConfig_spdtab_html(  ) {
    $options = get_option( 'tvsDebate_spdSettings' );
    ?>
    <select name='tvsDebate_spdSettings[tvsDebate_ShowRelatedCategory]'>
        <option value="yes" <?php selected( $options['tvsDebate_ShowRelatedCategory'] , "yes"); ?>>Yes</option>
        <option value="no" <?php selected( $options['tvsDebate_ShowRelatedCategory'] , "no" ); ?>>No</option>
    </select>
    <?php
}

// function tvsDebate_spdtabConfig_section_callback(  ) {
//     echo __( 'Coming Soon ', 'wordpress' );
// }

function tvsDebate_config_spdtab(  ) {
    ?>
    <form action='options.php' method='post'>
        <?php
        settings_fields( 'tvsDebate_spdSettingsSections' );
        do_settings_sections( 'tvsDebate_spdSettingsSections' );
        submit_button();
        ?>
    </form>
    <?php
}