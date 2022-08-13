<html>
<head>
<title>Bond Web Service Demo</title>
<style>
	body {font-family:georgia;}
</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">

function booksTemplate(book){
  return`
      <div class="book">
      <b>Title</b>: ${book.Title} <br />
      <b>Author</b>: ${book.Author}<br />
      <b>Year</b>: ${book.Year} <br />
      <b>Genre</b>: ${book.Genre} <br />  
      </div>
  
  `;
}
        

$(document).ready(function() {  

	$('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
		cat = $(this).attr("href");  //get category from URL

    var request = $.ajax({
       url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);

    $("#mytitle").html(data.title);

     $("#list").html("");

     $each (data.book, function (i,item) {
       let myData = booksTemplate(item);
       $("<div></div>").html(myData).appendTo("#list");
       
       
     })
   });
     request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
     
	});
});	


</script>
</head>
	<body>
	<h1>Best 10 books </h1>
		<a href="year" class="category">Best 10 books based on the year</a><br />
		<a href="box" class="category">Top 10 books based on sold copies</a>
		<h3 id="mytitle">Title Will Go Here</h3>
		<div id="list">
		</div>
		<div id="output">Results go here</div>
	</body>
</html>
