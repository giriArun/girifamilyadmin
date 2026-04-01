<?php
    include( $_SERVER['DOCUMENT_ROOT'] . '/dbconnect.php' );

    $lastModifiedQuery = "SELECT Q.lastModified
        FROM (
            (SELECT created_on AS lastModified FROM family ORDER BY created_on DESC LIMIT 1)
            UNION ALL
            (SELECT modified_on AS lastModified FROM family ORDER BY modified_on DESC LIMIT 1)
        ) AS Q ORDER BY Q.lastModified DESC LIMIT 1";

    $lastModifiedResult = mysqli_query($conn, $lastModifiedQuery);
    $lastModified = null;

    if ($lastModifiedResult && mysqli_num_rows($lastModifiedResult) > 0) {
        $row = mysqli_fetch_assoc($lastModifiedResult);
        $lastModified = date("d-m-Y H:i", strtotime($row['lastModified']));
    }

    function getFamilyTree($ids, $conn, $flag = false){
        global $lastModified;
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
                $tempStruct["lastModified"] = $lastModified;
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
        global $lastModified;
        $tree = [];

        $sql = "SELECT * FROM family WHERE spouse_id = $id ORDER BY sequence ASC";
        $mainSQL = mysqli_query($conn, $sql);

        if (mysqli_num_rows($mainSQL) > 0) {
            while($row = mysqli_fetch_assoc($mainSQL)) {
                $tempStruct["id"] = $row["id"];
                $tempStruct["name"] = $row["name"];
                $tempStruct["gender"] = $row["gender"];
                $tempStruct["lastModified"] = $lastModified;

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

    // JSON encode
    $json = json_encode($familyTree, JSON_PRETTY_PRINT);

    // Force download
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="familyData.json"');
    echo $json;
    exit;
?>