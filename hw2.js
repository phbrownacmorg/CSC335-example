//alert('JS file read');

$(function() {
    //alert('loaded');
    $(':button').click(function() {
       $('body').append('<table></table>');
       // Create header row
       $('table').append('<tr></tr>');
       $('tr').append('<th>Station name</th>');
       $('tr').append('<th>Address</th>');
       $('tr').append('<th>Latitude</th>');
       $('tr').append('<th>Longitude</th>');
       
       $.get('GSP-Fire-Stations.csv', function(data) {
           var stations = Papa.parse(data).data;
           var idx = [2, 3, 1, 0];
           //alert(csvdata.data);
           for (var row = 0; row < stations.length; row++) {
               $('table').append('<tr></tr>');
               for (var col = 0; col < idx.length; col++) {
                   $('tr:last').append('<td></td>');
                   $('td:last').text(stations[row][idx[col]]);
               }
           }
       });
       
       // Disable the button, since it has no further use
       $(':button').attr('disabled', 'yes');
    });
});