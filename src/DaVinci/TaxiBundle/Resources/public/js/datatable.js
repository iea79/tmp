require(['jquery', 'jquery.dataTables', 'SyntaxHighlighter'], function() {
    SyntaxHighlighter.config.tagName = 'code';
    
    function filterPrice(data) {
        var priceFilter = parseInt($('#filter_price').val());
            
        if (isNaN(priceFilter) || 0 == priceFilter) {
            return true;
        }

        var min = 0;
        var max = 0;

        if (priceFilter == 1) {
            min = 10;
            max = 50;
        } 

        if (priceFilter == 2) {
            min = 50;
            max = 100;
        }

        if (priceFilter == 3) {
            min = 100;
            max = 150;
        }

        if (priceFilter == 4) {
            min = 150;
            max = 200;
        }

        if (priceFilter == 5) {
            min = 200;
        }

        var price = parseFloat(data[3].substr(1)) || 0; // using the data from the 4th column

        if ( 
            (0 == min && 0 == max) ||    
            (0 == min && age <= max) ||
            (min <= price && 0 == max) ||
            (min <= price && price <= max) 
        ) {
            return true;
        }
        
        return false;
    }
    
    function filterTips(data) {
        var tipsFilter = parseInt($('#filter_tips').val());
            
        if (isNaN(tipsFilter) || 0 == tipsFilter) {
            return true;
        }

        var min = 0;
        var max = 0;

        if (tipsFilter == 1) {
            min = 1;
            max = 5;
        } 

        if (tipsFilter == 2) {
            min = 5;
            max = 10;
        }

        if (tipsFilter == 3) {
            min = 10;
            max = 15;
        }

        if (tipsFilter == 4) {
            min = 15;
            max = 20;
        }

        if (tipsFilter == 5) {
            min = 20;
        }

        var price = parseFloat(data[4].substr(1)) || 0; // using the data from the 4th column

        if ( 
            (0 == min && 0 == max) ||    
            (0 == min && age <= max) ||
            (min <= price && 0 == max) ||
            (min <= price && price <= max) 
        ) {
            return true;
        }
        
        return false;
    }
    
    function filterPaymentMethod(data) {
        var methodFilter = parseInt($('#filter_method').val());
            
        if (isNaN(methodFilter) || 0 == methodFilter) {
            return true;
        }
        
        if (
            1 == methodFilter && data[5] == 'escrow'
            || 2 == methodFilter && data[5] == 'cash'
        ) {
            return true;
        }
        
        return false;
    }
    
    function filterStatus(data) {
        var statusFilter = parseInt($('#filter_status').val());
            
        if (isNaN(statusFilter) || 0 == statusFilter) {
            return true;
        }
        
        if (
            1 == statusFilter && data[6] == 'open'
            || 2 == statusFilter && data[6] == 'pending'
        ) {
            return true;
        }
        
        return false;
    }
    
    function filterPickupTime(data) {
        var pickupFilter = $('#filter_pickup').val();
            
        if (pickupFilter.length == 0 || pickupFilter.length != 19) {
            return true;
        }
        
        var fromDate = new Date(
            "20" + pickupFilter.substr(6, 2),
            pickupFilter.substr(3, 2) - 1,
            pickupFilter.substr(0, 2)
        );
        var toDate = new Date(
            "20" + pickupFilter.substr(17, 2),
            pickupFilter.substr(14, 2) - 1,
            pickupFilter.substr(11, 2)
        );
            
        var value = new Date(data[1].substr(0, 11));
        
        if (
            fromDate <= value
            && value <= toDate
        ) {
            return true;
        }
        
        return false;
    }
    
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            return (
                filterPrice(data) 
                && filterTips(data)
                && filterPaymentMethod(data)
                && filterStatus(data)
                && filterPickupTime(data)
            );
        }
    );
    
    $(document).ready(function() {
        var table = $('#filter_table').DataTable({
            paging: false,
            info: false,
            columns: [
                null,
                null,
                { orderable: false },
                null,
                null,
                null,
                null,
                { orderable: false }
            ]
        });
                    
        $('#filter_route').on('keyup change', function() {
            table
                .column(2)
                .search(this.value)
                .draw();
        });
        
        $('#filter_pickup').on('keyup change', function() {
            table
                .search(this.value)
                .draw();
        });
	});
	
	// remove preloader
    togglePreloader(document.body, false);
});