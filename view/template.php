<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css"/>
        <script type="text/javascript" src="tinymce/tinymce.js"></script>
    <script type="text/javascript">
        tinyMCE.init({
        	selector : 'textarea',
            
            language : "fr",
            
            
			        });
     </script>
        <title><?= $title ?></title>
        
    </head>
        
    <body>
        <?= $content ?>
    </body>
</html>