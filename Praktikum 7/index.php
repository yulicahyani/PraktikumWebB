<!DOCTYPE HTML>
<html>
    <head>
        <title>Praktikum 7 PHP</title>
        <style>
            .form-style{
                max-width: 500px;
                height: 400px;
                margin: 30px auto;
                padding:10px;
            }
            form{
                margin: 30px auto;
            }
            legend{
                color:white;
                background-color:#1d3557;
                border-top: 1px solid white;
                border-left: 1px;
                border-right: 1px;
                border-radius: 5px 5px 0px 0px;
                padding: 5px;
            }
            fieldset{
                border-radius: 10px;
                background-color: #1d3557;
                width: fit-content;
                margin: 30px auto;
            }
            table td{
                color:white;
                padding: 5px 20px;
            }
            .sumit{
                padding:5px;
                margin: 10px 30px 100px 170px;
            }
            .sumit input{
                color:white;
                width: 150px;
                height: 30px;
                background-color:#1d3557;
            }
        </style>
    </head>
    <body>
        <div class="form-style">
            <form action="function.php" method="post">
                <fieldset>
                    <legend>Data Mahasiswa</legend>
                    <table>
                        <tr>
                            <td><label for="">Nama</label></td>
                            <td><input type="text" name="nama" value="<?=isset($_POST['nama']) ? $_POST['nama'] : ''?>"><br></td>
                        </tr>
                        <tr>
                            <td><label for="">NIM</label></td>
                            <td><input type="text" name="nim" value="<?=isset($_POST['nim']) ? $_POST['nim'] : ''?>"></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset>
                    <legend>Nilai Mahasiswa</legend>
                    <table>
                        <tr>
                            <td><label for="">Tugas</label></td>
                            <td><input type="text" name="tugas" value="<?=isset($_POST['tugas']) ? $_POST['tugas'] : ''?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">UTS</label></td>
                            <td> <input type="text" name="uts" value="<?=isset($_POST['uts']) ? $_POST['uts'] : ''?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">UAS</label></td>
                            <td><input type="text" name="uas" value="<?=isset($_POST['uas']) ? $_POST['uas'] : ''?>"></td>
                        </tr>
                    </table>
                </fieldset>
                <div class="sumit">
                    <input type="submit" name="submit" value="Submit"/> 
                </div>
            </form>
        </div>
    </body>
</html>