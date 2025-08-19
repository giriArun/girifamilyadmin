<?php 
    // Set default values first
    $familyId = 0;
    $name = "";
    $gender = "";
    $sequence = 1;
    $parentId = 0;
    $spouseId = 0;
    $nickName = "";
    $dob = "";
    $dod = "";
    $isRoot = "";

    // If family data exists, override defaults with family data
    if( count( $familyData ) && $familyData[ "status" ] && is_array( $familyData[ "data" ] ) && count( $familyData[ "data" ] ) == 1 ){
        $data = $familyData[ "data" ][ 0 ];
        
        $familyId = $data[ "familyId" ];
        $name = $data[ "name" ];
        $gender = $data[ "gender" ];
        $sequence = $data[ "sequence" ];
        $parentId = $data[ "parentId" ];
        $spouseId = $data[ "spouseId" ];
        $nickName = $data[ "nickName" ];
        $dob = $data[ "dob" ];
        $dod = $data[ "dod" ];
        $isRoot = $data[ "isRoot" ];
    }

    // If POST data exists, it takes highest priority
    if (!empty($_POST)) {
        $familyId = $_POST['familyId'] ?? $familyId;
        $name = $_POST['name'] ?? $name;
        $gender = $_POST['gender'] ?? $gender;
        $sequence = $_POST['sequence'] ?? $sequence;
        $parentId = $_POST['parentId'] ?? $parentId;
        $spouseId = $_POST['spouseId'] ?? $spouseId;
        $nickName = $_POST['nickName'] ?? $nickName;
        $dob = $_POST['dob'] ?? $dob;
        $dod = $_POST['dod'] ?? $dod;
        $isRoot = isset($_POST['isRoot']) ? '1' : '0';
    }
?>

<section class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row background-color-bone">
            <div class="col-1"></div>
            <div class="col-10 my-5">
                <div class="fs-2 text-center mb-5 mt-3 text-primary"><?=$pageTitle;?></div>
                <div class="row">
                    <div class="col-0 col-sm-1 col-md-1 col-lg-1"></div>
                    <div class="col-12 col-sm-10 col-md-10 col-lg-10 bg-white shadow py-5 px-5">
                        <?php if (isset($responceData['status']) && $responceData['status'] === 'error'): ?>
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <?php if (is_array($responceData['messages'])): ?>
                                    <?php foreach ($responceData['messages'] as $error): ?>
                                        <div><?= htmlspecialchars($error) ?></div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <?= htmlspecialchars($responceData['messages']) ?>
                                <?php endif; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <form class="row g-3 needs-validation" name="form_<?=$action;?>" id="form_<?=$action;?>" method="post" novalidate>
                                <input type="hidden" name="familyId" value="<?=$familyId;?>">
                                <input type="hidden" name="isSubmit" value="1">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-7 col-xxl-7 validationName">
                                    <label for="validationName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="validationName" name="name" maxlength="200" data-type="string" data-name="Name" value="<?=$name;?>" required>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please provide the Name.</div>
                                    <div class="invalid-js-message"></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xxl-3 validationGender">
                                    <label for="validationGender" class="form-label">Gender</label>
                                    <select class="form-select" aria-label="Default select example" id="validationGender" name="gender" maxlength="10" data-type="string" data-name="Gender" required>
                                        <option value="">Choose...</option>
                                        <option value="F" <?=$gender == 'F'?'selected':''?>>Female</option>
                                        <option value="M" <?=$gender == 'M'?'selected':''?>>Male</option>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please provide the Gender.</div>
                                    <div class="invalid-js-message"></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-lg-2 col-xxl-2 validationSequence">
                                    <label for="validationSequence" class="form-label">Sequence</label>
                                    <select class="form-control" aria-label="Default select example" data-live-search="true" id="validationSequence" name="sequence" data-type="phone" data-name="Sequence" required>
                                        <?php
                                            for ($x = 1; $x <= 15; $x++) {
                                                ?>
                                                <option value="<?=$x;?>" <?=$sequence == $x?'selected':''?>>
                                                    <?=$x;?>
                                                </option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please provide the Sequence.</div>
                                    <div class="invalid-js-message"></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xxl-4 validationNickName">
                                    <label for="validationNickName" class="form-label">NickName</label>
                                    <input type="text" class="form-control" id="validationNickName" name="nickName" data-type="string" maxlength="50" data-name="NickName" value="<?=$nickName;?>">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please provide the NickName.</div>
                                    <div class="invalid-js-message"></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xxl-4 validationDateOfBirth">
                                    <label for="validationDateOfBirth" class="form-label">Date Of Birth</label>
                                    <input type="date" class="form-control" id="validationDateOfBirth" name="dob" data-type="date" data-name="Date Of Birth" value="<?=$dob;?>">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please provide the Date Of Birth.</div>
                                    <div class="invalid-js-message"></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xxl-4 validationDateOfDeath">
                                    <label for="validationDateOfDeath" class="form-label">Date Of Death</label>
                                    <input type="date" class="form-control" id="validationDateOfDeath" name="dod" data-type="date" data-name="Date Of Death" value="<?=$dod;?>">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please provide the Date Of Death.</div>
                                    <div class="invalid-js-message"></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xxl-6 validationParent">
                                    <label for="validationParent" class="form-label">Parent</label>
                                    <select class="form-control selectpicker" aria-label="Default select example" data-live-search="true" id="validationParent" name="parentId" data-type="phone" data-name="Parent">
                                        <option value="0">Choose...</option>
                                        <?php
                                            if( $parentsData[ "status" ] ){
                                                foreach ( $parentsData[ "data" ] as $parent ){
                                                    ?>
                                                        <option value="<?=$parent[ "parentId" ];?>" <?=$parentId == $parent[ "parentId" ] ? 'selected' : '';?>>
                                                            <?=$parent[ "name" ];?> (<?=$parent[ "gender" ];?>) <?=$parent[ "nickName" ];?>
                                                        </option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please provide the Parent.</div>
                                    <div class="invalid-js-message"></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xxl-6 validationSpouse">
                                    <label for="validationSpouse" class="form-label">Spouse</label>
                                    <select class="form-control selectpicker" aria-label="Default select example" data-live-search="true" id="validationSpouse" name="spouseId" data-type="phone" data-name="Spouse">
                                        <option value="0">Choose...</option>
                                        <?php
                                            if( $spousesData[ "status" ] ){
                                                foreach ( $spousesData[ "data" ] as $spouse ){
                                                    ?>
                                                        <option value="<?=$spouse[ "spouseId" ];?>" <?=$spouseId == $spouse[ "spouseId" ] ? 'selected' : '';?>>
                                                            <?=$spouse[ "name" ];?> (<?=$spouse[ "gender" ];?>) <?=$spouse[ "nickName" ];?>
                                                        </option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please provide the Spouse.</div>
                                    <div class="invalid-js-message"></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xxl-12 validationRoot">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="validationRoot" name="isRoot" <?=$isRoot == 1?'checked':''?>>
                                        <label class="form-check-label" for="validationRoot">Is Root Person</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-0 col-sm-1 col-md-1 col-lg-1"></div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</section>