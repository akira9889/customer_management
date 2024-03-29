<?php
$hidden_logout_path = [
    '/',
    '/login/',
    '/shop_login/'
];
if (isset($_SESSION['USER'])) {
    $company_id = filter_input(INPUT_GET, 'company_id', FILTER_VALIDATE_INT);

    $sql = "SELECT `name` FROM `companies` WHERE `id` = :company_id";

    $options = [
        'company_id' => $company_id,
    ];

    $mysql = new ExecuteMySql($sql, $options) ?? null;
    $result = $mysql->execute() ? $mysql->execute()[0]: null;
    $header_logo = $result ? $result['name'] : '';
}

if (isset($shop) && isset($shop['area'])) {
    $header_logo = $shop['name'] . ' ' . $shop['area'] . '店';
}

if (in_array($request_path, $hidden_logout_path)) {
    $header_logo = 'Managee';
}
?>
<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- fontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- Original CSS -->
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css">
    <script>
        //
    </script>
    <title><?= $title ?></title>
</head>

<body class="register_shop">
    <header class="header">
        <div class="header-inner">
            <div class="header-content">
                <h1 class="header-logo"><? if($header_logo) echo $header_logo; ?></h1>
                <nav id="header-nav" class="header-nav">
                    <ul id="header-list" class="header-list">
                        <?php if (!in_array($request_path, $hidden_logout_path)) : ?>
                            <li class="header-item">
                                <a class="header-item-link" href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a>
                            </li>
                        <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>
