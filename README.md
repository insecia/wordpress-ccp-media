# wordpress-ccp-media
Wordpress plugin for Insecia CCP MediaManager

## Installation
1. Clone the repository and put it into the wordpress plugins directory
2. Log into wordpress and activate the plugin
3. Open the configurations page under settings and set the `Api Base Path`, `Project ID`, `Root Directory ID`, `Login Page URL`,
`Redirect After Login URL` and `Registration Form URL`. These fields are mandatory.
4. Create 3 new pages, one for the media browser, one for the image details view and one for logging in
5. Place the corresponding short-code in your page content wherever you like <br />
Media Browser: `[insecia_ccp_media_browser][/insecia_ccp_media_browser]` <br />
Image Detail View: `[insecia_ccp_media_view][/insecia_ccp_media_view]` <br />
Login Form: `[insecia_ccp_login][/insecia_ccp_login]`
6. Change `Login Page URL` and `Redirect After Login URL` according to your page names

## Requirements
* PHP 5.6
* cURL

## Templates
The optional textareas on the settings page can be used to modify the design of the plugin. Simply start with the plugins defaults 
and go from there
