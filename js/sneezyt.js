/**
 * Functions for sneezy 
 */
var sneezySingleton = new function sneezySingleton() 
{
	var instance = this;
	sneezySingleton.getInstance = function() {
		return instance;
	};
	
	this.toString = function() {
		return "[object Singleton]";
	};

 	function initializeMergeType() {
 		$( "#type-merge-from" ).autocomplete({
			  source: base_url + "index.php/food/get_types",
		      minLength: 1
		});
 		
 		$( "#type-merge-to" ).autocomplete({
			  source: base_url + "index.php/food/get_types",
		      minLength: 1
		});
 		
 		$('#type-merge-submit button').click( function() {
 			sneezySingleton.getInstance().submitMerge();
		});
 	};
 	this.initializeMergeType = initializeMergeType;
 	
 	function submitMerge() {
  	 	 var p = {};
	     p['type-merge-from'] = $('#type-merge-from').val();
	     p['type-merge-to'] = $('#type-merge-to').val();
	      
	     $('#merge-response').load(base_url + 'index.php/maintain/merge',p,function(str){
	    	 setTimeout(function() {
	    		 $('#merge-response').empty();
	    	 	} ,1500);
	     });
	     
	     $( '#type-merge-to').val('');
	     $( '#type-merge-from').val('').focus();
 	};
 	this.submitMerge = submitMerge;
 	
    return sneezySingleton;
};
