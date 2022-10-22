<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>NICL Invoice</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100&display=swap');

        * {
            box-sizing: border-box;
        }

        :root {
            --color-main: #ddd;
            --color-dark: #1d2231;
            --texto-grey: #8390a2;
            --color-blanco: #fff;
        }

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .table-rwd {
            font-size: 0.85em;
            border: 1px solid rgba(181, 213, 144, 0.5);
            color: #666;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
        }

        .table-rwd td,
        .table-rwd th {
            padding: 0.8em;
            border-bottom: 1px solid rgba(181, 213, 144, 0.5);
        }

        .table-rwd th {
            background: var(--color-main);
            color: black;
            font-weight: bold;
            text-align: right;
        }

        .table-rwd td {
            text-align: right;
        }

        .table-rwd td:before {
            content: "";
            color: var(--color-main);
        }

        .table-rwd td:after {
            content: "";
        }

        .table-rwd td:first-of-type {
            text-align: left;
        }

        .table-rwd td:first-of-type:before {
            content: "";
        }

        .table-rwd td:first-of-type:after {
            content: "";
        }

        .table-rwd tr:hover {
            background: rgba(181, 213, 144, 0.2);
        }

        .table-rwd tr td:nth-child(2n) {
            background: rgba(181, 213, 144, 0.2);
        }

        .table-container {
            overflow-x: auto;
        }

        .table-rwd tr:nth-child(2) td:first-child {
            box-shadow: 0 -2.7em 0 -6px var(--color-main),
            -6px -2.7em 0 -6px var(--color-main);
        }

        header {
            border-bottom: 2px solid #ddd;
        }

        main {
            display: flex;
            flex-direction: column;
            column-gap: 2rem;
        }

        main h2 {
            text-align: center;
        }
    </style>
</head>
<body>
<header>
    <h1>NICL Properties and Developers Ltd.</h1>
</header>
<main>
    @yield('content')
</main>
</body>
</html>
