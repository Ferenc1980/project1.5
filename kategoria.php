<?php
include 'config.php';
$sql='select distinct(azonosito),nev,beosztas,kod,leiras from kategoriak,szemelyek,jelenlet where kategoriak.kod=jelenlet.kateg_kod && szemelyek.azonosito=jelenlet.sz_azon order by azonosito asc';
$stmt=$db->query($sql);
$str='';

?>
<html>
<head>
    <title>PHP MySQL Inline Editing using jQuery Ajax</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <table class="tbl-qa table-striped">
        <thead>
            <tr>
                <th class="table-header" width="10%">Azonosito</th>
                <th class="table-header">Név</th>
                <th class="table-header">Beosztás</th>
                <th class="table-header">Kód</th>
                <th class="table-header">Leírás</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row=$stmt->fetch()){
                extract($row);?>
                <tr class='table-row'>
                            
                            <td contenteditable='true'
                                onBlur='save(this,"azonosito",<?=$azonosito?>)'
                                onClick='showEdit(this);'><?=$azonosito?></td>
                            <td contenteditable='true'
                                onBlur='save(this,"nev",<?=$azonosito?>)'
                                onClick='showEdit(this);'><?=$nev?></td>
                             <td contenteditable='true'
                                onBlur='save(this,"beosztas",<?=$azonosito?>)'
                                onClick='showEdit(this);'><?=$beosztas?></td>  
                            <td contenteditable='true'
                                onBlur='save(this,"kod",<?=$azonosito?>)'
                                onClick='showEdit(this);'><?=$kod?></td> 
                            <td contenteditable='true'
                                onBlur='save(this,"leírás",<?=$azonosito?>)'
                                onClick='showEdit(this);'><?=$leiras?></td>     
                        </tr>
            <?php } ?> 
        </tbody>
    </table>

    <script src="jquery-3.2.1.min.js"></script>
    <script src="inlineEdit.js"></script>
</body>
</html>

