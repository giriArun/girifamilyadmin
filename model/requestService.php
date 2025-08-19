<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/familyService.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/validateService.php';

    class requestService{
        public $requestData;
        public $isSubmit;
        public $familyId;
        public $name;
        public $gender;
        public $sequence;
        public $nickName;
        public $dob;
        public $dod;
        public $parentId;
        public $spouseId;
        public $isRoot;

        function __construct($data = []){
            $this->requestData = $data; 
            $this->isSubmit = $data['isSubmit'] ?? '';
            $this->familyId = $data['familyId'] ?? 0;
            $this->name = $data['name'] ?? '';
            $this->gender = $data['gender'] ?? '';
            $this->sequence = $data['sequence'] ?? '';
            $this->nickName = $data['nickName'] ?? '';
            $this->dob = $data['dob'] ?? '';
            $this->dod = $data['dod'] ?? '';
            $this->parentId = $data['parentId'] ?? 0;
            $this->spouseId = $data['spouseId'] ?? 0;
            $this->isRoot = isset($data['isRoot']) ? 1 : 0;
        }

        function addEditUpdateFamilyMember(){
            if( $this->isSubmit ){
                $validateService = new validateService();
                $errors = [];

                // Validate name (required)
                if (!$validateService->validateName($this->name)) {
                    $errors[] = "Name is required and must contain only letters ss";
                }

                // Validate gender (M/F)
                if (!in_array($this->gender, ['M', 'F'])) {
                    $errors[] = "Gender must be either M or F";
                }

                // Validate sequence (must be a number)
                if (!empty($this->sequence) && !$validateService->validateNumber($this->sequence)) {
                    $errors[] = "Sequence must be a valid number";
                }

                // Validate dates if provided
                if (!empty($this->dob) && !strtotime($this->dob)) {
                    $errors[] = "Date of Birth must be a valid date";
                }
                if (!empty($this->dod) && !strtotime($this->dod)) {
                    $errors[] = "Date of Death must be a valid date";
                }

                // If there are validation errors, return them
                if (!empty($errors)) {
                    return ["status" => "error", "messages" => $errors];
                }

                $familyService = new familyService( );
                $familyId = $this->familyId;

                if( $familyId > 0 ){
                    // Update existing family member
                    return $familyService->updateFamily(
                        $familyId,
                        $this->name,
                        $this->gender,
                        $this->sequence,
                        $this->nickName,
                        $this->dob,
                        $this->dod,
                        $this->parentId,
                        $this->spouseId,
                        $this->isRoot
                    );
                }else{
                    // Add new family member
                    return $familyService->insertFamily(
                        $this->name,
                        $this->gender,
                        $this->sequence,
                        $this->nickName,
                        $this->dob,
                        $this->dod,
                        $this->parentId,
                        $this->spouseId,
                        $this->isRoot
                    );
                }
            } else {
                return ["status" => "success", "messages" => "No changes made"];
            }
        }
    }

?>