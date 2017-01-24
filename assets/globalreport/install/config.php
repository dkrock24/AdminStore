<?php
/***************************************************************************
*
Transactel - Powered by Telus -
*
***************************************************************************/

$aConfig = array(
    /**
     * Main Section.
     */
    'title' => 'Global Report',
    'version' => '1.0',
    'vendor' => 'Transactel',
    'update_url' => '',
    'compatible_with' => array(
        '7.0.x'
    ),

    /**
     * 'home_dir' and 'home_uri' - should be unique. Don't use spaces in 'home_uri' and the other special chars.
     */
    'home_dir' => 'transactel/globalreport/',
    'home_uri' => 'globalreport',

    'db_prefix' => 'trl_globalreport_',
    'class_prefix' => 'TrlGlobalreport',
    /**
     * Installation/Uninstallation Section.
     */
    'install' => array(
        'show_introduction' => 1,
        'change_permissions' => 0,
        'execute_sql' => 1,
        'update_languages' => 1,
        'recompile_global_paramaters' => 0,
        'recompile_main_menu' => 0,
        'recompile_member_menu' => 0,
        'recompile_member_stats' => 0,
        'recompile_site_stats' => 0,
        'recompile_page_builder' => 0,
        'recompile_profile_fields' => 0,
        'recompile_comments' => 0,
        'recompile_member_actions' => 0,
        'recompile_tags' => 0,
        'recompile_votes' => 0,
        'recompile_categories' => 0,
        'recompile_search' => 0,
        'recompile_injections' => 1,
        'recompile_permalinks' => 0,
        'recompile_alerts' => 0,
        'show_conclusion' => 1
    ),
    'uninstall' => array (
        'show_introduction' => 1,
        'change_permissions' => 0,
        'execute_sql' => 1,
        'update_languages' => 1,
        'recompile_global_paramaters' => 0,
        'recompile_main_menu' => 0,
        'recompile_member_menu' => 0,
        'recompile_member_stats' => 0,
        'recompile_site_stats' => 0,
        'recompile_page_builder' => 0,
        'recompile_profile_fields' => 0,
        'recompile_comments' => 0,
        'recompile_member_actions' => 0,
        'recompile_tags' => 0,
        'recompile_votes' => 0,
        'recompile_categories' => 0,
        'recompile_search' => 0,
        'recompile_injections' => 1,
        'recompile_permalinks' => 0,
        'recompile_alerts' => 0,
        'show_conclusion' => 1
    ),
    /**
    * Dependencies Section
    */
    'dependencies' => array(),
    /**
     * Category for language keys.
     */
    'language_category' => 'globalreport',
    /**
     * Permissions Section
     */
    'install_permissions' => array(),
    'uninstall_permissions' => array(),
    /**
     * Introduction and Conclusion Section.
     */
    'install_info' => array(
        'introduction' => 'inst_intro.html',
        'conclusion' => 'inst_concl.html'
    ),
    'uninstall_info' => array(
        'introduction' => 'uninst_intro.html',
        'conclusion' => 'uninst_concl.html'
    )
);
?>