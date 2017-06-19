// JavaScript Document
function detailsmodal(id){
	var data = {"id": id};
	jQuery.ajax({
		url: 'isi/modal.php',
		method: "post",
		data: data,
		success: function(data){
			jQuery('body').append(data);
			jQuery('#details-modal').modal('toggle');
		},
		error: function(){
			alert("something went wrong!");
		}
	});
}
function closeModal(){
	jQuery('#details-modal').modal('hide');
	setTimeout(function(){
		jQuery('#details-modal').remove();
		jQuery('.modal-backdrop').remove();
	},500);	
}

function MyCtrl($scope, $window) {
    $scope.name = 'Superhero';
    MyCtrl.prototype.$scope = $scope;
}

var myApp = angular.module('myApp',[]);
function MyCtrl($scope, $window) {
    $scope.name = 'Superhero';
    MyCtrl.prototype.$scope = $scope;
}
MyCtrl.prototype.setFile = function(element) {
    var $scope = this.$scope;
    $scope.$apply(function() {
        $scope.theFile = element.files[0];
    });
};

$('form').attr('novalidate', true);

$('form').submit(function(e) {
    e.preventDefault();
    if(!$('input[name="kelamin"]:checked').val()) {
        $('input[name="kelamin"]')[0].setCustomValidity("Please select one of the fruits.");
        this.reportValidity();
        return;
    }
    this.submit();
});