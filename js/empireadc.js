

		$('#initiateSearch').click(function(){
			// Clear the selected facets of the previous search
			$("#selectedFacet").empty();
			$('input#queryTag').val('');
			var searchTerm = $('input#searchBox').val();
			var searchTerm = searchTerm.trim();
			var searchTerm = searchTerm.replace(/ /g,"%20");
			var searchTerm = searchTerm.replace(/'/g,"%27");
			var searchTerm = encodeURIComponent(searchTerm);
			var facet = 'NULL';

			if(searchTerm != "" ) {
				if(searchTerm == "*"){
					var resultUrl = "http://www.empireadc.org/search/searchAll";
				}else{
					var resultUrl = "http://www.empireadc.org/search/searchKeyWords" + "/" + searchTerm + "/" + facet ;
				}
			}
			$('#searchResults').load(resultUrl);
		});
