<?php

/**
 * Main Nepali Post Date plugin class.
 *
 * This class loads plugin options, sets filters and converts the date on selected hooks.
 *
 * @subpackage Frontend interfaces
 * @author Padam Shankhadev
 * @since 1.0
 * @var opts - plugin options
 */
class Nepali_Post_Date_Frontend
{

    private $opts;

    private $date;

    /**
     * Class Constructor
     *
     * Loads default options, sets default filter list and adds convert_date filter to selected locations
     *
     * @author Padam Shankhadev
     * @since 1.0
     */
    public function __construct()
    {
        $this->date = new Nepali_Date();

        $default_opts = [
            'active' => [ 
                'date' => true, 
                'time' => true, 
                'modified_date' => false, 
                'modified_time' => false 
            ],
            'date_format' => 'd m y, l',
            'custom_date_format' => '',
            'today_date_format' => ''
        ];

        $default_opts = apply_filters( 'npd_modify_default_opts', $default_opts );

        $this->opts = get_option( 'npd_opts', $default_opts );

        $filter_list = array();

        if ($this->opts['active']['date']):
            $filter_list = array_merge( $filter_list, array( 'get_the_date', 'the_date' ) );
        endif;

        if ($this->opts['active']['time']) :
            $filter_list = array_merge( $filter_list, array( 'get_the_time', 'the_time' ) );
        endif;

        if ( $this->opts['active']['modified_date'] ) :
            $filter_list = array_merge( $filter_list, array( 'get_the_modified_date', 'the_modified_date' ) );
        endif;

        if ( $this->opts['active']['modified_time'] ) :
            $filter_list = array_merge( $filter_list, array( 'get_the_modified_time', 'the_modified_time' ) );
        endif;


        /**
         * Filter the list of applicable filter locations
         *
         * @since 1.0
         * @param array $filter_list List of filters for time appearance change
         *
         */
        $filters = apply_filters(
            'npd_filters',
            $filter_list
        );

        foreach ( $filters as $filter ) :

            add_filter( $filter, array( &$this, 'convert_date' ), 10, 1);

        endforeach;

        add_shortcode( 'nepali_post_date', array( &$this, 'nepali_post_date_shortcode') );

        add_shortcode( 'nepali_today_date', array( &$this, 'nepali_today_date_shortcode') );

        add_shortcode( 'nepali_number', array( &$this, 'nepali_number_shortcode') );
    }


    /**
     * Main plugin function which does the date conversion.
     *
     * @param string $orig_time Original time / date string
     * @author Padam Shankhadev
     * @since 1.0
     */

    public function convert_date( $orig_time )
    {
        global $post;

        $converted_date = '';

        //If option not set as active return original string.
        if (!$this->opts['active']) {
            return $orig_time;
        }

        if ($this->opts['custom_date_format']) {
            $format = $this->opts['custom_date_format'];
        } else {
            $format = $this->opts['date_format'];
        }

        if ( $this->opts['active']['time'] ) {
            $converted_date = $this->get_converted_nepali_date( strtotime( $post->post_date ), $format, true );
        } else {
            $converted_date = $this->get_converted_nepali_date( strtotime( $post->post_date ), $format );
        }

        return $converted_date;

    }

    public function nepali_post_date_shortcode( $attrs = array() )
    {
        extract( shortcode_atts( array(
            'post_date' => time(),
        ), $attrs) );

        if ( $this->opts['custom_date_format'] ) {
            $format = $this->opts['custom_date_format'];
        } else {
            $format = $this->opts['date_format'];
        }

        if ( $this->opts['active']['time'] ) {
            $converted_date = $this->get_converted_nepali_date( strtotime( $post_date ), $format, true );
        } else {
            $converted_date = $this->get_converted_nepali_date( strtotime( $post_date ), $format );
        }

        return $converted_date;
    }

    public function nepali_today_date_shortcode( $attrs = array() )
    { 
        if ( $this->opts['today_date_format'] ) {
            $format = $this->opts['today_date_format'];
        } else {
            $format = $this->opts['date_format'];
        }

        return $this->get_converted_nepali_date( time(), $format );
    }

    public function nepali_number_shortcode( $attrs = array() )
    {
        extract( shortcode_atts( array(
            'number' => '0123456789',
        ), $attrs) );

        return $this->convert_into_nepali_number( $number );
    }


    public function get_converted_nepali_date( $date, $format, $time = false )
    {
        $nepali_calender = $this->date->eng_to_nep( date( 'Y', $date ), date( 'm', $date ), date( 'd', $date ) );

        $converted_date = str_replace( ['l', 'd', 'm', 'y' ], [
            $nepali_calender['day'],
            $this->date->convert_to_nepali_number( $nepali_calender['date'] ),
            $nepali_calender['nmonth'],
            $this->date->convert_to_nepali_number( $nepali_calender['year'] )
        ], $format );

        if( $time ) {
            $converted_date .= ' ' . $this->date->convert_to_nepali_number( date( 'H', $date ) ) . ':' . $this->date->convert_to_nepali_number( date( 'i', $date ) );
        }

        return $converted_date;
    }

    public function convert_into_nepali_number( $str ) {
        if( empty( $str ) ) {
            return 'Please enter the value.';
        }

        $search = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

        $replace = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];

        $string = str_replace($search, $replace, $str);

        return $string;
    }
}