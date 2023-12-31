<?php
    require("../requires/check_auth.php");
    require("../requires/connect.php");
    require("../requires/common.php");
    require("../requires/include_functions.php");
    $header_title    = "Hotel Booking::Create Room View";

    $proc_error      = false;
    $error_message   = "";
    $table           = "views";
    if (isset($_POST["submit"]) && $_POST["form-submit"] == 1) {
        $name= $mysqli->real_escape_string($_POST["name"]);


        /** Check Database Existence */
        $check_database_existence = checkDatabaseExistence($mysqli, $table, $name);
        if (isset($check_database_existence["error"]) == true) {
            $proc_error           = true;
            $error_message        = $check_database_existence["error_message"];
        }
        /** End of Check Database Existence */
         
        /** Check Space Input*/

        if(rtrim($name)){
            $process_error = true;
            $error_message = "Insert Unique Name";
        }
       /*end Check Space Input */

        if ($proc_error == false) {
            $data         = ["name"=> $name];
            $insert_query = insertQuery($mysqli, $table, $data);  
            
            $url          = $cp_base_url . "show_room_view.php?message=success";
            header("Location:" . $url);
            exit();
        } 
    }
    require("../templates/cp_header.php");
    require("../templates/cp_top_nav_bar.php");
    require("../templates/cp_left_side_bar.php");
?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_content">

                            <form class="" action="<?= $cp_base_url ?>create_room_view.php" method="POST" novalidate>
                                <span class="section">Create Room View</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" name="name" placeholder="eg. Lake View" required="required" />
                                    </div>
                                </div>
                                <div class="ln_solid">
                                    <div class="form-group">                                       
                                        <div class="col-md-6 offset-md-3 mt-2">
                                            <button type='submit' name="submit" class="btn btn-primary">Submit</button>
                                            <button type='reset' class="btn btn-success">Reset</button>
                                            <input type="hidden" name="form-submit" value="1">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
<?php if ($proc_error == true) : ?>
    <!-- <script>
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);

        // on form "submit" event
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
    </script> -->
<?php endif ?> 

<?php 
    require("../templates/cp_footer.php");
?>
    <!-- PNotify -->
        <script src="<?= $base_url ?>assets/backend/js/pnotify/dist/pnotify.js"></script>
        <script src="<?= $base_url ?>assets/backend/js/pnotify/dist/pnotify.buttons.js"></script>
        <script src="<?= $base_url ?>assets/backend/js/pnotify/dist/pnotify.nonblock.js"></script>
        <script>
            <?php if ($error == true) : ?>
            $(document).ready(function () {
                new PNotify({
                title   : 'Oh No!',
                text    : '<?= $error_message ?>',
                type    : 'error',
                styling : 'bootstrap3'
                });
            })
            <?php endif ?>
    </script>
</html>


