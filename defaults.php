<?php
/**
 * Register customizer defaults.
 *
 * @package   FoodiePro\Functions\Customizer
 * @copyright Copyright (c) 2020, Feast Design Co.
 * @license   GPL-2.0+
 * @since     3.0.0
 */

defined( 'WPINC' ) || die;

add_filter( 'feastco_customizer_font_variants', 'foodie_pro_font_variants', 10, 3 );
/**
 * Filters the allowed Google Font variants for the Brunch Pro theme.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $chosen_variants The chosen variants.
 * @param  string $font The font to load variants for.
 * @param  array  $variants The variants for the font.
 * @return array $chosen_variants The chosen variants.
 */
function foodie_pro_font_variants( $chosen_variants, $font, $variants ) {
	$allowed = array(
		'200',
		'200italic',
		'300',
		'300italic',
		'regular',
		'italic',
		'600',
		'600italic',
		'700',
		'700italic',
		'900',
		'900italic',
	);

	foreach ( $allowed as $variant ) {
		if ( in_array( $variant, $variants ) ) {
			$chosen_variants[] = $variant;
		}
	}

	return array_unique( $chosen_variants );
}

add_filter( 'feastco_customizer_all_fonts', 'feastco_customizer_get_google_fonts' );
add_filter( 'feastco_customizer_get_google_fonts', 'foodie_pro_get_google_fonts' );
/**
 * Filters the allowed Google Fonts for the Foodie Pro theme.
 *
 * @since  3.0.0
 *
 * @param  array $fonts
 * @return array $fonts
 */
function foodie_pro_get_google_fonts( $fonts ) {
	$fonts = array(
		'Handlee' => array(
			'label'    => 'Handlee',
			'variants' => array(
				'regular',
			),
			'subsets' => array(
				'latin',
			),
		),
        'Monserrat' => array(
            'label'    => 'Montserrat',
            'variants' => array(
                '100',
                '100italic',
                '300',
                '300italic',
                'regular',
                'italic',
                '700',
                '700italic',
                '900',
                '900italic',
            ),
            'subsets' => array(
                    'latin',
                    'latin-ext',
            ),
        ),
    	'Lato' => array(
			'label'    => 'Lato',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'700',
				'700italic',
				'900',
				'900italic',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		'Montserrat Alternates' => array(
            'label'    => 'Montserrat Alternates',
            'variants' => array(
                '100',
                '100italic',
                '300',
                '300italic',
                'regular',
                'italic',
                '700',
                '700italic',
                '900',
                '900italic',
            ),
            'subsets' => array(
                    'latin',
                    'latin-ext',
            ),
        ),
        'Paytone One' => array(
                'label'    => 'Paytone One',
                'variants' => array(
                        'regular',
                ),
                'subsets' => array(
                        'latin',
                ),
        ),
		'Playfair Display' => array(
			'label'    => 'Playfair Display',
			'variants' => array(
				'regular',
				'italic',
				'700',
				'700italic',
				'900',
				'900italic',
			),
			'subsets' => array(
				'latin',
				'cyrillic',
				'latin-ext',
			),
		),
		'Raleway' => array(
			'label'    => 'Raleway',
			'variants' => array(
				'100',
				'200',
				'300',
				'regular',
				'500',
				'600',
				'700',
				'800',
				'900',
			),
			'subsets' => array(
				'latin',
			),
		),
		'Roboto Slab' => array(
			'label'    => 'Roboto Slab',
			'variants' => array(
				'100',
				'300',
				'regular',
				'700',
			),
			'subsets' => array(
				'latin',
				'greek-ext',
				'cyrillic',
				'greek',
				'vietnamese',
				'latin-ext',
				'cyrillic-ext',
			),
		),
		'Trocchi' => array(
			'label'    => 'Trocchi',
			'variants' => array(
				'regular',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
	);

	return $fonts;
}
