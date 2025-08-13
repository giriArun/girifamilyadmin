<section class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row background-color-bone">
            <div class="col-1"></div>
            <div class="col-10 my-5">
                <div class="fs-2 text-center mb-5 mt-3 text-primary"><?=$pageTitle;?></div>
                <div class="row">
                    <div class="col-12 messageBox">
                        <div class="row">
                            <div class="col-0 col-sm-1"></div>
                            <div class="col-12 col-sm-10">
                                <?php
                                    if( isset( $_SESSION[ 'successMessage' ] ) ){
                                        ?>
                                            <div class="alert alert-success" role="alert">
                                                <?=$_SESSION[ 'successMessage' ];?>
                                            </div>
                                        <?php
                                        unset( $_SESSION[ 'successMessage' ] );
                                    }
                                ?>
                            </div>
                            <div class="col-0 col-sm-1"></div>
                        </div>
                    </div>
                    <div class="col-0 col-sm-1 col-md-1 col-lg-1"></div>
                    <div class="col-12 col-sm-10 col-md-10 col-lg-10 bg-white shadow py-5 px-5">
                        <div class="row">
                            <div class="col-12">
                                <table class="table cell-border hover order-column stripe w-100 data_table" id="data_table">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Nick Name</th>
                                            <th scope="col" class="text-end">
                                                <a href="?action=addEdit" class="btn btn-primary" title="Add">
                                                    Add
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if( $familyData[ "status" ] ){
                                                foreach ( $familyData[ "data" ] as $family ){
                                                    ?>
                                                        <tr>
                                                            <td><?=$family[ "name" ];?></td>
                                                            <td><?=$family[ "gender" ];?></td>
                                                            <td><?=$family[ "nickName" ];?></td>
                                                            <td class="text-end">
                                                                <a href="?action=addEdit&id=<?=$family[ "familyId" ];?>" class="btn btn-warning" title="Edit">
                                                                    Edit
                                                                </a>
                                                                <button type="button" 
                                                                    class="btn btn-danger" 
                                                                    title="Delete" 
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#deleteConfirmation" 
                                                                    data-bs-id="<?=$family[ "familyId" ];?>" 
                                                                    data-bs-name="<?=$family[ "name" ];?>" 
                                                                    data-bs-type="familyDelete">
                                                                    Delete
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-0 col-sm-1 col-md-1 col-lg-1"></div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</section>