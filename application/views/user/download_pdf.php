<div  style="font-size: 12px;">
<h1 style="color: blue; text-align: center"><u>Sistem Informasi Mahasiswa Online - Universitas Pamulang</u></h1>
<br>
<h2><i>Informasi Nilai Mahasiswa <?php echo l($user['fakultas_name']).' '.l($user['jurusan_name']) ?></i></h2>
<h3><?php echo 'NIM Mahasiswa : '.l($user['username']) ?></h3>
<h3><?php echo 'Nama Mahasiswa : '.l($user['name']) ?></h3>
<h3><?php echo 'Tahun Akademik : '.l($user['year_data']) ?></h3>
<h3><?php echo 'Alamat Mahasiswa : '.l($user['address']) ?></h3>
<br>
<h3><?php echo l('<hr>') ?></h3>
<br>
<h1><i><u><?php echo 'List Nilai '.l($user['name']) ?></u></i></h1>
</div>
<div  style="font-size: 11px;">
<h3>Semester 1 (Satu)</h3>
<?php if (!empty($user['nilai_semester1_items'])): ?>
<table border="1" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="background: #999; text-align: center" width="50px"><strong>Kode Matkul</strong></td>
            <td style="background: #999" width="250px"><strong>Nama Matkul</strong></td>
            <td style="background: #999; text-align: center" width="230px"><strong>Nama Dosen</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>SKS</strong></td>
            <td style="background: #999; text-align: center" width="70px"><strong>Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Bobot Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Mutu</strong></td>
        </tr>
            <?php $total_sks = 0 ?>
            <?php $total_mutu = 0 ?>
            <?php foreach ($user['nilai_semester1_items'] as $nilai) { ?>
        <tr>
            <td style="text-align:center" width="50px;"><?php echo l($nilai['code_matkul']); ?></td>
            <td width="250px"><?php echo l($nilai['matkul_name']); ?></td>
            <td style="text-align: center" width="230px"><?php echo l($nilai['dosen_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['sks_name']); ?><?php $total_sks += $nilai['sks_id']?></td>
            <td style="text-align: center" width="70px"><?php echo l($nilai['nilai_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['bobot']); ?></td>
            <td style="text-align: center" width="50px">
                        <?php
                        $nilai_mutu=$nilai['sks_id']*$nilai['bobot'];
                        $total_mutu += $nilai_mutu;
                        echo l($nilai_mutu);
                        ?>
            </td>
        </tr>
                <?php } ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50">Jumlah :</td>
            <td style="background: #ccc;" colspan="2" rowspan="1"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_sks) ?></td>
            <td style="background: #ccc; text-align:center" width="70"></td>
            <td style="background: #ccc; text-align:center" width="50"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_mutu) ?></td>
        </tr>
            <?php
            if (0!=$total_sks)
                $nilai_ips1=$total_mutu/$total_sks;
            else
                $nilai_ips1=0;
            ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPS :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">&nbsp;<? echo l($total_mutu) ?>:<? echo l($total_sks) ?> = <?php echo l($nilai_ips1)?></td>
        </tr>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPK :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">
                    <?php
                    $nilai_ipk1=$nilai_ips1/1;
                    echo '&nbsp;Saat ini nilai ipk kamu adalah <strong>'.($nilai_ipk1).'</strong>';
                    ?>
            </td>
        </tr>
    </tbody>
</table>
<?php else: ?>
    <?php echo 'Untuk semester ini '.l($user['name']).' belum ada nilainya atau belum mengikuti kuliah disemester ini.'; ?>
<?php endif ?>
<br><br><br>

<h3>Semester 2 (Dua)</h3>
<?php if (!empty($user['nilai_semester2_items'])): ?>
<table border="1" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="background: #999; text-align: center" width="50px"><strong>Kode Matkul</strong></td>
            <td style="background: #999" width="250px"><strong>Nama Matkul</strong></td>
            <td style="background: #999; text-align: center" width="230px"><strong>Nama Dosen</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>SKS</strong></td>
            <td style="background: #999; text-align: center" width="70px"><strong>Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Bobot Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Mutu</strong></td>
        </tr>
            <?php $total_sks = 0 ?>
            <?php $total_mutu = 0 ?>
            <?php foreach ($user['nilai_semester2_items'] as $nilai) { ?>
        <tr>
            <td style="text-align:center" width="50px;"><?php echo l($nilai['code_matkul']); ?></td>
            <td width="250px"><?php echo l($nilai['matkul_name']); ?></td>
            <td style="text-align: center" width="230px"><?php echo l($nilai['dosen_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['sks_name']); ?><?php $total_sks += $nilai['sks_id']?></td>
            <td style="text-align: center" width="70px"><?php echo l($nilai['nilai_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['bobot']); ?></td>
            <td style="text-align: center" width="50px">
                        <?php
                        $nilai_mutu=$nilai['sks_id']*$nilai['bobot'];
                        $total_mutu += $nilai_mutu;
                        echo l($nilai_mutu);
                        ?>
            </td>
        </tr>
                <?php } ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50">Jumlah :</td>
            <td style="background: #ccc;" colspan="2" rowspan="1"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_sks) ?></td>
            <td style="background: #ccc; text-align:center" width="70"></td>
            <td style="background: #ccc; text-align:center" width="50"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_mutu) ?></td>
        </tr>
            <?php
            if (0!=$total_sks)
                $nilai_ips2=$total_mutu/$total_sks;
            else
                $nilai_ips2=0;
            ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPS :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">&nbsp;<? echo l($total_mutu) ?>:<? echo l($total_sks) ?> = <?php echo l($nilai_ips2)?></td>
        </tr>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPK :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">
                    <?php
                    $angka2=2;
                    $nilai_ipk2=$nilai_ips2+$nilai_ipk1;
                    $nilai_ipk2_total=$nilai_ipk2/$angka2;
                    echo '&nbsp;Saat ini nilai ipk kamu adalah <strong>'.($nilai_ipk2_total).'</strong>';
                    ?>
            </td>
        </tr>
    </tbody>
</table>
<?php else: ?>
    <?php echo 'Untuk semester ini '.l($user['name']).' belum ada nilainya atau belum mengikuti kuliah disemester ini.'; ?>
<?php endif ?>
<br><br><br>

<h3>Semester 3 (Tiga)</h3>
<?php if (!empty($user['nilai_semester3_items'])): ?>
<table border="1" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="background: #999; text-align: center" width="50px"><strong>Kode Matkul</strong></td>
            <td style="background: #999" width="250px"><strong>Nama Matkul</strong></td>
            <td style="background: #999; text-align: center" width="230px"><strong>Nama Dosen</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>SKS</strong></td>
            <td style="background: #999; text-align: center" width="70px"><strong>Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Bobot Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Mutu</strong></td>
        </tr>
            <?php $total_sks = 0 ?>
            <?php $total_mutu = 0 ?>
            <?php foreach ($user['nilai_semester3_items'] as $nilai) { ?>
        <tr>
            <td style="text-align:center" width="50px;"><?php echo l($nilai['code_matkul']); ?></td>
            <td width="250px"><?php echo l($nilai['matkul_name']); ?></td>
            <td style="text-align: center" width="230px"><?php echo l($nilai['dosen_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['sks_name']); ?><?php $total_sks += $nilai['sks_id']?></td>
            <td style="text-align: center" width="70px"><?php echo l($nilai['nilai_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['bobot']); ?></td>
            <td style="text-align: center" width="50px">
                        <?php
                        $nilai_mutu=$nilai['sks_id']*$nilai['bobot'];
                        $total_mutu += $nilai_mutu;
                        echo l($nilai_mutu);
                        ?>
            </td>
        </tr>
                <?php } ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50">Jumlah :</td>
            <td style="background: #ccc;" colspan="2" rowspan="1"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_sks) ?></td>
            <td style="background: #ccc; text-align:center" width="70"></td>
            <td style="background: #ccc; text-align:center" width="50"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_mutu) ?></td>
        </tr>
            <?php
            if (0!=$total_sks)
                $nilai_ips3=$total_mutu/$total_sks;
            else
                $nilai_ips3=0;
            ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPS :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">&nbsp;<? echo l($total_mutu) ?>:<? echo l($total_sks) ?> = <?php echo l($nilai_ips3)?></td>
        </tr>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPK :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">
                    <?php
                    $angka3=3;
                    $nilai_ipk3=$nilai_ips3+$nilai_ipk1;
                    $ipk3_dapet1=$nilai_ipk3+$nilai_ipk2_total;
                    $nilai_ipk3_total=$ipk3_dapet1/$angka3;
                    echo '&nbsp;Saat ini nilai ipk kamu adalah <strong>'.($nilai_ipk3_total).'</strong>';
                    ?>
            </td>
        </tr>
    </tbody>
</table>
<?php else: ?>
    <?php echo 'Untuk semester ini '.l($user['name']).' belum ada nilainya atau belum mengikuti kuliah disemester ini.'; ?>
<?php endif ?>
<br><br><br>

<h3>Semester 4 (Empat)</h3>
<?php if (!empty($user['nilai_semester4_items'])): ?>
<table border="1" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="background: #999; text-align: center" width="50px"><strong>Kode Matkul</strong></td>
            <td style="background: #999" width="250px"><strong>Nama Matkul</strong></td>
            <td style="background: #999; text-align: center" width="230px"><strong>Nama Dosen</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>SKS</strong></td>
            <td style="background: #999; text-align: center" width="70px"><strong>Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Bobot Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Mutu</strong></td>
        </tr>
            <?php $total_sks = 0 ?>
            <?php $total_mutu = 0 ?>
            <?php foreach ($user['nilai_semester4_items'] as $nilai) { ?>
        <tr>
            <td style="text-align:center" width="50px;"><?php echo l($nilai['code_matkul']); ?></td>
            <td width="250px"><?php echo l($nilai['matkul_name']); ?></td>
            <td style="text-align: center" width="230px"><?php echo l($nilai['dosen_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['sks_name']); ?><?php $total_sks += $nilai['sks_id']?></td>
            <td style="text-align: center" width="70px"><?php echo l($nilai['nilai_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['bobot']); ?></td>
            <td style="text-align: center" width="50px">
                        <?php
                        $nilai_mutu=$nilai['sks_id']*$nilai['bobot'];
                        $total_mutu += $nilai_mutu;
                        echo l($nilai_mutu);
                        ?>
            </td>
        </tr>
                <?php } ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50">Jumlah :</td>
            <td style="background: #ccc;" colspan="2" rowspan="1"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_sks) ?></td>
            <td style="background: #ccc; text-align:center" width="70"></td>
            <td style="background: #ccc; text-align:center" width="50"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_mutu) ?></td>
        </tr>
            <?php
            if (0!=$total_sks)
                $nilai_ips4=$total_mutu/$total_sks;
            else
                $nilai_ips4=0;
            ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPS :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">&nbsp;<? echo l($total_mutu) ?>:<? echo l($total_sks) ?> = <?php echo l($nilai_ips4)?></td>
        </tr>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPK :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">
                    <?php
                    $angka4=4;
                    $nilai_ipk4=$nilai_ips4+$nilai_ipk1;
                    $ipk4_dapet1=$nilai_ipk4+$nilai_ipk2_total;
                    $ipk4_dapet2=$ipk4_dapet1+$nilai_ipk3_total;
                    $nilai_ipk4_total=$ipk4_dapet2/$angka4;
                    echo '&nbsp;Saat ini nilai ipk kamu adalah <strong>'.($nilai_ipk4_total).'</strong>';
                    ?>
            </td>
        </tr>
    </tbody>
</table>
<?php else: ?>
    <?php echo 'Untuk semester ini '.l($user['name']).' belum ada nilainya atau belum mengikuti kuliah disemester ini.'; ?>
<?php endif ?>
<br><br><br>

<h3>Semester 5 (Lima)</h3>
<?php if (!empty($user['nilai_semester5_items'])): ?>
<table border="1" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="background: #999; text-align: center" width="50px"><strong>Kode Matkul</strong></td>
            <td style="background: #999" width="250px"><strong>Nama Matkul</strong></td>
            <td style="background: #999; text-align: center" width="230px"><strong>Nama Dosen</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>SKS</strong></td>
            <td style="background: #999; text-align: center" width="70px"><strong>Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Bobot Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Mutu</strong></td>
        </tr>
            <?php $total_sks = 0 ?>
            <?php $total_mutu = 0 ?>
            <?php foreach ($user['nilai_semester5_items'] as $nilai) { ?>
        <tr>
            <td style="text-align:center" width="50px;"><?php echo l($nilai['code_matkul']); ?></td>
            <td width="250px"><?php echo l($nilai['matkul_name']); ?></td>
            <td style="text-align: center" width="230px"><?php echo l($nilai['dosen_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['sks_name']); ?><?php $total_sks += $nilai['sks_id']?></td>
            <td style="text-align: center" width="70px"><?php echo l($nilai['nilai_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['bobot']); ?></td>
            <td style="text-align: center" width="50px">
                        <?php
                        $nilai_mutu=$nilai['sks_id']*$nilai['bobot'];
                        $total_mutu += $nilai_mutu;
                        echo l($nilai_mutu);
                        ?>
            </td>
        </tr>
                <?php } ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50">Jumlah :</td>
            <td style="background: #ccc;" colspan="2" rowspan="1"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_sks) ?></td>
            <td style="background: #ccc; text-align:center" width="70"></td>
            <td style="background: #ccc; text-align:center" width="50"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_mutu) ?></td>
        </tr>
            <?php
            if (0!=$total_sks)
                $nilai_ips5=$total_mutu/$total_sks;
            else
                $nilai_ips5=0;
            ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPS :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">&nbsp;<? echo l($total_mutu) ?>:<? echo l($total_sks) ?> = <?php echo l($nilai_ips5)?></td>
        </tr>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPK :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">
                    <?php
                    $angka5=5;
                    $nilai_ipk5=$nilai_ips5+$nilai_ipk1;
                    $ipk5_dapet1=$nilai_ipk5+$nilai_ipk2_total;
                    $ipk5_dapet2=$ipk4_dapet1+$nilai_ipk3_total;
                    $ipk5_dapet3=$ipk4_dapet2+$nilai_ipk4_total;
                    $nilai_ipk5_total=$ipk5_dapet3/$angka5;
                    echo '&nbsp;Saat ini nilai ipk kamu adalah <strong>'.($nilai_ipk5_total).'</strong>';
                    ?>
            </td>
        </tr>
    </tbody>
</table>
<?php else: ?>
    <?php echo 'Untuk semester ini '.l($user['name']).' belum ada nilainya atau belum mengikuti kuliah disemester ini.'; ?>
<?php endif ?>
<br><br><br>

<h3>Semester 6 (Enam)</h3>
<?php if (!empty($user['nilai_semester6_items'])): ?>
<table border="1" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="background: #999; text-align: center" width="50px"><strong>Kode Matkul</strong></td>
            <td style="background: #999" width="250px"><strong>Nama Matkul</strong></td>
            <td style="background: #999; text-align: center" width="230px"><strong>Nama Dosen</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>SKS</strong></td>
            <td style="background: #999; text-align: center" width="70px"><strong>Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Bobot Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Mutu</strong></td>
        </tr>
            <?php $total_sks = 0 ?>
            <?php $total_mutu = 0 ?>
            <?php foreach ($user['nilai_semester6_items'] as $nilai) { ?>
        <tr>
            <td style="text-align:center" width="50px;"><?php echo l($nilai['code_matkul']); ?></td>
            <td width="250px"><?php echo l($nilai['matkul_name']); ?></td>
            <td style="text-align: center" width="230px"><?php echo l($nilai['dosen_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['sks_name']); ?><?php $total_sks += $nilai['sks_id']?></td>
            <td style="text-align: center" width="70px"><?php echo l($nilai['nilai_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['bobot']); ?></td>
            <td style="text-align: center" width="50px">
                        <?php
                        $nilai_mutu=$nilai['sks_id']*$nilai['bobot'];
                        $total_mutu += $nilai_mutu;
                        echo l($nilai_mutu);
                        ?>
            </td>
        </tr>
                <?php } ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50">Jumlah :</td>
            <td style="background: #ccc;" colspan="2" rowspan="1"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_sks) ?></td>
            <td style="background: #ccc; text-align:center" width="70"></td>
            <td style="background: #ccc; text-align:center" width="50"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_mutu) ?></td>
        </tr>
            <?php
            if (0!=$total_sks)
                $nilai_ips6=$total_mutu/$total_sks;
            else
                $nilai_ips6=0;
            ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPS :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">&nbsp;<? echo l($total_mutu) ?>:<? echo l($total_sks) ?> = <?php echo l($nilai_ips6)?></td>
        </tr>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPK :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">
                    <?php
                    $angka6=6;
                    $nilai_ipk6=$nilai_ips6+$nilai_ipk1;
                    $ipk6_dapet1=$nilai_ipk6+$nilai_ipk2_total;
                    $ipk6_dapet2=$ipk6_dapet1+$nilai_ipk3_total;
                    $ipk6_dapet3=$ipk6_dapet2+$nilai_ipk4_total;
                    $ipk6_dapet4=$ipk6_dapet3+$nilai_ipk5_total;
                    $nilai_ipk6_total=$ipk6_dapet4/$angka6;
                    echo '&nbsp;Saat ini nilai ipk kamu adalah <strong>'.($nilai_ipk6_total).'</strong>';
                    ?>
            </td>
        </tr>
    </tbody>
</table>
<?php else: ?>
    <?php echo 'Untuk semester ini '.l($user['name']).' belum ada nilainya atau belum mengikuti kuliah disemester ini.'; ?>
<?php endif ?>
<br><br><br>

<h3>Semester 7 (Tujuh)</h3>
<?php if (!empty($user['nilai_semester7_items'])): ?>
<table border="1" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="background: #999; text-align: center" width="50px"><strong>Kode Matkul</strong></td>
            <td style="background: #999" width="250px"><strong>Nama Matkul</strong></td>
            <td style="background: #999; text-align: center" width="230px"><strong>Nama Dosen</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>SKS</strong></td>
            <td style="background: #999; text-align: center" width="70px"><strong>Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Bobot Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Mutu</strong></td>
        </tr>
            <?php $total_sks = 0 ?>
            <?php $total_mutu = 0 ?>
            <?php foreach ($user['nilai_semester7_items'] as $nilai) { ?>
        <tr>
            <td style="text-align:center" width="50px;"><?php echo l($nilai['code_matkul']); ?></td>
            <td width="250px"><?php echo l($nilai['matkul_name']); ?></td>
            <td style="text-align: center" width="230px"><?php echo l($nilai['dosen_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['sks_name']); ?><?php $total_sks += $nilai['sks_id']?></td>
            <td style="text-align: center" width="70px"><?php echo l($nilai['nilai_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['bobot']); ?></td>
            <td style="text-align: center" width="50px">
                        <?php
                        $nilai_mutu=$nilai['sks_id']*$nilai['bobot'];
                        $total_mutu += $nilai_mutu;
                        echo l($nilai_mutu);
                        ?>
            </td>
        </tr>
                <?php } ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50">Jumlah :</td>
            <td style="background: #ccc;" colspan="2" rowspan="1"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_sks) ?></td>
            <td style="background: #ccc; text-align:center" width="70"></td>
            <td style="background: #ccc; text-align:center" width="50"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_mutu) ?></td>
        </tr>
            <?php
            if (0!=$total_sks)
                $nilai_ips7=$total_mutu/$total_sks;
            else
                $nilai_ips7=0;
            ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPS :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">&nbsp;<? echo l($total_mutu) ?>:<? echo l($total_sks) ?> = <?php echo l($nilai_ips7)?></td>
        </tr>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPK :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">
                    <?php
                    $angka7=7;
                    $nilai_ipk7=$nilai_ips7+$nilai_ipk1;
                    $ipk7_dapet1=$nilai_ipk7+$nilai_ipk2_total;
                    $ipk7_dapet2=$ipk7_dapet1+$nilai_ipk3_total;
                    $ipk7_dapet3=$ipk7_dapet2+$nilai_ipk4_total;
                    $ipk7_dapet4=$ipk7_dapet3+$nilai_ipk5_total;
                    $ipk7_dapet5=$ipk7_dapet4+$nilai_ipk6_total;
                    $nilai_ipk7_total=$ipk7_dapet5/$angka7;
                    echo '&nbsp;Saat ini nilai ipk kamu adalah <strong>'.($nilai_ipk7_total).'</strong>';
                    ?>
            </td>
        </tr>
    </tbody>
</table>
<?php else: ?>
    <?php echo 'Untuk semester ini '.l($user['name']).' belum ada nilainya atau belum mengikuti kuliah disemester ini.'; ?>
<?php endif ?>
<br><br><br>

<h3>Semester 8 (Delapan)</h3>
<?php if (!empty($user['nilai_semester8_items'])): ?>
<table border="1" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="background: #999; text-align: center" width="50px"><strong>Kode Matkul</strong></td>
            <td style="background: #999" width="250px"><strong>Nama Matkul</strong></td>
            <td style="background: #999; text-align: center" width="230px"><strong>Nama Dosen</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>SKS</strong></td>
            <td style="background: #999; text-align: center" width="70px"><strong>Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Bobot Nilai</strong></td>
            <td style="background: #999; text-align: center" width="50px"><strong>Mutu</strong></td>
        </tr>
            <?php $total_sks = 0 ?>
            <?php $total_mutu = 0 ?>
            <?php foreach ($user['nilai_semester8_items'] as $nilai) { ?>
        <tr>
            <td style="text-align:center" width="50px;"><?php echo l($nilai['code_matkul']); ?></td>
            <td width="250px"><?php echo l($nilai['matkul_name']); ?></td>
            <td style="text-align: center" width="230px"><?php echo l($nilai['dosen_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['sks_name']); ?><?php $total_sks += $nilai['sks_id']?></td>
            <td style="text-align: center" width="70px"><?php echo l($nilai['nilai_name']); ?></td>
            <td style="text-align: center" width="50px"><?php echo l($nilai['bobot']); ?></td>
            <td style="text-align: center" width="50px">
                        <?php
                        $nilai_mutu=$nilai['sks_id']*$nilai['bobot'];
                        $total_mutu += $nilai_mutu;
                        echo l($nilai_mutu);
                        ?>
            </td>
        </tr>
                <?php } ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50">Jumlah :</td>
            <td style="background: #ccc;" colspan="2" rowspan="1"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_sks) ?></td>
            <td style="background: #ccc; text-align:center" width="70"></td>
            <td style="background: #ccc; text-align:center" width="50"></td>
            <td style="background: #ccc; text-align:center" width="50"><? echo l($total_mutu) ?></td>
        </tr>
            <?php
            if (0!=$total_sks)
                $nilai_ips8=$total_mutu/$total_sks;
            else
                $nilai_ips8=0;
            ?>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPS :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">&nbsp;<? echo l($total_mutu) ?>:<? echo l($total_sks) ?> = <?php echo l($nilai_ips8)?></td>
        </tr>
        <tr>
            <td style="background: #ccc; text-align:center" width="50"><strong>Nilai IPK :</strong></td>
            <td style="background: #ccc;" colspan="6" rowspan="1" width="700px">
                    <?php
                    $angka8=8;
                    $nilai_ipk8=$nilai_ips8+$nilai_ipk1;
                    $ipk8_dapet1=$nilai_ipk8+$nilai_ipk2_total;
                    $ipk8_dapet2=$ipk8_dapet1+$nilai_ipk3_total;
                    $ipk8_dapet3=$ipk8_dapet2+$nilai_ipk4_total;
                    $ipk8_dapet4=$ipk8_dapet3+$nilai_ipk5_total;
                    $ipk8_dapet5=$ipk8_dapet4+$nilai_ipk6_total;
                    $ipk8_dapet6=$ipk8_dapet5+$nilai_ipk7_total;
                    $nilai_ipk8_total=$ipk8_dapet6/$angka8;
                    echo '&nbsp;Saat ini nilai ipk kamu adalah <strong>'.($nilai_ipk8_total).'</strong>';
                    ?>
            </td>
        </tr>
    </tbody>
</table>
<?php else: ?>
    <?php echo 'Untuk semester ini '.l($user['name']).' belum ada nilainya atau belum mengikuti kuliah disemester ini.'; ?>
<?php endif ?>
<br><br><br>
</div>