<?php
include_once "../../../components/public-user/templates/user-navbar.php";
include_once "functionalities/user-session.php";

include_once "functionalities/display-edit-affiliations.php";


include_once "functionalities/options.php";

?>

<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="author-profile.css">
<link rel="stylesheet" href="../../../css/animatev4.1.1.min.css" />
<div id='whole-page'>


    <!-- profile page -->
    <div id="author-page">

        <div class="page-title">
            <h3 class="animate__animated animate__zoomIn">AUTHOR DETAILS</h3>
        </div>
        <div class="profile-container">

            <div class="profile-details">
                <label class='author-header'>AUTHOR INFORMATION</label>
                <div class="profile-row">
                    <label for="affiliation">Author Identification Code:</label>
                    <p>
                        <?php echo $author_user['author_id'] ? $author_user['author_id'] : 'Not Yet Set'; ?>
                    </p>
                </div>
                <div class="profile-row">
                    <label for="affiliation">Type:</label>
                    <p>
                        <?php echo $author_user['type_of_author'] ? $author_user['type_of_author'] : 'Not Yet Set'; ?>
                    </p>
                </div>
                <div class="profile-row">
                    <label for="affiliation">Name:</label>
                    <p>
                        <?php echo $author_user['author_name'] ? $author_user['author_name'] : 'Not Yet Set'; ?>
                    </p>
                </div>
                <div class="profile-row">
                    <label for="affiliation">Affiliation:</label>
                    <p>
                        <?php
                        //check if affiliation is null
                        if (@$author_user['affiliation'] == false) {
                            echo "N/A";
                        } else {
                            //display affiliation 
                            $affiliation = explode(' || ', $author_user['affiliation']); //separate internal and external affiliation
                        
                            // initializations
                            $internal_affiliation = "";  //container for internal
                            $external_affiliation = "";  //container for external
                        
                            //extract internal
                            if (count($affiliation) > 0) {
                                foreach (explode('_', $affiliation[0]) as $in_aff) {
                                    if ($in_aff != "") {
                                        $internal_affiliation .= $in_aff . ", BatStateU <br>";

                                    } else {
                                        $internal_affiliation = "";
                                    }

                                }
                            }

                            //extract external
                            if (count($affiliation) > 1) {
                                foreach (explode('_', $affiliation[1]) as $ex_aff) {
                                    $external_affiliation = $ex_aff . "<br>";
                                }
                            }

                            //if both empty 
                            if ($internal_affiliation == "" && $external_affiliation == "") {
                                echo "N/A";
                            }
                            //if existing
                            else {
                                $all_affiliation = array($internal_affiliation, $external_affiliation);
                                echo implode('', $all_affiliation);
                            }


                        }

                        ?>
                    </p>
                </div>

            </div>

        </div>
        <label id='author-pubs'>AUTHOR'S WORKS</label>
        <div id='author-info' style='display: flex; justify-content: center;'>
            <?php
            include_once "functionalities/author-data.php";
            display_publications($conn, $author_user['author_id']);
            display_ipassets($conn, $author_user['author_id']);
            ?>
        </div>
    </div>
</div>
<script src='show-hide-password.js'></script>
<script src='edit-info.js'></script>

<?php
include_once "functionalities/affiliations.php";
?>