          <!-- footer content -->
          <footer style="margin-top:auto">
              <div class="pull-right">
                  Developed by Softguide Team
              </div>
              <div class="clearfix"></div>
          </footer>
          <!-- /footer content -->
      </div>
    </div>
    <!-- Custom Theme Scripts -->
    <script src="<?= $base_url ?>assets/backend/js/custom.js"></script>
    <script src="<?= $base_url ?>assets/backend/js/validator/custom.js"></script>

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
  </body>