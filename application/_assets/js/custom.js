$(document).ready(function() {
    $("body").on('keypress','.quantity',(function(event) {
        if (event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) {
            return 0;
        }else if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    }));//Quantity Field Validation

    $('body').on('change', '.tax_type', function(event) {
        $(this).parent().next().children().next('span.total').text(function(){
            var sum = 0;
            var qtyVal=parseFloat($(this).parent().prevAll().eq(1).children(':first-child').val());
            var Cprice=parseFloat($(this).parent().prevAll().eq(2).children(':first-child').val());
            var rawper=parseFloat($(this).parent().prev().children(':first-child').find(':selected').data('per'));
            var percentage=calPercentage(rawper);
            if (!isNaN(Cprice) & !isNaN(Cprice) & !isNaN(qtyVal)) sum = qtyVal*Cprice*percentage;
            else sum = 0;
            return sum.toFixed(2);

        });
        sumUpTotal();
        sumUpPer();
    });//Tax Type

    $('body').on('click','.addDescription', function(event) {
        $(this).next().toggle('slow');
    });//Add Description Hide Show

    $('#addmore').on('click', function() {
        var cloneRow = $('.prods:first').clone();
        cloneRow.find("input").val("").end();
        cloneRow.find(".total").text("").end();
        cloneRow.find(".total").after('<button type="button" class="close label-danger margin-left-10"  data-original-title="Remove row" data-dismiss="alert">&times;</button>');
        cloneRow.find(".footerinput").css({"display":"none"});
        cloneRow.appendTo('#products');
        autoField();
    });//Add Dynamic Row

    $("#dashboardPage a:contains('Dashboard')").parent().addClass('active');
    $("#customerPage a:contains('Customer')").parent().addClass('active');
    $("#usersPage a:contains('Users')").parent().addClass('active');
    $("#productPage a:contains('Products')").parent().addClass('active');
    $("#invoicePage a:contains('Invoice')").parent().addClass('active');
    $("#settingPage a:contains('Settings')").parent().addClass('active');
    $("#reportsPage a:contains('Reports')").parent().addClass('active');
    $('body').on('click', '.delete', function(event) {
        if (!confirm("Are you sure! want to delete the Record?")) {
            return false;
        }
    });
});//Documents Ready
$(function() {
    $('.btn').tooltip();
    $('.btn').tooltip({placement: 'top'});
});

jQuery.validator.setDefaults({
    errorPlacement: function(error, element) {
        // if the input has a prepend or append element, put the validation msg after the parent div
        if(element.parent().hasClass('input-prepend') || element.parent().hasClass('input-append')) {
            error.insertAfter(element.parent());
            // else just place the validation message immediatly after the input
        } else {
            error.insertAfter(element);
        }
    },
    errorElement: "small", // contain the error msg in a small tag
    wrapper: "div", // wrap the error message and small tag in a div
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error'); // add the Bootstrap error class to the form group
        $(element).closest('.form-group').removeClass('has-success'); // remove the Boostrap Success class from the form group

    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error'); // remove the Boostrap error class from the form group
        $(element).closest('.form-group').addClass('has-success'); // add the Bootstrap success class to the form group
    }
});