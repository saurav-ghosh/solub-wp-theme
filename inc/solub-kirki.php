<?php

new \Kirki\Panel(
	'Solub_panel',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Solub Options', 'solub' ),
		'description' => esc_html__( 'Solub customizer options are here.', 'solub' ),
	]
);


function header_time_section(){
	new \Kirki\Section(
		'Solub_header',
		[
			'title'       => esc_html__( 'Header options', 'solub' ),
			'description' => esc_html__( 'Header options are here.', 'solub' ),
			'panel'       => 'Solub_panel',
			'priority'    => 160,
		]
	);
	
	new \Kirki\Field\Text(
		[
			'settings' => 'header_time',
			'label'    => esc_html__( 'Time', 'solub' ),
			'section'  => 'Solub_header',
			'default'  => esc_html__( 'Monday - Friday : 8:30 AM to 6:30 PM', 'solub' ),
			'priority' => 10,
		]
	);
	
	new \Kirki\Field\Text(
		[
			'settings' => 'header_button',
			'label'    => esc_html__( 'Button Text', 'solub' ),
			'section'  => 'Solub_header',
			'default'  => esc_html__( '+999 3265 464968', 'solub' ),
			'priority' => 10,
		]
	);
	
	new \Kirki\Field\Text(
		[
			'settings' => 'header_button_url',
			'label'    => esc_html__( 'Button URL', 'solub' ),
			'section'  => 'Solub_header',
			'default'  => esc_html__( '#', 'solub' ),
			'priority' => 10,
		]
	);
}
header_time_section();

function header_social_section(){
	new \Kirki\Section(
		'Solub_header_social',
		[
			'title'       => esc_html__( 'Header Social', 'solub' ),
			'description' => esc_html__( 'Header social options are here.', 'solub' ),
			'panel'       => 'Solub_panel',
			'priority'    => 160,
		]
	);
	
	new \Kirki\Field\Text(
		[
			'settings' => 'header_social_facebook',
			'label'    => esc_html__( 'Facebook', 'solub' ),
			'section'  => 'Solub_header_social',
			'default'  => esc_html__( '#', 'solub' ),
			'priority' => 10,
		]
	);
	
	new \Kirki\Field\Text(
		[
			'settings' => 'header_social_twitter',
			'label'    => esc_html__( 'Twitter', 'solub' ),
			'section'  => 'Solub_header_social',
			'default'  => esc_html__( '#', 'solub' ),
			'priority' => 10,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'header_social_instagram',
			'label'    => esc_html__( 'Instagram', 'solub' ),
			'section'  => 'Solub_header_social',
			'default'  => esc_html__( '#', 'solub' ),
			'priority' => 10,
		]
	);
	new \Kirki\Field\Text(
		[
			'settings' => 'header_social_pinterest',
			'label'    => esc_html__( 'Pinterest', 'solub' ),
			'section'  => 'Solub_header_social',
			'default'  => esc_html__( '#', 'solub' ),
			'priority' => 10,
		]
	);
}

header_social_section();

function header_logo(){
	new \Kirki\Section(
		'Solub_header_logo',
		[
			'title'       => esc_html__( 'Header Logo', 'solub' ),
			'description' => esc_html__( 'Header Logo options are here.', 'solub' ),
			'panel'       => 'Solub_panel',
			'priority'    => 160,
		]
	);
	
	new \Kirki\Field\Image(
		[
			'settings' => 'header_logo_black',
			'label'    => esc_html__( 'Logo Black', 'solub' ),
			'section'  => 'Solub_header_logo',
			'default'  => esc_html__( get_template_directory_uri() . '/assets/img/logo/logo-black.png', 'solub' ),
			'priority' => 10,
		]
	);

	new \Kirki\Field\Image(
		[
			'settings' => 'header_logo_white',
			'label'    => esc_html__( 'Logo White', 'solub' ),
			'section'  => 'Solub_header_logo',
			'default'  => esc_html__( get_template_directory_uri() . '/assets/img/logo/logo-white.png', 'solub' ),
			'priority' => 10,
		]
	);
}

header_logo();


// Footer Section
function footer_copyright_section(){
	new \Kirki\Section(
		'Solub_footer_copyright',
		[
			'title'       => esc_html__( 'Footer copyright', 'solub' ),
			'description' => esc_html__( 'Footers copyright are here.', 'solub' ),
			'panel'       => 'Solub_panel',
			'priority'    => 160,
		]
	);
	
	new \Kirki\Field\Text(
		[
			'settings' => 'footer_copyright',
			'label'    => esc_html__( 'Copyright Texts', 'solub' ),
			'section'  => 'Solub_footer_copyright',
			'default'  => esc_html__( 'Copyright © 2024 Solub. All Rights Reserved.', 'solub' ),
			'priority' => 10,
		]
	);
}
footer_copyright_section();

function footer_social_section(){
	new \Kirki\Section(
		'Solub_footer_social',
		[
			'title'       => esc_html__( 'Footer Social', 'solub' ),
			'description' => esc_html__( 'Footer social options are here.', 'solub' ),
			'panel'       => 'Solub_panel',
			'priority'    => 160,
		]
	);
	
	new \Kirki\Field\Text(
		[
			'settings' => 'footer_social_facebook',
			'label'    => esc_html__( 'Facebook', 'solub' ),
			'section'  => 'Solub_footer_social',
			'default'  => esc_html__( '#', 'solub' ),
			'priority' => 10,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'footer_social_instagram',
			'label'    => esc_html__( 'Instagram', 'solub' ),
			'section'  => 'Solub_footer_social',
			'default'  => esc_html__( '#', 'solub' ),
			'priority' => 10,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'footer_social_linkedin',
			'label'    => esc_html__( 'Linkedin', 'solub' ),
			'section'  => 'Solub_footer_social',
			'default'  => esc_html__( '#', 'solub' ),
			'priority' => 10,
		]
	);
	
	new \Kirki\Field\Text(
		[
			'settings' => 'footer_social_twitter',
			'label'    => esc_html__( 'Twitter', 'solub' ),
			'section'  => 'Solub_footer_social',
			'default'  => esc_html__( '#', 'solub' ),
			'priority' => 10,
		]
	);
}
footer_social_section();

// Breadcrumb section
function breadcrumb_section(){
	new \Kirki\Section(
		'Solub_breadcrumb',
		[
			'title'       => esc_html__( 'Breadcrumb', 'solub' ),
			'description' => esc_html__( 'Breadcrumb options are here.', 'solub' ),
			'panel'       => 'Solub_panel',
			'priority'    => 160,
		]
	);
	
	new \Kirki\Field\Image(
		[
			'settings' => 'breadcrumb_img',
			'label'    => esc_html__( 'Breadcrumb Image', 'solub' ),
			'section'  => 'Solub_breadcrumb',
			'priority' => 10,
		]
	);
}

breadcrumb_section();
