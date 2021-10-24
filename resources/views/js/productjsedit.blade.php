{{--    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>--}}
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script>
    $(document).ready(function (){
        $('.grandTotal').attr('readonly',true);
    });
    $(document).ready(function (){
        $('.rowAdd').click(function (){
            var getTr = $('tr.rowFirst:first');
            $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"<tr>");
            var defultRow = $('tr.removableRow:last');
            defultRow.find('select.product').attr('disabled',false);
            defultRow.find('input.categoryName').attr('readonly',true).val('');
            defultRow.find('input.categoryId').val('');
            defultRow.find('input.brandName').attr('readonly',true).val('');
            defultRow.find('input.brandId').val('');
            defultRow.find('input.stockQty').attr('readonly',true).val('');
            defultRow.find('input.salePrice').attr('readonly',true).val('');
            defultRow.find('input.saleQty').val('');
            defultRow.find('input.totalItemPrice').val('');
        });
    });
    // $(document).on("click","span.rowRemove",function (){ //user for delete all row one by one
    //     $(this).closest("tr.removableRow").remove();
    // });
    $(document).on("click", "span.rowRemove ", function () {//delete all row one by one but except last one row
        var count = $("#productId tr").length - 1;
        if (count > 1) {
            $(this).parents("tr").remove();
        }
    });

    $(document).on('change','.product',function (){
        var thisRow = $(this).closest('tr');
        var productId = thisRow.find('.product').val();

        $.ajax({
            type: "GET",
            url : "/admin/product-details/"+productId,//this id from form vai request
            data: {'productId':productId},
            success: function (data){
                thisRow.find('.categoryId').val(data.category_id); //user for append data into row column product wise
                thisRow.find('.categoryName').val(data.name);
                thisRow.find('.brandId').val(data.brand_id);
                thisRow.find('.brandName').val(data.brandName);
                thisRow.find('.stockQty').val(data.qty);
                thisRow.find('.salePrice').val(data.sale_price);
                thisRow.find('.price').val(data.sale_price);
            }
        });

    });

    $(document).on('keyup change load','.saleQty',function () {
        var total = 0;
        var thisRow = $(this).closest('tr');
        var saleQty = parseFloat($(this).val())||0;
        var productPrice = parseFloat(thisRow.find('.price').val() || 0) ;
        var discountAmount = $('.discount').val()||0;
        var paidAmount = $('.totalPrice').val()||0;

        var priceAmount = productPrice * saleQty;

        thisRow.find('.totalItemPrice').val(parseFloat(priceAmount).toFixed(2));

        $('.totalItemPrice').each(function (){
            total += parseFloat($(this).val())||0;
        });

        $('.subTotal').val(parseFloat(total).toFixed(2));

        var subTotal = $('.subTotal').val()||0;
        var discountPercent = parseFloat((subTotal*discountAmount)/100)||0;
        var grandTotal = subTotal - discountPercent;

        $('.grandTotal').val(parseFloat(grandTotal).toFixed(2));
        var gTotal = $('.grandTotal').val()||0;
        var changTotal = parseFloat(paidAmount) - parseFloat(gTotal);
        var dueTotal = parseFloat(gTotal) - parseFloat(paidAmount);
        if(gTotal <= paidAmount){
            $('#due').val(0.00);
            $('#change').val(parseFloat(changTotal).toFixed(2));
            $('#changeTotal').show();
            $('#dueTotal').hide();
        }else{
            $('#changeTotal').hide();
            $('#dueTotal').show();
            $('#due').val(parseFloat(dueTotal).toFixed(2));
            $('#change').val(0.00);
        }
    });

    $(document).on('keyup change','.discount',function (){
        var productDis = $(this).val()||0;
        var subTotal = parseFloat($('.subTotal').val())||0;
        var totDiscount = parseFloat((subTotal * productDis)/100)||0;
        var grandTotal = subTotal - totDiscount;

        $('.grandTotal').val(parseFloat(grandTotal).toFixed(2));
    });

    $(document).on('keyup change','.totalPrice',function (){
        var paidAmount = parseFloat($(this).val()) || 0;
        var grandTotal = parseFloat($('.grandTotal').val()) || 0;

        var dueTotal = parseFloat(grandTotal) - parseFloat(paidAmount);

        if(grandTotal <= paidAmount){
            $('#due').val(0.00);
            $('#change').val(parseFloat(parseFloat(paidAmount) - parseFloat(grandTotal)).toFixed(2));
            $('#changeTotal').show();
            $('#dueTotal').hide();
        }else{
            $('#changeTotal').hide();
            $('#dueTotal').show();
            $('#due').val(parseFloat(dueTotal).toFixed(2));
            $('#change').val(0.00);
        }
    })

    $(document).on('change click','.product', function() {// use for disable same product select
        $('option').prop('disabled', false);
        $('select').each(function() {
            var val = $(this).val();
            $('select').not(this).find('option').filter(function() {
                return this.value === val;
            }).prop('disabled', true);
        });
    });
</script>
