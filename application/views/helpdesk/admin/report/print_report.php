<table width="700" style="font-size:10px">
    <tr>
        <td width="195" height="110"><img src="dataon.png" width="110" height="110" /> </td>
        <td width="133"></td>
        <td width="362" align="right"><b>PT. INDODEV
                NIAGA INTERNET (DATAON)</b><br />
            Jalan Tegal Rotan No. 78<br />
            ,Bintaro 15413<br /><b>
                T:</b>+62216505829
            <b>F:</b>+62216505827
        </td>
    </tr>
</table>
<table width="100%">
    <tr>
        <th colspan="7">
            <font size="+2">DETAIL ISSUE
                REPORT</font><br />
        </th>
    </tr>
    <tr>
        <th height="21" colspan="7">&nbsp;</th>
    </tr>
    <tr>
        <th colspan="7">&nbsp;</th>
    </tr>
    <tr>
        <td width="159">Customer</td>
        <td width="8">:</td>
        <td width="142"><?php echo $data[1]; ?></td>
        <td width="76">&nbsp;</td>
        <td width="97">Application</td>
        <td width="3">:</td>
        <td width="183"><?php echo $data[2]; ?></td>
    </tr>
    <tr>
        <td>Customer Issue Number</td>
        <td>:</td>
        <td><?php echo $data[0]; ?></td>
        <td>&nbsp;</td>
        <td>Status</td>
        <td>:</td>
        <?php
        $qw = "select pr_deskription from PARAMDETAILwhere detail_number = '$data[10]' and
pr_number=1";
        $pw = odbc_exec($koneksi, $qw);
        odbc_fetch_into($pw, $stat);
        ?>
        <td><?php echo $stat[0]; ?></td>
    </tr>
    <tr>
        <td>Related Issue</td>
        <td>:</td>
        <td><?php echo $r_isu; ?></td>
        <td>&nbsp;</td>
        <td>Reported By</td>
        <td>:</td>
        <td><?php echo $co[2]; ?></td>
    </tr>
    <tr>
        <td>Open Date</td>
        <td>:</td>
        <td><?php echo $data[13]; ?></td>
        <td>&nbsp;</td>
        <td>Printed By</td>
        <td>:</td>
        <td><?php echo $co[2]; ?></td>
    </tr>
    <tr>
        <td height="40" colspan="7" valign="bottom"><b>Issue
                :</b></td>
    </tr>
    <tr>
        <td height="45" valign="top" colspan="7" border="1"><?php echo $data[3]; ?><br />
            &nbsp;</td>
    </tr>
    <tr>
        <td height="30" colspan="7" valign="bottom"><b>Description :</b></td>
    </tr>
    <tr>
        <td valign="top" colspan="7" border="1" height="45"><?php echo $data[7]; ?><br />&nbsp;</td>
    </tr>
    <tr>
        <td height="30" colspan="7" valign="bottom"><b>Steps to
                Duplicate :</b></td>
    </tr>
    <tr>
        <td valign="top" colspan="7" border="1" height="45"><?php echo $data[8]; ?><br />&nbsp;</td>
    </tr>
    <tr>
        <td height="29" colspan="7" valign="bottom"><b>Succes
                Criteria : </b></td>
    </tr>
    <tr>
        <td valign="top" colspan="7" border="1" height="45"><?php echo $data[9]; ?><br />&nbsp;</td>
    </tr>
    <tr>
        <td height="29" colspan="7" valign="bottom"><b>Comments : </b></td>
    </tr>
    <tr>
        <td align="center" valign="top" colspan="7"></td>
    </tr>
    <?php
    $q = "select c.userlname, b.coment,
    CONVERT(VARCHAR(11), b.tgl, 106), b.tgl
    from dbo.ESDISDD b,
    dbo.ESDTUSERMAST c
    where c.userusinc=b.id_user and
    b.no_issu = '$issue_id' order by b.sequence asc";
    $r = odbc_exec($koneksi, $q);
    while (odbc_fetch_into($r, $h)) {
        $a = $h['3'];
        $arra = explode(' ', $a);
        $jam = $arra[1];
        $arr = explode('.', $jam);
        $j = $arr[0];
        //$bb={$bulan|date_format:"%A, %B %e, %Y" }
    ?>
        <tr>
            <td colspan="3"><?php echo
                            $h['0']; ?>
            <td colspan="4" align="right"><?php echo $h['2']; ?>&nbsp;<?php echo $j ?></td>
        </tr>
        <tr>
            <td colspan="7" border="1"><?php
                                        echo $h['1']; ?></td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3">Presented By : </td>
        <td>&nbsp;</td>
        <td colspan="3" align="">Approved, Tested and Closed By
            : </td>
    </tr>
    <?php
    $q1 = "select userlname from ESDISDD ,
    ESDTUSERMAST where userusinc = id_user and userprofl = 3 and
    no_issu = '$issue_id'";
    $p1 = odbc_exec($koneksi, $q1);
    odbc_fetch_into($p1, $re);
    ?>
    <tr>
        <td colspan="3">Support: <?php echo $re[0]; ?> </td>
        <td>&nbsp;</td>
        <td colspan="3">Customer : <?php echo $co[2]; ?></td>
    </tr>
    <tr>
        <td height="85" colspan="3"></td>
        <td></td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <?php
        $q = "select CONVERT(VARCHAR(11), ishddtmod, 106)
        from ESDTISSUEHED where ishdisinc='$issue_id'";
        $rq = odbc_exec($koneksi, $q);
        odbc_fetch_into($rq, $mm);
        $ar = $mm['0'];
        $arrar = explode(' ', $a);
        $mr = $arrar[0];
        ?>
        <td colspan="3">Date : <?php echo $mm[0] ?></td>
        <td></td>
        <td colspan="3">Date : <?php echo $mm[0] ?></td>
    </tr>
</table>