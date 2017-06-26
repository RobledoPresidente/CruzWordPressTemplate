<?php /*Template Name: Twitter*/

get_header(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="/css/main.min.css" rel="stylesheet">
    </head>
<body>
<div class="container">
    <div id="header" class="row">   
        <a href="http://sorgerobledo.com/" title="Jorge Robledo" rel="home"><img height="100" src="http://jorgerobledo.com/wp-content/uploads/2017/02/cropped-icono-300x300.png" class="attachment-full size-full" alt="logo-web"></a>
        <a href="/"><h1>Jorge Robledo</h1></a>
    </div>
    <a>Cerrar esta ventana</a>
    <script>
    
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
        
        // check if oauth_verifier is set
        var oauth_verifier = getUrlParameter('oauth_verifier');
        
        if (typeof oauth_verifier !== "undefined") {
            
            window.opener.twitter_oauth_accessToken(oauth_verifier);
            
            window.close();
        }
        
    </script>
</body>
</html>
