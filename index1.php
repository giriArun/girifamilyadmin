<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dbconnect.php' );?>

<?php
    function getFamilyTree($ids, $conn, $flag = false){
        $tree = [];

        if($flag){
            $sql = "SELECT * FROM family WHERE id IN ($ids) ORDER BY sequence ASC";
        }else{
            $sql = "SELECT * FROM family WHERE parent_id IN ($ids) ORDER BY sequence ASC";
        }

        $mainSQL = mysqli_query($conn, $sql);

        if (mysqli_num_rows($mainSQL) > 0) {
            while($row = mysqli_fetch_assoc($mainSQL)) {
                $tempStruct["id"] = $row["id"];
                $tempStruct["name"] = $row["name"];
                $tempStruct["gender"] = $row["gender"];
                $tempStruct["spouse"] = spouseDetails($row["id"], $conn);
                $sendIds = $row["id"];

                foreach ($tempStruct["spouse"] as $spouse) {
                    $sendIds = $sendIds . ',' . $spouse["id"];
                }

                $tempStruct["kids"] = getFamilyTree($sendIds, $conn);

                array_push( $tree,$tempStruct);
            }
        }
        return $tree;
    }

    function spouseDetails($id, $conn){
        $tree = [];

        $sql = "SELECT * FROM family WHERE spouse_id = $id ORDER BY sequence ASC";
        $mainSQL = mysqli_query($conn, $sql);

        if (mysqli_num_rows($mainSQL) > 0) {
            while($row = mysqli_fetch_assoc($mainSQL)) {
                $tempStruct["id"] = $row["id"];
                $tempStruct["name"] = $row["name"];
                $tempStruct["gender"] = $row["gender"];

                array_push( $tree,$tempStruct);
            }
        }
        return $tree;
    }

    $parentIds = 0;
    $firstSQL = "SELECT id FROM family WHERE isRoot = 1 AND parent_id = 0  ORDER BY sequence ASC";
    $firstSqlQuery = mysqli_query($conn, $firstSQL);
    
    if (mysqli_num_rows($firstSqlQuery) > 0) {
        while($row = mysqli_fetch_assoc($firstSqlQuery)) {
            $parentIds = $parentIds . ',' . $row["id"];
        }
    }
    
    $familyTree = getFamilyTree($parentIds, $conn, true);
?>

<html>
    <head>
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <META HTTP-EQUIV="Expires" CONTENT="-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Family Tree</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: sans-serif, Arial;
                font-size: 8pt;
                font-weight: 600;
            }

            .tree {
                white-space: nowrap;
                min-width: 800px;
                min-height: 500px;
                width: 7000px;
                height: 600px;
                border: 15px solid lightgray;
            }

            .tree ul {
                padding-top: 20px;
                position: relative;
                transition: all 0.5s;
                -webkit-transition: all 0.5s;
                -moz-transition: all 0.5s;
            }

            .tree li {
                float: left;
                text-align: center;
                list-style-type: none;
                position: relative;
                padding: 20px 5px 0 5px;
                transition: all 0.5s;
                -webkit-transition: all 0.5s;
                -moz-transition: all 0.5s;
            }

            /*We will use ::before and ::after to draw the connectors*/
            .tree li::before,
            .tree li::after {
                content: '';
                position: absolute;
                top: 0;
                right: 50%;
                border-top: 1px solid #ccc;
                width: 50%;
                height: 20px;
            }

            .tree li::after {
                right: auto;
                left: 50%;
                border-left: 1px solid #ccc;
            }

            /*We need to remove left-right connectors from elements without any siblings*/
            .tree li:only-child::after,
            .tree li:only-child::before {
                display: none;
            }

            /*Remove space from the top of single children*/
            .tree li:only-child {
                padding-top: 0;
            }

            /*Remove left connector from first child and right connector from last child*/
            .tree li:first-child::before,
            .tree li:last-child::after {
                border: 0 none;
            }

            /*Adding back the vertical connector to the last nodes*/
            .tree li:last-child::before {
                border-right: 1px solid #ccc;
                border-radius: 0 5px 0 0;
                -webkit-border-radius: 0 5px 0 0;
                -moz-border-radius: 0 5px 0 0;
            }

            .tree li:first-child::after {
                border-radius: 5px 0 0 0;
                -webkit-border-radius: 5px 0 0 0;
                -moz-border-radius: 5px 0 0 0;
            }

            /*Time to add downward connectors from parents*/
            .tree ul ul::before {
                content: '';
                position: absolute;
                top: 0;
                left: 50%;
                border-left: 1px solid #ccc;
                width: 0;
                height: 20px;
            }

            .tree li div {
                border: 1px solid #ccc;
                padding: 5px 5px;
                text-decoration: none;
                color: #666;
                font-family: arial, verdana, tahoma;
                font-size: 11px;
                display: inline-block;
                min-width: 60px;
                min-height: 25px;
                border-radius: 5px;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                transition: all 0.5s;
                -webkit-transition: all 0.5s;
                -moz-transition: all 0.5s;
            }

            .tree li div .male {
                background-color: lightblue;
                display: inline-block;
                width: auto;
                padding: 8px;
                border-radius: 5px;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
            }

            .tree li div .female {
                background-color: lightpink;
                display: inline-block;
                width: auto;
                padding: 8px;
                border-radius: 5px;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
            }

            .tree li div .spacer {
                background-color: lightblue;
                display: inline-block;
                width: 10px;
            }

            /*Time for some hover effects*/
            /*We will apply the hover effect the the lineage of the element also*/
            .tree li div:hover,
            .tree li div:hover+ul li div {
                background: #c8e4f8;
                color: #000;
                border: 1px solid #94a0b4;
            }

            /*Connector styles on hover*/
            .tree li div:hover+ul li::after,
            .tree li div:hover+ul li::before,
            .tree li div:hover+ul::before,
            .tree li div:hover+ul ul::before {
                border-color: #94a0b4;
            }

            .tree h1{
                font-size: x-large;
                color: blue;
                background-color: lightgray;
                padding: 10px;
                text-align: center;
            }

            .detailsBox .male, .detailsBox .female{
                padding: 10px;
                border-radius: 5px;
                margin: 5px;
            }

            .detailsBox .male{
                background-color: lightblue;
            }

            .detailsBox .female{
                background-color: lightpink;
            }

            .detailsBox{
                width: 80px;
                position: fixed;
                border: 3px solid #2a42dd52;
                border-radius: 12px;
                margin: 5px;
                z-index: 10;
            }
        </style>
    </head>

    <body>
        <div class="tree">
            <h1>Family Tree</h1>
            <div class="detailsBox">
                <div class="male">Male</div>
                <div class="female">Female</div>
            </div>
            <?php
                showFamilyTree($familyTree);

                function showFamilyTree($tree){
                    echo "<ul>";
                    foreach ($tree as $item) {
                        echo "<li>";

                        if($item["gender"] == "F"){
                            $gender = 'female';
                        }else{
                            $gender = 'male';
                        }
                        
                        $name = '<span class="'.$gender.'">' . $item['name'] . '</span>';
                            
                        foreach( $item['spouse'] as $sp){
                            
                            if($sp["gender"] == "F"){
                                $gender = 'female';
                            }else{
                                $gender = 'male';
                            }

                            $name = $name . '<span class="spacer"></span><span class="'.$gender.'">' . $sp['name'] . '</span>';
                        }
                        
                        echo "<div>";
                        echo $name;
                        echo "</div>";

                        showFamilyTree($item['kids']);

                        echo "</li>";
                    }
                    echo "</ul>";
                }
            ?>
        </div>
    </body>
</html>