<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php if($filename!='') {echo preg_replace('/^\d_/', '', $filename).' | ';} ?>
            <?php if($dir!='') {echo preg_replace('/^\d_/', '', $dir).' | ';} ?>
            Железные сказки | НРИ Dungeon World</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="app/views/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="app/views/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#ilyatommenu").menu();
            });
        </script>
        <style>
            @font-face {
                font-family: 'Literata';
                src: url('app/views/assets/fonts/Literata.ttf');
                font-weight: normal;
                font-style: normal;
            }
            @font-face {
                font-family: 'Literata-Italic';
                src: url('app/views/assets/fonts/Literata-Italic.ttf');
                font-weight: normal;
                font-style: normal;
            }
            @font-face {
                font-family: 'Windlass';
                src: url('app/views/assets/fonts/Windlass.ttf');
                font-weight: normal;
                font-style: normal;
            }
            em {
                font-family: Literata-Italic;
            } 
/*            h1+p {
                font-size: 9pt;
                font-weight: normal;
                font-family: Literata-Italic;
                text-align: center;
                width: 100%;
                column-span: all;
                padding-bottom: 42px;
            }*/
            p {
                font-size: 9pt;
                font-weight: normal;
                font-family: Literata;
                text-align: justify;
                margin-top: 0px;
            }
            table {
                font-size: 9pt;
                font-weight: normal;
                font-family: Literata;
                text-align: left;
                margin-top: 0px;
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
            }
            table td {
                padding: 5px;
                vertical-align: top;
            }
            table th {
                padding: 5px;
            }
            table tbody tr:nth-child(odd) {
                background-color: #dddddd;
            }
            a {
                font-size: 9pt;
                font-weight: normal;
                font-family: Literata-Italic;
            }
            small {
                font-weight: normal;
                font-family: Literata-Italic;
                color: red;
                text-transform: none;
            }
            h1 {
                font-size: 25pt;
                font-weight: bold;
                font-family: Windlass;
                text-align: left;
                width: 100%;
                /*line-height: 52px;*/
                column-span: all;
                padding-bottom: 15px;
                margin: 0px;
            }
            h2 {
                font-size: 16pt;
                font-weight: bold;
                font-family: Windlass;
                text-align: left;
                margin-top: 20px;
                margin-bottom: 10px;
                line-height: 28px;
                text-transform: none;
            }
            h3 {
                font-size: 14pt;
                font-weight: normal;
                font-family: Windlass;
                text-align: left;
                margin-top: 0px;
                margin-bottom: 5px;
                line-height: 28px;
            }
            h4 {
                font-size: 9pt;
                font-weight: bold;
                font-family: Literata;
                text-align: left;
                margin-top: 0px;
                margin-bottom: 5px;
                line-height: 20px;
                text-transform: uppercase;
            }
            h2 img {
                vertical-align: middle;
                height: 55px;
                width: 55px;
            }
            h3 img {
                vertical-align: middle;
            }
            ul, ol, table {
                margin-top: 2px;
                margin-bottom: 20px;
            }
            li {
                margin-left: -10px;
                list-style-position: outside;
                font-size: 9pt;
                font-weight: normal;
                font-family: Literata;
            }
            blockquote {
                margin: 15px 0px;
                padding: 15px 30px 5px 18px;
                quotes: none;
                background-color: #e5d0b3;  /*f5f5dc*/ /*fce4a8*/
                background-image: url('app/views/assets/img/flag.gif');
                background-repeat: repeat-y;
                background-position: right;
                border: 3px solid white;
            }
            blockquote:before,
            blockquote:after,
            q:before,
            q:after {
                content: none;
            }
            /*        .page {
                            counter-increment: page-numbers;
                            column-count: 2;
                            column-gap: 45px;
                            column-fill: balance;
                            padding: 50px 60px 80px 60px;
                            column-rule: 0px solid;
                            background-image: url('app/views/assets/img/back.png');
                            background-repeat: no-repeat;
                            background-attachment: fixed;
                    }*/
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-md-2 d-none d-md-block"></div>
            <div class="col-md-8 col-sm-12">
                <div class="container rounded" id="header" style="padding-top:10px;">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="app/views/assets/img/head.jpg" class="rounded img-fluid"/>
                        </div>
                    </div>
                </div>
                <div class="container" id="content">
                    <div class="row">
                        <div class="col-md-3" style="padding-top:20px;">
                            <?php echo $tableofcontents; ?>
                        </div>
                        <div class="col-md-9" style="padding-top:20px;">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
                <div class="container rounded" id="footer" style="background-color: #0c1672;padding-top:15px;margin-bottom:10px;margin-top:15px;">
                    <div class="row">
                        <div class="col-md-3"><p><strong style="color: white;"><?php echo date('Y');?> | Switcher сделал</strong></p>
                        </div>
                        <div class="col-md-8">
                            <p><small style="color: white;">Текст оригинального издания Dungeon World: Сейдж ЛяТорра и Адам Кёбел (издательство Sage Kobold Productions) распространяется по лицензии Creative Commons BY 3.0</small></p>
                            <p><small style="color: white;">Русскоязычный перевод оригинальных правил Indigo Games (ред. Василий Шаповалов, Андрей Воскресенский, Тамара Персикова) распространяется по лицензии Creative Commons BY 3.0</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-none d-md-block"></div>
        </div>
    </body>
</html>
