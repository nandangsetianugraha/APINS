<!doctype html>
<html>
    <head>
        <title>Shortcut - harviacode.com</title>
    </head>
    <body>
        <h1>HALAMAN HOME</h1>
        <p>Silahkan tekan tombol Esc untuk keluar aplikasi.</p>
        <script>
            document.onkeydown = function (e) {
                switch (e.keyCode) {
                    // escape
                    case 27:
                        setTimeout('self.location.href="logout.php"', 0);
                        break;
                    // f12
                    case 123:
                        setTimeout('self.location.href="help.php"', 0);
                        break;
                }
                //menghilangkan fungsi default tombol
                e.preventDefault();
            };
        </script>
    </body>
</html>
<!--
f1	112
f2	113
f3	114
f4	115
f5	116
f6	117
f7	118
f8	119
f9	120
f10	121
f11	122
f12	123
-->