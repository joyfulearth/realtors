<?php
function is_page_secure() {
	return variable(VARLocal) && !getQueryParameter('insecure');
}

function network_before_file() {
	echo variableOr('before_file_html', '');
}

function before_footer_assets() { //before as color needs to be overridden in mediakit
	includeThemeManager();
	echo implode('	', CanvasTheme::HeadCssFor('real-estate')) . NEWLINE;
}

function enrichThemeVars($vars, $what) {
	if ($what == 'header') {
		if (nodeIs(SITEHOME))
			$vars['optional-slider'] = getSnippet('home-slider');

		if ($vars['optional-slider'])
			variable('before_file_html', '<div class="m-4"></div>' . NEWLINE); //spacer
	}
	return $vars;
}

setup_cdn();

variables([
	VAREmail => plus_email('raveendar1960@gmail.com', 'realtors'),
	VARPhone  =>  $ph = '+91-91766-86867',
	VARWhatsapp  => whatsapp_clean($ph),
	VARPhone2 =>  $ph = '+91-8148165952',
	VARWhatsapp2 => whatsapp_clean($ph),

	'dont-show-current-menu' => true,

	VARMediakit => '?themecolor=00725B&heading=FEDA15',

	VARLinkToSectionHome => true,
	VARLinkToNodeHome => true,
	VARLinkToSubnodeHome => true,
	VARLinkToSiteHome => true,

	socialBuilder::variableName => socialBuilder::create()
		->addLinkedIn('#todo-raveendar/', 'Raveendar')
		->addGithubGroup()->addUtilityGroup()->getItems()
]);
