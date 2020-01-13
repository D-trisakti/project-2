<<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                width: 21cm;
                height: 29.7cm;
                margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 12px;
                font-family: Arial;
            }

            header {
                padding: 10px 0;
                margin-bottom: 30px;
            }

            #logo {
                text-align: center;
                margin-bottom: 10px;
            }

            #logo img {
                width: 250px;
            }

            h1 {
                border-top: 1px solid #5D6975;
                border-bottom: 1px solid #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(dimension.png);
            }

            h3 {
                border-bottom: 1px solid #5D6975;
                color: #5D6975;
                font-size: 1.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(dimension.png);
            }

            #project {
                float: left;
            }

            #project span {
                color: #5D6975;
                text-align: left;
                width: 52px;
                margin-right: 10px;
                display: inline-block;
                font-size: 12px;
            }

            #company {
                float: right;
                text-align: right;
            }

            #project div,
            #company div {
                white-space: nowrap;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
               
            }

            table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: left;
            }

            table td {
                padding: 20px;
                text-align: right;
            }

            table td.service,
            table td.desc {
                vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }



            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="assets/img/logo.png">
            </div>
            <h1>LAPORAN DATA PEGAWAI</h1>
            <div id="project">
            </div>
        </header>
        <main>
        <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th class="service">NAMA PEGAWAI</th>
                        <th class="service">EMAIL PEGAWAI</th>
                        <th class="desc">NOMOR TELEPON</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($user as $usr) : ?>
                        <tr>
                            <td><?= $no++ ?></th>
                            <td class="service"><?= $usr['nama']; ?></td>
                            <td class="service"><?= $usr['email']; ?></td>
                            <td class="desc"><?= $usr['notelpon']; ?></td>
                            <td class="desc"><?= $usr['is_active']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
        </main>
        <footer>
            Report was created on <?= date('d F Y');?>
        </footer>
    </body>

    </html>