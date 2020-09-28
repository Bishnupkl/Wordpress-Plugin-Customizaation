'use strict';
module.exports = function ( grunt ) {

    // load all grunt tasks matching the `grunt-*` pattern
    // Ref. https://npmjs.org/package/load-grunt-tasks
    require( 'load-grunt-tasks' )( grunt );

    grunt.initConfig( {
        /*
         * RTL CSS
         * Grunt plugin for RTLCSS, a framework for transforming CSS from LTR to RTL.
         * Ref. https://www.npmjs.com/package/grunt-rtlcss
         */
        rtlcss: {
            bbTask: {
                // task options
                options: {
                    // generate source maps
                    map: false,
                    // rtlcss options
                    opts: {
                        clean: false
                    },
                    // rtlcss plugins
                    plugins: [ ],
                    // save unmodified files
                    saveUnmodified: true,
                },
                expand: true,
                cwd: 'css/',
                dest: 'css-rtl/',
                src: [ '**/*.css' ]
            }
        },

        /*
         * CSS minify
         * Compress and Minify CSS files
         * Ref. https://github.com/gruntjs/grunt-contrib-cssmin
         */
        cssmin: {
            minify: {
                expand: true,
                cwd: 'css/',
                src: [ '*.css', '!*.min.css', '**/*.css'],
                dest: 'css-compressed/',
                //ext: '.min.css'
            },
            minifyRTL: {
                expand: true,
                cwd: 'css-rtl/',
                src: [ '*.css', '!*.min.css', '**/*.css'],
                dest: 'css-rtl-compressed/',
                //ext: '.min.css'
            },
        },
        /*
         * Uglify
         * Compress and Minify JS files
         * Ref. https://npmjs.org/package/grunt-contrib-uglify
         */
        uglify: {
            options: {
                banner: '/*! \n * Boss Theme JavaScript Library \n * @package Boss Theme \n */'
            },
            frontend: {
                src: [
                    'js/modernizr.min.js',
                    'js/ui-scripts/selectboxes.js',
                    'js/ui-scripts/fitvids.js',
                    'js/ui-scripts/jquery.cookie.js',
                    'js/ui-scripts/superfish.js',
                    'js/ui-scripts/hoverIntent.js',
                    'js/ui-scripts/imagesloaded.pkgd.js',
                    'js/ui-scripts/resize.js',
                    'js/jquery.growl.js',
                    'js/slider/slick.min.js',
                    'js/buddyboss.js',
                    'js/social-learner.js',
                    'js/boss-events.js'
                ],
                dest: 'js/compressed/boss-main-min.js'
            }
        },
        /*
         * Check text domain
         * Check your code for missing or incorrect text-domain in gettext functions
         * Ref. https://github.com/stephenharris/grunt-checktextdomain
         */
        checktextdomain: {
            options: {
                text_domain: [ 'boss', 'buddypress', 'bbpress', 'buddypress-docs', 'bpge', 'buddyboss-inbox', 'social-learner', 'invite-anyone', 'paid-memberships-pro', 'buddypress-groups-extras' ], //Specify allowed domain(s)
                keywords: [ //List keyword specifications
                    '__:1,2d',
                    '_e:1,2d',
                    '_x:1,2c,3d',
                    'esc_html__:1,2d',
                    'esc_html_e:1,2d',
                    'esc_html_x:1,2c,3d',
                    'esc_attr__:1,2d',
                    'esc_attr_e:1,2d',
                    'esc_attr_x:1,2c,3d',
                    '_ex:1,2c,3d',
                    '_n:1,2,4d',
                    '_nx:1,2,4c,5d',
                    '_n_noop:1,2,3d',
                    '_nx_noop:1,2,3c,4d'
                ]
            },
            target: {
                files: [ {
                        src: [
                            '*.php',
                            '**/*.php',
                            '!node_modules/**',
                            '!tests/**',
                            '!buddyboss-inc/buddyboss-framework/admin/**',
                            '!buddyboss-inc/buddyboss-framework/boss-extensions/**',
                            '!admin/tgm/**'
                        ], //all php
                        expand: true
                    } ]
            }
        },
        /*
         * Makepot
         * Generate a POT file for translators to use when translating your plugin or theme.
         * Ref. https://github.com/cedaro/grunt-wp-i18n/blob/develop/docs/makepot.md
         */
        makepot: {
            target: {
                options: {
                    cwd: '.', // Directory of files to internationalize.
                    domainPath: 'languages/', // Where to save the POT file.
                    exclude: [ 'node_modules/*', 'admin/ReduxFramework/*' ], // List of files or directories to ignore.
                    mainFile: 'index.php', // Main project file.
                    potFilename: 'boss.pot', // Name of the POT file.
                    potHeaders: { // Headers to add to the generated POT file.
                        poedit: true, // Includes common Poedit headers.
                        'Last-Translator': 'BuddyBoss <support@buddyboss.com>',
                        'Language-Team': 'BuddyBoss <support@buddyboss.com>',
                        'report-msgid-bugs-to': 'https://www.buddyboss.com/contact/',
                        'x-poedit-keywordslist': true // Include a list of all possible gettext functions.
                    },
                    type: 'wp-theme', // Type of project (wp-plugin or wp-theme).
                    updateTimestamp: true, // Whether the POT-Creation-Date should be updated without other changes.
                    updatePoFiles: true // Whether to update PO files in the same directory as the POT file.
                }
            }
        },
        /*
         * .Po to .Mo
         * Grunt plug-in to compile .po files into binary .mo files with msgfmt.
         * Ref. https://github.com/axisthemes/grunt-potomo
         */
        potomo: {
            dist: {
                options: {
                    poDel: false
                },
                files: [
                    {
                        expand: true,
                        cwd: 'languages/',
                        src: [ '*.po' ],
                        dest: 'languages/',
                        ext: '.mo',
                        nonull: true
                    }
                ]
            }
        }
    } );

    // register task
    grunt.registerTask( 'default', [ 'rtlcss', 'cssmin', 'uglify', 'checktextdomain', 'makepot', 'potomo' ] );
};