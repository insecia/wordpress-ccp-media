# wordpress-ccp-media
Wordpress plugin for Insecia CCP MediaManager

## Installation
1. Clone the repository and put it into the wordpress plugins directory
2. Log into wordpress and activate the plugin
3. Open the configurations page under settings and set the `Api Base Path`, `Project ID` and `Root Directory ID`
4. Paste the html/css/js code below into the corresponding template configuration fields. Individual style and functionality can be implemented from there
5. Create 3 new pages, one for the media browser, one for the image details view and one for logging in
6. Place the corresponding short-code in your page content wherever you like <br />
Media Browser: `[insecia_ccp_media_browser][/insecia_ccp_media_browser]` <br />
Image Detail View: `[insecia_ccp_media_view][/insecia_ccp_media_view]` <br />
Login Form: `[insecia_ccp_login][/insecia_ccp_login]`
7. Change the links in the templates to whatever you decided to name your page

## Requirements
* PHP 5.6
* cURL

## Templates
### Directory Template
This template represents the html for a single directory in the media browser
```html
<a class='directoryRow' href='.?parent=%DIR_ID%'>
    <i class='fa fa-folder-open-o fa-5x'></i>
    <h2 class='directoryName'>%DIR_NAME%</h2>
    <p class='directoryDescription'>%DIR_DESCRIPTION%</p>
    <img src="%DIR_PICTURE_PATH%?height=80" onerror="this.style.display='none'">
</a>
```

### File Template
This template represents the html for a single file in the media browser
```html
<a class='fileRow' href="beispielseite-bild?media=%MEDIA_ID%">
    <img src='%IMAGE_PATH%'>
    <p class='fileName'>%IMAGE_NAME%</p>
</a>
```

### Media Browser Style
This template should provide the necessary style for the media browser and its directories and files
```html
<div style="clear: both"></div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .directoryRow {
        width: calc(100% / 3 - 10px);
        border: 3px solid #00305e;
        margin: 5px;
        padding: 5px;
        float: left;
        text-align: center;
        height: 200px;
        overflow: hidden;
        color: #00305e;
        position: relative;
    }

    .directoryRow > img {
        position: absolute; 
        height: 80px;
        top: 10px; 
        width: 100px; 
        left: 70px;
    }

    .directoryName {
        color:#2B2B24;
        font-size: 18px;
        font-style: italic;   
        margin-top: 10px;
    }

    .directoryDescription {
        font-size: 12px;
        color:#706f6f;
    }

    .fileRow {
        width: calc(100% / 3 - 10px);
        border: 3px solid #00305e;
        margin: 5px;
        padding: 5px;
        float: left;
        text-align: center;
        height: 200px;
        overflow: hidden;
        color: black;
    }

    .fileName {
        font-size: 12px;
        font-style: italic;   
    }
</style>
```

### Image Details Template
This template is used to display the details of an image
```html
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h2>%IMAGE_NAME%</h2>
<p>%IMAGE_DESCRIPTION%</p>

<div class="iptcMeta">
    <div>Erstellungsdatum: %IPTC_FIELD_DATE_CREATED%</div>
    <div>Ersteller: %IPTC_FIELD_BY_LINE%</div>
    <div>Urheberrechtsvermerk: %IPTC_FIELD_COPYRIGHT_NOTICE%</div>
    <div>Stichwörter: %IPTC_FIELD_KEYWORDS%</div>
</div><br />

<img src="%IMAGE_PATH%">
<div class="downloadArea">
    <a class="downloadSmall" href="%IMAGE_PATH%&download=true&percent=0.2">
        <i class="fa fa-cloud-download fa-3x"></i>
        <div>Klein (20%)</div>
    </a>
    <a class="downloadMiddle" href="%IMAGE_PATH%&download=true&percent=0.5">
        <i class="fa fa-cloud-download fa-3x"></i>
        <div>Mittel (50%)</div>
    </a>
    <a class="downloadLarge" href="%IMAGE_PATH%&download=true&percent=0.7">
        <i class="fa fa-cloud-download fa-3x"></i>
        <div>Groß (70%)</div>
    </a>
    <a class="downloadOriginal" href="%IMAGE_PATH%&download=true">
        <i class="fa fa-cloud-download fa-3x"></i>
        <div>Original</div>
    </a>
</div>

<style>
    .downloadArea {
        width: 100%;
        margin-top:30px;
    }

    .downloadArea > a {
        width: 24%;
        display: inline-block;
        text-align: center;
        color:#00305e;
    }
</style>
```

### Login Form Template
This template is used to provide a login form 
(Link to registration form must be inserted)
```html
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<form id="inseciaLoginForm">
    <div>
        Benutzername <br />
        <input type="text" name="user">
    </div>
    <div>
        Passwort <br />
        <input type="password" name="pass">
    </div>
    <br />
    <div>
        <input type="submit">
    </div>
</form><br />

<a href="">
    <i class="fa fa fa-arrow-right"></i>
    Oder hier registrieren
</a>

<style>
    #inseciaLoginForm {
        width: 50%;
    }

    #inseciaLoginForm input {
        width: 100%;
    }
</style>
<script>
    jQuery("#inseciaLoginForm").submit(function(event) {
        event.preventDefault();

        var form = jQuery('#inseciaLoginForm');
        var data = form.serialize();
        data += '&action=insecia_api_login';

        jQuery.post('/wp-admin/admin-ajax.php', data, function(response) {
            data = JSON.parse(response);

            if(data.status === 'OK') {
                window.location.href = 'beispielseite-kategorieliste';
            } else {
                if(data.message === 'user_not_found') {
                    alert("Benutzernahme oder Passwort ist nicht korrekt");
                } else {
                    alert("Fehler bei der Anmeldung. Bitte versuchen Sie es später erneut");
                }
            }      
        });
    });
</script>
```
