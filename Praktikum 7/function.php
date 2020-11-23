<!DOCTYPE HTML>
<html>
    <head>
        <title>Praktikum 7 PHP</title>
        <style>
            h1{
                text-align:center;
            }
            .box-tampil{
                max-width: 500px;
                height: 400px;
                margin: 30px auto;
                padding:10px;
            }
            table{
                margin:auto;
            }
            table td{
                padding: 3px;
            }
            .nama{
                border-radius: 10px;
                background-color: #1d3557;
                padding:20px;
                color:white;
            }
            .nilai{
                background-color: #1d3557;
                padding:10px;
                color:white;
            }
            .akhir{
                border-radius: 10px;
                background-color: #1d3557;
                padding:5px; 
                color:white;
            }
            
        </style>
    </head>
    <body>
    <?php
        if (isset($_POST['submit'])){
            $nama = $_POST['nama'];
            $nim = $_POST['nim'];
            $tugas = $_POST['tugas'];
            $uts = $_POST['uts'];
            $uas = $_POST['uas'];

            $akhir = round((($tugas+$uts+$uas)/3),2);
    ?>
    
        <h1>Nilai Akhir Mahaiswa</h1>
        <div class="box-tampil">
            <div class="nama">
                <table>
                    <tr>
                        <td colspan="2"><?php echo $nama ?></td>
                        <td><?php echo $nim ?></td>
                    </tr>
                </table>
            </div>
            <div class="nilai">
                <table>
                    <tr>
                        <td>Nilai Tugas</td>
                        <td>=</td>
                        <td><?php echo $tugas ?></td>
                    </tr>
                    <tr>
                        <td>Nilai UTS</td>
                        <td>=</td>
                        <td><?php echo $uts ?></td>
                    </tr>
                    <tr>
                        <td>Nilai UAS</td>
                        <td>=</td>
                        <td><?php echo $uas ?></td>
                    </tr>
                    <tr>
                        <td>Nilai Akhir</td>
                        <td>=</td>
                        <td><h2><?php echo $akhir ?></h2></td>
                    </tr>
                </table>
            </div>
            <div class="akhir">
                <table>
                <tr>
                    <td colspan="3" rowspan="2"><h3>
                        <?php
                            if($akhir >= 80){
                                echo "Anda Lulus Dengan Predikat A";
                            }
                            elseif($akhir >= 70){
                                echo "Anda Lulus Dengan Predikat B";
                            }
                            elseif($akhir >= 60){
                                echo "Anda Lulus Dengan Predikat C";
                            }
                            else{
                                echo "Maaf Anda Dinyatakan Tidak Lulus";
                            }
                        ?>
                    </h3></td>  
                </tr>
                </table>
            </div>
        </div>
    <?php
        }
    ?>
    </body>
</html>