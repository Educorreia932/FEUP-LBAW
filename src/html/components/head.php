<?php function site_head($title, $stylesheets) { ?>
    <head>
        <meta charset="utf-8">
        <title>Trade-a-Bid | <?=$title?></title>

        <!-- Bootstrap Responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
        
        <!-- Chart.JS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

        <!-- Default stylesheet -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- Included stylesheets -->
        <?php foreach($stylesheets as $stylesheet) {?>
            <link rel="stylesheet" href="../css/<?=$stylesheet?>">
        <?php } ?>
    </head>
<?php } ?>