// JavaScript Document

$(document).ready(function() {
	$('#cari').on('keyup', function () {
		$('#block').load('get.php?cari=' + $('#cari').val())
		})
})