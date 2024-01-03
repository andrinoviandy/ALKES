// JavaScript Document
  $(document).ready(function() {
    selesai();
});
 
function selesai() {
	setTimeout(function() {
		update();
		selesai();
	}, 100);
}
 
function update() {
	//if (isset($_GET['tgl1'])) {
	$.getJSON("json/pembelian_alkes.php", function(data) {
		$("tbody").empty();
		var no = 1;
		$.each(data.result, function() {
			$("tbody").append("<tr><td>"+(no++)+"</td><td>"+this['no_po_pesan']+"</td><td>"+this['tgl_po_pesan']+"</td></tr>");
		});
	});
	//}
}