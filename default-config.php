<?php

const MEDIA_DIRECTORY_TEMPLATE = <<<EOD
<a class='directoryRow' href='.?parent=%DIR_ID%'>
    <i class='fa fa-folder-open-o fa-5x'></i>
    <h2 class='directoryName'>%DIR_NAME%</h2>
    <p class='directoryDescription'>%DIR_DESCRIPTION%</p>
    <img src="%DIR_PICTURE_PATH%?height=80" 
        onerror="this.style.display='none'">
</a>
EOD;

const MEDIA_FILE_TEMPLATE = <<<EOD
<a class='fileRow' href="%SETTING_MEDIA_VIEW_PAGE_URL%?media=%MEDIA_ID%">
    <img src='%IMAGE_PATH%'>
    <p class='fileName'>%IMAGE_NAME%</p>
</a>
EOD;

const MEDIA_BROWSER_STYLE = <<<EOD
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
EOD;

const IMAGE_DETAILS_TEMPLATE = <<<EOD
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
EOD;

const LOGIN_FORM_TEMPLATE = <<<EOD
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<form id="inseciaLoginForm">
    <div>
        Benutzername <br />
        <input type="text" name="insecia-ccp-media-user">
    </div>
    <div>
        Passwort <br />
        <input type="password" name="insecia-ccp-media-pass">
    </div>
    <br />
    <div>
        <input type="submit">
    </div>
</form><br />

<a href="%SETTING_REGISTRATION_FORM_URL%">
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
                window.location.href = '%SETTING_REDIRECT_AFTER_LOGIN_URL%';
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
EOD;

const ERROR_TOKEN_INVALID = <<<EOD
<a href="%SETTING_LOGIN_PAGE_URL%">Sie müssen sich anmelden, um diese Inhalte sehen zu können.</a>
EOD;

const ERROR_NO_RIGHTS = <<<EOD
Sie haben keine ausreichenden Rechte, um diese Inhalte zu sehen.
EOD;

const ERROR_TOKEN_EXPIRED = <<<EOD
<a href="%SETTING_LOGIN_PAGE_URL%">Ihre Sitzung ist abgelaufen. Bitte melden Sie sich erneut an.</a>
EOD;
