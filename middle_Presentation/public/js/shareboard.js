function search() {
    var keyword = $('#searchBar')[0].value;
    
    var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "#",
            data: {keyword:keyword, _token:token},
            
            success: function( json ) {
                
                
    
            }
}