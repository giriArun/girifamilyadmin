<?php
    class familyService{
        public function getFamily( $familyId = 0 ){
            global $conn;
            
            $sql = "
                SELECT id,
                    name,
                    nickName,
                    gender,
                    DOB,
                    DOD,
                    parent_id,
                    spouse_id,
                    sequence,
                    isRoot
                FROM family
            ";

            if( $familyId > 0 ){
                $sql .= " WHERE id = $familyId ";
            }

            $sql .= " ORDER BY name ASC ";

            $result = mysqli_query( $conn, $sql );

            $returnArray = array( 
                "status" => false, 
                "data" => []
            );

            if( mysqli_num_rows( $result ) > 0 ){
                $returnArray[ "status" ] = true;
                while( $queryResult = mysqli_fetch_assoc( $result ) ) {
                    array_push(
                        $returnArray[ "data" ], 
                        array( 
                            "familyId" => $queryResult[ "id" ],
                            "name" => $queryResult[ "name" ],
                            "nickName" => $queryResult[ "nickName" ],
                            "gender" => $queryResult[ "gender" ],
                            "dob" => $queryResult[ "DOB" ],
                            "dod" => $queryResult[ "DOD" ],
                            "parentId" => $queryResult[ "parent_id" ],
                            "spouseId" => $queryResult[ "spouse_id" ],
                            "sequence" => $queryResult[ "sequence" ],
                            "isRoot" => $queryResult[ "isRoot" ]
                        )
                    );
                }
            }

            return $returnArray;
        }
        
        public function getParents( $familyId = 0 ){
            global $conn;
            
            $sql = "
                SELECT id,
                    name,
                    nickName,
                    gender
                FROM family
                WHERE id <> $familyId 
                ORDER BY name
            ";

            $result = mysqli_query( $conn, $sql );

            $returnArray = array( 
                "status" => false, 
                "data" => []
            );

            if( mysqli_num_rows( $result ) > 0 ){
                $returnArray[ "status" ] = true;
                while( $queryResult = mysqli_fetch_assoc( $result ) ) {
                    array_push(
                        $returnArray[ "data" ], 
                        array( 
                            "parentId" => $queryResult[ "id" ],
                            "name" => $queryResult[ "name" ],
                            "nickName" => $queryResult[ "nickName" ],
                            "gender" => $queryResult[ "gender" ]
                        )
                    );
                }
            }

            return $returnArray;
        }
        
        public function getSpouses( $familyId = 0 ){
            global $conn;
            
            $sql = "
                SELECT id,
                    name,
                    nickName,
                    gender
                FROM family
                WHERE id NOT IN(
                    SELECT spouse_id 
                    FROM family 
                    WHERE id <> $familyId
                ) 
                AND id <> $familyId 
                ORDER BY name
            ";

            $result = mysqli_query( $conn, $sql );

            $returnArray = array( 
                "status" => false, 
                "data" => []
            );

            if( mysqli_num_rows( $result ) > 0 ){
                $returnArray[ "status" ] = true;
                while( $queryResult = mysqli_fetch_assoc( $result ) ) {
                    array_push(
                        $returnArray[ "data" ], 
                        array( 
                            "spouseId" => $queryResult[ "id" ],
                            "name" => $queryResult[ "name" ],
                            "nickName" => $queryResult[ "nickName" ],
                            "gender" => $queryResult[ "gender" ]
                        )
                    );
                }
            }

            return $returnArray;
        }

        public function insertFamily( 
            $name,
            $gender,
            $sequence,
            $nickName,
            $dob,
            $dod,
            $parentId,
            $spouseId,
            $isRoot
        ){
            global $conn;
 
            $nickName = !empty($nickName) ? "'$nickName'" : "NULL";
            $dob = !empty($dob) ? "'$dob'" : "NULL";
            $dod = !empty($dod) ? "'$dod'" : "NULL";

            $sql = "
                INSERT INTO family (
                    name, 
                    nickName, 
                    gender, 
                    DOB, 
                    DOD, 
                    parent_id, 
                    spouse_id, 
                    isRoot, 
                    sequence
                ) VALUES (
                    '$name', 
                    $nickName, 
                    '$gender', 
                    $dob, 
                    $dod, 
                    $parentId, 
                    $spouseId, 
                    $isRoot, 
                    $sequence
                )
            ";
    
            if ( mysqli_query( $conn, $sql ) ) {
                $last_id = mysqli_insert_id( $conn );
                
                $this->updateSpouse( $newId = $last_id, $spouseId = $spouseId );
                $this->updateSequence( $parentId = $parentId, $sequence = $sequence, $lastId = $last_id );
            } else {
                $last_id = 0;
            }
    
            return $last_id;
        }

        public function updateFamily(
            $familyId,
            $name,
            $gender,
            $sequence,
            $nickName,
            $dob,
            $dod,
            $parentId,
            $spouseId,
            $isRoot
        ){
            global $conn;
 
            $nickName = !empty($nickName) ? "'$nickName'" : "NULL";
            $dob = !empty($dob) ? "'$dob'" : "NULL";
            $dod = !empty($dod) ? "'$dod'" : "NULL";

            $sql = "
                UPDATE family SET
                name = '$name',
                nickName = $nickName,
                gender = '$gender',
                DOB = $dob,
                DOD = $dod,
                parent_id = $parentId,
                spouse_id = $spouseId,
                isRoot = $isRoot,
                sequence = $sequence,
                modified_on = now()
                WHERE id = $familyId
            ";

            if (mysqli_query($conn, $sql)) {
                $last_id = $familyId;
                
                $this->updateSpouse( $newId = $last_id, $spouseId = $spouseId );
                $this->updateSequence( $parentId = $parentId, $sequence = $sequence, $lastId = $last_id );
            } else {
                $last_id = 0;
            }

            return $last_id;
        } 

        private function updateSpouse( $newId, $spouseId ){
            global $conn;
            
            if($spouseId > 0){
                $update = "UPDATE family SET spouse_id = $newId WHERE id = $spouseId";
            }else{
                $update = "UPDATE family SET spouse_id = 0 WHERE spouse_id = $newId";
            }

            mysqli_query($conn, $update);
        }

        private function updateSequence( $parentId, $sequence, $lastId ){
            global $conn;

            $sql = "
                SELECT id, sequence 
                FROM family 
                WHERE parent_id IN (
                    SELECT id
                    FROM family 
                    WHERE id = $parentId
                    UNION
                    SELECT id
                    FROM family 
                    WHERE spouse_id = $parentId
                )
                AND sequence >= $sequence
                and id <> $lastId
                ORDER BY sequence ASC
            ";

            $result = mysqli_query( $conn, $sql );
            $tempSequence = $sequence;

            if( mysqli_num_rows( $result ) > 0 ){
                while( $queryResult = mysqli_fetch_assoc( $result ) ) {
                    $tempSequence++;
                    $familyId = $queryResult[ "id" ];

                    $updateSql = "UPDATE family SET sequence = $tempSequence WHERE id = $familyId";
                    mysqli_query($conn, $updateSql);
                }
            }
        }

        public function deleteFamily( $id ){
            global $conn;

            $sql = "
                DELETE 
                FROM family 
                WHERE id = $id
            ";
            
            if (mysqli_query($conn, $sql)) {
                $last_id = $id;
            } else {
                $last_id = 0;
            }
    
            return $last_id;
        }
    }
?>