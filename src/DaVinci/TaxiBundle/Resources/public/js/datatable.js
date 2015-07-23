require(['jquery', 'jquery.dataTables', 'SyntaxHighlighter'], function() {
    SyntaxHighlighter.config.tagName = 'code';
    
    $(document).ready(function() {
        var table = $('#filter_table').DataTable();
        
        // Apply the search
        table.columns().every(function() {
            var that = this;

            $('input', this.footer()).on('keyup change', function() {
                that
                    .search(this.value)
                    .draw();
            });
        });
	});
	
	// remove preloader
    togglePreloader(document.body, false);
});