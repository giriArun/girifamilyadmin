<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Giri Family</title>
        <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <?php 
        include( $_SERVER['DOCUMENT_ROOT'] . '/dbconnect.php' );
        $action = array_key_exists( "action", $_GET ) ? strtolower( $_GET[ "action" ] ) : "home";
        $id = isset( $_GET[ 'id' ] ) ? intval( $_GET[ 'id' ] ) : 0;
        require_once $_SERVER['DOCUMENT_ROOT'] . '/model/requestService.php';

        // Get current domain (with protocol)
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
            || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domain = $_SERVER['HTTP_HOST']; // e.g. example.com

        // Build new URL
        $newUrl = $protocol . $domain . "/newpage.php";
    ?>

    <body class="<?=$action;?>">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="">Family Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link <?=( $action == 'graph' ) ? 'active' : '';?>" href="?action=graph">Graph</a>
                    <a class="nav-link <?=( $action == 'list' ) ? 'active' : '';?>" href="?action=list">List</a>
                    <a class="nav-link <?=( $action == 'addedit' ) ? 'active' : '';?>" href="?action=addedit">Add</a>
                </div>
                </div>
            </div>
        </nav>

        <?php
            switch( $action ){
                case "graph":
                    include( $_SERVER['DOCUMENT_ROOT'] . '/pages/familyGraph.php' );
                    break;
                case "list": case 'addedit':

                    $familyService = new familyService( );
                    $requestService = new requestService( $_POST);
                    $pageTitle = "Family";

                    if( isset( $_POST[ 'deleteId' ] ) && isset( $_POST[ 'deleteType' ] ) ){
                        $deleteType = trim( $_POST[ 'deleteType' ] );
                        $deleteName = $_POST[ 'deleteName' ];

                        if( $deleteType == "familyDelete" ){
                            $familyService->deleteFamily( $_POST[ 'deleteId' ] );
                            $_SESSION[ "successMessage" ] = "The <b>" . $deleteName . "</b> was deleted.";
                        }
                    }

                    if( $action == "list" ){
                        $familyData = $familyService->getFamily( $familyId = 0 );
                        
                        include( $_SERVER['DOCUMENT_ROOT'] . '/pages/familyList.php' );
                    } else if( $action == "addedit" ){
                        $parentsData = $familyService->getParents( $familyId = $id );
                        $spousesData = $familyService->getSpouses( $familyId = $id );
                        $responceData = $requestService->addEditUpdateFamilyMember();

                        if (isset($responceData['status']) && $responceData['status'] === 'success' && isset($responceData['data']) && $responceData['data'] > 0){
                            //Redirect('?action=list', false);
                            echo "<script>window.location.href = '/index.php?action=list';</script>";
                        }

                        if( $id > 0 ){
                            $pageTitle = "Edit " . $pageTitle;
                            $familyData = $familyService->getFamily( $familyId = $id );
                            
                        } else {
                            $pageTitle = "Add " . $pageTitle;
                            $familyData = [ ];
                        }

                        include( $_SERVER['DOCUMENT_ROOT'] . '/pages/addEditFamily.php' );
                    }
                    break;
                case "export":
                    include( $_SERVER['DOCUMENT_ROOT'] . '/pages/exportData.php' );
                    break;
                default:
                    include( $_SERVER['DOCUMENT_ROOT'] . '/pages/familyGraph.php' );
            }
        
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
        <script src="/asset/js/admin.js"></script>

        <script>
            //new DataTable('#data_table');
            $('table.data_table').DataTable(
                {
                    columnDefs: [{ orderable: false, targets: -1 }],
                    scrollX: true
                }
            );
        </script>
    </body>

    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/deletePopupModal.php';
    ?>
</html>