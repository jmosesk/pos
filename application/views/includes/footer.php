
  </div><!-- mainpanel -->
</section>

</body>

<script>
    $(window).on('load', function() {
        var url = window.location.href.split('#')[0];
        var li = $('#main_menu');
        $.each(li.children(), function() {
            $(this).removeClass("nav-active");
        });
        //alert(url);
        var active_a = $('a').filter(function() {
            //alert(this.hrefx);
            return this.href == url;
        });

        /*var parent = active_a.closest('.main-menu');
        var master_parent = active_a.closest('.main-menu').css( "background-color", "red" );*/
        //active_a.prev().css( "background-color", "red" );
        //parent.css("background-color", "red");

        var parent = active_a.closest("li").parent().parent();
        parent.addClass('active');
        //parent.closest('a').css( "background-color", "red" );
        active_a.addClass('active');

        active_a.closest("li").addBack().addClass('active');
        active_a.closest("ul.children").css({"display": "block"});
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#no-pagination').DataTable({
        "paging":   false,
        "info":     false,
      });
      $('#no-pagination-ordering').DataTable({
        "paging":   false,
        "info":     false,
        "ordering": false,
      });
      $('#no-ordering').DataTable({
        "ordering": false,
      });
      $('#export').DataTable( {
          "paging":   false,
          "info":     false,
          "ordering": false,
          dom: 'Bfrtip',
          buttons: [
           {
                extend: 'excel',
                filename: 'FMS Report',
                title: '',
                text:'<i class="fa fa-table fainfo" aria-hidden="true" ></i>',
                titleAttr: 'Export Excel',
                exportOptions: {
                 columns: ":not(.not-export-column)"
              }
            },
            {
                extend: 'pdf',
                filename: 'FMS Report',
                title: '',
                exportOptions: {
                 columns: ":not(.not-export-column)"
              }
            },
            {
                extend: 'print',
                title: '',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            $("#preped").html()
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            }
          ]
      });
      $('#export-page').DataTable( {
          "paging":   false,
          "ordering": false,
          dom: 'Bfrtip',
          buttons: [
           {
                extend: 'excel',
                filename: 'FMS Report',
                title: ''
            },
            {
                extend: 'pdf',
                filename: 'FMS Report',
                orientation: 'landscape',
                title: ''
            }
          ]
      });
        $('#changepwrdForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
            oldpasswrd: {
                validators: {
                    notEmpty: {
                        message: "Please fill in old password"
                    }
                }
            },
          passwrd: {
            validators: {
              notEmpty: {
              message: "Please fill in new password"
              }
              }
            },
          cpasswrd: {
            validators: {
              notEmpty: {
              message: "Please confirm new password"
              },
              identical: {
              field: 'passwrd',
                message: 'Confirm password must match password'
                }
              } 
            }
            }
        })
      .on('success.form.bv', function(e) {
          // Prevent form submission
          e.preventDefault();
          // Get the form instance
          var $form = $(e.target);

          // Get the BootstrapValidator instance
          var bv = $form.data('bootstrapValidator');

          // Use Ajax to submit form data
          $.ajax({
          url: '<?php echo base_url(); ?>user/changepwd',
          type: 'post',
          data: $('#changepwrdForm :input'),
          dataType: 'html',   
          success: function(html) {
            $('#changepwrdForm')[0].reset();
            $('#changepwrd').modal('hide');
            bootbox.alert(html, function()
              {
              window.location.reload();
              });
            }
        });
      });
    });

    function format_amount(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function format_amount_decimals(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    function format_percent(numerator, denominator) {
        if (parseFloat(denominator) == 0 || isNaN(denominator)) {
            return 0;
        } else if (parseFloat(numerator) == 0 || isNaN(numerator)) {
            return 0;
        } else {
            return ((numerator/denominator) * 100);
        }
    }

    function sum_amnt(num1, num2) {
      var total = 0;
        if (parseFloat(num1) == null || isNaN(parseFloat(num1)) || num1 == null || isNaN(num1) || (typeof num1 === 'undefined')) {
            num1 = 0;
        } else if (parseFloat(num2) == null || isNaN(parseFloat(num2)) || num2 == null || isNaN(num2) || (typeof num2 === 'undefined')) {
            num2 = 0;
        }
        num1 = parseFloat(num1);
        num2 = parseFloat(num2);
        total = parseFloat(num1) + parseFloat(num2);
        return parseFloat(total).toFixed(2);
    }

    function strip_empty(str) {
        if(str !== null && str !== '' && (typeof str !== 'undefined')) {
            return str;
        } else 
            return "";
    }
</script>
</html>